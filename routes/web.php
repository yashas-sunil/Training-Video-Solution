<?php

use App\Http\Middleware\CheckAuthenticatedMiddleware;
use Illuminate\Support\Facclses\Route;

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

Route::group(['prefix' => 'campaign', 'as' => 'campaign.'], function () {
    Route::get('/sign-up', 'CampaignController@index');
});

/*Route::get('/', function () {
    return view('pages.home');
});*/

Route::group(['middleware' => ['web']], function () {

// Route::get('error','Quiz\IndexController@error');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/getPopularCourses', 'HomeController@getPopularCourses')->name('getPopularCourses');

//meta analytics

Route::get('include/metaScript','AnalyticsController@returnScript')->name('returnScript');

// Authentication

Route::post('/login', 'AuthController@login');

Route::get('/login', function() {
    return redirect('/?login=true');
});

Route::post('/register', 'AuthController@register');
Route::post('/signup_otp_verify','AuthController@signup_otp_verify');

Route::get('/register', function() {
    return redirect('/?register=true');
});

Route::post('/logout', 'AuthController@logout');
Route::get('/logout', 'AuthController@getLogout');

Route::get('auth/google', 'AuthController@redirectToGoogle');


// Profile


Route::get('/get-subjects-by-level', 'PackageController@getSubjectsByLevels');
Route::get('/get-subjects-by-language', 'PackageController@getSubjectsByLanguages');
Route::get('/get-chapter-by-subject', 'PackageController@getchaptersBySubject');
Route::get('/get-professor-by-chapter', 'PackageController@getProfessorByChapter');

// Spinners
Route::get('/spinners', 'SpinnerController@index');
Route::get('/spinners/calculate-price', 'SpinnerController@calculate_price');


// Cart

Route::get('/cart', 'CartController@index');
Route::post('/cart', 'CartController@addToCart');
Route::post('/cart/remove', 'CartController@removeFromCart');
Route::post('wishList', 'CartController@wishList');

// Order

Route::resource('order', 'OrderController');
Route::get('/purchase-now/{id}', 'OrderController@studentPurchase');

// Addresses

Route::resource('addresses', 'AddressController');

Route::get('/packages/{id}', 'PackageController@show');
Route::get('/packages', 'PackageController@index')->name('packages.index');
Route::get('/packagess', 'PackageController@loader')->name('packages.loader');

Route::get('/ca-demo-lectures-online', 'FreeResourceController@index')->name('ca-demo-lectures-online.index');

Route::resource('referrals', 'ReferralController')->only(['store']);

Route::resource('call-requests', 'CallRequestController')->only('store');

Route::resource('save-for-later', 'SaveForLaterController')->only('index', 'store', 'destroy');
Route::get('save-for-later/remove', 'SaveForLaterController@remove')->name('save-for-later.remove');

Route::resource('forgot-password', 'ForgotPasswordController')->only('index', 'store');
Route::get('forgot-pwd','ForgotPasswordController@fp_copy');

Route::resource('reset-password', 'ResetPasswordController')->only('index', 'store');

Route::resource('ca-faculty', 'ProfessorController')->only('index', 'show');

Route::resource('faq', 'FaqController')->only('index');

Route::resource('j-money', 'JMoneyController')->only('index');

// Associate

Route::group(['prefix' => 'associate', 'as' => 'associate.'], function () {
    Route::resource('dashboard', 'Associate\DashboardController')->only('index');
    Route::resource('profile', 'Associate\ProfileController')->only('index', 'update');
    Route::resource('students', 'Associate\StudentController')->except('delete');
    Route::post('students/send-verification-mail', 'Associate\StudentController@sendVerificationMail')->name('students.send-verification-mail');
    Route::resource('courses', 'Associate\CourseController')->only('index');
    Route::resource('commissions', 'Associate\CommissionController')->only('index');
    Route::resource('orders', 'Associate\OrderController')->only('index');
    Route::get('payment-link', 'Associate\OrderController@paymentLinkSent');
    Route::post('update-avatar', 'Associate\ProfileController@updateAvatar')->name('update-avatar');
    Route::post('send-payment-link', 'Associate\OrderController@sendPaymentLink')->name('send-payment-link');
});

// Professor

Route::group(['prefix' => 'professor', 'as' => 'professor.'], function () {
    Route::resource('profile', 'Professor\ProfileController')->only('index', 'store', 'update');
    Route::get('packages/{id}', 'Professor\ProfileController@show');
    Route::get('watch-video/{id}', 'Professor\ProfileController@watchVideo');
    Route::resource('questions', 'Professor\QuestionController')->only('index', 'show');
    Route::get('pending_question', 'Professor\QuestionController@pending_question');
    Route::get('answerd_question', 'Professor\QuestionController@answerd_question');
    Route::post('get_question_details', 'Professor\QuestionController@get_question_details');
    Route::post('get_question_answer', 'Professor\QuestionController@get_question_answer');
    Route::resource('answers', 'Professor\AnswerController')->only('store', 'show');
    Route::resource('notes', 'Professor\NotesController');
    Route::get('notes/create/{id}', 'Professor\NotesController@create');
    Route::post('update-professor-note', 'Professor\NotesController@update');
    Route::post('delete-professor-note', 'Professor\NotesController@delete');
    Route::resource('payout', 'Professor\PayoutController');
    Route::resource('testimonials', 'Professor\TestimonialController')->only('index');
    Route::resource('dashboard', 'Professor\DashboardController')->only('index');
    Route::resource('reports', 'Professor\ReportController')->only('index');
    Route::resource('revenues', 'Professor\ProfessorRevenueController')->only('index');
    Route::resource('videos', 'Professor\VideoController')->only('index');
    Route::resource('packages', 'Professor\PackageController')->only('index');
    Route::post('/change-password/{id}','Professor\ProfileController@changePassword');
});

Route::group(['prefix' => 'mobile', 'as' => 'mobile.'], function () {
    Route::resource('register', 'Mobile\RegisterController')->only('index');
    Route::get('register/success', 'Mobile\RegisterController@success');
    Route::get('videos/{id}/buy', 'Mobile\VideoController@buy');

    Route::resource('/packages', 'Mobile\PackageController')->only('index');
    Route::get('/packages/{id}', 'Mobile\PackageController@show');
    Route::get('order', 'Mobile\OrderController@index');
    Route::post('order', 'Mobile\OrderController@store');
    Route::get('order/checkout', 'Mobile\OrderController@checkout');
    Route::post('/order/apply-coupon', 'Mobile\OrderController@applyCoupon');
    Route::get('videos/{id}', 'Mobile\VideoController@show');
});

//Terms
Route::get('/terms', 'CMSController@terms');
Route::get('/privacy', 'CMSController@privacy');
Route::get('/disclaimer', 'CMSController@disclaimer');
Route::get('/contact-us', 'CMSController@contactUs');
Route::get('/bcom-with-ca-online', 'CMSController@bcomWithCaOnline');
Route::post('/enquiries', 'CMSController@enquiries');
Route::get('/about-us', 'CMSController@aboutUs');
Route::get('/cafc-scholarship', 'CMSController@thane');
// Route::post('captchacheck', 'ThaneVaibhavRegController@captchacheck')->name('captchacheck');
Route::post('captchacontactcheck', 'CaptchaController@captchacontactcheck')->name('captchacontactcheck');
Route::post('captchalogincheck', 'CaptchaController@captchalogincheck')->name('captchalogincheck');
Route::post('captchasignupcheck', 'CaptchaController@captchasignupcheck')->name('captchasignupcheck');
Route::post('captchacallmecheck', 'CaptchaController@captchacallmecheck')->name('captchacallmecheck');
Route::post('captcha_forgotcheck', 'CaptchaController@captcha_forgotcheck')->name('captcha_forgotcheck');


/*************Added by TE************************/

Route::get('refresh_captcha', 'ThaneVaibhavRegController@refreshCaptcha')->name('refresh_captcha');

/*********Ends TE *******************************/

Route::post('validate-email', 'AuthController@validateEmail');
Route::post('validate-phone', 'AuthController@validatePhone');

// Blogs
Route::get('/blog_view', 'BlogController@blogview');

// Route::namespace('Quiz')->name('quiz.')->group(function () {
//     Route::get('testing', 'IndexController@testing')->name('testing');
//     // Route::get('/', 'IndexController@index')->name('home');
//     Route::get('/practice/{grade?}/{board?}','IndexController@practice')->name('practice');
//     Route::get('tests', 'IndexController@Tests')->name('tests');
//     Route::get('test/{ID}', 'IndexController@Test')->name('test');
//     Route::get('content-library/{ID}', 'IndexController@ContentLibrary')->name('content-library');
//     Route::get('olympiad','IndexController@olympiad')->name('olympiad');
//     Route::post('save_olympiad','IndexController@save_olympiad')->name('save_olympiad');
//      Route::get('start-test/{ID}', 'IndexController@StartTest')->name('start-test');
//     Route::get('question/{ID}', 'IndexController@Question')->name('question');
//     Route::post('submit-question/{ID}', 'IndexController@SubmitQuestion')->name('submit-question');
//     Route::post('skip-question/{ID}', 'IndexController@SkipQuestion')->name('skip-question');
//     Route::get('complete-test/{ID}', 'IndexController@CompleteTest')->name('complete-test');
//     Route::post('hide5050', 'IndexController@hide5050')->name('hide5050');
// });

});

