<?php

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

Route::group([
    'namespace' => 'Api',
    'prefix' => 'v1'
], function (\Illuminate\Routing\Router $router) {
    $router->post('/login', 'LoginController@login');
    $router->get('/logout', 'LoginController@logout');

    $router->middleware('auth:api')->group(function (\Illuminate\Routing\Router $router) {
        $router->apiResource('/books', 'BooksController');
    });
});