<?php

use Illuminate\Support\Facades\Route;





Route::get('/','Patient\HomeController@index')->name('home');
Route::get('/about-us','Patient\HomeController@aboutUs');
Route::get('/faq','Patient\HomeController@Faq');
Route::get('/blog','Patient\HomeController@blog');
Route::get('/blog-details/{slug}','Patient\HomeController@blogDetails');
Route::get('/blog-category/{slug}','Patient\HomeController@blogCategory');
Route::post('comment-store','Patient\HomeController@commentStore');
Route::get('/contact-us','Patient\HomeController@contactUs');
Route::get('/doctor','Patient\HomeController@doctor');
Route::get('/doctor-details/{slug}','Patient\HomeController@doctorDetails');
Route::get('/search-doctor','Patient\HomeController@searchDoctor');

Route::get('/department','Patient\HomeController@department');
Route::get('/department-details/{slug}','Patient\HomeController@departmentDetails');
Route::get('/service','Patient\HomeController@service');
Route::get('/service-details/{slug}','Patient\HomeController@serviceDetails');
Route::get('/testimonial','Patient\HomeController@testimonial');
Route::get('/terms-condition','Patient\HomeController@termsCondition');
Route::get('/privacy-policy','Patient\HomeController@privacyPolicy');
Route::post('contact-message','Patient\ContactController@message');
Route::get('custom-page/{slug}','Patient\HomeController@customePage');
// ajax request for appointment
Route::get('get-appointment/','Patient\AppointmentController@getAppointment');
Route::get('get-department-doctor/{id}','Patient\AppointmentController@getDepartmentDoctor');
//appointment add to cart
Route::post('create-appointment','Patient\AppointmentController@createAppointment');
Route::get('remove-appointment/{id}','Patient\AppointmentController@removeAppointment');
// Subscribe us
Route::post('subscribe-us','Patient\HomeController@subscribeUs');
Route::get('subscription-verify/{token}','Patient\HomeController@subscriptionVerify')->name('subscription.verify');




//Patient profile section
Route::group(['as'=> 'patient.', 'namespace' => 'Patient', 'prefix' => 'patient'],function (){
    Route::get('dashboard','ProfileController@dashboard')->name('dashboard');
    Route::get('account','ProfileController@account')->name('account');
    Route::get('appointment','ProfileController@appointments')->name('appointment');
    Route::get('show/{id}/appointment','ProfileController@showAppointment')->name('shwo.appointment');
    Route::get('order','ProfileController@orders')->name('order');
    Route::post('update-profile','ProfileController@updateProfile')->name('update.profile');
    Route::get('change-password','ProfileController@changePassword')->name('change.password');
    Route::post('store-change-password','ProfileController@storePassword')->name('update.password');



    Route::get('payment','PaymentController@payment')->name('payment');
    Route::post('stripe-payment','PaymentController@stripePayment')->name('stripe.payment');
    Route::post('bank-payment','PaymentController@bankPayment')->name('bank.payment');

    Route::post('store-paypal','PaypalController@store');
    Route::get('paypal-payment-success','PaypalController@paymentSuccess');
    Route::get('paypal-payment-cancled','PaypalController@paymentCancled');


    Route::get('message','MessageController@index')->name('message');
    route::get('message-box/{slug}','MessageController@messagebox')->name('message.box');
    route::get('get-message/{id}','MessageController@getmessage')->name('get.message');
    route::get('send-message','MessageController@sendmessage')->name('send.message');

    Route::get('/meeting-history', 'MeetingController@meetingHistory')->name('meeting-history');
    Route::get('/upcomming-meeting', 'MeetingController@upCommingMeeting')->name('upcomming-meeting');

});


// patient custom auth route
Route::get('register','Auth\RegisterController@userRegisterPage')->name('register');
Route::post('register','Auth\RegisterController@storeRegister')->name('register');
Route::get('user-verify/{token}','Auth\RegisterController@userVerify')->name('user.verify');
Route::get('login','Auth\LoginController@userLoginPage')->name('login');
Route::post('login','Auth\LoginController@storeLogin')->name('login');
Route::get('logout','Auth\LoginController@userLogout')->name('logout');
Route::get('forget-password','Auth\ForgotPasswordController@forgetPassword')->name('forget.password');
Route::post('send-forget-password','Auth\ForgotPasswordController@sendForgetEmail')->name('send.forget.password');
Route::get('reset-password/{token}','Auth\ForgotPasswordController@resetPassword')->name('reset.password');
Route::post('store-reset-password/{token}','Auth\ForgotPasswordController@storeResetData')->name('store.reset.password');



