<?php

use App\Http\Controllers\Auth\MyWelcomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LanguageController;
use Flowframe\Trend\Trend;
use Illuminate\Support\Facades\Route;
use Spatie\WelcomeNotification\WelcomesNewUsers;

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

Route::get('/', [LandingController::class, 'index'])->name('home');


//Language Routes
Route::get('lang/{lang}', [LanguageController::class, 'changeLanguage'])->name('lang.switch');


Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->hasRole('tenant')) {
        return redirect('/portal');
    }
    if ($user->hasRole('landlord')) {
        return redirect('/landlord');
    }
    //if user has role is admin or staff
    if ($user->hasAnyRole(['admin', 'staff'])) {
        return redirect('/admin');
    }


    return redirect('/admin');
})
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/notifications', function () {
    $user = auth()->user();
    if ($user->hasRole('tenant')) {
        return redirect()->route('tenant.notifications');
    }
    if ($user->hasRole('landlord')) {
        return redirect()->route('landlord.notifications');
    }
    return redirect()->route('admin.notifications');
})
    ->middleware(['auth'])
    ->name('notifications');


require __DIR__ . '/auth.php';
require __DIR__ . '/landlord.php';
require __DIR__ . '/tenant.php';
require __DIR__ . '/admin.php';

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [MyWelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [MyWelcomeController::class, 'savePassword']);
});

Route::get('/test', function () {
    $expensesTrends = Trend::model(\App\Models\Expense::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->sum('amount');

    //[{"date":"2024-01","aggregate":0},{"date":"2024-02","aggregate":0},{"date":"2024-03","aggregate":0},{"date":"2024-04","aggregate":0},{"date":"2024-05","aggregate":0},{"date":"2024-06","aggregate":0},{"date":"2024-07","aggregate":0},{"date":"2024-08","aggregate":0},{"date":"2024-09","aggregate":0},{"date":"2024-10","aggregate":0},{"date":"2024-11","aggregate":0},{"date":"2024-12","aggregate":0}]
    return $expensesTrends;
});
