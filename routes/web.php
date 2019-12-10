<?php

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
Route::get('SwitchLang/{lang}',function($lang){
    App::setLocale($lang);
    Session()->put('Lang',$lang);
	return Redirect::back();
});

Route::get('/Sorry', function () {
    $setting = \App\Setting::get()->keyBy('key')->all();
    if ($setting['status']->value == 'open') {
        return redirect('/');
    } else {
        return view('Sorry');
    }
})->name('sorry');

Route::get('/error', function () {
    return view('401');
})->name('error');

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/404', function () {
    return view('errors.404');
})->name('404');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
    return 'dsss';
});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//====================== Auto operations ===============================
Route::get('/AutoStopAds/', 'AdsController@autoStopAds');


Route::group(['middleware' => ['checkSetting']], function () {


//------------------- front end operations -----------------
    Route::get('/', 'FrontEndController@getHome')->name('home');
    Route::get('/VisitAd/{AID}', 'FrontEndController@getVisitAd');
    Route::get('/Questionnaire', 'FrontEndController@Questionnaire');

    Route::get('/Articles/كل-المقالات', 'FrontEndController@getAllArticles');
    Route::get('/Categories/{CID}/{CSlug}', 'FrontEndController@getCategoryArticles');
    Route::get('/Categories/{CID}/Articles/{AID}/{ASlug}', 'FrontEndController@getSingleArticle');

    Route::get('/Cources/الدورات-التدريبية', 'FrontEndController@getAllCources');
    Route::get('/CourcesCate/{CateID}/{CSlug}', 'FrontEndController@getCategoryCources');
    Route::get('/CourcesCate/{CateID}/Cource/{CourceID}/{ASlug}', 'FrontEndController@getSingleCource');
    Route::post('/CourcesCate/{CateID}/Cource/{CourceID}/{ASlug}', 'FrontEndController@postSingleCource');

    Route::get('/Registeration/{Type}', 'FrontEndController@getRegisteration');
    Route::post('/Registeration/{Type}', 'FrontEndController@postRegisteration');

    Route::get('/Parteners/{Type}', 'FrontEndController@getAllParteners');

    Route::get('/Pages/{PID}/{PSlug}', 'FrontEndController@getStaticPages');
    Route::get('/about', 'FrontEndController@getAboutPage');
    Route::get('/consultancies', 'FrontEndController@getConsultanciesPage');
    Route::get('/photos', 'FrontEndController@getPhotosPage');
    Route::get('/videos', 'FrontEndController@getVideosPage');
    Route::get('/career', 'FrontEndController@getCareerPage');
    Route::post('/career', 'FrontEndController@postCareerPage');
    Route::get('/contact', 'FrontEndController@getContactPage');
    Route::post('/contact', 'ContactFormsController@postContactUsPage');
    Route::get('/attend', 'FrontEndController@getAttendPage');
    Route::post('/attend', 'FrontEndController@postAttendPage');
    Route::get('/BookStand', 'FrontEndController@getBookStandPage');
    Route::post('/BookStand', 'FrontEndController@postBookStandPage');
    Route::get('/BeSponsor', 'FrontEndController@getBeSponsorPage');
    Route::post('/BeSponsor', 'FrontEndController@postBeSponsorPage');
    Route::post('/Questionnaire/{QID}/Vote', 'FrontEndController@postQuestionnaireVote');

    Route::get('/Search', 'FrontEndController@getSearch');
    Route::get('/SearchResults/{keyword}', 'FrontEndController@getSearchResults');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/CheckUser', 'UsersController@checkUserActive');

        /*
        =================================================
                     admin panel operations
        =================================================
        */
        // pages accessed by Super Admin only

        Route::group(['middleware' => ['roles'], 'roles' => [1]], function () {

            Route::group(['prefix' => 'AdminPanel'], function () {

                Route::get('/', 'BackEndController@AdminIndex');

                /*
                =================================================
                               Profile operations
                =================================================
                */

                Route::get('/UpdateProfile', 'BackEndController@getUpdateProfile');
                Route::post('/UpdateProfile', 'BackEndController@postUpdateProfile');

                /*
                =================================================
                          admin notifications operations
                =================================================
                */

                Route::get('/ReadNotification/{NID}', 'NotificationsController@readAdminNotification');
                Route::get('/AllNotifications/', 'NotificationsController@getAllAdminNotifications');
                Route::get('/delete_notification/{NID}/', 'NotificationsController@DeleteNotification');

                /*
                =================================================
                               General Settings operations
                =================================================
                */

                Route::get('/General/Settings', 'SettingsController@getSettings');
                Route::post('/General/Settings', 'SettingsController@UpdateSettings');

                Route::get('/HomeSettings', 'SettingsController@getHomeSettings');
                Route::get('/AboutSettings', 'SettingsController@getAboutSettings');


                Route::get('/SeoImage/{LinkedID}/{Image}/{x}/{SeoType}/Delete', 'SettingsController@DeleteSeoImage');
                Route::get('/Image/{Type}/{Image}/{x}/Delete', 'SettingsController@DeleteImage');

                /*
                =================================================
                               Static Pages operations
                =================================================
                */

                //Route::get('/Pages/Home', 'SettingsController@getHomePage');
                Route::get('/Pages', 'SettingsController@getDynamicPages');
                Route::get('/Pages/CreatePage', 'SettingsController@getCreateDynamicPage');
                Route::post('/Pages/CreatePage', 'SettingsController@postCreateDynamicPage');
                Route::get('/Pages/{PID}/Edit', 'SettingsController@getUpdateDynamicPage');
                Route::post('/Pages/{PID}/Edit', 'SettingsController@postUpdateDynamicPage');
                Route::get('/Pages/{PID}/Delete', 'SettingsController@DeleteDynamicPage');

                Route::get('/Pages/{PID}/{Photo}/{x}/DeletePhoto', 'SettingsController@DeleteDynamicPagePhoto');

                /*
                =================================================
                             gallery operations
                =================================================
                */

                Route::get('/Gallery', 'BackEndController@getAllGalleryImages');
                Route::get('/Gallery/CreateGalleryImage', 'BackEndController@getCreateGalleryImage');
                Route::post('/Gallery/CreateGalleryImage', 'BackEndController@postCreateGalleryImage');
                Route::get('/Gallery/{IID}/Edit', 'BackEndController@getUpdateGalleryImage');
                Route::post('/Gallery/{IID}/Edit', 'BackEndController@postUpdateGalleryImage');
                Route::get('/Gallery/{IID}/Delete', 'BackEndController@DeleteGalleryImage');

                /*
                =================================================
                             Organizers operations
                =================================================
                */

                Route::get('/Organizers', 'BackEndController@getAllOrganizerImages');
                Route::get('/Organizers/CreateOrganizerImage', 'BackEndController@getCreateOrganizerImage');
                Route::post('/Organizers/CreateOrganizerImage', 'BackEndController@postCreateOrganizerImage');
                Route::get('/Organizers/{PID}/Edit', 'BackEndController@getUpdateOrganizerImage');
                Route::post('/Organizers/{PID}/Edit', 'BackEndController@postUpdateOrganizerImage');
                Route::get('/Organizers/{PID}/Delete', 'BackEndController@DeleteOrganizerImage');

                /*
                =================================================
                             MediaOrganizers operations
                =================================================
                */

                Route::get('/MediaOrganizers', 'BackEndController@getAllMediaOrganizerImages');
                Route::get('/MediaOrganizers/CreateMediaOrganizerImage', 'BackEndController@getCreateMediaOrganizerImage');
                Route::post('/MediaOrganizers/CreateMediaOrganizerImage', 'BackEndController@postCreateMediaOrganizerImage');
                Route::get('/MediaOrganizers/{PID}/Edit', 'BackEndController@getUpdateMediaOrganizerImage');
                Route::post('/MediaOrganizers/{PID}/Edit', 'BackEndController@postUpdateMediaOrganizerImage');
                Route::get('/MediaOrganizers/{PID}/Delete', 'BackEndController@DeleteMediaOrganizerImage');

                /*
                =================================================
                             Partners operations
                =================================================
                */

                Route::get('/Partners', 'BackEndController@getAllPartnerImages');
                Route::get('/Partners/CreatePartnerImage', 'BackEndController@getCreatePartnerImage');
                Route::post('/Partners/CreatePartnerImage', 'BackEndController@postCreatePartnerImage');
                Route::get('/Partners/{PID}/Edit', 'BackEndController@getUpdatePartnerImage');
                Route::post('/Partners/{PID}/Edit', 'BackEndController@postUpdatePartnerImage');
                Route::get('/Partners/{PID}/Delete', 'BackEndController@DeletePartnerImage');

                /*
                =================================================
                             Centers operations
                =================================================
                */

                Route::get('/Centers', 'BackEndController@getAllCenterImages');
                Route::get('/Centers/CreateCenterImage', 'BackEndController@getCreateCenterImage');
                Route::post('/Centers/CreateCenterImage', 'BackEndController@postCreateCenterImage');
                Route::get('/Centers/{PID}/Edit', 'BackEndController@getUpdateCenterImage');
                Route::post('/Centers/{PID}/Edit', 'BackEndController@postUpdateCenterImage');
                Route::get('/Centers/{PID}/Delete', 'BackEndController@DeleteCenterImage');

                /*
                =================================================
                             Certificates operations
                =================================================
                */

                Route::get('/Certificates', 'BackEndController@getAllCertificateImages');
                Route::get('/Certificates/CreateCertificateImage', 'BackEndController@getCreateCertificateImage');
                Route::post('/Certificates/CreateCertificateImage', 'BackEndController@postCreateCertificateImage');
                Route::get('/Certificates/{PID}/Edit', 'BackEndController@getUpdateCertificateImage');
                Route::post('/Certificates/{PID}/Edit', 'BackEndController@postUpdateCertificateImage');
                Route::get('/Certificates/{PID}/Delete', 'BackEndController@DeleteCertificateImage');

                /*
                =================================================
                             TeamMembers operations
                =================================================
                */

                Route::get('/TeamMembers', 'BackEndController@getAllTeamMemberImages');
                Route::get('/TeamMembers/CreateTeamMemberImage', 'BackEndController@getCreateTeamMemberImage');
                Route::post('/TeamMembers/CreateTeamMemberImage', 'BackEndController@postCreateTeamMemberImage');
                Route::get('/TeamMembers/{PID}/Edit', 'BackEndController@getUpdateTeamMemberImage');
                Route::post('/TeamMembers/{PID}/Edit', 'BackEndController@postUpdateTeamMemberImage');
                Route::get('/TeamMembers/{PID}/Delete', 'BackEndController@DeleteTeamMemberImage');

                //Videos Control
                Route::get('/Videos', 'VideosController@Videos')->name('Videos');
                Route::get('/Videos/New', 'VideosController@AddVideo')->name('AddVideo');
                Route::post('/Videos/New', 'VideosController@SubmitVideo')->name('SubmitVideo');
                Route::get('/Videos/{VideoID}/Edit', 'VideosController@EditVideo')->name('EditVideo');
                Route::post('/Videos/{VideoID}/Edit', 'VideosController@UpdateVideo')->name('UpdateVideo');
                Route::get('/Videos/{VideoID}/Delete', 'VideosController@DeleteVideo')->name('DeleteVideo');
                Route::get('/Videos/{VideoID}/DeletePhoto/{Photo}', 'VideosController@DeleteVideoPhoto')->name('DeleteVideoPhoto');

                //ServicesSection Control
                Route::get('/ServicesSections', 'ServicesController@ServicesSections')->name('ServicesSections');
                Route::get('/ServicesSections/NewServiceSection', 'ServicesController@AddServiceSection')->name('AddServiceSection');
                Route::post('/ServicesSections/NewServiceSection', 'ServicesController@SubmitServiceSection')->name('SubmitServiceSection');
                Route::get('/ServicesSections/{UID}/Edit', 'ServicesController@EditServiceSection')->name('EditServiceSection');
                Route::post('/ServicesSections/{UID}/Edit', 'ServicesController@UpdateServiceSection')->name('UpdateServiceSection');
                Route::get('/ServicesSections/{UID}/Delete', 'ServicesController@DeleteServiceSection')->name('DeleteServiceSection');
                
                //Services Control
                Route::get('/Services', 'ServicesController@Services')->name('Services');
                Route::get('/Services/NewService', 'ServicesController@AddService')->name('AddService');
                Route::post('/Services/NewService', 'ServicesController@SubmitService')->name('SubmitService');
                Route::get('/Services/{ServiceID}/Edit', 'ServicesController@EditService')->name('EditService');
                Route::post('/Services/{ServiceID}/Edit', 'ServicesController@UpdateService')->name('UpdateService');
                Route::get('/Services/{ServiceID}/Delete', 'ServicesController@DeleteService')->name('DeleteService');
                Route::get('/Services/{ServiceID}/DeletePhoto/{Photo}','ServicesController@DeleteServicePhoto');


                /*
                =================================================
                                  quotes operations
                =================================================
                */

                Route::get('/Quotes', 'BackEndController@getAllQuotes');
                Route::get('/Quotes/CreateQuote', 'BackEndController@getCreateQuote');
                Route::post('/Quotes/CreateQuote', 'BackEndController@postCreateQuote');
                Route::get('/Quotes/{QID}/Edit', 'BackEndController@getUpdateQuote');
                Route::post('/Quotes/{QID}/Edit', 'BackEndController@postUpdateQuote');
                Route::get('/Quotes/{QID}/Delete', 'BackEndController@DeleteQuote');

                /*
                =================================================
                                Ads Area operations
                =================================================
                */

                Route::get('/Ads', 'AdsController@getAllAds');
                Route::get('/Ads/Active', 'AdsController@ActiveAds');
                Route::get('/Ads/InActive', 'AdsController@getInactiveAds');
                Route::get('/Ads/CreateAd', 'AdsController@getCreateAd');
                Route::post('/Ads/CreateAd', 'AdsController@postCreateAd');
                Route::get('/Ads/{AdID}/Edit', 'AdsController@getUpdateAd');
                Route::post('/Ads/{AdID}/Edit', 'AdsController@postUpdateAd');
                Route::get('/Ads/{AdID}/Delete', 'AdsController@DeleteAd');

                /*
                =================================================
                                   Users operations
                =================================================
                */

                Route::get('/Users', 'UsersController@getAllUsers');
                Route::get('/Users/SuperAdmins', 'UsersController@getSuperAdmins');
                Route::get('/Users/Admins', 'UsersController@getAdmins');
                Route::get('/Users/NoPermissions', 'UsersController@getUsersOnly');
                Route::get('/Users/Sellers', 'UsersController@getAllSellers');
                Route::get('/Users/Default', 'UsersController@getAllDefaultUsers');
                Route::get('/Users/CreateUser', 'UsersController@getCreateUser');
                Route::post('/Users/CreateUser', 'UsersController@postCreateUser');
                Route::get('/Users/{UID}/Edit', 'UsersController@getUpdateUser');
                Route::post('/Users/{UID}/Edit', 'UsersController@postUpdateUser');
                Route::post('/Users/{UID}/ChangeRoles', 'UsersController@postChangeRoles');
                Route::get('/Users/{UID}/Delete', 'UsersController@DeleteUser');

                /*
                =================================================
                               categories operations
                =================================================
                */

                Route::get('/Categories/', 'BackEndController@getAllCategories');
                Route::get('/Categories/CreateCategory', 'BackEndController@getCreateCategory');
                Route::post('/Categories/CreateCategory', 'BackEndController@postCreateCategory');
                Route::get('/Categories/{CID}/Edit', 'BackEndController@getUpdateCategory');
                Route::post('/Categories/{CID}/Edit', 'BackEndController@postUpdateCategory');
                Route::get('/Categories/{CID}/Delete', 'BackEndController@DeleteCategory');
                Route::get('/Categories/{CID}/{Img}/{X}/DeleteImage', 'BackEndController@DeleteCategoryImage');


                /*
                =================================================
                                   articles operations
                =================================================
                */

                Route::get('/Articles', 'BackEndController@getAllArticles');
                Route::get('/Articles/CreateArticle', 'BackEndController@getCreateArticle');
                Route::post('/Articles/CreateArticle', 'BackEndController@postCreateArticle');
                Route::get('/Articles/{AID}/Edit', 'BackEndController@getUpdateArticle');
                Route::post('/Articles/{AID}/Edit', 'BackEndController@postUpdateArticle');
                Route::get('/Articles/{AID}/Delete', 'BackEndController@DeleteArticle');
                Route::get('/Articles/{AID}/{Photo}/{X}/DeletePhoto', 'BackEndController@DeleteArticlePhoto');
                Route::post('/UploadPhotos', 'BackEndController@postUploadPhotosArticle');


                /*
                =================================================
                        course categories operations
                =================================================
                */

                Route::get('/Categories/{CID}/Articles', 'BackEndController@getCategoryArticles');
                Route::get('/Categories/{CID}/Articles/CreateArticle', 'BackEndController@getCreateCategoryArticle');
                Route::get('/Categories/{CID}/Articles/{AID}/Edit', 'BackEndController@getUpdateCategoryArticle');

                /*
                =================================================
                                Questionnaire operations
                =================================================
                */

                Route::get('/Questionnaires', 'BackEndController@getAllQuestionnaires');
                Route::get('/Questionnaires/Active', 'BackEndController@ActiveQuestionnaires');
                Route::get('/Questionnaires/InActive', 'BackEndController@getInactiveQuestionnaires');
                Route::get('/Questionnaires/CreateQuestionnaire', 'BackEndController@getCreateQuestionnaire');
                Route::post('/Questionnaires/CreateQuestionnaire', 'BackEndController@postCreateQuestionnaire');
                Route::get('/Questionnaires/{QID}/Edit', 'BackEndController@getUpdateQuestionnaire');
                Route::post('/Questionnaires/{QID}/Edit', 'BackEndController@postUpdateQuestionnaire');
                Route::get('/Questionnaires/{QID}/Delete', 'BackEndController@DeleteQuestionnaire');


                /*
                =================================================
                                widgets operations
                =================================================
                */

                Route::get('/Widgets', 'BackEndController@getAllWidgets');
                Route::get('/Widgets/CreateWidget', 'BackEndController@getCreateWidget');
                Route::post('/Widgets/CreateWidget', 'BackEndController@postCreateWidget');
                Route::get('/Widgets/{WID}/Edit', 'BackEndController@getUpdateWidget');
                Route::post('/Widgets/{WID}/Edit', 'BackEndController@postUpdateWidget');
                Route::get('/Widgets/{WID}/Delete', 'BackEndController@DeleteWidget');


                /*
                =================================================
                                menus operations
                =================================================
                */

                Route::get('/Menus', 'BackEndController@getAllMenus');
                Route::get('/Menus/CreateMenu', 'BackEndController@getCreateMenu');
                Route::post('/Menus/CreateMenu', 'BackEndController@postCreateMenu');
                Route::get('/Menus/{MID}/Edit', 'BackEndController@getUpdateMenu');
                Route::post('/Menus/{MID}/Edit', 'BackEndController@postUpdateMenu');
                Route::get('/Menus/{MID}/Delete', 'BackEndController@DeleteMenu');

                /*
                =================================================
                                menu items operations
                =================================================
                */

                Route::get('/Menus/{MID}/Items', 'BackEndController@getMenuItems');
                Route::get('/Menus/{MID}/Items/CreateMenuItem', 'BackEndController@getCreateMenuItem');
                Route::post('/Menus/{MID}/Items/CreateMenuItem', 'BackEndController@postCreateMenuItem');
                Route::get('/Menus/{MID}/Items/{IID}/Edit', 'BackEndController@getUpdateMenuItem');
                Route::post('/Menus/{MID}/Items/{IID}/Edit', 'BackEndController@postUpdateMenuItem');
                Route::get('/Menus/{MID}/Items/{IID}/Delete', 'BackEndController@DeleteMenuItem');

                /*
                =================================================
                               Contacts
                =================================================
                */

                Route::get('/Contacts/', 'ContactFormsController@getAllContacts');
                Route::get('/Contacts/{CID}/View', 'ContactFormsController@getSingleContact');
                Route::get('/Contacts/{CID}/Delete', 'ContactFormsController@DeleteContact');

                /*
                =================================================
                               RegisterTrainers
                =================================================
                */

                Route::get('/RegisterTrainers/', 'ContactFormsController@getAllRegisterTrainers');
                Route::get('/RegisterTrainers/{CID}/View', 'ContactFormsController@getSingleRegisterTrainer');
                Route::get('/RegisterTrainers/{CID}/Delete', 'ContactFormsController@DeleteRegisterTrainer');

                /*
                =================================================
                               PersonalTrainings
                =================================================
                */

                Route::get('/PersonalTrainings/', 'ContactFormsController@getAllPersonalTrainings');
                Route::get('/PersonalTrainings/{CID}/View', 'ContactFormsController@getSinglePersonalTraining');
                Route::get('/PersonalTrainings/{CID}/Delete', 'ContactFormsController@DeletePersonalTraining');

                /*
                =================================================
                               CompaniesTrainings
                =================================================
                */

                Route::get('/CompaniesTrainings/', 'ContactFormsController@getAllCompaniesTrainings');
                Route::get('/CompaniesTrainings/{CID}/View', 'ContactFormsController@getSingleCompaniesTraining');
                Route::get('/CompaniesTrainings/{CID}/Delete', 'ContactFormsController@DeleteCompaniesTraining');
            });

        });

        Route::group(['middleware' => ['roles'], 'roles' => [2]], function () {

            Route::group(['prefix' => 'SupervisorPanel'], function () {

                Route::get('/', 'SupervisorController@SupervisorIndex');

                /*
                =================================================
                               Profile operations
                =================================================
                */

                Route::get('/UpdateProfile', 'SupervisorController@getUpdateProfile');
                Route::post('/UpdateProfile', 'SupervisorController@postUpdateProfile');

                /*
                =================================================
                          admin notifications operations
                =================================================
                */

                Route::get('/ReadNotification/{NID}', 'NotificationsController@readSupervisorNotification');
                Route::get('/AllNotifications/', 'NotificationsController@getAllSupervisorNotifications');
                Route::get('/delete_notification/{NID}/', 'NotificationsController@DeleteNotification');

                /*
                =================================================
                               General Settings operations
                =================================================
                */


                Route::get('/SeoImage/{LinkedID}/{Image}/{x}/{SeoType}/Delete', 'SettingsController@DeleteSeoImage');
                Route::get('/Image/{Type}/{Image}/{x}/Delete', 'SettingsController@DeleteImage');

                /*
                =================================================
                               categories operations
                =================================================
                */

                Route::get('/Categories/', 'SupervisorController@getAllCategories');
                Route::get('/Categories/{CID}/Edit', 'SupervisorController@getUpdateCategory');
                Route::post('/Categories/{CID}/Edit', 'SupervisorController@postUpdateCategory');
                Route::get('/Categories/{CID}/{Img}/{X}/DeleteImage', 'SupervisorController@DeleteCategoryImage');


                /*
                =================================================
                                   articles operations
                =================================================
                */

                Route::get('/Articles', 'SupervisorController@getAllArticles');
                Route::get('/Articles/CreateArticle', 'SupervisorController@getCreateArticle');
                Route::post('/Articles/CreateArticle', 'SupervisorController@postCreateArticle');
                Route::get('/Articles/{AID}/Edit', 'SupervisorController@getUpdateArticle');
                Route::post('/Articles/{AID}/Edit', 'SupervisorController@postUpdateArticle');
                Route::get('/Articles/{AID}/Delete', 'SupervisorController@DeleteArticle');
                Route::get('/Articles/{AID}/{Photo}/{X}/DeletePhoto', 'SupervisorController@DeleteArticlePhoto');


                /*
                =================================================
                        course categories operations
                =================================================
                */

                Route::get('/Categories/{CID}/Articles', 'SupervisorController@getCategoryArticles');
                Route::get('/Categories/{CID}/Articles/CreateArticle', 'SupervisorController@getCreateCategoryArticle');
                Route::get('/Categories/{CID}/Articles/{AID}/Edit', 'SupervisorController@getUpdateCategoryArticle');

            });

        });


    });
});