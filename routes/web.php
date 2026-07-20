<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

// Redirection de la racine vers le dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard public
Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');

// Fiche produit
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Pages publiques
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Pages légales
Route::get('/cgv', function () { return view('pages.cgv'); })->name('cgv');
Route::get('/privacy', function () { return view('pages.privacy'); })->name('privacy');
Route::get('/legal', function () { return view('pages.legal'); })->name('legal');

// Routes client (authentifié et non-admin)
Route::middleware(['auth', 'client'])->group(function () {
    // Panier
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

    // Commandes
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Favoris
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'destroy'])->name('wishlist.remove');

    // Avis
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Paiement
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{order}/process', [PaymentController::class, 'process'])->name('payment.process');
});

//route notification
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});

// Routes administrateur
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Graphiques
    Route::get('/charts/daily', [ChartController::class, 'dailySales'])->name('charts.daily');
    Route::get('/charts/monthly', [ChartController::class, 'monthlySales'])->name('charts.monthly');

    // Produits
    Route::resource('products', AdminProductController::class);
    Route::get('/products/{product}/stock-history', [AdminProductController::class, 'stockHistory'])->name('products.stock-history');

    // Commandes
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('orders.index');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Clients
    Route::resource('clients', ClientController::class)->except(['create', 'store']);

    // Catégories
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Exports
    Route::get('/export/orders', [ExportController::class, 'orders'])->name('export.orders');
    Route::get('/export/clients', [ExportController::class, 'clients'])->name('export.clients');
});

// ⚠️ ROUTE TEMPORAIRE POUR CRÉER UN ADMIN (À SUPPRIMER APRÈS UTILISATION)
Route::get('/create-admin', function () {
    // Vérifier si l'admin existe déjà pour éviter les doublons
    if (User::where('email', 'admin@exemple.com')->exists()) {
        return 'Un administrateur existe déjà. Connectez-vous avec admin@exemple.com / password';
    }

    $user = User::create([
        'name' => 'Admin',
        'email' => 'admin@exemple.com',
        'password' => bcrypt('password'),
        'is_admin' => true,
    ]);

    return '✅ Admin créé avec succès !<br>
            <strong>Email :</strong> admin@exemple.com<br>
            <strong>Mot de passe :</strong> password<br>
            <a href="/login">Se connecter</a>';
});

Route::get('/storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');
    if (file_exists($link)) {
        return 'Le lien symbolique existe déjà.';
    }
    symlink($target, $link);
    return '✅ Lien symbolique créé avec succès !';
});


// ⚠️ ROUTES TEMPORAIRES POUR LE DÉPLOIEMENT (À SUPPRIMER APRÈS)
Route::get('/run-migrations', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return '✅ Migrations exécutées avec succès !';
    } catch (\Exception $e) {
        return '❌ Erreur : ' . $e->getMessage();
    }
});

Route::get('/storage-link', function () {
    try {
        Artisan::call('storage:link');
        return '✅ Lien symbolique créé avec succès !';
    } catch (\Exception $e) {
        return '❌ Erreur : ' . $e->getMessage();
    }
});
// Route de test
Route::get('/test-produits', [ProductController::class, 'index'])->name('test.produits');

Route::get('/fix-database', function () {
    try {
        $columns = ['payment_status', 'payment_method', 'currency'];
        $results = [];

        foreach ($columns as $col) {
            $check = DB::select("SELECT column_name FROM information_schema.columns WHERE table_name='orders' AND column_name='$col'");
            if (empty($check)) {
                // Ajouter la colonne avec le bon type
                if ($col === 'payment_status') {
                    DB::statement("ALTER TABLE orders ADD COLUMN payment_status VARCHAR(255) DEFAULT 'pending'");
                } elseif ($col === 'payment_method') {
                    DB::statement("ALTER TABLE orders ADD COLUMN payment_method VARCHAR(255) NULL");
                } elseif ($col === 'currency') {
                    DB::statement("ALTER TABLE orders ADD COLUMN currency VARCHAR(3) DEFAULT 'USD'");
                }
                $results[] = "✅ Colonne $col ajoutée.";
            } else {
                $results[] = "ℹ️ Colonne $col existe déjà.";
            }
        }

        // Recréer le lien symbolique
        \Artisan::call('storage:link');
        $results[] = '✅ Lien symbolique recréé.';

        return implode('<br>', $results);
    } catch (\Exception $e) {
        return '❌ Erreur : ' . $e->getMessage();
    }
});

require __DIR__.'/auth.php';