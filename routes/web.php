<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminServiceRequestController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ServiceRequestController;
use App\Http\Controllers\User\DocumentController;

Route::get('/', function () { return view('welcome'); });

// User Authentication
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.register');
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

// User Dashboard
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

// User Service Requests
Route::get('/requests', [ServiceRequestController::class, 'index'])->name('user.requests.index');
Route::get('/requests/create', [ServiceRequestController::class, 'create'])->name('user.requests.create');
Route::post('/requests', [ServiceRequestController::class, 'store'])->name('user.requests.store');
Route::get('/requests/{id}', [ServiceRequestController::class, 'show'])->name('user.requests.show');
Route::post('/requests/{id}/resubmit', [ServiceRequestController::class, 'resubmit'])->name('user.requests.resubmit');

// User Documents
Route::get('/documents', [DocumentController::class, 'index'])->name('user.documents.index');
Route::post('/documents', [DocumentController::class, 'store'])->name('user.documents.store');
Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('user.documents.download');
Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('user.documents.destroy');

// Admin Authentication
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Admin Service Requests Management
Route::get('/admin/service-requests', [AdminServiceRequestController::class, 'index'])->name('admin.service-requests.index');
Route::get('/admin/service-requests/{id}', [AdminServiceRequestController::class, 'show'])->name('admin.service-requests.show');
Route::post('/admin/service-requests/{id}/approve', [AdminServiceRequestController::class, 'approve'])->name('admin.service-requests.approve');
Route::post('/admin/service-requests/{id}/reject', [AdminServiceRequestController::class, 'reject'])->name('admin.service-requests.reject');
Route::post('/admin/service-requests/{id}/complete', [AdminServiceRequestController::class, 'complete'])->name('admin.service-requests.complete');