<?php

use App\Http\Controllers\ExitRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomLeaveRequestController;
use App\Http\Controllers\ScrapeController;
use App\Http\Controllers\Teacher\AuthController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\ExitRequestController as TeacherExitRequestController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('change_password', [HomeController::class, 'change_password'])->name('change_password');


Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/scrape', [ScrapeController::class, 'scrapeLink']);

Route::post('/login', [HomeController::class, 'post_login'])->name('post_login');
Route::get('/employee-login', [HomeController::class, 'employee_login'])->name('employee_login');
Route::post('/employee_login', [HomeController::class, 'employee_login_post'])->name('employee_login_post');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [HomeController::class, 'logout'])->name('logout');
    Route::resource('rooms', RoomController::class);
    Route::get('available-employees', [RoomController::class, 'getAvailableEmployees'])->name('rooms.getAvailableEmployees');
    Route::post('add-employees', [RoomController::class, 'addEmployees'])->name('rooms.addEmployees');
    Route::get('get-employees', [RoomController::class, 'getEmployees'])->name('rooms.getEmployees');
    Route::post('remove-employee', [RoomController::class, 'removeEmployee'])->name('rooms.removeEmployee');
    Route::resource('exit-requests', ExitRequestController::class);
    Route::post('/exit-requests/{exitRequest}/complete', [ExitRequestController::class, 'complete'])->name('exit-requests.complete');
    Route::get('/exit-requests/{id}/approve', [ExitRequestController::class, 'approve'])->name('exit-requests.approve');
    Route::get('/exit-requests/{id}/reject', [ExitRequestController::class, 'reject'])->name('exit-requests.reject');
    Route::get('/get-companions/{teacher}', [ExitRequestController::class, 'getCompanions'])->name('getCompanions');
    Route::get('/notifications', function () {
        return view('notifications');
    });
    Route::get('/notifications', [HomeController::class, 'getNotifications'])->name('notifications.index');

    // Test route to trigger a notification (for debugging)
    
});
Broadcast::routes(['middleware' => ['web', 'auth']]);

Route::prefix('teacher')->name('teacher.')->group(function () {
    // Authentication
    Route::get('/', [AuthController::class, 'index'])->name('index');

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::middleware('teacher.auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('exit-requests', TeacherExitRequestController::class);
        Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');
        Route::post('exit-requests/{exitRequest}/complete', [ExitRequestController::class, 'complete'])
    ->name('exit-requests.complete');
    });
});