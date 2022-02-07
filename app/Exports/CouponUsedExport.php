<?php

namespace App\Exports;

use App\Models\UsedCoupon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CouponUsedExport implements FromCollection,WithHeadings
{
    public function headings():array
    {
        return[
            'order id',
            'user',
            'coupon code',
            'discounted price'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $coupons = UsedCoupon::all();
        $list = array();
      foreach(  $coupons  as $item)
      {
          $list[]=[
            $item->getOrder->id,
            $item->getUser->email,
            $item->getCoupon->code,
            $item->discounted_price
          ];
      }
        return collect($list);
    }
}
