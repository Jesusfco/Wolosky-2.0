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

Route::post('resetPassword', 'Auth\ResetPasswordController@reset');
Route::post('validateResetToken', 'Auth\ResetPasswordController@checkToken');
Route::post('setPassword', 'Auth\ResetPasswordController@changePassword');

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

Route::post('user/saveUserImg', 'UsersController@saveUserImg');
Route::post('user/sugest', 'UsersController@sugest');

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


Route::post('receipt/sugestUser', 'ReceiptController@sugestUser');
Route::post('receipt/getMonthlyPayment', 'ReceiptController@getMonthlyPayment');

//HORARIOS 
Route::post('schedule/getStudents', 'SchedulesController@getStudents');

//PAGO DE TRABAJADORES
Route::post('workers-payment', 'Auth\PaymentsController@list');
Route::post('workers-payment/dataToProcess', 'Auth\PaymentsController@dataToProcess');
Route::post('workers-payment/storePayment', 'Auth\PaymentsController@storePayment');
Route::get('workers-payment/show/{id}', 'Auth\PaymentsController@show');
Route::get('workers-payment/delete/{id}', 'Auth\PaymentsController@destroy');
Route::post('workers-payment/update', 'Auth\PaymentsController@update');

// Asistencioas
Route::post('records', 'App\RecordsController@list');
Route::get('record/show/{id}', 'App\RecordsController@show');
Route::post('record/update/{id}', 'App\RecordsController@update');
Route::get('record/delete/{id}', 'App\RecordsController@delete');
Route::post('records/delete', 'App\RecordsController@deleteBetweenDates');

// Punto de venta Route

Route::get('inventory/getProducts', 'ProductController@getProducts');
Route::post('inventory/create', 'ProductController@store');
Route::post('inventory/update', 'ProductController@update');
Route::get('inventory/{id}', 'ProductController@show');
Route::delete('inventory/delete/{id}', 'ProductController@delete');

Route::post('sale', 'SaleController@storeSale');
Route::post('sale/delete', 'SaleController@delete');
Route::post('saleDebt', 'SaleController@storeSaleDebt');

Route::post('sale/outService', 'SaleController@storeSaleOutService');
Route::get('sales', 'SaleController@getSales');
Route::post('sales', 'SaleController@postSales');
Route::get('sales/{id}', 'SaleController@showSale');

Route::post('sales/sugestDebt' , 'SaleController@sugestDebt');

//Cashhh

Route::post('cash', 'App\CashController@update');
Route::get('cutout', 'App\CashController@cutout');

//EXPENSES
Route::post('expenses', 'ExpensesController@get');
Route::get('expenses/{id}', 'ExpensesController@show');
Route::post('expenses/create', 'ExpensesController@create');
Route::post('expenses/update', 'ExpensesController@update');
Route::delete('expenses/{id}', 'ExpensesController@delete');

// EXPORT EXCEL
Route::get('excel/users', 'ExcelController@users');
Route::post('excel/records', 'ExcelController@records');
Route::get('excel/receipt', 'ExcelController@receipt');
Route::get('excel/expenses', 'ExcelController@expenses');
Route::get('excel/debtors', 'ExcelController@debtors');
Route::get('excel/sales', 'ExcelController@getSales');
Route::get('excel/inventory', 'ExcelController@getInventory');
Route::post('excel/schedules', 'ExcelController@schedules');
Route::get('excel/event/participants/{id}', 'ExcelController@participantsEvent');
Route::get('excel/event/participantsInf/{id}', 'ExcelController@participantsInf');
Route::get('excel/event/receipts/{id}', 'ExcelController@eventReceipts');

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
Route::get('monthly-cost/show/{id}', 'MonthlyCostController@show');
Route::get('monthly-cost/studentSchedules', 'MonthlyCostController@getStudentsSchedules');
Route::post('monthly-cost/create', 'MonthlyCostController@store');
Route::post('monthly-cost/update', 'MonthlyCostController@update');
Route::post('monthly-cost/updateMonthlyPayment', 'MonthlyCostController@updateMonthlyPayment');
Route::delete('monthly-cost/{id}', 'MonthlyCostController@delete');

// Events
Route::post('events', 'App\EventsController@get');
Route::post('event', 'App\EventsController@store');
Route::get('event/show/{id}', 'App\EventsController@show');
Route::post('event/update', 'App\EventsController@update');
Route::post('event/delete', 'App\EventsController@delete');
Route::get('event/participants/{id}', 'App\EventsController@getParticipants');
Route::post('event/createParticipants', 'App\EventsController@createParticipants');
Route::post('event/createParticipant', 'App\EventsController@createParticipant');
Route::post('event/createReceipt', 'App\EventsController@createReceipt');

//Parkingss
Route::post('parkings', 'App\ParkingController@get');
Route::post('parkings/create', 'App\ParkingController@store');
Route::get('parkings/show/{id}', 'App\ParkingController@show');
Route::post('parkings/update/{id}', 'App\ParkingController@update');
Route::get('parkings/delete/{id}', 'App\ParkingController@delete');
