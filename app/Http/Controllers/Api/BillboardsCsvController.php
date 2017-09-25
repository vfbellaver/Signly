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
use Validator;

class BillboardsCsvController
{
    public function CsvUpload(BillboardCreateRequest $request, BillboardsImportService $billboardImport){


        $validator = Validator::make($request->all(),[
            'file'=> 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }


        $file = request()->file('file');
        $csvData = file_get_contents($file);

        $rows = array_map('str_getcsv',explode("\n",$csvData));
        $header = array_shift($rows);

        if(!$billboardImport->checkImportCsv($rows,$header)){
            $request->session()->flash('errors_rows',$billboardImport->getErrorRows());
            \Session::flash()->error('Error in data. Correct and re-upload');
            return redirect()->back();
        }


        $billboardImport->createBillboards($header,$rows);

        //return message after insertion
        //flash('billboards imported')
        return redirect()->back();



    }
}