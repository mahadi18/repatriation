<?php

use Illuminate\Http\Request;

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('unauthorized', 'HomeController@unauthorized');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::resource("activities", "ActivityController");
Route::resource("tasks", "TaskController");
Route::resource("users", "UserController");

Route::get('organization/{id}/users', ['as' => 'organization.users', 'uses' => 'UserController@index']);


Route::resource("cases", "LitigationController");
Route::get('cases/{id}/move-to-shelter-home', ['as' => 'move.to.shelter', 'uses' => 'LitigationController@moveToShelterHome']);
Route::post('cases/{id}/store_in_shelter', ['as' => 'store.in.shelter', 'uses' => 'LitigationController@storeToShelterHome']);
Route::get('cases/print/ngo-hir/{id}', ['as' => 'print.hir', 'uses' => 'PrintController@ngoHir']);
Route::get('cases/print/fullprofile/{id}', ['as' => 'print.hir', 'uses' => 'PrintController@fullProfile']);

Route::get('cases/{id}/care-plans', ['as' => 'get.care.plans', 'uses' => 'LitigationController@carePlanProgress']);
Route::post('cases/{id}/attach-care-plan', ['as' => 'attach.care.plans', 'uses' => 'LitigationController@attachCarePlan']);
Route::post('cases/{id}/care-plans', ['as' => 'post.care.plans', 'uses' => 'LitigationController@updateCarePlans']);
Route::get('cases/{id}/case-profile', ['as' => 'case.profile', 'uses' => 'LitigationController@showCaseProfile']);
Route::get('cases/{id}/full-profile', ['as' => 'full.profile', 'uses' => 'LitigationController@fullProfile']);
Route::get('cases/{id}/take-over', ['as' => 'take.over', 'uses' => 'LitigationController@takeOver']);
Route::post('cases/{id}/save-take-over', ['as' => 'save.take.over', 'uses' => 'LitigationController@saveTakeOver']);
Route::post('cases/{id}/save-repatriation', ['as' => 'save.repatriation', 'uses' => 'LitigationController@saveRepatriation']);
Route::get('cases/{id}/document-archive', ['as' => 'case.profile', 'uses' => 'LitigationController@documentArchive']);
Route::get('cases/{id}/change-log', ['as' => 'change.log', 'uses' => 'LitigationController@showChangeLog']);
Route::get('cases/{id}/dashboard', ['as' => 'case.dashboard', 'uses' => 'LitigationController@dashboard']);
Route::post('cases/{id}/task/{tid}', ['as' => 'save.case.task', 'uses' => 'LitigationController@saveCaseTaskStatus']);
Route::get('cases/{id}/assign', ['as' => 'get.assign', 'uses' => 'LitigationController@assign']);
Route::post('cases/{id}/assign', ['as' => 'post.assign', 'uses' => 'LitigationController@saveAssignment']);
Route::get('cases/{id}/accessibility', ['as' => 'get.accessibility', 'uses' => 'LitigationController@accessibility']);
Route::get('cases/{id}/tid={tid}&sub_task={{stid}}', ['as' => 'case.show', 'uses' => 'LitigationController@show']);
Route::post('cases/{id}/accessibility', ['as' => 'post.accessibility', 'uses' => 'LitigationController@saveAccessibility']);
Route::post('cases/{id}/change_status', ['as' => 'post.change.status', 'uses' => 'LitigationController@changeStatus']);

Route::resource("organizations", "OrganizationController");

Route::get('organization/dashboard/{organization_id?}', ['as' => 'organization.dashboard', 'uses' => 'OrganizationController@dashboard']);
Route::get('shelterhomes/{id}/careplans', ['as' => 'post.accessibility', 'uses' => 'ShelterHomeController@carePlansWithCases']);
Route::resource("shelterhomes", "ShelterHomeController");
Route::get('shelterhomes/intake/{shelterhomes}', ['as' => 'post.accessibility', 'uses' => 'ShelterHomeController@intake']);


Route::resource("careplans", "CarePlanController");
Route::resource("servicemanagements", "ServiceManagementController");
Route::resource("taskstatuses", "TaskStatusController");

