<?php

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
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

Route::get('/users', function () {
    $user = Cache::remember("user_all", 10 * 60, function () {
        return User::all();
    });

    return response()->json($user);
});

Route::get('/redis', function () {

    $redis = Redis::connection();
    $redis->set('name', 'Taylor');
    return $redis->get('name');
});
