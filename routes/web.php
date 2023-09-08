<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Invoices_ReportController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoiceController::class);

Route::resource('sections', SectionController::class);

Route::resource('products', ProductController::class);

Route::resource('invoiceAttachments', InvoiceAttachmentsController::class);

Route::get('/section/{id}', [InvoiceController::class, 'getproducts']);

Route::get('/edit_invoice/{id}', [InvoiceController::class, 'edit']);

Route::get('/invoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);

Route::get('view_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);

Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file']);

Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');

Route::get('/Status_show/{id}',[InvoiceController::class, 'show'])->name('Status_show');

Route::post('/Status_Update/{id}', [InvoiceController::class, 'Status_Update'])->name('Status_Update');

Route::get('invoice_paid', [InvoiceController::class, 'invoice_paid']);

Route::get('invoice_unpaid', [InvoiceController::class, 'invoice_unpaid']);

Route::get('invoice_partial', [InvoiceController::class, 'invoice_partial']);

Route::get('print_invoice/{id}', [InvoiceController::class, 'print_invoice']);

Route::resource('archive', InvoiceArchiveController::class);

Route::get('export_invoices', [InvoiceController::class, 'export']);

Route::group(['middleware' => ['auth']], function() {
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
});

Route::get('invoices_report', [Invoices_ReportController::class , 'index']);

Route::post('search_invoices', [Invoices_ReportController::class , 'search_invoices']);

Route::get('/{page}', [AdminController::class,'index']);
