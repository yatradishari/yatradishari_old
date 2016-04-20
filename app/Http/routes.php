<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['namespace'=> 'Partner' , 'middleware' => 'auth'] , function(){
	
		//Route::get('/admin/project/{filterBy}',  ['uses' =>'ProjectController@getIndex', 'as'=>'project.index'] );		

		Route::controller('/partner/dashboard'	, 'DashboardController' 	); 	
		/*Route::controller('/admin/user'			, 'UserController' 			);
		Route::controller('/admin/activity'		, 'ActivityController' 		);
		Route::controller('/admin/payments'		, 'PaymentsController' 		);
		Route::controller('/admin/project'		, 'ProjectController'		);
		Route::controller('/admin/category'		, 'CategoryController'		);
		Route::controller('/admin/genre'		, 'GenreController'			);	
		Route::controller('/admin/menu'			, 'MenuController'			);
		Route::controller('/admin/banner'		, 'BannerController'		);
		Route::controller('/admin/pages'		, 'PageController'			);
		
		Route::get('/admin/settings/{formkey}',  ['uses' =>'SettingsController@show', 'as'=>'settingsConfig'] );
		Route::post('/admin/settings/{formkey}',  ['uses' =>'SettingsController@postshow', 'as'=>'postsettingsConfig'] );*/

});
