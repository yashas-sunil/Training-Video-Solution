<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    function http()
    {
        return Http::withHeaders([
            'Accept' => 'application/json',
            'X-Api-Key' => env('API_KEY')
        ])->withoutVerifying()
            ->baseUrl(env('API_URL'))
            ->withToken(session()->get('access_token'));
    }

    function postLogin($credentials) {
        return $this->http()->post( 'login', $credentials);
    }

    function hasTestpress($credentials) {
        return $this->http()->get( 'has_testpress', $credentials);
    }

    function loginTestpress($credentials) {
        return $this->http()->post( 'login_testpress', $credentials);
    }

    function login_testpress($credentials){
        return $this->http()->get( 'sso_testpress', $credentials);
    }

    function updateLogSession() {
        return $this->http()->get( 'update-log-session');
    }

    function removeDeviceFromPushNotification() {
        return $this->http()->get( 'remove-user-from-push-notification');
    }

    function register($data) {
        return $this->http()->post('register', $data);
    }
    function canNotFindEnquire($data) {
        return $this->http()->post('can-not-find-enquire', $data);
    }

    function getProfile()
    {
        return $this->http()->get( 'user');
    }

    function getCourseDetails()
    {
        return $this->http()->get( 'student-dashboard');
    }

    function getMyCourseCourseDetails()
    {
        return $this->http()->get( 'get-my-course-package-details');
    }


    function getStudentOrders($data = [])
    {
        return $this->http()->get( 'get-student-orders',$data);
    }

    function getInvoiceDetails($data = [])
    {
        return $this->http()->get( 'get-invoice-details',$data);
    }

    function getStudyMaterials($data = [])
    {
        return $this->http()->get( 'get-study-materials',$data);
    }

    function getPurchasedChapters($data = [])
    {
        return $this->http()->get( 'get-purchased-chapters',$data);
    }

    function getLanguages($data = [])
    {
        return $this->http()->get( 'get-all-languages',$data);
    }

    function getPurchasedSubjects($data = [])
    {
        return $this->http()->get( 'get-purchased-subjects',$data);
    }

    function filterStudyMaterials($data = [])
    {
        return $this->http()->get( 'filter-study-materials',$data);
    }

    function dashboardStudyPlans($data = [])
    {
        return $this->http()->get( 'dashboard-study-plans',$data);
    }

    function getPackageStudyMaterials($data = [])
    {
        return $this->http()->get( 'get-package-study-materials',$data);
    }

    function getTestPapersOfOrderItem($data = [])
    {
        return $this->http()->get( 'get-test-papers-of-order-items',$data);
    }

    function getTestPapersOfUserFreemium($data = [])
    {
        return $this->http()->get( 'get-test-papers-of-user-freemium',$data);
    }

    function getSearchResults($data){

        return $this->http()->post( 'search', $data);
    }

    function updateProfile($data)
    {
        return $this->http()->post( 'students', $data);
    }

    function updateAcademicInformation($data)
    {
        return $this->http()->post( 'update-academic-information', $data);
    }

    function updateStudentAddress($data)
    {
        return $this->http()->post( 'update-student-address', $data);
    }

    function editEmailOtp($data)
    {
        return $this->http()->post( 'edit-email-otp', $data);
    }

    function verifyEmailOtp($data)
    {
        return $this->http()->post( 'verify-email-otp', $data);
    }

    function updateEmail($data)
    {
        return $this->http()->post( 'update-email', $data);
    }

    function uploadProfileImage($image)
    {
        return $this->http()->attach('image', $image->get(), 'image.' . $image->getClientOriginalExtension())->post( 'upload-profile-image');
    }

    function getProfessorNotes($data = []) {
        return $this->http()->get( 'professor-notes', $data);
    }

    function getProfessorVideoNotes($data = []) {
        return $this->http()->get( 'professor/professor-notes', $data);
    }

    function getStudentNotes($data = [])
    {
        return $this->http()->get( 'student-notes', $data);
    }

    function getContentCourses()
    {
        return $this->http()->get( 'content-courses');
    }

    function getContentLevels($data)
    {
        return $this->http()->get( 'content-levels', $data);
    }

    function getContentSubjects($data)
    {
        return $this->http()->get( 'content-subjects', $data);
    }

    function getContentChapters($data)
    {
        return $this->http()->get( 'content-chapters', $data);
    }

    function getVideoHistories($data = [])
    {
        return $this->http()->get( 'video-histories', $data);
    }

    function getFreemiumVideoHistories($data = [])
    {
        return $this->http()->get( 'freemium-video-histories', $data);
    }

    function getAskAQuestions($data = []) {
        return $this->http()->get('ask-a-questions', $data);
    }

    function getCart($data = [])
    {
        return $this->http()->get('cart', $data);
    }

    function getWishList($data = [])
    {
        return $this->http()->get('wishlist', $data);
    }

    function getWishListUserPackageIds($data = [])
    {
        return $this->http()->get('get-wish-list-user-package-ids', $data);
    }

    function getFreeResources($data = [])
    {
        return $this->http()->get('free-resources', $data);
    }

    function getCourses($includeRelations = false)
    {
        return $this->http()->get('courses', [
            'with' => $includeRelations ? ['levels.subjects'] : []
        ]);
//        return $this->http()->get('courses', [
//            'with' => $includeRelations ? ['levels.subjects'] : []
//        ])->throw()->json();
    }

    function getLevels($data = [])
    {
        return $this->http()->get('levels', $data);
    }

    function getSections($data = [])
    {
        return $this->http()->get('sections', $data);
    }

    function getCourse($id)
    {
        return $this->http()->get('course/' . $id);
    }

    function getLevel($id)
    {
        return $this->http()->get('level/' . $id);
    }
    function getLevelByCourse($id) {
        return $this->http()->get('level-by-course/' . $id);
    }

    function getSubjects($data = [])
    {
        return $this->http()->get('subjects', $data);
    }

    function getSubjectsByLevels($data = [])
    {
        return $this->http()->get('get-subjects-by-levels', $data);
    }
    function getTypesByLevels($data = [])
    {
        return $this->http()->get('get-types-by-levels', $data);
    }

    function getSubjectsByLanguages($data = [])
    {
        return $this->http()->get('get-subjects-by-languages', $data);
    }

    function getChapters($data = [])
    {
        return $this->http()->get('chapters', $data);
    }

    function getChaptersBySubjects($data = [])
    {
        return $this->http()->get('get-chapter-by-subject', $data);
    }

    function getProfessorsByChapter($data = [])
    {
        return $this->http()->get('get-professor-by-chapter', $data);
    }

    function getProfessors($data = [])
    {
        return $this->http()->get('professors', $data);
    }

    /****Added BY TE on 24 MAy 2022*********/
    function getProfessorsBySubject($data = [])
    {        
        return $this->http()->get('professorsBYSubject', $data);
    }
    
    // function postEmailSupport($data = [])
    // {
    //     return $this->http()->post('email-support', $data);
    // }
	 function getlastCompletedVideo($data=[]){
        return $this->http()->post('getlastCompletedVideo', $data);
    }
    function getValidPackages(){
        return $this->http()->get('getValidPackages');
    }
    
    function postTestiFeedback($data = []){
        return $this->http()->post('testimonials', $data);
    }
    function getLinkedPackages($data=[]){
        return $this->http()->get('linkedPackages', $data); 
     
    } function getDemoVideo($data=[]){
        return $this->http()->get('demo_video', $data); 

    }
    
    function getVideoById($id){
       
        return $this->http()->get('videos/getVideoById/'. $id);
    }
    
    function getCourseVideo($data=[]){
        return $this->http()->get('course_demo_video', $data); 
    }
    
    function getPackageTypes($data=[]){
        return $this->http()->get('getallpackagetypes', $data);
    }

    function getLevelCourse($id) {
        return $this->http()->get('levelbycourse/' . $id);
    }
    
    function getProfessorBySubject($data=[]){
        return $this->http()->get('get-professor-by-subject', $data);
    }
    function getLatestTransaction(){
        return $this->http()->get('get-last-success-payments');
    }

    function getLevelsByCourse($data=[]){
        return $this->http()->get('get-levels-by-course',$data);
    }
    
    function postStudentLogs($data=[]){
        return $this->http()->post('save-student-logs', $data);
    }
    
    function getJomenySetting(){
        return $this->http()->get('jkoin-max');
    }
    function getHolidayOffers(){
            return $this->http()->get('holiday-offers');
    }
     function getHolidayOfferDet($data = []){   
          return $this->http()->get('holiday-offer-det',$data);
    }
    function getUsedJMoney(){
       return $this->http()->get('jkoin-used');
    }


    function getActiveSpin(){
        return $this->http()->get('get-active-spin');
    }

    function debitJkoin($data=[]){
        return $this->http()->post('debit-jkoin',$data);
    }
    public function thaneVaibhavReg($data = []){
        return $this->http()->post('thane-vaibhav-reg', $data);
    }
    public function verifyMObileVaibhav($data = []){
        return $this->http()->post('thane-vaibhav-mob-verify', $data);
    }
    public function getAllWishlistPackages(){
        return $this->http()->get('get-user-wishlist-packages');
    }
    function sentotp($data = [])
    {
       
        return $this->http()->post('/otp/send', $data);
    }

    function signup_otp_verify($data = [])
    {
        return $this->http()->post('signup_otp_verify', $data);
    }

    function saveScreenshot($data){
        info($data);
        return $this->http()->post('save_screenshot',$data);
    }
    function get_question_details($data = [])
    {
        return $this->http()->post('get_question_details', $data);
    }
    function get_question_answer($data = [])
    {
        return $this->http()->post('get_question_answer', $data);
    }
    function saveInvoiceAccessLog($data){
        return $this->http()->post('save_invoice_access_log',$data);
    }

    function getPurchasedStudyMat(){
        return $this->http()->get('get-purchased-studymaterials');
    }
    /*************** TE Ends ****************/
    function getProfessorsByExperience($data = [])
    {
        return $this->http()->get('professors-by-experience', $data);
    }

    function getMiniPackages($data = [])
    {
        return $this->http()->get('packages', array_merge(['type' => 'mini'], $data));
    }
    function getCrashCourses($data = [])
    {
        return $this->http()->get('packages', array_merge(['type' => 'crash'], $data));
    }

    function getPreBookCourses($data = [])
    {
        return $this->http()->get('packages', array_merge(['type' => 'pre-book'], $data));
    }

    function getFullPackages($data = [])
    {
        return $this->http()->get('packages', array_merge(['type' => 'full'], $data));
    }

    function getCaFoundationPackages($data = [])
    {
        return $this->http()->get('packages',  $data);
    }

    function getAllPackages($data = [])
    {
        return $this->http()->get('packages', $data);
    }

    function getPackagesToHomePage($data = [])
    {
        return $this->http()->get('get-all-packages', $data);
    }

    function getSectionPackagesToHomePage($data = [])
    {
        return $this->http()->get('get-section-packages', $data);
    }

    function getPackageByLevelId($data = [])
    {
        return $this->http()->get('get-all-packages-by-level', $data);
    }

    function addToCart($uuID, $packageId)
    {
        return $this->http()->post('cart', [
            'uuid' => $uuID,
            'package_id' => $packageId
        ]);
    }

    function removeFromCart($id) {
        return $this->http()->delete('cart/' . $id);
    }

    function addToWishlist($data) {
        return $this->http()->post('wishlist', $data);
    }

    function getCoupons($data = []) {
        return $this->http()->get('coupons', $data);
    }

    function getTax($data = []) {
        return $this->http()->get('tax', $data);
    }

    function rewardPoints($data = []) {
        return $this->http()->get('redeem-reward-points', $data);
    }

    function getAddresses() {
        return $this->http()->get('addresses');
    }

    function postAddresses($data = []) {
        return $this->http()->post('addresses', $data);
    }

    function putAddress($id = null, $data = []) {
        return $this->http()->put('addresses/' . $id, $data);
    }

    function deleteAddress($id = null) {
        return $this->http()->delete('addresses/' . $id);
    }

    function getPackage($id, $data = [])
    {
        return $this->http()->get('packages/' . $id, $data);
    }

    function getPackageDetails($id) {
        return $this->http()->get('package-details/' . $id);
    }

    function showVideo($id) {
        return $this->http()->get('videos/' . $id);
    }

    function postQuestion($data = [])
    {
        return $this->http()->post('ask-a-questions', $data);
    }

    function postContact($data = [])
    {
        return $this->http()->post('contact', $data);
    }

    function deleteQuestion($id)
    {
        return $this->http()->delete('ask-a-questions/' . $id);
    }

    function postStudentNote($data = [])
    {
        return $this->http()->post('student-notes', $data);
    }

    function updateStudentNote($id = null, $data = [])
    {
        return $this->http()->put('student-notes/' . $id, $data);
    }

    function deleteStudentNote($id)
    {
        return $this->http()->delete('student-notes/' . $id);
    }

    function getOrder($data = [])
    {
        return $this->http()->post('fetch-student-orders' , $data);
    }

    function postOrder($data = [])
    {
        return $this->http()->post('orders', $data);
    }

    function contactUs($data = [])
    {
        return $this->http()->post('contact-us', $data);
    }

    function updateOrder($data = [])
    {
        return $this->http()->put('orders/'.$data['id'],$data);
    }

    function easeBuzzUpdateOrder($data = [])
    {
        return $this->http()->post('ease-buzz-orders',$data);
    }

    function paymentTransactionHistory($data = [])
    {
        return $this->http()->post('payment-transaction-history',$data);
    }


    function getOrderItem($data = [])
    {
        return $this->http()->get('order-items', $data);
    }

    function getOrderItems($data = [])
    {
        return $this->http()->get('package-order-items', $data);
    }

    function showOrderItem($id = null, $data = [])
    {
        return $this->http()->get('order-items/' . $id, $data);
    }

    function getFilteredPackages($data = [])
    {
        return $this->http()->get('packages', $data);
    }

    function getPackageList($data = [])
    {
        return $this->http()->get('get-package-list', $data);
    }

    function postReferrals($data = [])
    {
        return $this->http()->post('referrals', $data);
    }

    function getBanners()
    {
        return $this->http()->get('banners');
    }

    function postCallRequest($data = [])
    {
        return $this->http()->post('call-requests', $data);
    }

    function getSaveForLater()
    {
        return $this->http()->get('wishlist');
    }

    function postSaveForLater($data = [])
    {
        return $this->http()->post('wishlist', $data);
    }

    function deleteSaveForLater($id = null)
    {
        return $this->http()->delete('wishlist/' . $id);
    }

    function deleteFromWishList($data = [])
    {
        return $this->http()->get('delete-from-wishlist', $data);
    }

    function postForgotPassword($data = [])
    {
        return $this->http()->post('forgot-password', $data);
    }

    function postResetPassword($data = [])
    {
        return $this->http()->post('reset-password', $data);
    }

    function getAssociateProfile()
    {
        return $this->http()->get('associate/profile');
    }

    function putAssociateProfile($id, $data = [])
    {
        return $this->http()->put('associate/profile/' . $id, $data);
    }

    function getSettings($data = [])
    {
        return $this->http()->get('settings', $data);
    }

    function getAssociateStudents($data = [])
    {
        return $this->http()->get('associate/students', $data);
    }

    function getAssociateStudent($id = null)
    {
        return $this->http()->get('associate/students/' . $id);
    }

    function postAssociateStudent($data = [])
    {
        return $this->http()->post('associate/students', $data);
    }

    function putAssociateStudent($data = [], $id)
    {
        return $this->http()->put('associate/students/' . $id, $data);
    }

    public function sendStudentVerificationMail($data = [])
    {
        return $this->http()->post('associate/students/send-verification-mail', $data);
    }

    function getProfessor($id = null)
    {
        return $this->http()->get('professors/' . $id);
    }

    function getAssociateOrders($data = [])
    {
        return $this->http()->get('associate/orders',$data);
    }

    function getAssociateOrderItems()
    {
        return $this->http()->get('associate/order-items');
    }

    function postAssociateAvatar($image = null)
    {
        return $this->http()->attach('image', $image->get(), 'image.' . $image->getClientOriginalExtension())->post('associate/update-avatar');
    }

    function getAssociateCommissions($data = [])
    {
        return $this->http()->get('associate/commissions', $data);
    }

    function getAssociateSales($data = [])
    {
        return $this->http()->get('associate/sales', $data);
    }

    function getProfessorProfile()
    {
        return $this->http()->get('professor/profile');
    }

    public function postProfessorProfile($image = null)
    {
        return $this->http()->attach('image', $image->get(), 'image.' . $image->getClientOriginalExtension())->post('professor/profile');
    }

    function putProfessorProfile($id = null, $data = [])
    {
        return $this->http()->put('professor/profile/' . $id, $data);
    }

    function getProfessorQuestions($page = '')
    {
        return $this->http()->get('professor/questions?page=' . $page);
    }

    function getProfessorQuestion($id)
    {
        return $this->http()->get('professor/questions/' . $id);
    }

    function getProfessorAnswers($page = '')
    {
        return $this->http()->get('professor/answers?page=' . $page);
    }

    function postProfessorAnswer($data = [])
    {
        return $this->http()->post('professor/answers', $data);
    }

    function getProfessorVideos($data = [])
    {
        return $this->http()->get('professor/videos', $data);
    }

    function showProfessorVideos($data = [])
    {
        return $this->http()->get('professor/show-videos', $data);
    }

    function getProfessorTestimonials()
    {
        return $this->http()->get('professor/testimonials');
    }

    function postProfessorNote($data = [])
    {
        return $this->http()->post('professor/notes',$data);
    }

    function updateProfessorNote($data = [])
    {
        return $this->http()->post('professor/update-notes',$data);
    }

    function deleteProfessorNote($data = [])
    {
        return $this->http()->post('professor/delete-notes',$data);
    }

    function getProfessorPayout($data = [])
    {
        return $this->http()->get('professor/payout',$data);
    }

    function getTestimonials()
    {
        return $this->http()->get('testimonials');
    }

    function getJMoney()
    {
        return $this->http()->get('j-money');
    }

    function getVideo($id = null, $data = [])
    {
        return $this->http()->get('videos/' . $id, $data);
    }

    public function validateEmail($data = [])
    {
        return $this->http()->post('validate-email', $data);
    }

    public function validatePhone($data = [])
    {
        return $this->http()->post('validate-phone', $data);
    }

    public function validateScholarEmail($data = [])
    {
        return $this->http()->post('check-email', $data);
    }

    public function validateScholarPhone($data = [])
    {
        return $this->http()->post('check-phone', $data);
    }

    public function embedVideo($id = null)
    {
        return $this->http()->get('embed/videos/' . $id);
    }

    public function getChapterVideos($chapterID = null, $videoID = null)
    {
        return $this->http()->get('chapters/' . $chapterID . '/videos/' . $videoID);
    }

    public function getLastWatchedVideo($data = [])
    {
        return $this->http()->get('get-last-watched-video', $data);
    }

    public function getPlayer($videoID = null,$s3 = null)
    {
        if($s3){
            return $this->http()->get('videos/get-player/' . $videoID . "/" . $s3);
        }else{
            return $this->http()->get('videos/get-player/' . $videoID);
        }
    }

    public function postVideoHistory($data = [])
    {
        return $this->http()->post('video-histories', $data);
    }

    public function postFreemiumVideoHistory($data = [])
    {
        return $this->http()->post('freemium-video-histories', $data);
    }

    public function validateLogin($data = [])
    {
        return $this->http()->post('validate-login', $data);
    }

    public function getContents($data = [])
    {
        return $this->http()->get('contents', $data);
    }

    public function getPurchasedPackages($data = [])
    {
        return $this->http()->get('get-purchased-packages', $data);
    }

    public function getDashboardPurchasedPackage($data = [])
    {
        return $this->http()->get('get-dashboard-purchased-packages', $data);
    }

    public function getCompletedCourse($totalPurchasedOrderCount = null)
    {
        return $this->http()->get('get-completed-packages/' . $totalPurchasedOrderCount);
    }

    public function getPackageSubjects($packageID = null)
    {
        return $this->http()->get('get-package-subjects/' . $packageID);
    }

    public function getTotalChapters($data = [])
    {
        return $this->http()->get('get-total-chapters', $data);
    }

    public function postBalanceOrders($data = [])
    {
        return $this->http()->post('balance-orders', $data);
    }

    public function getPayments($data = [])
    {
        return $this->http()->get('payments', $data);
    }

    public function getRemainingDuration($data = [])
    {
        return $this->http()->get('remaining-duration', $data);
    }

    public function getFreemiumRemainingDuration($data = [])
    {
        return $this->http()->get('freemium-remaining-duration', $data);
    }

    public function orderItemsMarkAsCompleted($id = null)
    {
        return $this->http()->post('order-items/mark-as-completed/' . $id);
    }

    public function getUserNotifications($data = [])
    {
        return $this->http()->get('user-notifications', $data);
    }

    public function postUserNotifications($data = [])
    {
        return $this->http()->post('user-notifications/mark-as-read', $data);
    }

    public function getAddress($id = null)
    {
        return $this->http()->get('addresses/' . $id);
    }

    public function getProfessorDashboard($data = [])
    {
        return $this->http()->get('professor/dashboard', $data);
    }

    public function getProfessorPackages($data = [])
    {
        return $this->http()->get('professor/packages', $data);
    }

    public function getProfessorReports($data = [])
    {
        return $this->http()->get('professor/reports', $data);
    }

    public function getSpinWheelCampaign($slug = null)
    {
        return $this->http()->get('campaigns/spin-wheels/' . $slug);
    }

    public function getSpinWheelPrize($id = null)
    {
        return $this->http()->get('campaigns/spin-wheels/' . $id . '/prize');
    }

    public function postCampaignRegistration($data = [])
    {
        return $this->http()->post('campaign-registrations', $data);
    }

    public function validateCampaignRegistrationPhone($data = [])
    {
        return $this->http()->post('campaigns/validate-phone', $data);
    }

    public function postTempCampaignPoints($data = [])
    {
        return $this->http()->post('temp-campaigns-points', $data);
    }

    public function postTempCampaignRegister($data = [])
    {
        return $this->http()->post('temp-campaigns-resgister', $data);
    }

    public function getSpinWheelCampaignRemainingChances($data = [])
    {
        return $this->http()->get('campaigns/remaining-chances', $data);
    }

    public function validateCampaignRegistrationOTP($data = [])
    {
        return $this->http()->post('campaigns/validate-otp', $data);
    }

    public function getProfessorRevenue($data = [])
    {
        return $this->http()->get('professor/revenues', $data);
    }
    public function getHistory($data = [])
    {
        return $this->http()->get('histories', $data);
    }

    public function updatePaymentInitiatedAt($id = null)
    {
        return $this->http()->post("update-payment-initiated-at/$id");
    }

    public function getProfessorPackageVideos($data = [])
    {
        return $this->http()->get('professor/package-videos', $data);
    }

    public function getAssociateTotalOrders()
    {
        return $this->http()->get('associate/dashboard');
    }

    public function getBranchManagerProfile()
    {
        return $this->http()->get('branch-managers/profile');
    }

    public function putBranchManagerProfile($id, $data = [])
    {
        return $this->http()->put('branch-managers/profile/' . $id, $data);
    }

    function getBranchManagerOrders($data = [])
    {
        return $this->http()->get('branch-managers/orders',$data);
    }

    function getBranchManagerStudents()
    {
        return $this->http()->get('branch-managers/students');
    }

    function postBranchManagerStudent($data = [])
    {
        return $this->http()->post('branch-managers/students', $data);
    }
    function changeProfessorPassword($id, $data = [])
    {
        return $this->http()->post('professor/change-password/' . $id, $data);
    }

    public function studentMarkAsVerified($token = null)
    {
        return $this->http()->get('verifications/' . $token);
    }

    public function sendPaymentLink($data = [])
    {
        return $this->http()->post('associate/send-payment-link', $data);
    }

    public function getBlogs($data = [])
    {
        return $this->http()->get('blogs', $data);
    }

    public function getBlog($id = null)
    {
        return $this->http()->get('blogs' . '/' .$id);
    }

    public function getBlogCategories($data = [])
    {
        return $this->http()->get('blog-categories');
    }
    //for api
    function apiUpdateOrder($data = [])
    {
        return $this->http()->post('apiOrders',$data);
    }
    //for cancel api
    function apiCancelOrder($data = [])
    {
        return $this->http()->post('apiCancelOrders',$data);
    }
    //for order history
    function getOrderHistory($data = [])
    {
        return $this->http()->get( 'get-order-history',$data);
    }

    function getHighPriorityNotification()
    {
        return $this->http()->get('high-priority-notification');
    }

    public function getAnswerPortal($data = [])
    {
        return $this->http()->get('answer-portal', $data);
    }

    public function postAnswerPortal($data = [])
    {
        return $this->http()->post('answer-portal', $data);
    }

    public function likeBlog($id = null)
    {
        return $this->http()->post('blogs' . '/' . $id . '/' . 'like');
    }

    public function getBlogTags($data = [])
    {
        return $this->http()->get('blog-tags');
    }

    function postFeedback($data = [])
    {
        return $this->http()->post('feedback', $data);
    }

    function getFeedbackOrderItem($data = [])
    {
        return $this->http()->get('feedback-order-item', $data);
    }

    function redirectToGoogle($data = [])
    {
        return $this->http()->get('auth/google', $data);
    }

    function getPackageFeatures($id = null)
    {
        return $this->http()->get( 'package-features/' . $id);
    }
    function attemptYearUpdate($data = []) {

        return $this->http()->post( 'student/attempt_year/update',$data);
    }
    function addJmoney($data=[]) {

        return $this->http()->post( 'add-jmoney-holidayoffer',$data);
    }
    function getJmoneyOffer() {

        return $this->http()->get( 'get-jmoney-holidayoffer');
    } 
    function deleteJmoneyOffer() {

        return $this->http()->get( 'delete-jmoney-holidayoffer');
    } 

    function getUserFreemiumPackageIds($data = [])
    {
        return $this->http()->get('get-user-freemium-package-ids', $data);
    }

    function startFreeTrial($data) {
        return $this->http()->post('userFreemium', $data);
    }
    
    function getDashboardUserFreemiumPackage($data){
        return $this->http()->get('get-user-freemium-packages',$data );
    }

    function agreeTnCofVerandaVarsity($data=[]){
        return $this->http()->post('agreeTnCofVerandaVarsity', $data);
    }
    
    function getCheckaAgreeTnC($data=[]){
        return $this->http()->get('get-user-agree-TnC', $data);
    }
}
