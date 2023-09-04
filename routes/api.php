<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IntroductionController;
use App\Http\Controllers\Api\ProfileImageController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HelpController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\AdviceController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\PortraitImageController;
use App\Http\Controllers\Api\LandscapeImageController;
use App\Http\Controllers\Api\PartnerSubcategoryController;
use App\Http\Controllers\Api\WorkdayController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\CounterController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\AdController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//Auth
Route::post('login', [AuthController::class, 'login']);

Route::post('user-reg', [AuthController::class, 'store']);


Route::post('sociallogin', [AuthController::class, 'sociallogin']);

Route::get('user/{id}', [AuthController::class, 'userProfile']);

Route::get('delete-user/{id}', [AuthController::class, 'delete']);

Route::post('user/token', [AuthController::class, 'updateDeviceToken']);

Route::post('deactivate-user', [AuthController::class, 'deactivate']);

//forget pw step 1
Route::post('check-user', [AuthController::class, 'checkUser']);


Route::post('update-password', [AuthController::class, 'changePassword']);

Route::get('delete-user/{id}', [AuthController::class, 'delete']);
Route::post('update-user', [AuthController::class, 'updateProfile']);
Route::post('send-otp', [AuthController::class, 'sendOtp']);
Route::post('check-otp', [AuthController::class, 'checkOTP']);