Route::middleware([CheckAuthenticatedMiddleware::class])->group(function () {
    Route::get('/student-dashboard', 'HomeController@studentDashbaord');
    Route::post('/agreeTnCofVerandaVarsity', 'HomeController@agreeTnCofVerandaVarsity')->name('agreeTnC.save');
    Route::get('/profile', 'ProfileController@show');
    Route::get('/get-last-watched-video', 'VideoController@lastWatchedVideo');

    Route::post('/profile/update', 'ProfileController@update');
    Route::post('/profile/update-academic-details', 'ProfileController@updateAcademicInformation');
    Route::post('/profile/update-student-address', 'ProfileController@updateStudentAddress');

    Route::post('/edit-student-email', 'ProfileController@editEmailOtp');
    Route::post('/attempt-year-update','AuthController@attemptYearUpdate');
    Route::post('/verify-student-email-otp', 'ProfileController@verifyEmailOtp');

    Route::post('/update-email', 'ProfileController@updateEmail');

    Route::get('/professor-notes', 'ProfessorNoteController@index');

    Route::get('/study-materials', 'StudyMaterialController@index')->name('study-materials.index');

    Route::get('/study-plans', 'StudyMaterialController@studyPlans')->name('study-plans.index');

    Route::get('/test-papers', 'StudyMaterialController@testPapers')->name('test-papers.index');

    Route::get('/student-notes', 'StudentNoteController@index');

    Route::get('/contents', 'ContentController@index');
    Route::get('/video-contents', 'ContentController@videoContents');
    Route::get('/freemium-video-contents', 'ContentController@freemiumVideoContents');

    Route::get('/ask-a-question', 'AskAQuestionController@index');

    Route::get('/my-orders', 'MyOrderController@index');
    Route::get('/order-history', 'MyOrderController@orderHistory')->name('orderHistory');

    Route::get('/statusCancelOrderApi', 'OrderController@statusCancelOrderApi');

    Route::get('/invoice', 'MyOrderController@invoice');
    Route::get('/download-invoice/{id}/{pdf}', 'MyOrderController@previewInvoice');

    Route::post('/upload-profile-image', 'ProfileController@uploadProfileImage');

    Route::resource('videos', 'VideoController');

    Route::resource('freemium-videos', 'VideoController');

    Route::resource('histories','VideoHistoryLogController');

    Route::resource('questions', 'AskAQuestionController');

    Route::resource('student-notes', 'StudentNoteController');

    Route::get('get-video-notes', 'VideoController@getNotes');
    Route::get('post-video-note', 'VideoController@postNote');
    Route::get('put-video-note/{id}', 'VideoController@putNote');
    Route::get('delete-video-note/{id}', 'VideoController@deleteNote');

    Route::get('get-video-questions', 'VideoController@getQuestions');
    Route::get('post-video-question', 'VideoController@postQuestion');
    Route::get('delete-video-question/{id}', 'VideoController@deleteQuestion');

    Route::get('get-video-professor-notes', 'VideoController@getProfessorNotes');
    Route::get('/performances', 'PerformanceController@index');
    Route::get('remaining-duration', 'VideoHistoryController@getRemainingDuration');
    Route::get('freemium-remaining-duration', 'VideoHistoryController@getFreemiumRemainingDuration');

    Route::post('/cart/add-to-wishlist', 'CartController@addToWishlist');
    Route::get('/cart/checkout', 'CartController@checkout');
    Route::post('/cart/apply-coupon', 'CartController@applyCoupon');

});

