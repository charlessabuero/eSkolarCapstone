<?php

use App\Http\Controllers\Login as ControllersLogin;
use App\Http\Livewire\Login;
use App\Http\Livewire\RegisterScholar;
use App\Mail\TestMail;
use App\Models\Requirement;
use App\Models\ScholarshipOrganization;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
    return view('welcome');
})->name('landing-page');

Route::get('/scholarships', function () {
    return view('view.scholarship');
})->name('scholarship.view');

Route::get('/login',Login::class)->name('filament.auth.login');

// Route::post('/login', [ControllersLogin::class, 'login'])->name('login');

// Route::get('/login', [ControllersLogin::class, 'index'])
//     ->name('filament.auth.login');

Route::get('/be-a-scholar',RegisterScholar::class)->name('be-a-scholar');