Route::get('/veri','HomeController@verification');
// admin routes
Route::group(['as'=> 'admin.', 'namespace' => 'Admin', 'prefix' => 'admin'],function (){
    // login route
    Route::get('login','Auth\LoginController@adminLoginForm')->name('login');
    Route::post('login','Auth\LoginController@storeLoginInfo')->name('login');
    Route::post('register','Auth\LoginController@register')->name('register');
    Route::get('/logout','Auth\LoginController@adminLogout')->name('logout');
    Route::get('forget-password','Auth\ForgotPasswordController@forgetPassword')->name('forget.password');
    Route::post('send-forget-password','Auth\ForgotPasswordController@sendForgetEmail')->name('send.forget.password');
    Route::get('reset-password/{token}','Auth\ForgotPasswordController@resetPassword')->name('reset.password');
    Route::post('store-reset-password/{token}','Auth\ForgotPasswordController@storeResetData')->name('store.reset.password');

    // manage admin profile
    Route::get('profile','ProfileController@profile')->name('profile');
    Route::post('update-profile','ProfileController@updateProfile')->name('update.profile');

    //admin Dashboard
    Route::get('dashboard','DashboardController@index')->name('dashboard');

    // manage location and status
    Route::resource('location', 'LocationController');
    Route::get('location-status/{id}','LocationController@changeStatus')->name('location.status');

    // manage blog category
    Route::resource('blog-category', 'BlogCategoryController');
    Route::get('blog-category-status/{id}','BlogCategoryController@changeStatus')->name('blog.category.status');

    // manage blog,images,status
    Route::resource('blog', 'BlogController');
    Route::get('blog-status/{id}','BlogController@changeStatus')->name('blog.status');
    Route::get('blog-images/{blogId}','BlogController@images')->name('blog.images');
    Route::post('blog-thumbnail/{blogId}','BlogController@thumbnailImage')->name('blog.thumbnail');
    Route::post('blog-feature/{blogId}','BlogController@featureImage')->name('blog.feature');
    Route::get('delete-blog-thumbnail/{blogId}','BlogController@deleteThumbnailImage')->name('delete.blog.thumbnail');
    Route::get('delete-blog-feature/{blogId}','BlogController@deleteFeatureImage')->name('delete.blog.feature');
    // Blog comment
    Route::get('blog-comment','BlogCommentController@allComments')->name('blog-comment');
    Route::get('delete-blog-comment/{id}','BlogCommentController@deleteComment')->name('delete.blog.comment');
    Route::get('blog-comment-status/{id}','BlogCommentController@changeStatus')->name('blog.comment.status');


    // manage feature and status
    Route::resource('feature', 'FeatureController');
    Route::get('feature-status/{id}','FeatureController@changeStatus')->name('feature.status');

    Route::resource('home-section', 'HomeSectionController');
    Route::get('home-section-status/{id}','HomeSectionController@changeStatus')->name('home.section.status');

    // service,status,video, faq and image section
    Route::resource('service', 'ServiceController');
    Route::get('service-status/{id}','ServiceController@changeStatus')->name('service.status');
    Route::get('/faq-by-service/{serviceId}','ServiceFaqController@faqByService')->name('faq.by.service');
    Route::resource('faq-service', 'ServiceFaqController');
    Route::get('service-faq-status/{id}','ServiceFaqController@changeStatus')->name('service.faq.status');
    Route::resource('service-video', 'ServiceVideoController');
    Route::get('service-video-status/{id}','ServiceVideoController@changeStatus')->name('service.video.status');
    Route::get('service-images/{serviceId}','ServiceController@images')->name('service.images');
    Route::get('delete-service-image/{imageId}','ServiceController@deleteImage')->name('delete.service.image');
    Route::post('service-image-store/{serviceId}','ServiceController@storeImage')->name('service.image.store');

    // department, faq, video and image
    Route::resource('department', 'DepartmentController');
    Route::get('department-status/{id}','DepartmentController@changeStatus')->name('department.status');
    Route::get('/faq-by-department/{departmentId}','DepartmentFaqController@faqByDepartment')->name('faq.by.department');
    Route::resource('faq-department', 'DepartmentFaqController');
    Route::get('department-faq-status/{id}','DepartmentFaqController@changeStatus')->name('department.faq.status');
    Route::resource('department-video','DepartmentVideoController');
    Route::get('department-video-status/{id}','DepartmentVideoController@changeStatus')->name('department.video.status');
    Route::get('department-images/{departmentId}','DepartmentController@images')->name('department.images');
    Route::post('department-image-store/{departmentId}','DepartmentController@storeImage')->name('department.image.store');
    Route::post('department-thumbnail/{departmentId}','DepartmentController@thumbnailImage')->name('department.thumbnail.image');
    Route::get('delete-department-thumbnail/{departmentId}','DepartmentController@deleteThumbnail')->name('delete.department.thumbnail');
    Route::get('delete-department-image/{imageId}','DepartmentController@deleteImage')->name('delete.department.image');


    // Faq category and faq
    Route::resource('faq-category', 'FaqCategoryController');
    Route::get('faq-category-status/{id}','FaqCategoryController@changeStatus')->name('faq.category.status');
    Route::get('faq-by-category/{slug}','FaqController@index')->name('faq.category');
    Route::resource('faq','FaqController');
    Route::get('faq-status/{id}','FaqController@changeStatus')->name('faq.status');

    // manage testimonial and status
    Route::resource('testimonial', 'TestimonialController');
    Route::get('testimonial-status/{id}','TestimonialController@changeStatus')->name('testimonial.status');

    // manage about section
    Route::resource('about', 'AboutController');
    Route::post('update-about/{id}', 'AboutController@updateAbout')->name('update.about.section');
    Route::post('update-mission/{id}', 'AboutController@updateMission')->name('update.mission.section');
    Route::post('update-vision/{id}', 'AboutController@updateVision')->name('update.vision.section');


    Route::post('store-about-image/{id}', 'AboutController@storeImage')->name('store.about.image');


    // manage Doctor
    Route::resource('doctor', 'DoctorController');
    Route::get('doctor-status/{id}','DoctorController@changeStatus')->name('doctor.status');

    // Terms-condition and privacy-policy
    Route::resource('terms-privacy', 'ConditionPrivacyController');

    // manage contact us section
    Route::resource('contact-us', 'ContactUsController');
    Route::get('contact-message','ContactUsController@message')->name('contact.message');
    Route::resource('contact-information','ContactInformationController');

    // manage slider
    Route::resource('slider', 'SliderController');
    Route::get('slider-status/{id}','SliderController@changeStatus')->name('slider.status');
    Route::get('slider-content','SliderContentController@index')->name('slider.content');
    Route::post('slider-content-update/{id}','SliderContentController@update')->name('slider.content.update');

    // manage medicine
    Route::resource('medicine', 'MedicineController');
    Route::get('medicine-status/{id}','MedicineController@changeStatus')->name('medicine.status');
    Route::resource('medicine-type','MedicineTypeController');
    Route::get('medicine-type-status/{id}','MedicineTypeController@changeStatus')->name('medicine.type.status');

    // manage Schedule
    Route::resource('schedule','ScheduleController');
    Route::get('schedule-status/{id}','ScheduleController@changeStatus')->name('schedule.status');

    // manage work section
    Route::resource('work', 'WorkController');
    Route::resource('work-faq', 'WorkFaqController');
    Route::get('work-faq-status/{id}', 'WorkFaqController@changeStatus')->name('work.faq.status');

    // mange habit section
    Route::resource('habit', 'HabitController');

    // manage day
    Route::resource('day','DayController');

    // payment Account information
    Route::resource('payment-account','PaymentAccountController');

    // setting
    Route::resource('settings','SettingsController');
    Route::get('comment-setting','SettingsController@blogCommentSetting')->name('comment.setting');
    Route::post('update-comment-setting','SettingsController@updateCommentSetting')->name('update.comment.setting');
    Route::get('cookie-consent-setting','SettingsController@cookieConsentSetting')->name('cookie.consent.setting');
    Route::post('update-cookie-consent','SettingsController@updateCookieConsentSetting')->name('update.cookie.consent.setting');
    Route::get('captcha-setting','SettingsController@captchaSetting')->name('captcha.setting');
    Route::post('update-captcha-setting','SettingsController@updateCaptchaSetting')->name('update.captcha.setting');

    Route::get('livechat-setting','SettingsController@livechatSetting')->name('livechat.setting');
    Route::post('update-livechat-setting','SettingsController@updateLivechatSetting')->name('update.livechat.setting');

    Route::get('preloader-setting','SettingsController@preloaderSetting')->name('preloader.setting');
    Route::post('preloader-update/{id}','SettingsController@preloaderUpdate')->name('preloader.update');

    Route::get('google-analytic-setting','SettingsController@googleAnalytic')->name('google.analytic.setting');
    Route::post('google-analytic-update','SettingsController@googleAnalyticUpdate')->name('google.analytic.update');
    Route::get('theme-color','SettingsController@themeColor')->name('theme-color');
    Route::post('theme-color-update','SettingsController@themeColorUpdate')->name('theme-color.update');

    Route::get('email-template','SettingsController@emailTemplate')->name('email.template');
    Route::get('email-template-edit/{id}','SettingsController@editEmail')->name('email-edit');
    Route::post('email-template-update/{id}','SettingsController@updateEmail')->name('email.update');

    Route::get('email-configuration','EmailConfigurationController@index')->name('email-configuration');
    Route::post('update-email-configuraion','EmailConfigurationController@update')->name('update-email-configuraion');

    Route::get('prescription-contact','SettingsController@prescriptionContact')->name('prescription.contact');
    Route::post('prescription-contact-update','SettingsController@prescriptionContactUpdate')->name('prescription.contact.update');













    // clear database
    Route::get('clear-database','SettingsController@clearDatabase')->name('clear.database');
    Route::get('clear-all','SettingsController@destroyDatabase')->name('clear.all.data');




    //  Manage Pages
    Route::get('home-page','ManagePageController@homePage')->name('home.page');
    Route::post('home-page-update','ManagePageController@homePageUpdate')->name('home.page.update');
    Route::get('about-us-page','ManagePageController@aboutUs')->name('aboutus.page');
    Route::post('about-us-page-update','ManagePageController@aboutUsUpdate')->name('aboutus.page.update');
    Route::get('doctor-page','ManagePageController@doctor')->name('doctor-page');
    Route::post('doctor-page-update','ManagePageController@doctorUpdate')->name('doctor.page.update');
    Route::get('department-page','ManagePageController@department')->name('department-page');
    Route::post('department-page-update','ManagePageController@departmentUpdate')->name('department.page.update');
    Route::get('service-page','ManagePageController@service')->name('service-page');
    Route::post('service-page-update','ManagePageController@serviceUpdate')->name('service.page.update');
    Route::get('testimonial-page','ManagePageController@testimonial')->name('testimonial.page');
    Route::post('testimonial-page-update','ManagePageController@testimonialUpdate')->name('testimonial.page.update');
    Route::get('faq-page','ManagePageController@faq')->name('faq.page');
    Route::post('faq-page-update','ManagePageController@faqUpdate')->name('faq.page.update');
    Route::get('blog-page','ManagePageController@blog')->name('blog.page');
    Route::post('blog-page-update','ManagePageController@blogUpdate')->name('blog.page.update');
    Route::get('contactus-page','ManagePageController@contactUs')->name('contactus.page');
    Route::post('contactus-page-update','ManagePageController@contactUsUpdate')->name('contactus.page.update');

    Route::get('subscribe-content','SubscriberContentController@index')->name('subscriber.content');
    Route::post('subscribe-content-update/{id}','SubscriberContentController@Update')->name('subscriber.content.update');
    Route::get('subscriber','SubscriberController@index')->name('subscriber');
    Route::get('subscriber-delete/{id}','SubscriberController@delete')->name('subscriber.delete');
    Route::get('subscriber-email','SubscriberController@emailTemplate')->name('subscriber.email');
    Route::post('send-subscriber-email','SubscriberController@sendMail')->name('send.subscriber.mail');


    // manage partner
    Route::resource('partner', 'PartnerController');
    Route::get('partner-status/{id}', 'PartnerController@changeStatus')->name('partner.status');

    // order
    Route::get('pending-order','OrderController@pendingOrder')->name('pending.order');
    Route::get('show-order/{id}','OrderController@showOrder')->name('show.order');
    Route::get('all-order','OrderController@allOrder')->name('all.order');
    Route::get('payment-accept/{id}','OrderController@paymentAccept')->name('payment.accept');
    Route::get('cancle-order/{id}','OrderController@cancleOrder')->name('cancle.order');
    Route::get('cancle-order-payment','OrderController@cancleOrderPayment')->name('canceled.order.payment');

    // appointment
    Route::get('pending-appointment','AppointmentController@pendingAppointment')->name('pending.appointment');
    Route::get('new-appointment','AppointmentController@newAppointment')->name('new.appointment');
    Route::get('all-appointment','AppointmentController@allAppointment')->name('all.appointment');
    Route::get('appointment-show/{id}','AppointmentController@show')->name('appointment.show');
    Route::get('approved-payment/{id}','AppointmentController@approvedPayment')->name('approved.payment');

    // patients
    Route::get('patients','PateintController@index')->name('patients');
    Route::get('patient-show/{id}','PateintController@show')->name('patient.show');
    Route::get('patient-search','PateintController@search')->name('patient.search');
    Route::get('patient-status/{id}','PateintController@changeStatus')->name('patient.status');
    Route::get('patient-delete/{id}','PateintController@delete')->name('patient.delete');


    // custome page
    Route::resource('custom-page','CustomePageController');
    Route::get('custom-page-status/{id}', 'CustomePageController@changeStatus')->name('custom.page.status');

    // manage prescription
    Route::get('prescribe','PrescribeController@index')->name('prescribe');
    Route::get('prescribe-show/{id}','PrescribeController@show')->name('prescribe.show');
    Route::get('prescribe-search','PrescribeController@search')->name('prescribe.search');

    // overview
    Route::resource('overview','OverviewController');
    Route::get('overview-status/{id}', 'OverviewController@changeStatus')->name('overview.status');

     // manage payment
     Route::get('payment','PaymentController@payment')->name('payment');
     Route::get('payment-search','PaymentController@paymentSearch')->name('payment.search');

    //  admin
    Route::resource('admin-list','AdminController');
    Route::get('admin-status/{id}', 'AdminController@changeStatus')->name('admin.status');

    // check notification
    Route::get('view-order-notify','OrderController@viewOrderNotify')->name('view.order.notify');
    Route::get('view-message-notify','OrderController@viewMessageNotify')->name('view.message.notify');


    Route::get('setup-navbar','NavbarController@index')->name('setup.navbar');
    Route::post('update-navbar','NavbarController@update')->name('update.navigation');
    Route::get('setup-text','TextController@index')->name('setup.text');
    Route::post('update-text','TextController@update')->name('update.text');

    // manage banner image
    Route::get('banner-image','BannerImageController@index')->name('banner.image');
    Route::post('about-banner','BannerImageController@aboutBanner')->name('about.banner');
    Route::post('about-us-bg','BannerImageController@aboutUsBg')->name('about_us_bg');
    Route::post('subscribe-us-banner','BannerImageController@subscribe')->name('subscribe.us.banner');
    Route::post('doctor-banner','BannerImageController@doctor')->name('doctor.banner');
    Route::post('service-banner','BannerImageController@service')->name('service.banner');
    Route::post('department-banner','BannerImageController@department')->name('department.banner');
    Route::post('testimonial-banner','BannerImageController@testimonial')->name('testimonial.banner');
    Route::post('faq-banner','BannerImageController@faq')->name('faq.banner');
    Route::post('contact-banner','BannerImageController@contact')->name('contact.banner');
    Route::post('profile-banner','BannerImageController@profile')->name('profile.banner');
    Route::post('login-banner','BannerImageController@login')->name('login.banner');
    Route::post('payment-banner','BannerImageController@payment')->name('payment.banner');
    Route::post('overview-banner','BannerImageController@overview')->name('overview.banner');
    Route::post('custom_page-banner','BannerImageController@custom_page')->name('custom_page.banner');
    Route::post('blog-banner','BannerImageController@blog')->name('blog.banner');
    Route::post('admin_login-banner','BannerImageController@admin_login')->name('admin_login.banner');
    Route::post('doctor_login-banner','BannerImageController@doctor_login')->name('doctor_login.banner');
    Route::post('privacy_and_policy-banner','BannerImageController@privacy_and_policy')->name('privacy_and_policy.banner');
    Route::post('terms_and_condition-banner','BannerImageController@terms_and_condition')->name('terms_and_condition.banner');

    Route::post('default-profile','BannerImageController@defaultProfile')->name('default.profile');
    Route::get('login-image','BannerImageController@loginImageIndex')->name('login.image');
    Route::get('profile-image','BannerImageController@profileImageIndex')->name('profile.image');


    Route::get('validation-errors','ValidationTextController@index')->name('validation.errors');
    Route::post('update-validation-text','ValidationTextController@update')->name('update.validation.text');

    Route::get('notification-text','ValidationTextController@notification')->name('notification.text');
    Route::post('update-notification-text','ValidationTextController@updateNotification')->name('update.notification.text');

    Route::get('/meeting-history', 'MeetingController@meetingHistory')->name('meeting-history');


});


