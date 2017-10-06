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

    public function CsvConvertArray(Request $request)
    {

        $file = $request->file('file');
        $data = csv_to_array($file[0]);
        return $data;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->service->createBillboards($data);
        $response = [
            'message' => 'Billboards imported.',
            'data' => $data,
        ];

        return $response;
    }

}
