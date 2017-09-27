<?php
/**
 * Created by PhpStorm.
 * User: vfb
 * Date: 9/14/17
 * Time: 9:15 AM
 */

namespace App\Http\Controllers\Api;


use App\Http\Requests\BillboardCreateRequest;
use App\Services\BillboardsImportService;
use Illuminate\Http\Request;
use Validator;

class BillboardsCsvController
{

    public function CsvConvertArray(Request $request){

        $file = $request->file('file');
        $data = $this->csv_to_array($file[0]);

        //$this->service->createBillboards($data);

        return $data;


    }

    private function csv_to_array($filename, $delimiter = ',')
    {
        if (!$filename){
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
}