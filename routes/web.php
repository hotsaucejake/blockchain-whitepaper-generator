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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function() {
   return view('home');
});

Route::post('pdf', 'PDFGeneratorController@store');

Route::get('pdftest', function(){
   Fpdf::AddPage();
   Fpdf::SetFont('Courier', 'B', 18);
   Fpdf::Cell(50, 25, 'Hello World!');
   Fpdf::Output();
});