<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class EntityService
{

    public function getAllEntities()
    {

        // this request is handled by cache due to having possinbility of 1 million plus data
        // cache frequency is 1 day because data is updated less than once per day
        $entities = Cache::get('entities');

        if ($entities == null) {
            $entities = Cache::remember('entities', 86400, function () {
                return DB::collection('entities')->get();
            });
        }
        return response()->json($entities);
    }

    public function getEntityById(string $id)
    {
        $entity = DB::collection('entities')->where('_id', $id)->first();
        return $entity;
    }

    public function getEntityBalance(string $id)
    {
        $entityBalance = DB::collection('entities_balance')->where('entity_id', $id)->orderBy('_id', 'desc')->first();

        $currentBalance = 0;

        if (is_null($entityBalance)) {
            $currentBalance = 0;
        } else {
            $currentBalance = $entityBalance["current_balance"];
        }

        return $currentBalance;
    }

    public function updateEntityBalance($transactionId, $id, $currentBalance) {
        
        DB::collection('entities_balance')->insert([
            'transaction_id' => $transactionId,
            'entity_id' => $id,
            'current_balance' => $currentBalance,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

    }
}
