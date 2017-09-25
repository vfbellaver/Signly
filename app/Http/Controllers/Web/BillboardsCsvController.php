<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\BillboardsImportService;
use Illuminate\Http\Request;

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

        return $data;
    }

    public function CsvUpload(Request $request){
                $validator = \Validator::make($request->all(),[
                   'file' => 'required'
                ]);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator);
                }

                $file = $request->file('file');
                $data = $this->csv_to_array($file);

                $this->service->createBillboards($data);

                $response = [
                    'message' => 'Billboard created.',
                    'data' => $data
                ];

                return $response;


        }

}
