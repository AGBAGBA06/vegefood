<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/','App\Http\Controllers\ClientController@home');
Route::get('/cart','App\Http\Controllers\ClientController@cart');
Route::get('/shop','App\Http\Controllers\ClientController@shop');
Route::get('/checkout','App\Http\Controllers\ClientController@checkout');
Route::get('/login','App\Http\Controllers\ClientController@login');
Route::get('/signup','App\Http\Controllers\ClientController@signup');
Route::post('/creer_compte','App\Http\Controllers\ClientController@creer_compte');
Route::post('/acceder_compte','App\Http\Controllers\ClientController@acceder_compte');
Route::get('/select_by_cat/{name}','App\Http\Controllers\ClientController@select_by_cat');
Route::get('/ajouter_au_panier/{id}','App\Http\Controllers\ClientController@ajouter_au_panier');
Route::post('/modifier_qty/{id}','App\Http\Controllers\ClientController@modifier_panier');
Route::post('/modifier_qty/{id}','App\Http\Controllers\ClientController@modifier_panier');
Route::post('/payer','App\Http\Controllers\ClientController@payer');
Route::get('/logout','App\Http\Controllers\ClientController@logout');


Route::get('/admin','App\Http\Controllers\AdminController@dashboard');
Route::get('/commandes','App\Http\Controllers\AdminController@commandes');

Route::get('/ajoutercategorie','App\Http\Controllers\CategoryController@ajoutercategorie');
Route::post('/sauvercategorie','App\Http\Controllers\CategoryController@sauvercategorie');
Route::get('/categories','App\Http\Controllers\CategoryController@categories');
//une route dynamique//
Route::get('/edit_categorie/{id}','App\Http\Controllers\CategoryController@edit_categorie');
Route::post('/modifiercategorie','App\Http\Controllers\CategoryController@modifiercategorie');
Route::get('/deletecategorie/{id}','App\Http\Controllers\CategoryController@deletecategorie');

Route::get('/products','App\Http\Controllers\PoductController@products');
Route::get('/ajouterproduit','App\Http\Controllers\PoductController@ajouterproduit');
Route::post('/sauverproduit','App\Http\Controllers\PoductController@sauverproduit');
Route::get('/editproduit/{id}','App\Http\Controllers\PoductController@editproduit');
Route::post('/modifierproduit','App\Http\Controllers\PoductController@modifierproduit');
Route::get('/deleteproduit/{id}','App\Http\Controllers\PoductController@deleteproduit');
Route::get('/desactiver_produit/{id}','App\Http\Controllers\PoductController@desactiver_produit');
Route::get('/activer_produit/{id}','App\Http\Controllers\PoductController@activer_produit');

Route::get('/ajouterslider','App\Http\Controllers\SliderController@ajouterslider');
Route::post('/sauverslider','App\Http\Controllers\SliderController@sauverslider');
Route::get('/slider','App\Http\Controllers\SliderController@slider');
Route::get('/activer_slider/{id}','App\Http\Controllers\SliderController@activer_slider');
Route::get('/desactiver_slider/{id}','App\Http\Controllers\SliderController@desactiver_slider');
Route::get('/deleteslider/{id}','App\Http\Controllers\SliderController@deleteslider');
