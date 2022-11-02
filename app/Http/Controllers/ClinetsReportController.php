<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;

class ClinetsReportController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('clients_report.clients_report' , compact('sections'));
    }

    public function search_clients(Request $request)
    {
        $section = $request->Section;
        $product = $request->product;
        $start_at  = date($request->start_at);
        $end_at  = date($request->end_at);
        $sections = Section::all();
        
        if(!empty($start_at && $end_at))
        {
            $invoices = Invoice::whereBetween('invoice_date', [$start_at, $end_at])->where('product' , $product)->get();
            return view('clients_report.clients_report' , compact('invoices' , 'sections'));
        }
        else
        {
            if($section == 'الكل')
            {
                $invoices = Invoice::all();
                $sections = Section::all();
                return view('clients_report.clients_report' , compact('invoices' , 'sections'));
            }
            else
            {
                $invoices = Invoice::where('section_id' , $section)->where('product' , $product)->get();
                return view('clients_report.clients_report' , compact('invoices' , 'sections'));
            }
        }
    }
}
