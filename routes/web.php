<?php

use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inquiry.inquiry');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/inquiry', function () {
    return view('inquiry.inquiry');
});
Route::get('/inquiry-form', function () {
    return view('inquiry.inquiryForm');
});
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');
Route::get('/followups', function () {
    return view('followups.follow');
});
Route::get('/Shedule', function () {
    return view('followups.shedule');
});
Route::get('/document', function () {
    return view('filemagement.createDocument');
});
Route::get('/meeting', function () {
    return view('meeting.createMeeting');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
