<?php

use App\Http\Controllers\VideoController;
use App\Http\Controllers\Admin\VideoManagementController;
use Illuminate\Support\Facades\Route;

// Public routes (only for non-authenticated users)
Route::get('/', function(\Illuminate\Http\Request $request) {
    // If user is already authenticated, redirect to home
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('home');
    }
    return view('welcome');
})->name('welcome');

// Support page - accessible to everyone
Route::get('/support', function() {
    return view('support');
})->name('support');

// Authentication routes (provided by Laravel Breeze or similar)
require __DIR__.'/auth.php';

// All application routes require authentication
Route::middleware(['auth'])->group(function () {
    
    // Home page - protected by auth
    Route::get('/home', function(\Illuminate\Http\Request $request) {
        $categories = \App\Models\Category::all();
        $countries = \App\Models\Country::orderBy('name')->get();
        $videos = \App\Models\Video::with(['category', 'country', 'user'])
            ->where('is_approved', true)
            ->when($request->query('category'), function($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($request->query('country'), function($query, $countryId) {
                return $query->where('country_id', $countryId);
            })
            ->when($request->query('search'), function($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(12);

        $selectedCategory = $request->query('category') ? \App\Models\Category::find($request->query('category')) : null;
        $selectedCountry = $request->query('country') ? \App\Models\Country::find($request->query('country')) : null;

        return view('home', compact('categories', 'countries', 'videos', 'selectedCategory', 'selectedCountry'));
    })->name('home');

    // Creator-only video upload routes - MUST come BEFORE /videos/{video:slug}
    Route::middleware(['role:creator'])->group(function () {
        Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
        Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
    });

    // Redirect /videos to home since home now shows all videos
    Route::get('/videos', function() {
        return redirect()->route('home');
    });

    // Video show route - protected by auth
    Route::get('/videos/{video:slug}', [VideoController::class, 'show'])->name('videos.show');
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
                'show' => 'admin.categories.show',
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

        // Country management
        Route::resource('/admin/countries', \App\Http\Controllers\Admin\CountryController::class)
            ->names([
                'index' => 'admin.countries.index',
                'create' => 'admin.countries.create',
                'store' => 'admin.countries.store',
                'edit' => 'admin.countries.edit',
                'update' => 'admin.countries.update',
                'destroy' => 'admin.countries.destroy'
            ]);
    });
    // Video edit routes - MUST come BEFORE /videos/{video:slug} to avoid conflicts
    Route::get('/videos/{video:slug}/edit', [VideoController::class, 'edit'])->name('videos.edit');
    Route::put('/videos/{video:slug}', [VideoController::class, 'update'])->name('videos.update');

    // Video like routes
    Route::post('/videos/{video:slug}/like', [\App\Http\Controllers\VideoLikeController::class, 'toggle'])->name('videos.like');

    // Profile management routes
    Route::get('/profile', [\App\Http\Controllers\UserProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [\App\Http\Controllers\UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/profile/password', [\App\Http\Controllers\UserProfileController::class, 'updatePassword'])->name('profile.password');

    // Manual table creation routes (for missing tables)
    Route::get('/create-system-logs-table', function() {
        try {
            \Illuminate\Support\Facades\DB::statement("
                CREATE TABLE IF NOT EXISTS `system_logs` (
                  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
                  `action` varchar(255) NOT NULL,
                  `description` text NOT NULL,
                  `ip_address` varchar(255) DEFAULT NULL,
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `system_logs_user_id_foreign` (`user_id`),
                  CONSTRAINT `system_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            ");
            return 'System logs table created successfully!';
        } catch (\Exception $e) {
            return 'Error creating table: ' . $e->getMessage();
        }
    });

}); // End of auth middleware group
