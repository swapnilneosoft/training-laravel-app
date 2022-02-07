<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'order id',
            'user',
            'address',
            'amount',
            'payment mode',
            'payment status',
            "payment_id",
            "transaction_id",
            "coupon_used",
            "status"
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $order = array();
        $list = Order::all();
        foreach ($list as $item) {
            $order[] = [
                $item->id,
                $item->getUser->email,
                $item->getAddress->address,
                $item->amount,
                $item->payment_mode == 1 ? 'Online' : 'COD',
                $item->payment_status == 1 ? 'Paid' : 'Unpaid',
                $item->payment_id,
                $item->transaction_id,
                $item->coupon_used == 1 ? "Yes" : 'No',
                $item->status == 0 ? 'Delivered' : ($item->status == 1 ? 'Processing' : 'Delivered')
            ];
        }
        return collect($order);
    }
}
