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

Route::get('/', 'ContentController@getHome')->name('home');

//Module Cart
Route::get('/cart', 'CartController@getCart')->name('cart');
Route::post('/cart', 'CartController@postCart')->name('cart');   //para confirmar la orden
Route::post('/cart/product/{id}/add', 'CartController@postCartAdd')->name('cart_add');
Route::post('/cart/item/{id}/update', 'CartController@postCartItemQuantityUpdate')->name('cart_item_update');
Route::get('/cart/item/{id}/delete', 'CartController@getCartItemDelete')->name('cart_item_delete');

Route::get('/cart/{order}/type/{type}', 'CartController@getCartChangeType')->name('cart');


//MODULO DE TIENDA Store
Route::get('/store', 'StoreController@getStore')->name('store');
Route::get('/store/category/{id}/{slug}', 'StoreController@getCategory')->name('store_category'); //ruta para las categorias
Route::post('/search', 'StoreController@postSearch')->name('search');    //Ruta de busqueda

//DEFINIR ROUERS DE AUTENTIFICACION
Route::get('/login', 'ConnectController@getLogin')->name('login');
Route::post('/login', 'ConnectController@postLogin')->name('login');
Route::get('/recover', 'ConnectController@getRecover')->name('recover');  //RUTA PARA RECUPERAR CUENTA
Route::post('/recover', 'ConnectController@postRecover')->name('recover');  //RUTA PARA RECUPERAR CUENTA post
Route::get('/reset', 'ConnectController@getReset')->name('reset');
Route::get('/register', 'ConnectController@getRegister')->name('register');
Route::post('/register', 'ConnectController@postRegister')->name('register');
Route::get('/logout', 'ConnectController@getLogout')->name('logout');//para cerrar sesion

//MODULO PARA VER LOS PRODUCTOS
Route::get('/product/{id}/{slug}', 'ProductController@getProduct')->name('product_single');


//Ruta del usuario
//Modulo user actions
Route::get('/account/edit', 'UserController@getAccountEdit')->name('account_edit');
Route::post('/account/edit/avatar', 'UserController@postAccountAvatar')->name('account_avatar_edit');   //ruta para cambiar imagen
Route::post('/account/edit/password', 'UserController@postAccountPassword')->name('account_password_edit'); //ruta para cambiar contraseña
Route::post('/account/edit/info', 'UserController@postAccountInfo')->name('account_info_edit'); //ruta para cambiar datos informacion del ususario o cliente

//Mis direcciones
Route::get('/account/address', 'UserController@getAccountAddress')->name('account_address');
Route::post('/account/address/add', 'UserController@postAccountAddressAdd')->name('account_address');
Route::get('/account/address/{address}/setdefault', 'UserController@getAccountAddressSetDefault')->name('account_address');
Route::get('/account/address/{address}/delete', 'UserController@getAccountAddressDelete')->name('account_address');

//Ajax Api Router : Para desqe aqui podmao llamar a diferencias API
Route::get('/md/api/load/products/{section}', 'ApiJsController@getProductsSection');
Route::post('/md/api/load/user/favorites', 'ApiJsController@postUserFavorites');
Route::post('/md/api/favorites/add/{object}/{module}', 'ApiJsController@postFavoriteAdd');
Route::post('/md/api/load/product/inventory/{inv}/variants', 'ApiJsController@postProductInventoryVariants');

//Mis direcciones
Route::post('/md/api/load/cities/{state}', 'ApiJsController@postCoverageCtitiesFromState');