Route::middleware('changeLang')->group(function () {

//Introduction
Route::get('introductions', [IntroductionController::class, 'list']);
Route::post('introduction-create', [IntroductionController::class, 'save']);
Route::get('introduction/{id}', [IntroductionController::class, 'view']);
Route::get('introduction/delete/{id}', [IntroductionController::class, 'delete']);
Route::post('introduction/edit/{id}', [IntroductionController::class, 'edit']);



//profile images
Route::get('images', [ProfileImageController::class, 'list']);
Route::post('image-create', [ProfileImageController::class, 'save']);
Route::get('image/{id}', [ProfileImageController::class, 'view']);
Route::get('image/delete/{id}', [ProfileImageController::class, 'delete']);
Route::post('image/edit/{id}', [ProfileImageController::class, 'edit']);


//helps
Route::get('helps', [HelpController::class, 'list']);
Route::post('help-create', [HelpController::class, 'save']);
Route::get('help/{id}', [HelpController::class, 'view']);
Route::get('help/delete/{id}', [HelpController::class, 'delete']);
Route::post('help/edit/{id}', [HelpController::class, 'edit']);

//sections
Route::get('sections', [SectionController::class, 'list']);
Route::post('section-create', [SectionController::class, 'save']);
Route::get('section/{id}', [SectionController::class, 'view']);
Route::get('section/delete/{id}', [SectionController::class, 'delete']);
Route::post('section/edit/{id}', [SectionController::class, 'edit']);


//blogs
Route::get('blogs', [BlogController::class, 'list']);
Route::post('blog-create', [BlogController::class, 'save']);
Route::get('blog/{id}', [BlogController::class, 'view']);
Route::get('blog/delete/{id}', [BlogController::class, 'delete']);
Route::post('blog/edit/{id}', [BlogController::class, 'edit']);

//recentBlogs
Route::get('recent-blogs', [BlogController::class, 'recentBlogs']);

//mostWatchedBlogs
Route::get('most-watched-blogs', [BlogController::class, 'mostWatchedBlogs']);

//getblogsbysection
Route::get('get-blogs/{id}', [BlogController::class, 'getBlogs']);

//getrandomblogsbysection
Route::get('get-random-blogs/{id}', [BlogController::class, 'getRandomBlogs']);


//advice
Route::get('advices', [AdviceController::class, 'list']);
Route::post('advice-create', [AdviceController::class, 'save']);
Route::get('advice/{id}', [AdviceController::class, 'view']);
Route::get('advice/delete/{id}', [AdviceController::class, 'delete']);
Route::post('advice/edit/{id}', [AdviceController::class, 'edit']);

//last advice
Route::get('last-advice', [AdviceController::class, 'getLastAdvice']);


//city
Route::get('cities', [CityController::class, 'list']);
Route::post('city-create', [CityController::class, 'save']);
Route::get('city/{id}', [CityController::class, 'view']);
Route::get('city/delete/{id}', [CityController::class, 'delete']);
Route::post('city/edit/{id}', [CityController::class, 'edit']);

//area
Route::get('areas', [AreaController::class, 'areas']);
Route::post('area-create', [AreaController::class, 'save']);
Route::get('area/{id}', [AreaController::class, 'view']);
Route::get('area/delete/{id}', [AreaController::class, 'delete']);
Route::post('area/edit/{id}', [AreaController::class, 'edit']);

//Category
Route::get('categories', [CategoryController::class, 'list']);
Route::post('category-create', [CategoryController::class, 'save']);
Route::get('category/{id}', [CategoryController::class, 'view']);
Route::get('category/delete/{id}', [CategoryController::class, 'delete']);
Route::post('category/edit/{id}', [CategoryController::class, 'edit']);
Route::get('category/partners/{id}', [CategoryController::class, 'getParnersByCategory']);


//Subcategory
Route::get('subcategories', [SubcategoryController::class, 'list']);
Route::post('subcategory-create', [SubcategoryController::class, 'save']);
Route::get('subcategory/{id}', [SubcategoryController::class, 'view']);
Route::get('subcategory/delete/{id}', [SubcategoryController::class, 'delete']);
Route::post('subcategory/edit/{id}', [SubcategoryController::class, 'edit']);


//partner
Route::get('partners', [PartnerController::class, 'partners']);
Route::get('partners/prices', [PartnerController::class, 'getPrices']);
Route::post('partner-create', [PartnerController::class, 'save']);
Route::get('partner/{id}', [PartnerController::class, 'view']);

Route::get('partner/delete/{id}', [PartnerController::class, 'delete']);
Route::post('partner/edit/{id}', [PartnerController::class, 'edit']);

//get suggested partner
Route::get('suggested-partner', [PartnerController::class, 'getSuggestedPartner']);

//getPartnerByCity
Route::get('partner-by-city/{id}', [PartnerController::class, 'getPartnerByCity']);

//getPartnersByCategory
Route::get('partners-by-category/{id}', [PartnerController::class, 'getPartnersByCategory']);

//getPartnersBySubcategoryId
Route::get('partners-by-subcategory/{id}', [PartnerController::class, 'getPartnersBySubcategoryId']);

// getPartnersByName
Route::post('partners-by-name', [PartnerController::class, 'getPartnersByName']);

//getPartnersByNameAndCategory (get partners by name which exist in specific category)
Route::post('search/{id}/{name}', [PartnerController::class, 'getPartnersByNameAndCategory']);


//filter
// Route::post('filter', [PartnerController::class, 'getPartners']);

//filter
Route::post('filter', [PartnerController::class, 'getPartnersInArea']);


//filter in specific sub
// Route::post('partners-filter', [PartnerController::class, 'getPartnersOfSubcategory']);

//filter in category or sub
// Route::post('partners-filter', [PartnerController::class, 'getPartnersOfSubOrCategory']);

//filter in cat or sub in areas
Route::post('partners-filter', [PartnerController::class, 'getPartnersOfSubOrCategortInArea']);

//range of start price in partner
Route::get('partners-range', [PartnerController::class, 'getMinAndMaxOfPrice']);


//Branch
Route::get('branches', [BranchController::class, 'list']);
Route::post('branch-create', [BranchController::class, 'save']);
Route::get('branch/{id}', [BranchController::class, 'view']);
Route::get('branch/delete/{id}', [BranchController::class, 'delete']);
Route::post('branch/edit/{id}', [BranchController::class, 'edit']);

//nearbyBranchesIn5 kilometers
Route::post('nearest-branches', [BranchController::class, 'nearest']);


//portrait image
Route::get('portraits', [PortraitImageController::class, 'pImages']);
Route::post('portrait-create', [PortraitImageController::class, 'save']);
Route::get('portrait/{id}', [PortraitImageController::class, 'view']);
Route::get('portrait/delete/{id}', [PortraitImageController::class, 'delete']);
Route::post('portrait/edit/{id}', [PortraitImageController::class, 'edit']);

//landscape image
Route::get('landscapes', [LandscapeImageController::class, 'lImages']);
Route::post('landscape-create', [LandscapeImageController::class, 'save']);
Route::get('landscape/{id}', [LandscapeImageController::class, 'view']);
Route::get('landscape/delete/{id}', [LandscapeImageController::class, 'delete']);
Route::post('landscape/edit/{id}', [LandscapeImageController::class, 'edit']);


//partnersubcategory

Route::post('partnersub-create', [PartnerSubcategoryController::class, 'save']);

Route::get('partnersub/delete/{id}', [PartnerSubcategoryController::class, 'delete']);


//workday
Route::get('workdays', [WorkdayController::class, 'list']);
Route::post('workday-create', [WorkdayController::class, 'save']);
Route::get('workday/{id}', [WorkdayController::class, 'view']);
Route::get('workday/delete/{id}', [WorkdayController::class, 'delete']);
Route::post('workday/edit/{id}', [WorkdayController::class, 'edit']);

//reviews
Route::get('reviews', [ReviewController::class, 'activeReviews']);
Route::post('review-create', [ReviewController::class, 'save']);
Route::get('review/{id}', [ReviewController::class, 'view']);
Route::get('review/delete/{id}', [ReviewController::class, 'delete']);
Route::post('review/edit/{id}', [ReviewController::class, 'edit']);


//getReviewsByPartner
Route::get('reviews-by-partner/{id}', [ReviewController::class, 'getReviewsByPartner']);

//favorite

Route::post('favorite-create', [FavoriteController::class, 'save']);
Route::get('favorite/delete/{partner_id}/{user_id}', [FavoriteController::class, 'deletebyID']);

//is partner fav
Route::post('partner-fav', [FavoriteController::class, 'isFav']);




//whatsappCounter
Route::post('whatsapp-counter', [CounterController::class, 'whatsappCounter']);

//callCounter
Route::post('call-counter', [CounterController::class, 'callCounter']);

//viewCounter
Route::post('view-counter', [CounterController::class, 'viewCounter']);


//pages

Route::get('pages', [PageController::class, 'list']);
Route::post('page-create', [PageController::class, 'save']);
Route::get('page/{id}', [PageController::class, 'view']);
Route::get('page/delete/{id}', [PageController::class, 'delete']);
Route::post('page/edit/{id}', [PageController::class, 'edit']);

  //faq
  Route::get('faqs', [FaqController::class, 'list']);
  Route::post('faq-create', [FaqController::class, 'save']);
  Route::get('faq/{id}', [FaqController::class, 'view']);
  Route::post('faq/edit/{id}', [FaqController::class, 'edit']);
  Route::get('faq/delete/{id}', [FaqController::class, 'delete']);


    //my notifications
   Route::get('my-notifications', [AuthController::class, 'myNotifications']);

    // updateById
    Route::post('/user-edit', [AuthController::class, 'updateById']);

    //ad
  Route::get('ads', [AdController::class, 'list']);

});


Route::middleware(['auth:api','changeLang'])->group(function () {
    Route::get('toggle-favorite/{id}', [FavoriteController::class, 'toggleFavorite']);

    Route::post('/user-update', [AuthController::class, 'updateProfile']);

    Route::get('single-partner/{id}', [PartnerController::class, 'view']);




    //myFavorites
Route::get('my-favorites', [FavoriteController::class, 'myFavorites']);





});
