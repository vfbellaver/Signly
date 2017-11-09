<?php

namespace App\Http\Controllers\Web;

use App\Models\Billboard;
use App\Models\BillboardFace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mpdf\Mpdf;

class PDFController extends Controller
{
    public function index ()
    {
        $billboard = Billboard::query()->find(1);
        $faces = BillboardFace::query()->where('billboard_id','=',1);
        $mpdf = new Mpdf();
        return view('pdf.index',compact('billboard','faces','mpdf'));
    }
}
