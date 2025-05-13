<?php
// Désactive complètement la limite d'exécution
ini_set('max_execution_time', 0);
set_time_limit(0);

use App\Http\Controllers\VideoController;
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

Route::get('/', function () {
    if (!session()->has('user')){
        session()->put('user', (string) \Illuminate\Support\Str::uuid());
    }
    $userId = session()->get('user');

    return view('index', [
        'userId' => $userId
    ]);
});

Route::controller(VideoController::class)->group(function () {
    Route::post('/search', 'search')->name('search.video');
    Route::post('/cut', 'cut')->name('cut.video');
    Route::post('/download', 'download')->name('download.video');
});


Route::get('/test', function (\App\Services\MercureService $mercureService) {




});
