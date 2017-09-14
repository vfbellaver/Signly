<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class CsvUploadController extends Controller
{
    public function index()
    {
        return view('billboard.upload-csv');
    }
}
