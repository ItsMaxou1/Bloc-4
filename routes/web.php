<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminProductController;

// 🏠 Redirection vers la page d'accueil de l'admin
Route::redirect('/', '/admin');



// 📁 Groupe de routes admin (prefix: /admin | name: admin.)
Route::prefix('admin')->name('admin.')->group(function () {

    // 🔒 Routes admin protégées par authentification
    // 👇 Quand tu remettras la protection plus tard :
    // Route::middleware(['auth', 'role:admin'])->group(function () {
    //     Route::get('/', [AdminProductController::class, 'dashboard'])->name('welcome');
    //     Route::resource('products', AdminProductController::class); // version raccourcie
    // });


    // 🔓 Routes admin accessibles sans authentification (pour le dev)

    // 🏠 Accueil admin (dashboard)
    Route::get('/', [AdminProductController::class, 'dashboard'])->name('welcome');


    // 📦 CRUD Produits
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');             // Liste des produits
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');     // Formulaire de création
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');             // Traitement de création
    Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('products.show');      // Affichage d’un produit
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit'); // Formulaire d’édition
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');  // Traitement de l’édition
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy'); // Suppression

});