Route::resource("doctypes", "DocTypeController");
Route::resource("movements", "MovementController");
Route::resource("ngohirfiles", "NgohirfilesController");
Route::resource("proceedings", "ProceedingController");
Route::resource("casestudies", "CaseStudyController");
Route::resource("services", "ServiceController");
Route::resource("cares", "CareController");
Route::resource("attachments", "AttachmentController");
Route::resource("countries", "CountryController");
Route::resource("actpoints", "ActpointController");
Route::resource("form_fields", "FormFieldController");
Route::group(['prefix' => 'cases/{id}'], function () {
//    Route::resource("personal-info","PersonalInformationController");
    Route::get('personal-info/edit', ['as' => 'personal.information.edit', 'uses' => 'LitigationController@editPersonalInformation']);
//    Route::get('personal-info/edit',['as' => 'personal.information.edit', 'uses' => 'PersonalInformationController@edit']);
    Route::put('personal-info', ['as' => 'personal.information.update', 'uses' => 'LitigationController@updatePersonalInformation']);
    Route::post('personal-info/address/store', ['as' => 'personal.information.address.store', 'uses' => 'LitigationController@storePersonalInformationAddress']);
    Route::post('personal-info/child/store', ['as' => 'personal.information.child.store', 'uses' => 'LitigationController@storePersonalInformationChildInfo']);
    Route::post('personal-info/family/store', ['as' => 'personal.information.family.member.store', 'uses' => 'LitigationController@storePersonalInformationFamilyMemberInfo']);
    Route::post('personal-info/family/update', ['as' => 'personal.information.family.member.update', 'uses' => 'LitigationController@updatePersonalInformationFamilyMemberInfo']);
    Route::delete('personal-info/family/delete', ['as' => 'personal.information.family.member.delete', 'uses' => 'LitigationController@deletePersonalInformationFamilyMemberInfo']);

    Route::get('ngohirs', ['as' => 'ngohirs.index', 'uses' => 'NgohirController@index']);
    Route::get('ngohirs/show', ['as' => 'ngohirs.show', 'uses' => 'NgohirController@show']);
    Route::get('ngohirs/edit', ['as' => 'ngohirs.edit', 'uses' => 'NgohirController@edit']);
    Route::get('ngohirs/create', ['as' => 'ngohirs.create', 'uses' => 'NgohirController@create']);
    Route::post('ngohirs', ['as' => 'ngohirs.store', 'uses' => 'NgohirController@store']);
    Route::put('ngohirs', ['as' => 'ngohirs.update', 'uses' => 'NgohirController@update']);
    Route::delete('ngohirs', ['as' => 'ngohirs.destroy', 'uses' => 'NgohirController@destroy']);
//    Route::resource("ngohirs","NgohirController");
});
Route::post('save-form/{id}', ['as' => 'case.form.update', 'uses' => 'FormController@saveCaseForm']);
Route::post('save-form-order/{id}', ['as' => 'save.field.order', 'uses' => 'FormFieldController@saveOrder']);

// This is for test purposes

Route::resource("tweets","TweetController");


Route::get('search/case',['as' => 'search.case', 'uses' => 'SearchController@litigation']);
Route::get('search/all',['as' => 'search.all', 'uses' => 'SearchController@all']);
Route::get("messages/sent",['as' => 'message.sent', 'uses' => "MessageController@sent"]);
Route::get("notifications/all",['as' => 'ngo.notifications.all', 'uses' => "MessageController@allNotifications"]);
Route::get("notifications",['as' => 'ngo.notifications', 'uses' => "MessageController@notifications"]);
Route::get("notifications/{id}",['as' => 'ngo.notification.show', 'uses' => "MessageController@showNotification"]);
Route::get("notification/{id}",['as' => 'notification.show', 'uses' => "MessageController@show"]);
Route::resource("messages","MessageController");
Route::get('country/list',['as' => 'country.list', 'uses' => 'GeoController@countries']);
Route::get('state/list/{cid?}',['as' => 'state.list', 'uses' => 'GeoController@states']);
Route::get('services/list/{care_plan?}',['as' => 'service.list', 'uses' => 'ServiceController@services']);
Route::get('organizations/type/{type_id}',['as' => 'organizations.of.type', 'uses' => 'OrganizationController@getOrgsOfType']);
Route::get('organizations/info/{id}',['as' => 'organizations.of.type', 'uses' => 'OrganizationController@getOrgsInfo']);
Route::get('district/list/{sid?}',['as' => 'disctrict.list', 'uses' => 'GeoController@districts']);

Route::resource("forms","FormController");
Route::get("notifications",['as' => 'ngo.notifications', 'uses' => "MessageController@notifications"]);


