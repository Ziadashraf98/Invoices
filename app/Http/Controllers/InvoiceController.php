<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InvoiceRequest;
use App\Models\invoicesAttachment;
use App\Models\invoicesDetail;
use App\Models\User;
use App\Notifications\Add_Invoice_Notification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;



class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.invoices' , compact('invoices'));
    }

    public function paid_invoices()
    {
        $invoices = Invoice::where('status_value' , 1)->get();
        return view('invoices.paid_invoices' , compact('invoices'));
    }

    public function unpaid_invoices()
    {
        $invoices = Invoice::where('status_value' , 2)->get();
        return view('invoices.unpaid_invoices' , compact('invoices'));
    }

    public function partially_paid_invoices()
    {
        $invoices = Invoice::where('status_value' , 3)->get();
        return view('invoices.partially_paid_invoices' , compact('invoices'));
    }

    public function invoices_archive()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('invoices.invoices_archive' , compact('invoices'));
    }

    public function add_invoice_view()
    {
        $sections = Section::all();
        return view('invoices.add_invoice_view' , compact('sections'));
    }

    public function getProducts($id)
    {
        $products = Product::where('section_id' , $id)->pluck('product_name' , 'id');
        return $products;
    }

    public function add_invoice(InvoiceRequest $request)
    {
        Invoice::create([
            'invoice_number'=>$request->invoice_number,
            'invoice_date'=>$request->invoice_Date,
            'due_date'=>$request->Due_date,
            'section_id'=>$request->section,
            'user_id'=>Auth::user()->id,
            'product'=>$request->product,
            'collection_amount'=>$request->Amount_collection,
            'commission_amount'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'vat_rate'=>$request->Rate_VAT,
            'vat_value'=>$request->Value_VAT,
            'total'=>$request->Total,
            'status'=>'غير مدفوعة',
            'status_value'=>2,
            'note'=>$request->note,
        ]);

        $invoice_id = Invoice::latest()->first()->id;
        $invoice_number = $request->invoice_number;

        invoicesDetail::create([
            'user'=>Auth::user()->name,
            'status_value'=>2,
            'status'=>'غير مدفوعة',
            'section_id'=>$request->section,
            'product'=>$request->product,
            'invoice_number'=>$request->invoice_number,
            'note'=>$request->note,
            'invoice_id'=>$invoice_id,
        ]);

        $data = new invoicesAttachment;
        $data->invoice_number = $request->invoice_number;
        $data->invoice_id = $invoice_id;
        $data->created_by = Auth::user()->name;
        
        if($request->file('pic'))
        {
            $data->file_name = $request->file('pic')->getClientOriginalName();
            $request->file('pic')->move('productimage/' . $invoice_number, $data->file_name);
        }
        
        $data->save();

        Notification::send(Auth::user() , new Add_Invoice_Notification($invoice_id));
        
        // $users = User::all();
        
        // foreach ($users as $user)
        // {
        //     $user->notify(new Add_Invoice_Notification($invoice_id));
        // } 
        
        return back()->with('success' , 'Invoice Added Successfully');
    }

    public function SoftDelete($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        return back()->with('success' , 'Invoice Deleted Successfully');
    }

    public function delete_invoice($id , $invoice_number)
    {
        $invoices = Invoice::withTrashed()->find($id);
        // dd($invoices);
        $invoices->forceDelete();
        Storage::disk('public_uploads')->deleteDirectory($invoice_number);
        return back()->with('success' , 'Invoice Deleted Successfully');
    }

    public function restore_invoice($id)
    {
        $invoice = Invoice::withTrashed()->find($id);
        $invoice->restore();
        return back()->with('success' , 'Invoice Restored Successfully');
    }

    public function change_payment_status_view($id)
    {
        $invoice = Invoice::find($id);
        return view('invoices.change_payment_status_view' , compact('invoice'));
    }

    public function export() 
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function update_payment_status(Request $request , $id)
    {
        $invoice = Invoice::find($id);
        $invoicesDetails = Invoice::find($id)->invoicesDetails;
        
        if($request->payment_status == 'مدفوعة')
        {
            $invoice->update([
                'status_value'=>1,
                'status'=>$request->payment_status,
                'payment_date'=>$request->payment_date,
            ]);
            
            $invoicesDetails->update([
                'status_value'=>1,
                'status'=>$request->payment_status,
                'payment_date'=>$request->payment_date,
            ]);
        }
        elseif($request->payment_status == 'غير مدفوعة')
        {
            $invoice->update([
                'status_value'=>2,
                'status'=>$request->payment_status,
                'payment_date'=>$request->payment_date,
            ]);
            
            $invoicesDetails->update([
                'status_value'=>2,
                'status'=>$request->payment_status,
                'payment_date'=>$request->payment_date,
            ]);
        }
        else
        {
            $invoice->update([
                'status_value'=>3,
                'status'=>$request->payment_status,
                'payment_date'=>$request->payment_date,
            ]);
            
            $invoicesDetails->update([
                'status_value'=>3,
                'status'=>$request->payment_status,
                'payment_date'=>$request->payment_date,
            ]);
        }
        
        // $invoicesDetail = invoicesDetail::where('id' , $id)->first();
        // $invoicesDetail->update([
        //     'status'=>$request->payment_status,
        //     'payment_date'=>$request->payment_date,
        // ]);

        return back()->with('success' , 'Payment Status Updated Successfully');
    }
}
