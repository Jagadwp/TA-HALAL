<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HewaniController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\NabatiController;
use App\Http\Controllers\ProductController;

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


// TA Routes Start
Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    
    Route::prefix('product')->name('product.')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product_id}', [ProductController::class, 'show'])->name('show');
        Route::get('/{product_id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product_id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product_id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('ingredient')->name('ingredient.')->group(function() {
        Route::get('/', [IngredientController::class, 'index'])->name('index');
        Route::get('/{product_id}/create', [IngredientController::class, 'create'])->name('create');
        Route::post('/', [IngredientController::class, 'store'])->name('store');
        Route::get('/{ingredient_id}', [IngredientController::class, 'show'])->name('show');
        Route::get('/{ingredient_id}/edit', [IngredientController::class, 'edit'])->name('edit');
        Route::put('/{ingredient_id}', [IngredientController::class, 'update'])->name('update');
        Route::delete('/{ingredient_id}', [IngredientController::class, 'destroy'])->name('destroy');
        
        
        Route::get('/{ingredient_id}/check/certificate', [IngredientController::class, 'checkCertificate'])->name('certificate');
        Route::put('/store/certificate', [IngredientController::class, 'storeCertificate'])->name('certificate.store');
    });

    Route::prefix('activity')->name('activity.')->group(function() {
        Route::post('/', [ActivityController::class, 'store'])->name('store');
    });

    Route::prefix('hewani')->name('hewani.')->group(function() {
        // Not implemented yet
        Route::get('/{ingredient_id}/check/uji-lab-babi', [HewaniController::class, 'checkUjiLabBabi'])->name('uji-lab-babi');
        Route::put('/store/uji-lab-babi', [HewaniController::class, 'storeUjiLabBabi'])->name('uji-lab-babi.store');

        Route::get('/{ingredient_id}/check/kelompok-bahan', [HewaniController::class, 'checkKelompokBahan'])->name('kelompok-bahan');
        Route::get('/{ingredient_id}/check/kehalalan-hewan', [HewaniController::class, 'checkKehalalanHewan'])->name('kehalalan-hewan');

        Route::get('/{ingredient_id}/check/daging', [HewaniController::class, 'checkDaging'])->name('daging');
        Route::get('/{ingredient_id}/check/lemak', [HewaniController::class, 'checkLemak'])->name('lemak');
        Route::get('/{ingredient_id}/check/kulit', [HewaniController::class, 'checkKulit'])->name('kulit');
        Route::get('/{ingredient_id}/check/tulang', [HewaniController::class, 'checkTulang'])->name('tulang');
        Route::get('/{ingredient_id}/check/jerohan', [HewaniController::class, 'checkJerohan'])->name('jerohan');
        Route::get('/{ingredient_id}/check/sembelih', [HewaniController::class, 'checkSembelih'])->name('halal-hewan');
        
        Route::get('/{ingredient_id}/check/pengolahan-tambahan', [HewaniController::class, 'checkPengolahanTambahan'])->name('pengolahan-tambahan');

        Route::get('/{ingredient_id}/check/pemanis', [HewaniController::class, 'checkPemanis'])->name('pemanis');
        Route::get('/{ingredient_id}/check/pewarna', [HewaniController::class, 'checkPewarna'])->name('pewarna');
        Route::get('/{ingredient_id}/check/emulsifier', [HewaniController::class, 'checkEmulsifier'])->name('emulsifier');
        Route::get('/{ingredient_id}/check/flavor', [HewaniController::class, 'checkFlavor'])->name('flavor');
        Route::get('/{ingredient_id}/check/penyedap', [HewaniController::class, 'checkPenyedap'])->name('penyedap');
        Route::get('/{ingredient_id}/check/garam', [HewaniController::class, 'checkGaram'])->name('garam');
        Route::get('/{ingredient_id}/check/pengawet', [HewaniController::class, 'checkPengawet'])->name('pengawet');
        Route::get('/{ingredient_id}/check/btp', [HewaniController::class, 'checkBtp'])->name('btp');
    });

    Route::prefix('nabati')->name('nabati.')->group(function() {
        // Not implemented yet
        Route::get('/{ingredient_id}/check/uji-lab-babi', [NabatiController::class, 'checkUjiLabBabi'])->name('uji-lab-babi');
        Route::put('/store/uji-lab-babi', [NabatiController::class, 'storeUjiLabBabi'])->name('uji-lab-babi.store');

        Route::get('/{ingredient_id}/check/uji-etanol', [NabatiController::class, 'checkUjiEtanol'])->name('uji-etanol');
        Route::put('/store/uji-etanol', [NabatiController::class, 'storeUjiEtanol'])->name('uji-etanol.store');

        // Simpan stack halaman list titik kritis per bahan
        Route::get('/{ingredient_id}/check/kelompok-bahan', [NabatiController::class, 'checkKelompokBahan'])->name('kelompok-bahan');

        Route::get('/{ingredient_id}/check/laktosa', [NabatiController::class, 'checkLaktosa'])->name('laktosa');
        Route::get('/{ingredient_id}/check/karbon-aktif-minyak', [NabatiController::class, 'checkKarbonAktifMinyak'])->name('karbon-aktif-minyak');
        Route::get('/{ingredient_id}/check/vitamin', [NabatiController::class, 'checkVitamin'])->name('vitamin');
        Route::get('/{ingredient_id}/check/emulsifier', [NabatiController::class, 'checkEmulsifier'])->name('emulsifier');
        Route::get('/{ingredient_id}/check/enzim', [NabatiController::class, 'checkEnzim'])->name('enzim');
        Route::get('/{ingredient_id}/check/karbon-aktif', [NabatiController::class, 'checkKarbonAktif'])->name('karbon-aktif');
        Route::get('/{ingredient_id}/check/flavor', [NabatiController::class, 'checkFlavor'])->name('flavor');
        Route::get('/{ingredient_id}/check/pewarna', [NabatiController::class, 'checkPewarna'])->name('pewarna');
        Route::get('/{ingredient_id}/check/resin', [NabatiController::class, 'checkResin'])->name('resin');
        Route::get('/{ingredient_id}/check/pelapis', [NabatiController::class, 'checkPelapis'])->name('pelapis');
        Route::get('/{ingredient_id}/check/pelarut', [NabatiController::class, 'checkPelarut'])->name('pelarut');
        Route::get('/{ingredient_id}/check/gula', [NabatiController::class, 'checkGula'])->name('gula');
        Route::get('/{ingredient_id}/check/proses-produksi', [NabatiController::class, 'checkProsesProduksi'])->name('proses-produksi');
        Route::get('/{ingredient_id}/check/gelatin', [NabatiController::class, 'checkGelatin'])->name('gelatin');
    });
});


