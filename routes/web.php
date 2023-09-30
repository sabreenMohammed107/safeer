<?php

use App\Http\Controllers\AllFavHotelsController;
use App\Http\Controllers\BestHotelController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogsCategoryController;
use App\Http\Controllers\CarClassController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyBranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ExploreCityController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelPricesController;
use App\Http\Controllers\HotelsTagController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SiteAuth\AuthController;
use App\Http\Controllers\SiteAuth\FaceBookController;
use App\Http\Controllers\SiteAuth\GoogleController;
use App\Http\Controllers\SiteContriesController;
use App\Http\Controllers\SiteUsersController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourGalleryController;
use App\Http\Controllers\ToursTagController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransferLocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersOrderController;
use App\Http\Controllers\UsersRoleController;
use App\Http\Controllers\VisaController;
use App\Http\Controllers\VisaTypeController;
use App\Http\Controllers\Website\BookingController;
use App\Http\Controllers\Website\ContentController;
use App\Http\Controllers\Website\HotelsController;
use App\Http\Controllers\Website\MainController;
use App\Http\Controllers\Website\SiteTransferController;
use App\Http\Controllers\Website\ToursController;
use App\Http\Controllers\Website\VisaDataController;
use App\Http\Controllers\WhyUsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');

    return "Cache cleared successfully";
});
Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

