<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', 'LoginController@signin');
Route::get('login/check', 'LoginController@checkAuth');

Route::post('userSearch', 'UsersController@get');
Route::get('user/{id}', 'UsersController@showUser');
Route::post('user', 'UsersController@create');
Route::post('user/edit/{id}', 'UsersController@updateUser');
Route::post('user/uniqueEmail', 'UsersController@checkUniqueEmail');
Route::post('user/uniqueName', 'UsersController@checkUniqueName');

Route::get('user/schedules/{id}', 'UsersController@getSchedules');
Route::post('user/schedules/{id}', 'UsersController@updateSchedules');

Route::get('user/status/{id}', 'UsersController@getStatus');
Route::post('user/status', 'UsersController@createStatus');


//RECIBOS CONTROLLADORES
Route::post('receipt/get', 'ReceiptController@get');
Route::post('receipt', 'ReceiptController@create');
Route::post('receipt/update', 'ReceiptController@update');
Route::get('receipt/show/{id}', 'ReceiptController@show');
Route::delete('receipt/delete/{id}', 'ReceiptController@delete');


Route::get('receipt/analisis', 'ReceiptController@getAnalisis');

;
Route::post('receipt/sugestUser', 'ReceiptController@sugestUser');
Route::post('receipt/getMonthlyPayment', 'ReceiptController@getMonthlyPayment');







// Punto de venta Route

Route::get('inventory/getProducts', 'ProductController@getProducts');
Route::post('inventory/create', 'ProductController@store');
Route::post('inventory/update', 'ProductController@update');
Route::get('inventory/{id}', 'ProductController@show');
Route::delete('inventory/delete/{id}', 'ProductController@delete');

Route::post('sale', 'SaleController@storeSale');
Route::post('saleDebt', 'SaleController@storeSaleDebt');

Route::post('sale/outService', 'SaleController@storeSaleOutService');
Route::get('sales', 'SaleController@getSales');
Route::post('sales', 'SaleController@postSales');
Route::get('sales/{id}', 'SaleController@showSale');

Route::post('sales/sugestDebt' , 'SaleController@sugestDebt');

//Cashhh

Route::post('cash', 'CashController@update');
Route::get('cutout', 'CashController@cutout');

//EXPENSES
Route::post('expenses', 'ExpensesController@get');
Route::get('expenses/{id}', 'ExpensesController@show');
Route::post('expenses/create', 'ExpensesController@create');
Route::post('expenses/update', 'ExpensesController@update');
Route::delete('expenses/{id}', 'ExpensesController@delete');

// EXPORT EXCEL

Route::get('excel/receipt', 'ExcelController@receipt');
Route::get('excel/expenses', 'ExcelController@expenses');
Route::get('excel/debtors', 'ExcelController@debtors');

//Debtors
Route::post('debtors', 'DebtorsController@get');
Route::post('debtors/sugest', 'DebtorsController@sugestUser');
Route::post('debtors/update', 'DebtorsController@update');
Route::post('debtors/delete', 'DebtorsController@delete');