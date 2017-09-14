<?php
/**
 * Created by PhpStorm.
 * User: vfb
 * Date: 9/14/17
 * Time: 9:15 AM
 */

namespace App\Http\Controllers\Api;


class CsvUploadController
{
    public function CsvUpload(){
        $files = request()->file('file');

    }
}