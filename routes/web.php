<?php

use App\Http\Controllers\ClinetsReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\checkStauts;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('auth.login');
    return redirect('/login');
});

// Route::get('/{page}', [AdminController::class , 'index']);

Auth::routes(['register'=>false]);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(checkStauts::class);

//========================================================================================================

Route::get('/invoices' , [InvoiceController::class , 'index']);
Route::get('/paid_invoices' , [InvoiceController::class , 'paid_invoices']);
Route::get('/unpaid_invoices' , [InvoiceController::class , 'unpaid_invoices']);
Route::get('/partially_paid_invoices' , [InvoiceController::class , 'partially_paid_invoices']);
Route::get('/invoices_archive' , [InvoiceController::class , 'invoices_archive']);
Route::get('/add_invoice_view' , [InvoiceController::class , 'add_invoice_view']);
Route::get('/section/{id}' , [InvoiceController::class , 'getProducts']);
Route::post('/add_invoice' , [InvoiceController::class , 'add_invoice']);
Route::get('/delete_invoice/{id}' , [InvoiceController::class , 'SoftDelete'])->name('SoftDelete');
Route::get('/delete_invoice/{id}/{invoice_number}' , [InvoiceController::class , 'delete_invoice']);
Route::get('/restore_invoice/{id}' , [InvoiceController::class , 'restore_invoice']);
Route::get('/change_payment_status_view/{id}' , [InvoiceController::class , 'change_payment_status_view']);
Route::post('/update_payment_status/{id}' , [InvoiceController::class , 'update_payment_status']);
Route::get('/export_invoices' , [InvoiceController::class, 'export']);

//===============================================================================================================

Route::get('/invoices_details/{id}' , [InvoicesDetailsController::class , 'index'])->name('invoice_details');
Route::get('/show_file/{invoice_number}/{file_name}' , [InvoicesDetailsController::class , 'show_file']);
Route::get('/download_file/{invoice_number}/{file_name}' , [InvoicesDetailsController::class , 'download_file']);
Route::get('/delete_file/{id}/{invoice_number}/{file_name}' , [InvoicesDetailsController::class , 'delete_file']);
Route::post('/update_file/{id}/{invoice_number}/{file_name}' , [InvoicesDetailsController::class , 'update_file']);

//===================================================================================================================

Route::get('/invoices_report' , [InvoicesReportController::class , 'index']);
Route::post('/search_invoices' , [InvoicesReportController::class , 'search_invoices']);

//==========================================================================================================

Route::get('/clients_report' , [ClinetsReportController::class , 'index']);
Route::post('/search_clients' , [ClinetsReportController::class , 'search_clients']);

//=============================================================================================================

Route::get('/sections' , [SectionController::class , 'index']);
Route::post('/add_section' , [SectionController::class , 'add_section']);
Route::post('/update_section/{id}' , [SectionController::class , 'update_section']);
Route::post('/delete_section/{id}' , [SectionController::class , 'delete_section']);

//===============================================================================================================

Route::post('/update_product/{id}' , [ProductController::class , 'update_product']);
Route::get('/products' , [ProductController::class , 'index']);
Route::post('/add_product' , [ProductController::class , 'add_product']);
Route::post('/delete_product/{id}' , [ProductController::class , 'delete_product']);

//=========================================={Mark-All}==========================================================

Route::get('/mark_all', function(){
	
    Auth::user()->unreadNotifications->markAsRead();
	return back();

})->name('mark_all');

//=========================================={Single-Mark}==========================================================

// Route::get('/single_mark', function(){
	
//     $id = Auth::user()->unreadNotifications[0]->id;
//     $link = Auth::user()->unreadNotifications[0]->data['link'];
//     Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
//     return redirect($link);

// })->name('single_mark');

//=============================================================================================================

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});