// doctor routes
Route::group(['as'=> 'doctor.', 'namespace' => 'Doctor', 'prefix' => 'doctor'],function (){
    // login route
    Route::get('login','Auth\LoginController@doctorLoginForm');
    Route::post('login','Auth\LoginController@storeLoginInfo')->name('login');
    Route::get('/logout','Auth\LoginController@doctorLogout')->name('logout');
    Route::get('forget-password','Auth\ForgotPasswordController@forgetPassword')->name('forget.password');
    Route::post('send-forget-password','Auth\ForgotPasswordController@sendForgetEmail')->name('send.forget.password');
    Route::get('reset-password/{token}','Auth\ForgotPasswordController@resetPassword')->name('reset.password');
    Route::post('store-reset-password/{token}','Auth\ForgotPasswordController@storeResetData')->name('store.reset.password');


    // manage doctor profile
    Route::get('profile','ProfileController@profile')->name('profile');
    Route::post('update-profile','ProfileController@updateProfile')->name('update.profile');
    Route::post('change-password','ProfileController@changePassword')->name('change.password');

    // dashbaord
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('leave', 'LeaveController');

    Route::get('today-appointment','AppointmentController@todayAppointment')->name('today.appointment');
    Route::get('new-appointment','AppointmentController@newAppointment')->name('new.appointment');
    Route::get('all-appointment','AppointmentController@allAppointment')->name('all.appointment');
    Route::get('treatment/{id}','AppointmentController@treatment')->name('treatment');
    Route::get('already-treatment/{id}','AppointmentController@allReadyTreatment')->name('already.treatment');
    Route::post('treatment-store/{id}','AppointmentController@storeTreatment')->name('treatment.store');
    Route::get('treatment-edit/{id}','AppointmentController@editTreatment')->name('treatment.edit');
    Route::post('treatment-update/{id}','AppointmentController@updateTreatment')->name('treatment.update');
    Route::get('old-appointment/{id}','AppointmentController@oldAppointment')->name('old.appointment');
    Route::get('delete-appointment-prescribe/{id}','AppointmentController@deleteAppointmentPrescribe')->name('delete.appointment.prescribe');

    // doctor payment
    Route::get('payment-history','AppointmentController@paymentHistory')->name('payment.history');
    Route::get('search-payment-history','AppointmentController@searchPaymentHistory')->name('search.payment.history');
    // doctor schedule
    Route::get('schedule','ScheduleController@index')->name('schedule');



    // search-doctor-appointment using ajax
    Route::get('search-appointment','AppointmentController@searchAppointment')->name('search.appointment');
    Route::get('search-particular-appointment','AppointmentController@searchParticulerAppointment')->name('search.particuler.appointment');


    Route::get('message','MessageController@index')->name('message.index');
    Route::get('message-box/{id}','MessageController@messagebox')->name('message.box');
    Route::get('get-message/{id}','MessageController@getmessage')->name('get.message');
    Route::get('send-message','MessageController@sendmessage')->name('send.message');



    Route::get('/zoom-meetings', 'MeetingController@index')->name('zoom-meetings');
    Route::get('/create-zoom-meeting', 'MeetingController@createForm')->name('create-zoom-meeting');
    Route::post('/store-zoom-meeting', 'MeetingController@store')->name('store-zoom-meeting');
    Route::get('/edit-zoom-meeting/{id}', 'MeetingController@editForm')->name('edit-zoom-meeting');
    Route::post('/update-zoom-meeting/{id}', 'MeetingController@updateMeeting')->name('update-zoom-meeting');
    Route::get('/delete-zoom-meeting/{id}', 'MeetingController@destroy')->name('delete-zoom-meeting');

    Route::get('/meeting-history', 'MeetingController@meetingHistory')->name('meeting-history');
    Route::get('/upcomming-meeting', 'MeetingController@upCommingMeeting')->name('upcomming-meeting');



    Route::get('/zoom', 'MeetingController@store')->name('zoom');

    Route::get('/zoom-credential', 'ZoomCredentialController@index')->name('zoom-credential');
    Route::post('/store-zoom-credential', 'ZoomCredentialController@store')->name('store-zoom-credential');
    Route::post('/update-zoom-credential/{id}', 'ZoomCredentialController@update')->name('update-zoom-credential');


});
