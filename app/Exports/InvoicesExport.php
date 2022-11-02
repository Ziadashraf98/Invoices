<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class InvoicesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $invoices = DB::table('invoices')
        ->join('sections' , 'invoices.section_id' , 'sections.id')
        ->join('users' , 'invoices.user_id' , 'users.id')
        ->select('invoice_number' , 'invoices.status' , 'product' ,  'sections.section_name' , 'users.name')
        ->get();

        return $invoices;
        // dd($invoices);
    }      
}
