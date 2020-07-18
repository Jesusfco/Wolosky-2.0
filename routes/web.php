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

Route::get('/test', 'VisitorsController@test');

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
Route::get('/equipo', 'VisitorsController@team');
Route::get('/contacto', function () {
    return view('home/contacto');
});
Route::get('/suscribete', function () {
    return view('home/subscripcion');
});

Route::post('/mensaje', 'VisitorsController@mail');


Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('home', function(){
    return redirect('admin');
});


Route::get('noticias/{id}/edit', 'NoticiasController@edit');
Route::get('noticias/{id}/uploadPhotos', 'NoticiasController@uploadPhotos');
Route::post('noticias/{id}/upload', 'NoticiasController@storePhoto');
Route::post('noticias/{id}/deletePhoto' , 'NoticiasController@deletePhoto');
Route::get('noticias/{id}/getPhotos', 'VisitorsController@getPhotos');
Route::post('admin/noticias/{id}', 'NoticiasController@update');

Route::prefix('admin')->group(function () { 

    Route::get('noticias', 'NoticiasController@index');
    Route::get('noticias/create', 'NoticiasController@create');
    Route::post('noticias/create', 'NoticiasController@store');
    Route::get('noticias/delete/{id}', 'NoticiasController@destroy');

    Route::get('equipo', 'Web\TeamController@index');
    Route::get('equipo/create', 'Web\TeamController@create');
    Route::post('equipo/create', 'Web\TeamController@store');
    Route::get('equipo/edit/{id}', 'Web\TeamController@edit');
    Route::post('equipo/edit/{id}', 'Web\TeamController@update');
    Route::get('equipo/delete/{id}', 'Web\TeamController@destroy');

});

// NO SIRVE
Route::get('/admin', 'HomeController@index');