Entrust::routeNeedsRole('tasks*','owner',Redirect::to('/unauthorized'));
Entrust::routeNeedsRole('activities*','owner',Redirect::to('/unauthorized'));
Entrust::routeNeedsRole('organizations/create', array('owner','admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('organizations/store', array('owner','admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('organizations/edit', array('owner','admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('organizations/update', array('owner','admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('organizations/type={type_id}', array('owner','admin','contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('users*', array('owner','admin','contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('actpoints*', array('owner','admin','contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('cases*', array('owner','contributor','admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('careplans*', array('owner','admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('servicemanagements*', array('owner','admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('taskstatuses*', array('owner','admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('attachments*', array('owner','admin', 'contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('doctypes*', array('owner','admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('search*', array('owner','admin','contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('messages*', array('owner','contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('countries*', array('owner','admin','contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('ngohirs*', array('owner','contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('forms*', array('owner'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('form_fields*', array('owner'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('cases/{id}/ngohirs', array('owner','contributor'), Redirect::to('/unauthorized'), false);

Route::resource("tweets", "TweetController");


Route::get('search/case', ['as' => 'search.case', 'uses' => 'SearchController@litigation']);
Route::get('search/all', ['as' => 'search.all', 'uses' => 'SearchController@all']);
Route::get("notifications/all", ['as' => 'ngo.notifications.all', 'uses' => "MessageController@allNotifications"]);
Route::get("notifications", ['as' => 'ngo.notifications', 'uses' => "MessageController@notifications"]);
Route::get("notifications/{id}", ['as' => 'ngo.notification.show', 'uses' => "MessageController@showNotification"]);
Route::get("notification/{id}", ['as' => 'notification.show', 'uses' => "MessageController@show"]);
Route::get("messages/sent", ['as'=>'messages.sent','uses' => "MessageController@sent"]);
Route::get("messages/showMessage/{id}", ['as'=>'messages.showMessage','uses' => "MessageController@showMessage"]);
Route::resource("messages", "MessageController");
Route::get('country/list', ['as' => 'country.list', 'uses' => 'GeoController@countries']);
Route::get('state/list/{cid?}', ['as' => 'state.list', 'uses' => 'GeoController@states']);
Route::get('services/list/{care_plan?}', ['as' => 'service.list', 'uses' => 'ServiceController@services']);
Route::get('organizations/type/{type_id}', ['as' => 'organizations.of.type', 'uses' => 'OrganizationController@getOrgsOfType']);
Route::get('organizations/info/{id}', ['as' => 'organizations.of.type', 'uses' => 'OrganizationController@getOrgsInfo']);
Route::get('district/list/{sid?}', ['as' => 'disctrict.list', 'uses' => 'GeoController@districts']);

Route::resource("forms", "FormController");
Route::get("notifications", ['as' => 'ngo.notifications', 'uses' => "MessageController@notifications"]);


Entrust::routeNeedsRole('tasks*', 'owner', Redirect::to('/unauthorized'));
Entrust::routeNeedsRole('activities*', 'owner', Redirect::to('/unauthorized'));
Entrust::routeNeedsRole('organizations/create', array('owner', 'admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('organizations/store', array('owner', 'admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('organizations/edit', array('owner', 'admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('organizations/update', array('owner', 'admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('organizations/type={type_id}', array('owner', 'admin', 'contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('users*', array('owner', 'admin', 'contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('actpoints*', array('owner', 'admin', 'contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('cases*', array('owner', 'contributor', 'admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('careplans*', array('owner', 'admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('servicemanagements*', array('owner', 'admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('taskstatuses*', array('owner', 'admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('attachments*', array('owner', 'admin', 'contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('doctypes*', array('owner', 'admin'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('search*', array('owner', 'admin', 'contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('messages*', array('owner', 'admin', 'contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('countries*', array('owner', 'admin', 'contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('ngohirs*', array('owner', 'admin', 'contributor'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('forms*', array('owner'), Redirect::to('/unauthorized'), false);
Entrust::routeNeedsRole('form_fields*', array('owner'), Redirect::to('/unauthorized'), false);

Route::group(['prefix'=> 'dashboard'], function () {
    Route::get('/', "DashboardController@index");
    Route::get('initiated-cases', ['uses' =>'DashboardController@showInitiatedCases']);
//    Route::get('initiated-cases', ['uses' =>'DashboardController@showInitiatedCases']);
    Route::get('totalOrganizations', ['uses' =>'DashboardController@showTotalOrganizationsByCountry']);
    Route::get('rescues-by-state', ['uses' =>'DashboardController@showNumberOfRescuesByState']);
    Route::get('rescues-by-age', ['uses' =>'DashboardController@showNumberOfRescuesByAge']);
    Route::get('repatriation-by-age', ['uses' =>'DashboardController@showNumberOfRepatriationByAge']);
    Route::get('rescues-by-gender', ['uses' =>'DashboardController@showNumberOfRescuesByGender']);
    Route::get('repatriation-by-gender', ['uses' =>'DashboardController@showNumberOfRepatriationByGender']);
    Route::get('cases-by-ngo', ['uses' =>'DashboardController@showInitiatedCasesByOrganization']);
    Route::get('initiation-by-org', ['uses' =>'DashboardController@showTotalInitiationByOrganization']);
    Route::get('organization-with-ngohr', ['uses' =>'DashboardController@showNgoHrCompletedOrganizationByCountry']);
    Route::get('litigations-with-incomplete-statehir', ['uses' =>'DashboardController@showLitigationsWithIncompleteStateHir']);
    Route::get('year-wise-rescues', ['uses' =>'DashboardController@showYearWiseRescues']);
    Route::get('year-wise-repatriation', ['uses' =>'DashboardController@showYearWiseRepatriation']);
    Route::get('state-wise-rescues', ['uses' =>'DashboardController@showStateWiseRescues']);
    Route::get('state-wise-repatriate', ['uses' =>'DashboardController@showStateWiseRepatriation']);
});


//Route::get('dashboard/test2', "DashboardController@showInitiatedCasesByOrganization");

Route::get('dashboard/test2', "DashboardController@demo");

Route::get('dashboard/demo', "DashboardController@demo");



