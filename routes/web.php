<?php
set_time_limit(5400); // Définit une limite d'exécution de 5400 secondes

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
    return view('welcome-3-1-1');
});

Route::controller(VideoController::class)->group(function () {
    Route::post('/download', 'download')->name('download.video');
});
