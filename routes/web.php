<?php


use App\Http\Controllers\backend\AttendanceController;
use App\Http\Controllers\backend\AttendanceDetailsController;
use App\Http\Controllers\backend\ClientController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\CraneController;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\ProjectController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\WorkerController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('home');
});

Auth::routes(['false' => true, 'reset' => false ,'register' => false]);


Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::get('components', [HomeController::class, 'components'])->name('components');
    Route::get('media', [HomeController::class, 'media'])->name('media.index');


    Route::resource('users', UserController::class);
    Route::get('profile/{user}', [UserController::class, 'profile'])->name('profile.edit');
    Route::post('profile/{user}', [UserController::class, 'profileUpdate'])->name('profile.update');

    Route::resource('roles', RoleController::class)->except('show');

    Route::resource('permissions', PermissionController::class)->except(['show', 'destroy', 'update']);

    Route::post('worker/store/ajax', [WorkerController::class, 'storeAjax'])->name('worker.store.ajax');
    Route::get('worker/ajax', [WorkerController::class, 'ajax'])->name('worker.ajax');
    Route::post('worker/ajax/data/status', [WorkerController::class, 'checkWorkerStatusInDate'])->name('worker.data.status');
    Route::resource('worker', WorkerController::class);

    Route::resource('attendance', AttendanceController::class);

    Route::resource('client', ClientController::class);

    Route::resource('client.contact', ContactController::class)->only(['store','update','destroy']);
    Route::resource('project.crane', CraneController::class)->only(['store','update','destroy']);


    Route::resource('project', ProjectController::class)->only(['index', 'show']);
    Route::resource('client.project', ProjectController::class)->only(['create', 'store', 'edit','update', 'destroy']);

    Route::get('activity-log', [SettingController::class, 'activity'])->name('activity-log.index');

    Route::post('project/ajax/request-1', [AttendanceDetailsController::class, 'getWorkerForMonthAndProject'])->name('project.ajax.one');
    Route::post('project/ajax/request-2', [AttendanceDetailsController::class, 'getProjectForMonthAndWorker'])->name('project.ajax.two');

});
