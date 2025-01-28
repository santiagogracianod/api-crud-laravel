<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::prefix('v1')->group(function () {
    Route::resource('/note', NoteController::class);
});
