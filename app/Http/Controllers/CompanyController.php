<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * @OA\Get(
     *     path="/company-balance",
     *     @OA\Response(response="200", description="Get current balance of the company")
     * )
     */
    public function index()
    {
        return response()->json(['balance' => $this->companyService->getCompanyBalance()]);
    }
}
