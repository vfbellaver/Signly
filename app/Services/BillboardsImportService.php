<?php
/**
 * Created by PhpStorm.
 * User: vfb
 * Date: 9/15/17
 * Time: 11:34 AM
 */

namespace App\Services;



class BillboardsImportService
{

    protected $valid = true;

    public function checkImportCsv(array $data){

        // verifies that the data already exists in the DB
        $exist = $this->checkBillboardsExists($data);

        //if the data exist, it informs the existence
        if(count($exist) > 0){
            $this->valid = false;
            $this->addBillboardExistErrorMessage($data);
        }
        return $this->valid;
    }


    // check if it already exists in DB
    private function checkBillboardsExists($address)
    {

    }

    // add message error case billboard exists
    private function addBillboardExistErrorMessage($exist, $header, $rows)
    {

    }



    // save Billboards
    public function createBillboards($header, $rows)
    {

    }

}