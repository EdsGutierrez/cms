<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
	Route::get('/', 'Admin\DashboardController@getDashboard')->name('dashboard');

	//Modulo para el settings
	Route::get('/configuracion', 'Admin\ConfiguracionController@getHome')->name('configuracion');
	Route::post('/configuracion', 'Admin\ConfiguracionController@postHome')->name('configuracion');	//Configurar para guardra en archivo no en bDd


	//Module users
	//Route::get('/users', 'Admin\UserController@getUsers')->name('user_list');
	Route::get('/users/{status}', 'Admin\UserController@getUsers')->name('user_list');
	Route::get('/user/{id}/view', 'Admin\UserController@getUserView')->name('user_view');
	Route::post('/user/{id}/edit', 'Admin\UserController@postUserEdit')->name('user_edit'); //PARA DAR PERMISOS AL USUARIO Y EN LA PARTE DE EDITAR USUARIO MOSTRAR EL BOTON GUARDADR USUSARIO DESPUES DE HABER SIDO MODIFICADO
	Route::get('/user/{id}/banned', 'Admin\UserController@getUserBanned')->name('user_banned');	//PARA SUSPENDER A UN USUARIO
	Route::get('/user/{id}/permissions', 'Admin\UserController@getUserPermissions')->name('user_permissions');	//===PERSMISOS DE USUARIOS
	Route::post('/user/{id}/permissions', 'Admin\UserController@postUserPermissions')->name('user_permissions');	//BOTON DE GUARDAR PERMISOS

	//=============== PRODUCTOS ====================
	//Module productos
	Route::get('/products/{status}', 'Admin\ProductController@getHome')->name('products');
	Route::get('/product/add', 'Admin\ProductController@getProductAdd')->name('product_add');
	Route::get('/product/{id}/edit', 'Admin\ProductController@getProductEdit')->name('product_edit');    //router para editar productos de pantalla
	Route::get('/product/{id}/delete', 'Admin\ProductController@getProductDelete')->name('product_delete');	//PARA ELIMINAR PRODUCTOS ¿ESTAS SEGURO DE ELIMINAR?
	Route::get('/product/{id}/restore', 'Admin\ProductController@getProductRestore')->name('product_delete');	//RESTAURRAR ELEMEMTO
	Route::get('/product/{id}/inventory', 'Admin\ProductController@getProductInventory')->name('product_inventory');		//inventRIO
	Route::post('/product/add', 'Admin\ProductController@postProductAdd')->name('product_add');
	Route::post('/product/search', 'Admin\ProductController@postProductSearch')->name('product_search');	//===EVENTO PARA HACER UNA BUSQUEDA
	Route::post('/product/{id}/edit', 'Admin\ProductController@postProductEdit')->name('product_edit');     //Ruta para ediar desde Home.blade
	Route::post('/product/{id}/inventory', 'Admin\ProductController@postProductInventory')->name('product_inventory');		//INVENTARIO
	Route::post('/product/{id}/gallery/add', 'Admin\ProductController@postProductGalleryAdd')->name('product_gallery_add');    //Ruta para editar desde Home del icono +
	Route::get('/product/{id}/gallery/{gid}/delete', 'Admin\ProductController@getProductGalleryDelete')->name('product_gallery_deleted');    //eliminar imagen de la galeria

	//====================OTRO MODULO DE INVENTARIO
	// Module Inventory
	Route::get('/product/inventory/{id}/edit', 'Admin\ProductController@getProductInventoryEdit')->name('product_inventory');
	Route::post('/product/inventory/{id}/edit', 'Admin\ProductController@postProductInventoryEdit')->name('product_inventory');
	Route::post('/product/inventory/{id}/variant', 'Admin\ProductController@postProductInventoryVariantAdd')->name('product_inventory');
	Route::get('/product/inventory/{id}/delete', 'Admin\ProductController@getProductInventoryDeleted')->name('product_inventory');
	Route::get('/product/variant/{id}/delete', 'Admin\ProductController@getProductInventoryVariantDeleted')->name('product_inventory');



	//=============== CATEGORIAS ====================
	//Categorias
	Route::get('/categories/{module}', 'Admin\CategoriesController@getHome')->name('categories');
	Route::post('/category/add/{module}', 'Admin\CategoriesController@postCategoryAdd')->name('category_add'); //guardar categoria
	Route::get('/category/{id}/edit', 'Admin\CategoriesController@getCategoryEdit')->name('category_edit'); //Rutas de modificar
	Route::post('/category/{id}/edit', 'Admin\CategoriesController@postCategoryEdit')->name('category_edit');
	Route::get('/category/{id}/subs', 'Admin\CategoriesController@getSubsCategories')->name('category_edit'); //Rutas de Subcategorias
	Route::get('/category/{id}/delete', 'Admin\CategoriesController@getCategoryDelete')->name('category_delete'); //Rutas de eliminar

	//Rutas de Sliders
	Route::get('/sliders', 'Admin\SliderController@getHome')->name('sliders_list');
	Route::post('/slider/add', 'Admin\SliderController@postSliderAdd')->name('slider_add');
	Route::get('/slider/{id}/edit', 'Admin\SliderController@getSliderEdit')->name('slider_edit');
	Route::post('/slider/{id}/edit', 'Admin\SliderController@postSliderEdit')->name('slider_edit');
	Route::get('/slider/{id}/delete', 'Admin\SliderController@postSliderDelete')->name('slider_delete');

	//Coverage
	Route::get('/coverage', 'Admin\CoverageController@getList')->name('coverage_list');
	Route::post('/coverage/state/add', 'Admin\CoverageController@postCoverageStateAdd')->name('coverage_add');
	Route::post('/coverage/city/add', 'Admin\CoverageController@postCoverageCityAdd')->name('coverage_add');
	Route::get('/coverage/{id}/edit', 'Admin\CoverageController@getCoverageEdit')->name('coverage_edit');
	Route::get('/coverage/city/{id}/edit', 'Admin\CoverageController@getCoverageCityEdit')->name('coverage_edit');
	Route::post('/coverage/city/{id}/edit', 'Admin\CoverageController@postCoverageCityEdit')->name('coverage_edit');
	Route::post('/coverage/state/{id}/edit', 'Admin\CoverageController@postCoverageStateEdit')->name('coverage_edit');
	Route::get('/coverage/{id}/cities', 'Admin\CoverageController@getCoverageCities')->name('coverage_list');
	Route::get('/coverage/{id}/delete', 'Admin\CoverageController@getCoverageDelete')->name('coverage_delete');

	//Ordenes
	Route::get('/orders/{status}/{type}', 'Admin\OrderController@getList')->name('orders_list');
	Route::get('/order/{order}/view', 'Admin\OrderController@getOrder')->name('order_view');
	Route::post('/order/{order}/view', 'Admin\OrderController@postOrderStatusUpdate')->name('order_view');

	//JavaScript Request
	Route::get('/md/api/load/subcategories/{parent}', 'Admin\ApiController@getSubCategories');
});