//Payment Gateway
Route::post('/payment-status', 'OrderController@success');
Route::post('/payment-failure', 'OrderController@failed');
Route::post('/easebuzz-payment-status', 'OrderController@easebuzzsuccess');
Route::post('/easebuzz-payment-failure', 'OrderController@easebuzzfailed');
Route::get('email', 'OrderController@email');

//webhook api
Route::post('easebuzz-webhook-notify', 'OrderController@easebuzzWebhookNotify');


Route::get('embed/videos/{id}', 'VideoController@embedVideo');

Route::get('chapters/{chapterID}/videos/{videoID}', 'VideoController@getChapterVideos');

Route::get('videos/get-player/{id}/{s3?}', 'VideoController@getPlayer');

Route::resource('video-histories', 'VideoHistoryController')->only('index', 'store');

Route::get('freemium-video-histories', 'VideoHistoryController@freemium_index');

Route::post('freemium-video-histories', 'VideoHistoryController@freemium_store');

Route::post('validate-login', 'AuthController@validateLogin');

Route::post('secondary-login', 'AuthController@secondaryLogin');

// Balance Order
Route::post('balance-orders', 'BalanceOrderController@store')->name('balance-orders.store');
Route::post('balance-orders/success', 'BalanceOrderController@handleSuccess');
Route::post('balance-orders/failure', 'BalanceOrderController@handleFailure');

