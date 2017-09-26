<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\BillboardsImportService;
use Illuminate\Http\Request;
use Symfony\Component\Finder\SplFileInfo;

class BillboardsCsvController extends Controller
{
    private $service;

    public function __construct(BillboardsImportService $service)
    {
        $this->middleware('needsRole:admin');
        $this->service = $service;
    }

    public function index()
    {
        return view('billboard.upload-csv');
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

    public function CsvConvertArray(Request $request){

                $file = $request->file('file');
                $data = $this->csv_to_array($file[0]);

                //$this->service->createBillboards($data);

                return $data;


        }

}