// TA Routes End

Route::controller(AuthController::class)->middleware('loggedin')->group(function() {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
});

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(PageController::class)->group(function() {
        Route::get('dashboard-overview-1-page', 'dashboardOverview1')->name('dashboard-overview-1');
        Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
        Route::get('dashboard-overview-4-page', 'dashboardOverview4')->name('dashboard-overview-4');
        Route::get('categories-page', 'categories')->name('categories');
        Route::get('add-product-page', 'addProduct')->name('add-product');
        Route::get('product-list-page', 'productList')->name('product-list');
        Route::get('product-grid-page', 'productGrid')->name('product-grid');
        Route::get('transaction-list-page', 'transactionList')->name('transaction-list');
        Route::get('transaction-detail-page', 'transactionDetail')->name('transaction-detail');
        Route::get('seller-list-page', 'sellerList')->name('seller-list');
        Route::get('seller-detail-page', 'sellerDetail')->name('seller-detail');
        Route::get('reviews-page', 'reviews')->name('reviews');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('file-manager-page', 'fileManager')->name('file-manager');
        Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('post-page', 'post')->name('post');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
        Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');
        Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
        Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
        Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
        Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
        Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
        Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
        Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
        Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
        Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
        Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
        Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
        Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
        Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
        Route::get('login-page', 'login')->name('login');
        Route::get('register-page', 'register')->name('register');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('update-profile-page', 'updateProfile')->name('update-profile');
        Route::get('change-password-page', 'changePassword')->name('change-password');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
    });
});
