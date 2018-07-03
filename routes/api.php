<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group(['prefix' => 'v1'],
    function () {
    Route::post('authenticate', 'Auth\AuthenticateController@authenticate');
    Route::get('authenticate/user', 'Auth\AuthenticateController@getAuthenticatedUser');
    Route::post('authenticate/invalidate', 'Auth\AuthenticateController@invalidate');
    Route::post('authenticate/register', 'Auth\AuthenticateController@register');
    Route::post('upload', 'UploadController@uploadImage');
});
Route::group(['prefix' => 'v1', 'middleware' => 'jwt.customAuth', 'jwt.refresh'],
    function () {

        
        Route::resource('section', 'SectionController');
        Route::resource('subject', 'SubjectController');

        Route::post('sections', 'SectionController@getPagedList');
        Route::post('sections/filterByCode', 'SectionController@filterByCode');

});

