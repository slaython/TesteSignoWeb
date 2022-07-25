<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Dashboard\Dashboard;
use App\Http\Controllers\Dashboard\ViewsDashboard;
use App\Http\Controllers\Enquetes\Enquetes;
use App\Http\Controllers\Enquetes\ViewsEnquetes;


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

Route::get('/',[ViewsDashboard::class, 'Dashboard']);
Route::get('/dashboard',[ViewsDashboard::class, 'Dashboard']);
Route::get('/gerenciar-enquetes',[ViewsEnquetes::class, 'GerenciarEnquetes']);
Route::get('/enquete-{ID}',[ViewsEnquetes::class, 'Enquete']);

Route::post('/form-cadastro-enquete',[Enquetes::class, 'CadastroEnquete']);
Route::post('/form-votacao',[Enquetes::class, 'Votacao']);