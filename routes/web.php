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

use App\Models;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/api/getDepartment', 'Administration\SeekController@getDepartment');

Route::resource('/parameter', 'Administration\ParametersController');
Route::resource('/orders', 'Operations\OrdersController');


Route::group(['namespace' => 'Api'], function () {
    Route::post('/user/login', 'UserController@login');
    Route::post('/newStakeholder', 'UserController@newStakeholder');
    Route::get('/getUser', 'UserController@details')->middleware('auth:api');

    Route::post('/newPark', 'ParkController@newPark')->middleware('auth:api');

    Route::put('/editPark/{id}/edit', 'ParkController@update')->middleware('auth:api');
    Route::delete('park/{id}', 'ParkController@delete')->middleware('auth:api');
    Route::get('/getPark/{id}', 'ParkController@getPark')->middleware('auth:api');
    Route::get('getParks', 'ParkController@getParks')->middleware('auth:api');
//    Route::resource("binnacle", "BinnacleController");

    Route::post('/reserveW', 'OrdersController@reserveW')->middleware('auth:api');
    Route::get('/getOrders', 'OrdersController@getOrders')->middleware('auth:api');
    Route::get('/getTypeVehicle', 'OrdersController@getTypeVehicle')->middleware('auth:api');
    Route::put('cancel/{id}', 'OrdersController@cancelOrder')->middleware('auth:api');
});


Route::get('/api/listParameter', function() {
    return Datatables::queryBuilder(
                    DB::table('parameters')->orderBy("id", "asc")
            )->make(true);
});

Route::get('/api/listOrders', function() {
    $query = DB::table('vorders');

    return Datatables::queryBuilder($query)->make(true);
});

Route::get('/api/listUser', function() {
    return Datatables::queryBuilder(
                    DB::table("users")
                            ->select("users.id", "users.name", "users.email", DB::raw("coalesce(users.document::text,'') as document"), "roles.description as role", "cities.description as city", "parameters.description as status")
                            ->join("roles", "roles.id", "users.role_id")
                            ->leftjoin("cities", "cities.id", "users.city_id")
                            ->join("parameters", "parameters.code", DB::raw("users.status_id and parameters.group='generic'"))
            )->make(true);
});

Route::resource('/user', 'Security\UserController');
Route::get('/user/getListPermission/{id}', 'Security\UserController@getPermission');
Route::put('/user/savePermission/{id}', 'Security\UserController@savePermission');

Route::resource('/role', 'Security\RoleController');
Route::put('/role/savePermission/{id}', 'Security\RoleController@savePermissionRole');

Route::get('/api/listRole', function() {
    return Datatables::eloquent(Models\Security\Roles::query())->make(true);
});


Route::resource('/city', 'Administration\CityController');

Route::resource('/department', 'Administration\DepartmentController');

Route::get('/api/listCity', function() {
    $query = DB::table("vcities");
    return Datatables::queryBuilder($query)->make(true);
});

Route::get('/api/listDepartment', function() {
    return Datatables::eloquent(Models\Administration\Department::query())->make(true);
});


Route::resource('/permission', 'Security\PermissionController');
Route::get('/api/listPermission', 'Security\PermissionController@getPermission');
Route::get('/permission/{id}/getMenu', ['uses' => 'Security\PermissionController@getMenu']);

Route::resource('/clients', 'Clients\ClientController');

Route::get('/api/listClient', function() {

    $query = DB::table('vclient');

    if (Auth::user()->role_id != 1) {
        $query->where("responsible_id", Auth::user()->id);
    }
    return Datatables::queryBuilder($query)->make(true);
});


Route::get('/api/listProduct', function() {
    $query = DB::table('vproducts');
    return Datatables::queryBuilder($query)->make(true);
});

Route::resource('/product', 'Administration\ProductController');
Route::post('/product/upload', 'Administration\ProductController@uploadImage');
Route::put('/product/checkmain/{id}', 'Administration\ProductController@checkMain');
Route::delete('/product/deleteImage/{id}', 'Administration\ProductController@deleteImage');
Route::get('/product/getImages/{id}', 'Administration\ProductController@getImages');
Route::post('/product/StoreSpecial', 'Administration\ProductController@storeSpecial');
Route::post('/product/uploadExcel', 'Administration\ProductController@storeExcel');
Route::post('/product/uploadExcelCode', 'Administration\ProductController@storeExcelCode');
Route::resource('services', 'Administration\ServicesController');

Route::get('/api/listServices', function() {
    $query = DB::table('vservices');
    return Datatables::queryBuilder($query)->make(true);
});

Route::resource('/schedules', 'Administration\SchedulesController');
Route::get('/schedules/getTable/{day}/{course_id}/{location_id}', 'Administration\SchedulesController@getTable');

Route::post('/schedules/detail', 'Administration\SchedulesController@storeDetail');
Route::get('/schedules/{id}/editDetail', 'Administration\SchedulesController@getDetail');
Route::delete('/schedules/detail/{id}', 'Administration\SchedulesController@destroyItem');
Route::get('/schedules/{id}/getModal', 'Administration\SchedulesController@getModalData');


Route::resource('/locations', 'Administration\LocationsController');

Route::get('/api/listLocations', function() {
    return Datatables::queryBuilder(DB::table("locations"))->make(true);
});

Route::get('/api/listSchedules', function(Request $request) {
    $query = DB::table("schedules");
    return Datatables::queryBuilder($query)->make(true);
});

Route::get('/api/getCategory', 'Administration\SeekController@getCategory');

Route::resource('/suppliers', 'Suppliers\SupplierController');
Route::post('/suppliers/upload', 'Suppliers\SupplierController@uploadImage');
Route::post('/suppliers/uploadExcel', 'Suppliers\SupplierController@uploadExcel');
Route::post('/suppliers/uploadClient', 'Suppliers\SupplierController@uploadclient');
Route::put('/suppliers/checkmain/{id}', 'Suppliers\SupplierController@checkMain');
Route::delete('/suppliers/deleteImage/{id}', 'Suppliers\SupplierController@deleteImage');
Route::get('/suppliers/getImages/{id}', 'Suppliers\SupplierController@getImages');

Route::post('/suppliers/StoreSpecial', 'Suppliers\SupplierController@storeSpecial');
Route::put('/suppliers/updatePrice/{id}', 'Suppliers\SupplierController@updatePrice');
Route::put('/suppliers/UpdateContact/{id}', 'Suppliers\SupplierController@updateContact');
Route::post('/suppliers/StoreContact', 'Suppliers\SupplierController@storeContact');
Route::delete('/suppliers/deleteContact/{id}', 'Suppliers\SupplierController@deleteContact');
Route::post('/suppliers/addChage', 'Suppliers\SupplierController@addChanges');

Route::get('/suppliers/contact/{id}', 'Suppliers\SupplierController@editContact');

Route::post('/suppliers/addTax', 'Suppliers\SupplierController@storeTax');
Route::put('/suppliers/UpdateTax', 'Suppliers\SupplierController@updateTax');
Route::delete('/suppliers/deleteTax/{id}', 'Suppliers\SupplierController@deleteTax');

Route::get('/api/listSupplier', function() {

    $query = DB::table('vsupplier');
    if (Auth::user()->role_id != 1 && Auth::user()->role_id != 5) {
        $query->where("responsible_id", Auth::user()->id);
    }
    return Datatables::queryBuilder($query)->make(true);
});