<?php

use Illuminate\Http\Request;

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

Route::resource('products','ProductController');
// Route::get('products/search/{name}','ProductController@search');



Route::group(['middleware' => ['auth:sanctum']],function () {
    Route::get('products/search/{name}','ProductController@search');
});

// Route::post('/products',function(){
//     return App\Product::create([
//         'name' => 'Product1',
//         'slug' => 'Product1 slug',
//         'desc' => 'this is Product1',
//         'price' => '200'
//     ]);
//   });

  Route::post('/products/{id}',function(){
    return App\Product::update([
        'name' => 'Product1',
        'slug' => 'Product1 slug',
        'desc' => 'this is Product1',
        'price' => '200'
    ]);
  });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
