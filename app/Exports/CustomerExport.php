<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection,WithHeadings
{
     public function headings():array
     {
        return[
            'firstname',
            'lasttname',
            'email',

        ];
     }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::where('role_id', User::Roles['Customer'])->get(['firstname','lastname','email']);
    }
}