Route::get('payments/failure', function() {
    return view('pages.payments.failure');
});

Route::get('payments/success', function() {
    return view('pages.payments.success');
});



Route::post('order-items/mark-as-completed/{id}', 'OrderController@markAsCompleted');

Route::get('user-notifications', 'UserNotificationController@index');
Route::post('user-notifications/mark-as-read', 'UserNotificationController@markAsRead');
Route::get('free-resources/download-document', 'FreeResourceController@downloadDocument');

Route::get('study-materials/{id}/checkout', 'OrderController@checkoutStudyMaterial');

Route::group(['prefix' => 'campaigns'], function () {
    Route::get('spin-wheels/calculate-price', 'Campaigns\SpinWheelController@calculatePrice');
    Route::get('spin-wheels/{slug}', 'Campaigns\SpinWheelController@show');
    Route::post('validate-phone', 'CampaignRegistrationController@validatePhone');
    Route::post('validate-otp', 'CampaignRegistrationController@validateOTP');
    Route::get('remaining-chances', 'TempCampaignPointController@getRemainingChances');
});

Route::post('campaign-registrations', 'CampaignRegistrationController@store');
Route::post('temp-campaigns-points', 'TempCampaignPointController@store');
//added by TE
Route::post('temp-campaigns-register', 'TempCampaignPointController@campaignRegister');

