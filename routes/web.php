<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScrapeController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('change_password', [HomeController::class, 'change_password'])->name('change_password');


Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/scrape', [ScrapeController::class, 'scrapeLink']);


Route::post('/login', [HomeController::class, 'post_login'])->name('post_login');
Route::get('/employee-login',[HomeController::class,'employee_login'])->name('employee_login');
Route::post('/employee_login',[HomeController::class,'employee_login_post'])->name('employee_login_post');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [HomeController::class, 'logout'])->name('logout');
    Route::resource('rooms', RoomController::class);
    Route::get('available-employees', [RoomController::class, 'getAvailableEmployees'])->name('rooms.getAvailableEmployees');
    Route::post('add-employees', [RoomController::class, 'addEmployees'])->name('rooms.addEmployees');
    Route::get('get-employees', [RoomController::class, 'getEmployees'])->name('rooms.getEmployees');
    Route::post('remove-employee', [RoomController::class, 'removeEmployee'])->name('rooms.removeEmployee');
});
