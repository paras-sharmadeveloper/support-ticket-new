<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\{EmailSettingController, AssetController, LocationController, RenewalController, DashboardController};

use App\Models\{Ticket, Renewal};

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'company.active', 'mail.config'])->group(function () {

    Route::get('/mail/inbox', [EmailController::class, 'inbox'])->name('mail.inbox');

    Route::get('/mail/sent', [EmailController::class, 'sent'])->name('mail.sent');

    Route::get('/mail/compose', [EmailController::class, 'compose'])->name('mail.compose');

    Route::post('/mail/send', [EmailController::class, 'send'])->name('mail.send');
    Route::get('/mail/view/{id}', [EmailController::class, 'view'])->name('mail.view');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'company.active'])->name('dashboard');


Route::get('/companies/{id}/edit', [CompanyController::class, 'edit'])
    ->name('companies.edit');

Route::put('/companies/{id}', [CompanyController::class, 'update'])
    ->name('companies.update');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'company.active'])->group(function () {});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::resource('departments', DepartmentController::class);
});
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::middleware(['auth'])->group(function () {

    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');

    Route::post('/companies/store', [CompanyController::class, 'store'])->name('companies.store');

    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::post('/companies/status/{id}', [CompanyController::class, 'changeStatus'])
        ->name('companies.status');


    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');

    Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
});
Route::middleware(['auth', 'company.active', 'mail.config'])->group(function () {

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');

    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');

    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');

    Route::post('/tickets/reply', [TicketController::class, 'reply'])->name('tickets.reply');
    Route::post('/tickets/{id}/resolve', [TicketController::class, 'resolve'])
        ->name('tickets.resolve');
});

Route::middleware(['auth', 'mail.config'])->group(function () {

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
});


Route::middleware(['auth', 'mail.config'])->group(function () {

    Route::get('/email-settings', [EmailSettingController::class, 'index'])
        ->name('email.settings');

    Route::post('/email-settings', [EmailSettingController::class, 'store'])
        ->name('email.settings.store');

    Route::post('/email-test', [EmailSettingController::class, 'sendTest'])
        ->name('email.settings.test');

    Route::post(
        '/employees/{id}/resend-email',
        [EmployeeController::class, 'resendEmail']
    )->name('employees.resend.email');
});
Route::middleware(['auth', 'company.active'])->group(function () {

    Route::resource('assets', AssetController::class);
});
Route::get('/assets/import', [AssetController::class, 'importForm'])
    ->name('assets.import');

Route::post('/assets/import', [AssetController::class, 'import'])
    ->name('assets.import.store');
Route::post('/locations/store', [LocationController::class, 'store'])
    ->name('locations.store');
Route::resource('renewals', RenewalController::class);
