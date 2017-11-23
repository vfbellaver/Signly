<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\BillboardsImportService;
use Illuminate\Http\Request;
use Symfony\Component\Finder\SplFileInfo;

class BillboardsCsvController extends Controller
{
    public function index()
    {
        return view('billboard.upload-csv');
    }
}
