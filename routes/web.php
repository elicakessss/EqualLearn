<?php

use App\Http\Controllers\VideoController;
use App\Http\Controllers\Admin\VideoManagementController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function(\Illuminate\Http\Request $request) {
    // End any existing session when visiting the welcome/login page
    if (\Illuminate\Support\Facades\Auth::check()) {
        \Illuminate\Support\Facades\Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Quietly redirect without notification
        return redirect()->route('welcome');
    }
    return view('welcome');
})->name('welcome');
Route::get('/home', function(\Illuminate\Http\Request $request) {
    $categories = \App\Models\Category::all();
    $videos = \App\Models\Video::with(['category', 'user'])
        ->where('is_approved', true)
        ->when($request->query('category'), function($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        })
        ->when($request->query('search'), function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
        ->latest()
        ->paginate(12);
    
    $selectedCategory = $request->query('category') ? \App\Models\Category::find($request->query('category')) : null;
    
    return view('home', compact('categories', 'videos', 'selectedCategory'));
})->name('home');

// Redirect /videos to home since home now shows all videos
Route::get('/videos', function() {
    return redirect()->route('home');
});

// Authentication routes (provided by Laravel Breeze or similar)
require __DIR__.'/auth.php';

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // All users: redirect /dashboard to /home
    Route::get('/dashboard', function () {
        return redirect('/home');
    })->name('dashboard');

    // Account page for all users
    Route::get('/account', function () {
        return view('account');
    })->name('account');

    // Debug route to check user roles
    Route::get('/debug/user-roles', function () {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Not authenticated']);
        }
        
        return response()->json([
            'user_id' => $user->id,
            'user_email' => $user->email,
            'roles' => $user->roles->pluck('name')->toArray(),
            'has_creator_role' => $user->hasRole('creator'),
            'roles_count' => $user->roles()->count()
        ]);
    })->name('debug.user.roles');

    // Test route without middleware
    Route::get('/debug/videos/create', [VideoController::class, 'create'])->name('debug.videos.create');

    // Test with just auth middleware
    Route::get('/test/videos/create', [VideoController::class, 'create'])->middleware('auth')->name('test.videos.create');

    // Creator-only video upload routes - MUST come BEFORE /videos/{video:slug}
    Route::middleware(['role:creator'])->group(function () {
        Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
        Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
    });

    // Admin-only management routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        // Category management
        Route::resource('/admin/categories', \App\Http\Controllers\Admin\CategoryController::class)
            ->names([
                'index' => 'admin.categories.index',
                'create' => 'admin.categories.create',
                'store' => 'admin.categories.store',
                'edit' => 'admin.categories.edit',
                'update' => 'admin.categories.update',
                'destroy' => 'admin.categories.destroy'
            ]);
        
        // User management
        Route::get('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::put('/admin/users/{user}/role', [\App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('admin.users.updateRole');
        
        // System logs
        Route::get('/admin/logs', [\App\Http\Controllers\Admin\SystemLogController::class, 'index'])->name('admin.logs.index');
        
        // Video management
        Route::get('/admin/videos', [\App\Http\Controllers\Admin\VideoController::class, 'index'])->name('admin.videos.index');
        Route::post('/admin/videos/{video}/approve', [\App\Http\Controllers\Admin\VideoController::class, 'approve'])->name('admin.videos.approve');
        Route::delete('/admin/videos/{video}/reject', [\App\Http\Controllers\Admin\VideoController::class, 'reject'])->name('admin.videos.reject');
        Route::post('/admin/videos/{video}/unapprove', [\App\Http\Controllers\Admin\VideoController::class, 'unapprove'])->name('admin.videos.unapprove');
    });
});

// Video show route - MUST come AFTER /videos/create to avoid conflicts
Route::get('/videos/{video:slug}', [VideoController::class, 'show'])->name('videos.show');
