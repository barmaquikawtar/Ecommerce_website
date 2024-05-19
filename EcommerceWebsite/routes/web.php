<?php

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

Route::get('/auth/redirect/{type}', [\App\Http\Controllers\ClientAuthController::class,'SocialLoginRedirect']);

Route::get('/auth/callback/{type}', [\App\Http\Controllers\ClientAuthController::class,'SocialLoginRedirectBack']);

Route::get('/', [\App\Http\Controllers\UserController::class, 'Home'])->name('homepage');
/**message***/
Route::get('/message', [\App\Http\Controllers\UserController::class, 'messagepage']);
Route::post('/sendmessage', [\App\Http\Controllers\UserController::class, 'sendmessage']);
/**product**/
Route::get('/product/{id}', [\App\Http\Controllers\UserController::class, 'product']);
Route::post('/getproductinfo', [\App\Http\Controllers\UserController::class, 'getproductinfo']);
/**categories**/
Route::get('/Category/{id}', [\App\Http\Controllers\UserController::class, 'categoryproductd']);
Route::get('/SousCategory/{id}', [\App\Http\Controllers\UserController::class, 'childCategory']);
Route::get('/statut/{name}', [\App\Http\Controllers\UserController::class, 'bystatutproducts']);
Route::get('/meilleures_ventes', [\App\Http\Controllers\UserController::class, 'meilleures_ventes']);
Route::post('/filterproductbytype/{id?}/{name?}', [\App\Http\Controllers\UserController::class, 'filterproductbytype']);
/**search**/
Route::get('/searchsuggestion', [\App\Http\Controllers\UserController::class, 'searchsuggestion']);
Route::get('/search', [\App\Http\Controllers\UserController::class, 'search']);
Route::post('/filtersearch', [\App\Http\Controllers\UserController::class, 'filtersearch']);
/**client register**/
Route::get('/connexion', [\App\Http\Controllers\ClientAuthController::class, 'connexion'])->name('clientlogin');
Route::post('/connexioncheck', [\App\Http\Controllers\ClientAuthController::class, 'connexioncheck']);

Route::get('/inscrire ', [\App\Http\Controllers\ClientAuthController::class, 'inscrire']);
Route::post('/inscrirecheck', [\App\Http\Controllers\ClientAuthController::class, 'inscrirecheck']);
Route::post('/logout', [\App\Http\Controllers\ClientAuthController::class, 'logout'])->middleware('auth:client');
Route::get('dashboard', [\App\Http\Controllers\ClientController::class, 'dashboard']);
Route::get('/information', [\App\Http\Controllers\ClientAuthController::class, 'information'])->middleware('auth:client');
Route::post('/informationcheck', [\App\Http\Controllers\ClientAuthController::class, 'informationcheck'])->middleware('auth:client');
Route::get('/adresses', [\App\Http\Controllers\ClientAuthController::class, 'adresses'])->middleware('auth:client');
Route::post('/adressecheck', [\App\Http\Controllers\ClientAuthController::class, 'adressecheck'])->middleware('auth:client');
Route::get('/forgetpassword', [\App\Http\Controllers\ClientAuthController::class, 'forgetpassword']);
Route::post('/forgetpasswordcheck', [\App\Http\Controllers\ClientAuthController::class, 'forgetpasswordcheck']);
Route::get('/changepassword/{token}', [\App\Http\Controllers\ClientAuthController::class, 'changepassword']);
Route::post('/changepasswpordcheck', [\App\Http\Controllers\ClientAuthController::class, 'changepasswpordcheck']);

/**Pane**/
Route::post('/addtopane', [\App\Http\Controllers\ClientController::class, 'addtopane']);
Route::get('/panier', [\App\Http\Controllers\ClientController::class, 'pane']);
Route::post('/deletepanier', [\App\Http\Controllers\ClientController::class, 'deletepanier']);
Route::post('/changepanequantity', [\App\Http\Controllers\ClientController::class, 'changepanequantity']);

/**Commande**/
Route::get('/Commande', [\App\Http\Controllers\ClientController::class, 'Commande']);
Route::post('/Commandeclick', [\App\Http\Controllers\ClientController::class, 'Commandeclick']);
Route::post('/validationclick', [\App\Http\Controllers\ClientController::class, 'validationclick']);
Route::get('/pay', [\App\Http\Controllers\ClientController::class, 'pay']);
Route::get('/mescommande', [\App\Http\Controllers\ClientController::class, 'mescommande']);
Route::get('/test{id}', [\App\Http\Controllers\ClientController::class, 'test']);

