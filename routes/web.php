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
// Home Routes
Route::get('/', 'HomeController@index')->name('home');

// samples
Route::get('/sample', function () {
    return view('sample');
});

// Manage - Content Providers
Route::prefix('manage')
    ->middleware('role:superadministrator|administrator')
    ->group(function () {
        Route::get('/', 'ManageController@index')->name('manage.index');
        Route::get('/dashboard', 'ManageController@dashboard')->name(
            'manage.dashboard'
        );
        Route::resource('/users', 'UserController');
        Route::resource('/permissions', 'PermissionController', [
            'except' => 'destroy'
        ]);
        Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
        Route::resource('/posts', 'PostController');
    });

/**
 *
 * Category Routes
 *
 */
Route::resource('/categories', 'OrganisationCategoryController');
Route::post(
    '/categories/store-json',
    'OrganisationCategoryController@storeCategoryJSON'
)->name('categories.storejson');

/**
 *
 * Organisations Routes
 * Organisations, Categories, Organisation&Events, Organisation&Reviews
 *
 */
Route::resource('/organisations', 'OrganisationController');
// Organisation&Events
Route::prefix('/organisations/{organisation_id}')->group(function () {
    // organisation events
    Route::resource('/events', 'EventController', ['as' => 'organisations']);

    // organisation team
    Route::resource('/team', 'TeamController', ['as' => 'organisations']);

    // organisation contact
    Route::resource('/contacts', 'ContactController', [
        'as' => 'organisations'
    ]);

    // organisation claims
    Route::resource('/claims', 'ClaimController', ['as' => 'organisations']);

    // organisation resource
    Route::resource('/resources', 'OrganisationResourceController', [
        'as' => 'organisations'
    ]);

    // organisation reviews
    Route::resource('/reviews', 'ReviewController', ['as' => 'organisations']);
});

/**
 *
 * Profiles Routes
 *
 *
 */
Route::resource('/profiles', 'ProfileController');
Route::prefix('/profiles/{profile_id}')->group(function () {
    // profile events
    Route::resource('/events', 'EventController', ['as' => 'profiles']);

    // profile contact
    Route::resource('/contacts', 'ContactController', ['as' => 'profiles']);

    // profile claims
    Route::resource('/claims', 'ClaimController', ['as' => 'profiles']);

    // profile resource
    Route::resource('/resources', 'ProfileResourceController', [
        'as' => 'profiles'
    ]);

    // profile reviews
    Route::resource('/reviews', 'ReviewController', ['as' => 'profiles']);
});

/**
 *
 * Resources Routes
 *
 *
 */
Route::resource('/resources', 'ResourceController');

// Auth Routes
Auth::routes(['verify' => true]);

Route::get('/fake', function () {
    $faker = Faker\Factory::create();
    $data = array();

    for ($i = 0; $i < 10; $i++) {
        $data[] = array(
            'name' => $faker->name(),
            'company_name' => $faker->company,
            'email' => $faker->companyEmail,
            'phone' => $faker->e164PhoneNumber,
            'website' => 'https://' . $faker->domainName,
            'address' => $faker->address,
            'coordinates' => array(
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude
            ),
            'description' => $faker->paragraph()
        );
    }

    return json_encode($data);
});
