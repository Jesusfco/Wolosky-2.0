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

//USUARIOS

Route::post('userSearch', 'UsersController@get');
Route::get('user/{id}', 'UsersController@showUser');
Route::post('user', 'UsersController@create');
Route::post('user/edit/{id}', 'UsersController@updateUser');
Route::post('user/saveImageProfile', 'UsersController@saveImageProfile');

Route::post('user/uniqueEmail', 'UsersController@checkUniqueEmail');
Route::post('user/uniqueName', 'UsersController@checkUniqueName');

Route::post('user/safeDelete/{id}', 'UsersController@checkSafeDelete');
Route::delete('user/delete/{id}', 'UsersController@deleteUser');

//SCHEDULES USER
Route::get('user/schedules/{id}', 'UsersController@getSchedules');
Route::post('user/schedules/{id}', 'UsersController@updateSchedules');
Route::delete('user/schedules/delete/{id}', 'UsersController@deleteSchedule');

//STATUS USER
Route::get('user/status/{id}', 'UsersController@getStatus');
Route::post('user/status', 'UsersController@createStatus');

Route::get('monthlyPayment/{id}', 'UsersController@getMonthlyPayment');
Route::get('salary/{id}', 'UsersController@getSalary');

//REFERENCES
Route::get('references/{id}', 'UsersController@getReferences');
Route::post('references/create', 'UsersController@storeReference');
Route::post('references/update', 'UsersController@updateReference');
Route::delete('references/delete/{id}', 'UsersController@deleteReference');

Route::post('user/monthlyPayment', 'UsersController@updateMonthlyPayment');
Route::post('user/updateSalary', 'UsersController@updateSalary');


//RECIBOS CONTROLLADORES
Route::post('receipt/get', 'ReceiptController@get');
Route::post('receipt', 'ReceiptController@create');
Route::post('receipt/update', 'ReceiptController@update');
Route::get('receipt/show/{id}', 'ReceiptController@show');
Route::delete('receipt/delete/{id}', 'ReceiptController@delete');
Route::post('receipt/checkUnique', 'ReceiptController@checkLastReceipt');


Route::get('receipt/analisis', 'ReceiptController@getAnalisis');

;
Route::post('receipt/sugestUser', 'ReceiptController@sugestUser');
Route::post('receipt/getMonthlyPayment', 'ReceiptController@getMonthlyPayment');

//HORARIOS 
Route::post('schedule/getStudents', 'SchedulesController@getStudents');

//PAGO DE TRABAJADORES
Route::post('workers-payment', 'Auth\PaymentsController@list');
Route::post('workers-payment/dataToProcess', 'Auth\PaymentsController@dataToProcess');

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
Route::get('excel/sales', 'ExcelController@getSales');
Route::get('excel/inventory', 'ExcelController@getInventory');

//Exportaciones PDF
Route::get('pdf/user', 'PDFController@userResume');
Route::get('pdf/scheduleUser', 'PDFController@personalSchedule');

//Debtors
Route::post('debtors', 'DebtorsController@get');
Route::post('debtors/sugest', 'DebtorsController@sugestUser');
Route::post('debtors/update', 'DebtorsController@update');
Route::post('debtors/delete', 'DebtorsController@delete');

//MONTHLY-COST
Route::get('monthly-cost', 'MonthlyCostController@get');
Route::post('monthly-cost/create', 'MonthlyCostController@store');
Route::post('monthly-cost/update', 'MonthlyCostController@update');
Route::delete('monthly-cost/{id}', 'MonthlyCostController@delete');