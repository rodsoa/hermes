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

Auth::routes();

Route::get('/', function() {
    return redirect()->route('home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    /**
    * Users Routes
    */
    Route::namespace('Admin')->group( function (){
        Route::prefix('blacklist')->group(function () {
            Route::get('/', 'BlacklistController@index')->name('blacklist.index');
            Route::post('/', 'BlacklistController@store')->name('blacklist.store');
            Route::delete('/remove-all-dates', 'BlacklistController@destroyAllDates')->name('blacklist.destroyAllDates');
            Route::delete('/{id}', 'BlacklistController@destroy')->name('blacklist.destroy');
        });

        Route::resource('users', 'UsersController')->only(['index', 'update', 'destroy', 'store']);
        Route::resource('reports', 'ReportsController')->only(['index', 'store', 'destroy']);
        Route::get('/profile', 'UsersController@profile')->name('user.profile');
        Route::get('/reports/{id}/download', 'ReportsController@download')->name('report.download');
    });

    /**
    * Campaigns Routes
    */
    Route::namespace('Campaign')->prefix('campaigns')->group( function () {

        /**
        * Number Lists Routes
        */
        Route::prefix('number-lists')->group(function () {
            Route::get('/', 'CampaignNumberListsController@index')->name('campaigns.number-lists.index');
            Route::post('/', 'CampaignNumberListsController@store')->name('campaigns.number-lists.store');
            Route::delete('/{number_list}', 'CampaignNumberListsController@destroy')->name('campaigns.number-lists.destroy');
            Route::get('/{number_list}/download', 'CampaignNumberListsController@download')->name('campaigns.number-lists.download');
        });

        Route::get('/list', 'CampaignsController@index')->name('campaigns.list');
        Route::post('/', 'CampaignsController@store')->name('campaigns.store');
        Route::delete('/{campaign}', 'CampaignsController@destroy')->name('campaigns.destroy');
        Route::get('/{campaign}/download', 'CampaignsController@download')->name('campaigns.download');
    });


    // APIS
    Route::namespace('Rest')->prefix('api')->group(function () {  
        Route::prefix('users')->group(function () {
            Route::prefix('credits')->group(function () {
                Route::post('/', 'RestCreditsController@store');
                Route::post('/{id}', 'RestCreditsController@update');
            });

            Route::get('/{id}', 'RestUsersController@show');
            Route::get('/{id}/campaigns', 'RestUsersController@campaigns');
        });

        Route::prefix('campaigns')->group(function () {
            Route::prefix('number-lists')->group(function () {
                Route::get('/{id}', 'RestCampaignsNumberLists@show');
            });
            Route::post('/{id}/approve', 'RestCampaignsController@approveCampaign');
            Route::post('/{id}/denie', 'RestCampaignsController@denieCampaign');
            Route::post('/{id}/complete', 'RestCampaignsController@completeCampaign');
        });

        Route::get('blacklist', 'RestBlacklistController@index');
    });
});
