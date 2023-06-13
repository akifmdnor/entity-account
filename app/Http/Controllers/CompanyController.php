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
    
    public function index()
    {
        return response()->json(['balance' => $this->companyService->getCompanyBalance()]);
    }
}
