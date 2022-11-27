<?php

use App\Http\Controllers\BestHotelController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogsCategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyBranchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\ExploreCityController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelPricesController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\Website\ContentController;
use App\Http\Controllers\Website\HotelsController;
use App\Http\Controllers\Website\MainController;
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
Route::post("/hotels/{id}/fetch", [HotelsController::class, 'fetch_hotel_cards']);
Route::post("/hotels/review/{id}", [HotelsController::class, 'add_review']);
//new Routes 23-11
Route::get("/about", [ContentController::class, 'about']);
Route::get("/blogs", [ContentController::class, 'blogs']);
Route::get('blogs/fetch_data', [ContentController::class, 'fetch_data']);
Route::get('/single-blog/{id}',[ContentController::class, 'singleBlog'])->name('single-blog');
Route::get('/contact', [ContentController::class, 'createForm']);
Route::post('/contact', [ContentController::class, 'ContactUsForm'])->name('contact.store');
//site-login
Route::get("/site-login", [ContentController::class, 'loginSite']);
//signupSite
Route::get("/site-signup", [ContentController::class, 'signupSite']);

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
          Route::post('dynamicdependentCat/fetch',[HotelController::class,'fetchCat'] )->name('dynamicdependentCat.fetch');
         //editingRooms

            Route::post('editingRooms',[HotelController::class,'editingRooms'] )->name('editingRooms');
           //features
            Route::resource('features', FeatureController::class);
           //galleries
           Route::resource('galleries', GalleryController::class);
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


            //branch
          Route::resource('branch', CompanyBranchController::class);

           //tours
         Route::resource('offers', OfferController::class);

});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

