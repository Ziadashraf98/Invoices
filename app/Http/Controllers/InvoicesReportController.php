<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesReportController extends Controller
{
    public function index()
    {
        return view('invoices_report.invoices_report');
    }

    public function search_invoices(Request $request)
    {
        $rdio = $request->rdio;
        $invoice_number  = $request->invoice_number;
        $type  = $request->type;
        $start_at  = date($request->start_at);
        $end_at  = date($request->end_at);

        if($invoice_number)
        {
            $invoices = Invoice::where('invoice_number' , $invoice_number)->get();
            return view('invoices_report.invoices_report' , compact('invoices'));
        }
        elseif(!empty($start_at && $end_at))
        {
            $invoices = Invoice::whereBetween('invoice_date', [$start_at, $end_at])->where('status' , $type)->get();
            return view('invoices_report.invoices_report' , compact('invoices'));
        }
        else
        {
            if($type == 'الكل')
            {
                $invoices = Invoice::all();
                return view('invoices_report.invoices_report' , compact('invoices'));
            }
            else
            {
                $invoices = Invoice::where('status' , $type)->get();
                return view('invoices_report.invoices_report' , compact('invoices'));
            }
            
        }
    }
}

