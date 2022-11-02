<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\invoicesAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    public function index($id)
    {
        $invoices = Invoice::find($id);
        return view('invoices.invoices_details' , compact('invoices'));
    }

    public function show_file($invoice_number , $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number. '/' .$file_name);
        return response()->file($files);
    }

    public function download_file($invoice_number , $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number. '/' .$file_name);
        return response()->download($files);
    }

    public function delete_file($id , $invoice_number , $file_name)
    {
        $invoices = Invoice::find($id);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($invoice_number. '/' .$file_name);
        return back()->with('success' , 'File Deleted Successfully');
    }

    public function update_file($id , $invoice_number , $file_name , Request $request)
    {
        $request->validate([
            'pic'=>'required|mimes:pdf,jpg,jpej,png',
        ]);

        $invoicesAttachment = invoicesAttachment::find($id);
        $invoicesAttachment->file_name = $request->file('pic')->getClientOriginalName();
        $request->file('pic')->move('productimage/' . $invoice_number, $invoicesAttachment->file_name);
        $invoicesAttachment->update();
        Storage::disk('public_uploads')->delete($invoice_number. '/' .$file_name);
        return back();    
    }
}