/**admin**/
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class,'dashboard'])->name('dashboard');

    Route::get('/', function () {
        return redirect('admin/dashboard');
    });

    /**commande**/
    Route::get('/commades', [\App\Http\Controllers\AdminController::class, 'commades']);
    Route::get('/ajaxcommades', [\App\Http\Controllers\AdminController::class, 'ajaxcommades']);
    Route::get('/getDetailsajaxcommades/{id}', [\App\Http\Controllers\AdminController::class, 'getDetailsajaxcommades']);

    Route::post('/updatecommandestatut', [\App\Http\Controllers\AdminController::class, 'updatecommandestatut']);

    Route::get('/categories', [\App\Http\Controllers\AdminController::class, 'categories']);
    Route::get('/ajaxcategories', [\App\Http\Controllers\AdminController::class, 'ajaxcategories']);
    Route::get('/addcategorypage', [\App\Http\Controllers\AdminController::class, 'addcategorypage']);
    Route::post('/addcategory', [\App\Http\Controllers\AdminController::class, 'addcategory']);
    Route::post('/deletecategory', [\App\Http\Controllers\AdminController::class, 'deletecategory']);

    Route::get('/souscategories', [\App\Http\Controllers\AdminController::class, 'souscategories']);
    Route::get('/ajaxsouscategories', [\App\Http\Controllers\AdminController::class, 'ajaxsouscategories']);
    Route::get('/addsouscategorypage', [\App\Http\Controllers\AdminController::class, 'addsouscategoriespage']);
    Route::post('/addsouscategories', [\App\Http\Controllers\AdminController::class, 'addsouscategories']);
    Route::post('/deletesouscategories', [\App\Http\Controllers\AdminController::class, 'deletesouscategories']);

    Route::get('/messages', [\App\Http\Controllers\AdminController::class, 'messages']);
    Route::get('/ajaxmessages', [\App\Http\Controllers\AdminController::class, 'ajaxmessages']);

    Route::post('/deletemessage', [\App\Http\Controllers\AdminController::class, 'deletemessage']);
    Route::post('/downlaodmessagefile', [\App\Http\Controllers\AdminController::class, 'downlaodmessagefile']);

    Route::get('/clients', [\App\Http\Controllers\AdminController::class, 'clients']);
    Route::get('/ajaxclients', [\App\Http\Controllers\AdminController::class, 'ajaxclients']);


    Route::get('/companies', [\App\Http\Controllers\AdminController::class, 'companies']);
    Route::get('/ajaxcompanies', [\App\Http\Controllers\AdminController::class, 'ajaxcompanies']);
    Route::get('/addcompanypage', [\App\Http\Controllers\AdminController::class, 'addcompanypage']);
    Route::post('/addcompanies', [\App\Http\Controllers\AdminController::class, 'addcompanies']);
    Route::get('/modifycompanypage/{id}', [\App\Http\Controllers\AdminController::class, 'modifycompanypage']);
    Route::post('/modifycompanies', [\App\Http\Controllers\AdminController::class, 'modifycompanies']);
    Route::post('/deletecompanies', [\App\Http\Controllers\AdminController::class, 'deletecompanies']);

    Route::get('/profile', [\App\Http\Controllers\AdminController::class, 'profile']);
    Route::post('/updateprofile', [\App\Http\Controllers\AdminController::class, 'updateprofile']);

    Route::get('/products', [\App\Http\Controllers\AdminController::class, 'products']);    Route::get('/products', [\App\Http\Controllers\AdminController::class, 'products']);
    Route::get('/ajaxproducts', [\App\Http\Controllers\AdminController::class, 'ajaxproducts']);
    Route::get('/addproductpage', [\App\Http\Controllers\AdminController::class, 'addproductpage']);
    Route::post('/addproduct', [\App\Http\Controllers\AdminController::class, 'addproduct']);
    Route::get('/modifyproductpage/{id}', [\App\Http\Controllers\AdminController::class, 'modifyproductpage']);
    Route::post('/modifyproduct/{id}', [\App\Http\Controllers\AdminController::class, 'modifyproduct']);
    Route::post('/deleteproduct', [\App\Http\Controllers\AdminController::class, 'deleteproduct']);
    Route::post('/filtercategory', [\App\Http\Controllers\AdminController::class, 'filtercategory']);

    Route::get('/bestproducts', [\App\Http\Controllers\AdminController::class, 'bestproducts']);
    Route::get('/ajaxbestproducts', [\App\Http\Controllers\AdminController::class, 'ajaxbestproducts']);
    Route::get('/addbestproductpage', [\App\Http\Controllers\AdminController::class, 'addbestproductpage']);
    Route::post('/addbestproduct', [\App\Http\Controllers\AdminController::class, 'addbestproduct']);
    Route::post('/deletebestproduct', [\App\Http\Controllers\AdminController::class, 'deletebestproduct']);

});

require __DIR__ . '/auth.php';
