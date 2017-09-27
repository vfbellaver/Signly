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





}
