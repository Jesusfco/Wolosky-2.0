<?php

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

Route::get('/test/{id}', 'PDFController@userCredential');

Route::get('/', 'VisitorsController@index');
Route::get('/noticias', 'VisitorsController@noticias');
Route::get('/checar', function(){ return view('home/checar'); });
Route::post('/checar', 'VisitorsController@checar');
Route::get('/noticias/{id}', 'VisitorsController@articulo');
Route::get('/quienes', function () {
    return view('home/quienes');
});

Route::get('/gimnasia', function () {
    return view('home/gimnasia');
});
Route::get('/equipo', function () {
    return view('home/equipo');
});
Route::get('/contacto', function () {
    return view('home/contacto');
});
Route::get('/suscribete', function () {
    return view('home/subscripcion');
});

Route::post('/mensaje', 'VisitorsController@mail');

Route::get('schedules', 'VisitorsController@schedules');
// Route::get('records', 'VisitorsController@records');

// Route::get('setYear', 'VisitorsController@setYear');



Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('home', function(){
    return redirect('admin');
});

Route::get('recordss', 'Auth\PaymentsController@insertRecords');

Route::get('admin/noticias/list', 'NoticiasController@index');
Route::get('admin/noticias/create', 'NoticiasController@create');
Route::post('admin/noticias/create', 'NoticiasController@store');
Route::get('admin/noticias/destroy', 'NoticiasController@destroy');
Route::get('noticias/{id}/edit', 'NoticiasController@edit');
Route::get('noticias/{id}/uploadPhotos', 'NoticiasController@uploadPhotos');
Route::post('noticias/{id}/upload', 'NoticiasController@storePhoto');
Route::post('noticias/{id}/deletePhoto' , 'NoticiasController@deletePhoto');
Route::get('noticias/{id}/getPhotos', 'VisitorsController@getPhotos');
Route::post('admin/noticias/{id}', 'NoticiasController@update');

// Route::get('order', 'NoticiasController@order');


Route::get('/admin', 'HomeController@index');

Route::get('barcode', 'PDFController@getProductsWithCodeBar');

// Route::get('/migrate', 'VisitorsController@migration');
