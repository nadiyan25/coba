<?php

use App\Http\Controllers\Stokbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// buat route karyawan
// route untuk tampil data
Route::get('/view', [Stokbarang::class,'view']);

//route untuk detail data
Route::get('/detail/{parameter}',[Stokbarang::class,'detail']);

//route untuk delete data
Route::delete('/delete/{parameter}',[Stokbarang::class,'delete']);

//route untuk insert data
Route::post('/insert', [Stokbarang::class,'insert']);

//route untuk update data
Route::put('/update/{parameter}',[Stokbarang::class,'update']);

