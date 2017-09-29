<?php
/**
 * Created by PhpStorm.
 * User: vfb
 * Date: 9/14/17
 * Time: 9:15 AM
 */

namespace App\Http\Controllers\Api;


use App\Services\BillboardsImportService;
use Illuminate\Http\Request;

class BillboardsCsvController
{
    public function __construct(BillboardsImportService $service)
    {
        $this->service = $service;
    }

    public function CsvConvertArray(Request $request){

        $file = $request->file('file');
        $data = $this->csv_to_array($file[0]);
        return $data;


    }

    private function csv_to_array($filename, $delimiter = ',')
    {
        if (!$filename) {
            return false;
        }
        $header = null;
        $data = array();

        if (($handle = @fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                    continue;
                }
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;

    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->service->createBillboards($data);
        $response = [
            'message' => 'Billboards imported.',
        ];

        return $response;
    }

}
