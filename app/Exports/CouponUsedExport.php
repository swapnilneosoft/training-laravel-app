<?php

namespace App\Exports;

use App\Models\UsedCoupon;
use Maatwebsite\Excel\Concerns\FromCollection;

class CouponUsedExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UsedCoupon::all();
    }
}
