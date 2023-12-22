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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/students', 'StudentController@students')->name('students');
    Route::get('/get-student', 'StudentController@get_student')->name('get.student');
    Route::get('/update-student', 'StudentController@update_student')->name('update.student');
    Route::get('/generate-pdf', 'StudentController@generate_pdf')->name('generate.pdf');
    Route::get('/add-student', 'StudentController@store')->name('add.student');
    Route::get('/delete-student', 'StudentController@destroy')->name('delete.student');
    Route::get('/add-systeminfo', 'SystemInfoController@store')->name('add.systeminfo');
    Route::match(['get', 'post'], '/add-template', 'TemplateController@saveTemplate')->name('add.template');
    Route::get('/get-template', 'TemplateController@get_template')->name('get.template');
    Route::get('/delete-template', 'TemplateController@destroy')->name('delete.template');
    Route::get('/templates', 'TemplateController@templates')->name('templates');
    Route::get('/organizations', 'OrganizationController@organizations')->name('orgs');
    Route::get('/organization/mainpage', 'OrganizationController@get_org');
    Route::match(['get', 'post'], '/upload', 'FileController@upload')->name('file.upload');
    Route::get('/loadimages', 'FileController@loadimages')->name('file.load');
    Route::view('/canva', 'canva');
    Route::get('/edit-template', 'TemplateController@edit_template');
    Route::view('/template', 'template');
    // Route::view('/myfiles', 'myfiles');
});
