<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * @OA\Put(
     *     path="/transactions/{transaction}/{id}",
     * @OA\RequestBody(
     *         required=true,
     *         description="Request body in JSON format",
     *         @OA\JsonContent(
     *             @OA\Property(property="amount", type="number", example="105"),
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Entity id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="transaction",
     *          description="topup or withdraw",
     *          required=true,
     *          in="path",
     *           @OA\Schema(
     *             type="string",
     *             enum={"withdraw", "topup"},
     *             default="topup"
     *          )
     *      ),
     * 
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(Request $request, string $transaction, string $id)
    {
        $rules = array(
            'amount' => 'required|int',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        return $this->transactionService->transaction($request->amount, $transaction, $id);
    }
}