/*
Routes Before Applying Authentication
 */
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::get("/", [MainController::class, 'index']);
    Route::get("/hotels", [HotelsController::class, 'all_hotels']);
    Route::post("/hotels", [HotelsController::class, 'hotels']);
    Route::post("/hotels/retrieve", [HotelsController::class, 'fetch']);
    Route::post("/hotels/search", [HotelsController::class, 'search']);
    Route::get("/hotels/{id}", [HotelsController::class, 'profile']);
    //favourite
    Route::get("/favourite/{id}", [HotelsController::class, 'favourite']);
    //removeFavourite
    Route::get("/removeFavourite/{id}", [HotelsController::class, 'removeFavourite']);
    Route::post("/hotels/{id}/fetch", [HotelsController::class, 'fetch_hotel_cards']);
    Route::get("/hotels/review/add", [HotelsController::class, 'add_review']);
    Route::get('/fetch-hotel-filter', [HotelsController::class, 'fetch_data'])->name('fetch-hotel-filter');
    //new Routes 23-11
    Route::get("/about", [ContentController::class, 'about']);
    Route::get("/blogs", [ContentController::class, 'blogs']);

    Route::get('blogs/fetch_data', [ContentController::class, 'fetch_data']);

    Route::get('dynamicFilterBolgs/fetch', [ContentController::class, 'dynamicFilterBolgs'])->name('dynamicFilterBolgs.fetch');
    Route::get('/single-blog/{id}/{slug?}', [ContentController::class, 'singleBlog'])->name('single-blog');

    Route::get("/offers", [ContentController::class, 'offers']);

    Route::get('offers/fetch_data', [ContentController::class, 'fetch_data_offer']);
    Route::get('/single-offer/{id}/{slug?}', [ContentController::class, 'singleOffer'])->name('single-offer');


    Route::get('/contact', [ContentController::class, 'createForm']);
    Route::post('/contact', [ContentController::class, 'ContactUsForm'])->name('contact.store');
    Route::post('/sendNewsLetter', [ContentController::class, 'sendNewsLetter']);
    Route::get('/reload-captcha', [ContentController::class, 'reloadCaptcha']);
    // outocomplete search
    // Route::get('/autocomplete-search', [HotelsController::class, 'autocompleteSearch']);
    Route::get('autocomplete', [HotelsController::class, 'autocompleteSearch'])->name('autocomplete');
    //tours
    Route::get("/tours", [ToursController::class, 'all_tours']);
    Route::post("/tours", [ToursController::class, 'tours']);
    Route::get('/fetch-tour-filter', [ToursController::class, 'fetch_data'])->name('fetch-tour-filter');
    Route::post("/tours/retrieve", [ToursController::class, 'fetch']);
    Route::get("/tours/{id}/{slug?}", [ToursController::class, 'profile']);
    Route::post("/bookTours", [ToursController::class, 'bookTours']);
    //getTourByCity
    Route::get("/tourByCity/{id}", [ToursController::class, 'getTourByCity'])->name("tourByCity");
    //removeFavouriteTours

    Route::get("/removeFavouriteTours/{id}", [ToursController::class, 'removeFavourite']);
    //favouriteTours
    Route::get("/favouriteTours/{id}", [ToursController::class, 'favourite']);
    Route::get("/tours/review/add", [ToursController::class, 'add_review']);

    //transfer
    Route::get("/transfers", [SiteTransferController::class, 'all_transfer']);
    Route::post("/transfers", [SiteTransferController::class, 'transfer']);
    Route::get('/fetch-transfers-filter', [SiteTransferController::class, 'fetch_data'])->name('fetch-transfers-filter');
    Route::post("/transfers/retrieve", [SiteTransferController::class, 'fetch']);
    Route::post("/bookTransfer", [SiteTransferController::class, 'bookTransfer']);
    //visa
    Route::get("/visa", [VisaDataController::class, 'all_visa']);
    Route::post("/Safer/BookVisa", [VisaDataController::class, 'bookVisas']);
    //dynamicvisatype.fetch
    Route::get('dynamicvisatype/fetch', [VisaDataController::class, 'fetchCat'])->name('dynamicvisatype.fetch');
    //dynamicnationality.fetch
    Route::get('dynamicnationality/fetch', [VisaDataController::class, 'fetchNationality'])->name('dynamicnationality.fetch');
    //dynamicCost
    Route::get('dynamicCost/fetch', [VisaDataController::class, 'dynamicCost'])->name('dynamicCost.fetch');
    Route::get("/getLocal", function () {
        return LaravelLocalization::getCurrentLocale();
    });
    Route::middleware(['prevent-relogin'])->group(function () {
        //site-login
        Route::get("/safer/login", [ContentController::class, 'loginSite'])->name("siteLogin");
        Route::post("/safer/login", [AuthController::class, 'Login'])->name("ProceedLogin");

        //signupSite
        Route::get("/safer/register", [ContentController::class, 'signupSite'])->name("siteRegister");

        Route::post("/safer/register", [AuthController::class, 'Register'])->name("ProceedRegister");

    });
    Route::get('/safer/reload-captcha-register', [ContentController::class, 'reloadCaptcha']);

    // Logout
    Route::get("/safer/logout", [AuthController::class, 'Logout'])->name("siteLogout");
    // user profile

    Route::get("/safer/profile/{id}", [AuthController::class, 'profile'])->name("siteProfile");
    //updateProfile
    Route::post("/safer/updateProfile", [AuthController::class, 'updateProfile'])->name("updateProfile");

    Route::get('load-rooms-data', [AuthController::class, 'loadMoreData'])->name('load-rooms-data');

    //hotelByCity
    Route::get("/hotelByCity/{id}", [HotelsController::class, 'getHotelByCity'])->name("hotelByCity");

    //dynamicSearchCity.fetch
    Route::get('dynamicSearchCity/fetch', [MainController::class, 'fetchCity'])->name('dynamicSearchCity.fetch');

    Route::get("/safer/room/{id}/book/{cap}", [BookingController::class, 'BookRoom'])->name("bookRoom");
    Route::get("/safer/room/{id}/book/{cap}/exchange", [BookingController::class, 'ExBookRoom'])->name("exBookRoom");
    Route::get("/terms", [MainController::class, 'terms'])->name("terms");

    /**
     * fast login using social media
     */
    //
    // Facebook
    Route::prefix('facebook')->name('facebook.')->group(function () {
        Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
        Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
    });
    // Google
    Route::prefix('google')->name('google.')->group(function () {
        Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
        Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
    });
    // End Social Media Login

    Route::middleware(['is-site-auth'])->group(function () {
        //Route::get("/safeer/test", [AuthController::class, 'testSessions']);
        Route::get("/cart", [BookingController::class, 'Cart'])->name("get_cart");
        Route::post("/Book", [BookingController::class, 'MakeOrder']);
        Route::get("/cart/visa", [BookingController::class, 'DeleteVisa'])->name("deleteVisa");
        Route::get("/cart/{id}", [BookingController::class, 'DeleteCartItem'])->name("deleteCartItem");
        Route::get("/Safer/OrderPlacement/{id}", [BookingController::class, 'SuccessOrder'])->name("successOrder");

    });
});
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['middleware' => ['auth', 'user-access:admin'], 'prefix' => 'dashboard'], function () {
//Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('/change-password', [UserController::class, 'changePasswordSave'])->name('postChangePassword');

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    //cities
    Route::resource('cities', CityController::class);
    //room-types
    Route::resource('room-types', RoomTypeController::class);
    //tours
    Route::resource('tours', TourController::class);
    Route::post('dynamicdependentCat/fetch', [TourController::class, 'fetchCat'])->name('dynamicdependentCat.fetch');

    //hotels
    Route::resource('hotels', HotelController::class);
    //

    Route::get('autocompleteKeywords', [HotelController::class, 'autocompleteSearch'])->name('autocompleteKeywords');

    //editingRooms

    Route::post('editingRooms', [HotelController::class, 'editingRooms'])->name('editingRooms');
    //features
    Route::resource('features', FeatureController::class);
    //hotelTag
    Route::resource('hotelTag', HotelsTagController::class);
    //tourTag
    Route::resource('tourTag', ToursTagController::class);
    //galleries
    Route::resource('galleries', GalleryController::class);
    //tour-galleries
    Route::resource('tour-galleries', TourGalleryController::class);
    //blog-categories
    Route::resource('blog-categories', BlogsCategoryController::class);
    //blogs
    Route::resource('blogs', BlogController::class);

    //why-us
    Route::resource('why-us', WhyUsController::class);

    //explore
    Route::resource('explore', ExploreCityController::class);
    //best-hotel
    Route::resource('best-hotel', BestHotelController::class);
    //hotel-price
    Route::resource('hotel-price', HotelPricesController::class);
    //counter
    Route::resource('counter', CounterController::class);

    //company
    Route::resource('company', CompanyController::class);

    Route::get('/contact', [CompanyController::class, 'contact'])->name('contact');

    //branch
    Route::resource('branch', CompanyBranchController::class);

    //tours
    Route::resource('offers', OfferController::class);

    //

    Route::resource('site-users', SiteUsersController::class);

    Route::resource('users-orders', UsersOrderController::class);

    //new updates on order
    Route::post('EditTourDetails', [UsersOrderController::class, 'EditTourDetails'])->name('EditTourDetails');

    Route::post('EditholderDetails', [UsersOrderController::class, 'EditholderDetails'])->name('EditholderDetails');
    Route::post('EditTourPersons', [UsersOrderController::class, 'EditTourPersons'])->name('EditTourPersons');
    Route::post('deleteTourPersons', [UsersOrderController::class, 'deleteTourPersons'])->name('deleteTourPersons');
    Route::post('AddAdultTourPersons', [UsersOrderController::class, 'AddAdultTourPersons'])->name('AddAdultTourPersons');
    Route::post('AddChildTourPersons', [UsersOrderController::class, 'AddChildTourPersons'])->name('AddChildTourPersons');

    Route::post('updateStatus', [UsersOrderController::class, 'updateStatus'])->name('updateStatus');

    //
    Route::post('EditTransDetails', [UsersOrderController::class, 'EditTransDetails'])->name('EditTransDetails');

    Route::post('EditVisaDetails', [UsersOrderController::class, 'EditVisaDetails'])->name('EditVisaDetails');
//receiptSave
Route::post('receiptSave', [UsersOrderController::class, 'receiptSave'])->name('receiptSave');

    //fav-hotels
    Route::resource('fav-hotels', AllFavHotelsController::class);
//transfer
    Route::resource('car-models', CarModelController::class);
    Route::resource('car-navigate', CarClassController::class);
    Route::resource('transfer-location', TransferLocationController::class);
    Route::resource('transfer', TransferController::class);

    //visa
    //countries
    Route::resource('countries', CountryController::class);
    Route::resource('site-countries', SiteContriesController::class);
    Route::resource('nationalities', NationalityController::class);
    Route::resource('visaType', VisaTypeController::class);
    Route::resource('visa', VisaController::class);
    Route::resource('user-role', UsersRoleController::class);
    Route::post('storeAssign', [UsersRoleController::class, 'storeAssign'])->name('storeAssign');
    Route::post('assignThisOrder', [UsersOrderController::class, 'storeAssign'])->name('assignThisOrder');



});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');

    return "Cache cleared successfully";
});
/*-----------------------------------------------
mcmr cash
---------------------------------------------------
- remove cache files in bootstrap folder
2- php artisan optimize
3- php artisan route:trans:cache
4- php artisan cache:clear
5- php artisan route:clear
-----------*/
