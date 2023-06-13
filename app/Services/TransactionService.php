<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionService
{
    protected $entityService;
    protected $companyService;

    public function __construct(EntityService $entityService, CompanyService $companyService)
    {
        $this->entityService = $entityService;
        $this->companyService = $companyService;
    }

    public function transaction(int $amount, string $transaction, string $id)
    {
        $entity = $this->entityService->getEntityById($id);

        if ($entity == null) {
            return response()->json(['error' => 'Entity not found']);
        }

        if ($transaction != 'topup' && $transaction != 'withdraw') {
            return response()->json(['error' => 'Invalid transaction type']);
        }

        $netAmount = $amount * 0.95;
        $entityBalance = $this->entityService->getEntityBalance($id);

        if ($transaction == 'topup') {
            $entityBalance = $entityBalance + $netAmount;
        } else if ($transaction == 'withdraw') {

            if (is_null($entityBalance) || $entityBalance < $amount) {
                return response()->json(['error' => 'Not Enough Balance!']);
            }

            $entityBalance = $entityBalance - $amount;
            
        }

        $transactionId = $this->recordTransaction($amount, $transaction);
        $this->entityService->updateEntityBalance($transactionId, $id, $entityBalance);

        return response()->json(['entity' => $entity, 'current_balance' => $entityBalance]);
    }

    public function recordTransaction($amount, $transaction_type)
    {
        $transactionId = DB::collection('transactions')->insertGetId([
            'transaction_total' => $amount,
            'transaction_comission' => $amount * 0.05,
            'net_transaction' => $amount * 0.05,
            'transaction_type' => $transaction_type,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        $companyBalance = $this->companyService->getCompanyBalance();

        DB::collection('company_balance')->insert([
            'transaction_id' => $transactionId,
            'current_balance' => $companyBalance + ($amount* 0.05),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        return $transactionId;
    }
}