Route::get('update-free-order', 'OrderController@updateFreeOrder');

Route::group(['prefix' => 'branch-managers', 'as' => 'branch-managers.'], function () {
    Route::resource('profile', 'BranchManager\ProfileController')->only('index', 'update');
    Route::resource('orders', 'BranchManager\OrderController')->only('index');
    Route::resource('students', 'BranchManager\StudentController')->only('index', 'store');
});

Route::get('verifications/{token}', 'AuthController@markAsVerified');

Route::post('blogs/{id}/like', 'BlogController@like')->name('blogs.like');
Route::resource('blogs', 'BlogController')->only('index', 'show');
Route::resource('feedback', 'FeedbackController')->only('store');

Route::get('answer-portal', 'AnswerPortalController@index')->name('answer-portal.index');
Route::post('answer-portal', 'AnswerPortalController@store')->name('answer-portal.store');

Route::post('close-notification', 'HomeController@closeNotification')->name('close-notification');
Route::get('get-all-packages-by-level', 'PackageController@getPackageByLevel');

/*************************************Datavoice******************************************************/
Route::namespace('Quiz')->name('quiz.')->group(function () {
    Route::get('testList', 'QuizController@index')->name('testing');
    Route::get('question/{id}', 'QuizController@question')->name('question');
    Route::post('submit-question', 'QuizController@SubmitQuestion')->name('submit-question');
    Route::post('check-answer', 'QuizController@CheckAnswer')->name('check-answer');
    Route::post('instruction', 'QuizController@instruction')->name('instruction');
    Route::post('skip-question', 'QuizController@SkipQuestion')->name('skip-question');
    Route::get('test-points/{id}','QuizController@points')->name('test-points');
   Route::get('test-summary/{id}','QuizController@testsummary')->name('testsummary');
});
/*****************************Datavocie Ends******************************************************/

//-----------------------------------Third Eye --------------------------------------------------//
Route::get('get-prof-packages','ProfessorController@getprofessorpackages')->name('get-prof-packages');
// Route::resource('email-support', 'EmailSupportController')->only('store');
Route::resource('testimonials','TestimonialController');
Route::get('testimonials', 'TestimonialController@index')->name('testimonials');
Route::get('linked_packages/{id}','FreeResourceController@linked_packages');

Route::get('get_video/{id}','VideoController@getvideo')->name('get_video');
Route::get('/get-professor-by-subject', 'PackageController@getProfessorBySubject');
Route::get('get-levels-by-course','PackageController@getLevelsByCourse');
Route::get('/getLastTransaction', 'HomeController@getLastTransaction');
Route::get('/blockpopup', 'HomeController@blockpopup');
Route::get('/get-types-by-level', 'PackageController@getTypesByLevels');
Route::post('send-otp', 'HomeController@sendotp');
Route::get('get_question_video/{id}/{time}','VideoController@get_question_video')->name('get_question_video');

Route::post('set_session','VideoController@SetSession');
Route::post('validate-captcha','CMSController@validate_captcha');
//----------------------------------Third Eye Ends ----------------------------------------------//
Route::get('/emailer', 'HomeController@jkemail');
Route::get('/unsubscribe', 'HomeController@unsubscribe');
Route::post('savescreenshot','HomeController@savescreenshot')->name('savescreenshot');
Route::post('save_tech_support','HomeController@save_tech_support')->name('save_tech_support');
Route::post('save_proof','CartController@saveproof')->name('save_proof');
// emailer
Route::get('/redirect_to_home/{data}','HomeController@redirecthome')->name('email.redirect');
//can not find enquire 
Route::resource('can-not-find-enquire','CanNotFindEnquireController');
Route::post('/start-free-trial','PackageController@startFreeTrial');