<?php

use App\Http\Controllers\NotaFiscalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){ 
    return "Hello World";
});
Route::post('nota-fiscal', [NotaFiscalController::class, 'store'])->withoutMiddleware(['web', 'auth', 'csrf']);;
Route::get('nota-fiscal/{id}', [NotaFiscalController::class, 'show']);