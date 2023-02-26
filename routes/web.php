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
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\SiteUsersController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourGalleryController;
use App\Http\Controllers\ToursTagController;
use App\Http\Controllers\TransferLocationController;
use App\Http\Controllers\UsersOrderController;
use App\Http\Controllers\VisaController;
use App\Http\Controllers\VisaTypeController;
use App\Http\Controllers\Website\BookingController;
use App\Http\Controllers\Website\ContentController;
use App\Http\Controllers\Website\HotelsController;
use App\Http\Controllers\Website\MainController;
use App\Http\Controllers\Website\SiteTransferController;
use App\Http\Controllers\Website\ToursController;
use App\Http\Controllers\Website\VisaDataController;
use App\Models\Offer;

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
Route::post("/hotels/review/{id}", [HotelsController::class, 'add_review']);
Route::get('/fetch-hotel-filter',  [HotelsController::class, 'fetch_data'])->name('fetch-hotel-filter');
//new Routes 23-11
Route::get("/about", [ContentController::class, 'about']);
Route::get("/blogs", [ContentController::class, 'blogs']);
Route::get('blogs/fetch_data', [ContentController::class, 'fetch_data']);
Route::get('/single-blog/{id}',[ContentController::class, 'singleBlog'])->name('single-blog');
Route::get('/contact', [ContentController::class, 'createForm']);
Route::post('/contact', [ContentController::class, 'ContactUsForm'])->name('contact.store');
Route::post('/sendNewsLetter', [ContentController::class, 'sendNewsLetter']);
// outocomplete search
// Route::get('/autocomplete-search', [HotelsController::class, 'autocompleteSearch']);
Route::get('autocomplete', [HotelsController::class, 'autocompleteSearch'])->name('autocomplete');
//tours
Route::get("/tours", [ToursController::class, 'all_tours']);
Route::post("/tours", [ToursController::class, 'all_tours']);
Route::get('/fetch-tour-filter',  [ToursController::class, 'fetch_data'])->name('fetch-tour-filter');
Route::post("/tours/retrieve", [ToursController::class, 'fetch']);
Route::get("/tours/{id}", [ToursController::class, 'profile']);
Route::post("/bookTours", [ToursController::class, 'bookTours']);
//transfer
Route::get("/transfers", [SiteTransferController::class, 'all_transfer']);
Route::post("/transfers", [SiteTransferController::class, 'all_transfer']);
Route::get('/fetch-transfers-filter',  [SiteTransferController::class, 'fetch_data'])->name('fetch-transfers-filter');
Route::post("/transfers/retrieve", [SiteTransferController::class, 'fetch']);
Route::post("/bookTransfer", [SiteTransferController::class, 'bookTransfer']);
//visa
Route::get("/visa", [VisaDataController::class, 'all_visa']);
//dynamicvisatype.fetch
Route::post('dynamicvisatype/fetch',[VisaDataController::class,'fetchCat'] )->name('dynamicvisatype.fetch');


Route::middleware(['prevent-relogin'])->group(function () {
    //site-login
    Route::get("/safer/login", [ContentController::class, 'loginSite'])->name("siteLogin");
    Route::post("/safer/login", [AuthController::class, 'Login'])->name("ProceedLogin");

    //signupSite
    Route::get("/safer/register", [ContentController::class, 'signupSite'])->name("siteRegister");
    Route::post("/safer/register", [AuthController::class, 'Register'])->name("ProceedRegister");

});

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
  Route::get('dynamicSearchCity/fetch', [MainController::class,'fetchCity'])->name('dynamicSearchCity.fetch');

Route::get("/safer/room/{id}/book/{cap}", [BookingController::class, 'BookRoom'])->name("bookRoom");
Route::get("/safer/room/{id}/book/{cap}/exchange", [BookingController::class, 'ExBookRoom'])->name("exBookRoom");
Route::get("/terms", [MainController::class, 'terms'])->name("terms");

/**
 * fast login using social media
 */
//
// Facebook
Route::prefix('facebook')->name('facebook.')->group( function(){
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
    Route::get("/cart/{id}", [BookingController::class, 'DeleteCartItem'])->name("deleteCartItem");


});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['middleware' => ['auth', 'user-access:admin'], 'prefix' => 'dashboard'], function () {
//Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

        //cities
        Route::resource('cities', CityController::class);
        //room-types
        Route::resource('room-types', RoomTypeController::class);
         //tours
         Route::resource('tours', TourController::class);
          //hotels
          Route::resource('hotels', HotelController::class);
          //

          Route::get('autocompleteKeywords', [HotelController::class, 'autocompleteSearch'])->name('autocompleteKeywords');

          Route::post('dynamicdependentCat/fetch',[HotelController::class,'fetchCat'] )->name('dynamicdependentCat.fetch');
         //editingRooms

            Route::post('editingRooms',[HotelController::class,'editingRooms'] )->name('editingRooms');
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

           Route::get('/contact',[CompanyController::class,'contact'] )->name('contact');

            //branch
          Route::resource('branch', CompanyBranchController::class);

           //tours
         Route::resource('offers', OfferController::class);

         //

         Route::resource('site-users', SiteUsersController::class);

         Route::resource('users-orders', UsersOrderController::class);
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
        Route::resource('nationalities', NationalityController::class);
        Route::resource('visaType', VisaTypeController::class);
        Route::resource('visa', VisaController::class);

});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

