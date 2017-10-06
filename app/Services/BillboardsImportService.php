<?php
/**
 * Created by PhpStorm.
 * User: vfb
 * Date: 9/15/17
 * Time: 11:34 AM
 */

namespace App\Services;



use App\Events\BillboardCreated;
use App\Forms\BillboardForm;
use App\Models\Billboard;
use function Deployer\add;

class BillboardsImportService
{

    // save Billboards
    public function createBillboards(array $data)
    {
        foreach ($data['billboards'] as $billboard){
                    log($billboard);
//                $billboard = new Billboard($billboard);
//                $billboard->save();
            }
    }
}
