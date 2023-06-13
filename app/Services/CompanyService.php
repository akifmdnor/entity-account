<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CompanyService
{

    public function getCompanyBalance()
    {

        $current_balance = DB::collection('company_balance')->orderBy('_id', 'desc')->first();
        if (is_null($current_balance)) {
            $company_balance = 0;
        } else {
            $company_balance =  $current_balance["current_balance"];
        }

        return $company_balance;
    }
}
