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

Route::get('/', 'VisitorsController@index');
Route::get('/noticias', 'VisitorsController@noticias');
Route::get('/noticias/{id}', 'VisitorsController@articulo');
Route::get('/quienes', function () {
    return view('home/quienes');
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

Route::get('records', 'VisitorsController@records');

Route::get('setYear', 'VisitorsController@setYear');



Auth::routes();
Route::get('home', function(){
    return redirect('admin');
});

Route::get('admin/noticias/list', 'NoticiasController@index');
Route::get('admin/noticias/create', 'NoticiasController@create');
Route::post('admin/noticias/create', 'NoticiasController@store');
Route::get('admin/noticias/destroy', 'NoticiasController@destroy');
Route::get('noticias/{id}/edit', 'NoticiasController@edit');
Route::get('noticias/{id}/uploadPhotos', 'NoticiasController@uploadPhotos');
Route::post('admin/noticias/{id}', 'NoticiasController@update');



Route::get('/admin', 'HomeController@index');

// Route::get('/migrate', 'VisitorsController@migration');
