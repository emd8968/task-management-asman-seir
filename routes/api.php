<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use \App\Http\Controllers\TaskController;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return [
        'token' => $user->createToken('api-token')->plainTextToken
    ];
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('tasks', TaskController::class)->only(['store', 'update', 'destroy','index']);

    Route::prefix('tasks')->group(function () {
        Route::post('/bulk-insert', [TaskController::class, 'bulkStore']);
        Route::post('/bulk-update', [TaskController::class, 'bulkUpdate']);
    });

});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
