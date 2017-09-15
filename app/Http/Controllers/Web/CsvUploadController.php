<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillboardCreateRequest;
use App\Services\BillboardsImportService;
use Illuminate\Http\Request;
use Validator;

class CsvUploadController extends Controller
{
    public function index()
    {
        return view('billboard.upload-csv');
    }

    private function csv_to_array($filename, $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                    continue;
                }
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        dd($data);
        return $data;
    }

    public function CsvUpload(Request $request){

                $file = $request->file('file');
                $this->csv_to_array($file);


//
//            if(!$billboardImport->checkImportCsv($rows,$header)){
//                $request->session()->flash('errors_rows',$billboardImport->getErrorRows());
//                flash()->error('Error in data. Correct and re-upload');
//                return redirect()->back();
//            }
//
//
//            $billboardImport->createBillboards($header,$rows);
//
//            //return message after insertion
//            //flash('billboards imported')
//            return redirect()->back();



        }
}
