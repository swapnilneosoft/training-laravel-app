<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CouponUsedExport;
use App\Exports\CustomerExport;
use App\Exports\SalesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Return_;

class ReportController extends Controller
{
    public function getCustomerReport()
    {
        return Excel::download(new CustomerExport,'customer.xlsx');
    }
    public function getUsedCouponReport()
    {
        return Excel::download(new CouponUsedExport,'coupon.xlsx');
    }
    public function getSalesReport()
    {
        return Excel::download(new SalesExport,'sales.xlsx');
    }
}
