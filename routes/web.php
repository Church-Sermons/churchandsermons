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
// Bind Routes

use App\User;

// Home Routes
Route::get('/', 'HomeController@index')->name('home');

// User Routes
Route::prefix('user')->group(function () {
    // Profile Details
    Route::get('/profile', 'User\UserProfileController@index', [
        'as' => 'user'
    ])->name('user.profile.index');
    Route::put('/profile', 'User\UserProfileController@updateUserProfile', [
        'as' => 'user'
    ])->name('user.profile.update');

    // Password
    Route::get(
        '/profile/security',
        'User\UserProfileController@securityIndex',
        [
            'as' => 'user'
        ]
    )->name('user.profile.security.index');
    Route::put(
        '/profile/security',
        'User\UserProfileController@securityUpdate',
        [
            'as' => 'user'
        ]
    )->name('user.profile.security.update');
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
    Route::resource('/events', 'Organisation\OrganisationEventController', [
        'as' => 'organisations'
    ]);

    // organisation team
    Route::resource('/team', 'TeamController', ['as' => 'organisations']);

    // organisation contact
    Route::resource('/contacts', 'Organisation\OrganisationContactController', [
        'as' => 'organisations',
        'except' => ['update', 'edit']
    ]);

    // organisation claims
    Route::resource('/claims', 'Organisation\OrganisationClaimController', [
        'as' => 'organisations',
        'except' => ['update', 'edit']
    ]);

    // organisation resource
    Route::resource(
        '/resources',
        'Organisation\OrganisationResourceController',
        [
            'as' => 'organisations'
        ]
    );

    // organisation reviews
    Route::resource('/reviews', 'Organisation\OrganisationReviewController', [
        'as' => 'organisations',
        'except' => ['edit', 'update']
    ]);
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
    Route::resource('/events', 'Profile\ProfileEventController', [
        'as' => 'profiles'
    ]);

    // profile contact
    Route::resource('/contacts', 'Profile\ProfileContactController', [
        'as' => 'profiles',
        'except' => ['update', 'edit']
    ]);

    // profile claims
    Route::resource('/claims', 'Profile\ProfileClaimController', [
        'as' => 'profiles',
        'except' => ['update', 'edit']
    ]);

    // profile resource
    Route::resource('/resources', 'Profile\ProfileResourceController', [
        'as' => 'profiles'
    ]);

    // profile reviews
    Route::resource('/reviews', 'Profile\ProfileReviewController', [
        'as' => 'profiles',
        'except' => ['update', 'edit']
    ]);
});

/**
 *
 * Sermon Routes
 *
 *
 */
Route::resource('/sermons', 'Sermon\SermonController');
Route::prefix('/sermons/{sermon_id}')->group(function () {
    // sermon claims
    Route::resource('/claims', 'Sermon\SermonClaimController', [
        'as' => 'sermons',
        'except' => ['update', 'edit']
    ]);

    // sermon resource
    Route::resource('/resources', 'Sermon\SermonResourceController', [
        'as' => 'sermons'
    ]);

    // sermon reviews
    Route::resource('/reviews', 'Sermon\SermonReviewController', [
        'as' => 'sermons',
        'except' => ['update', 'edit']
    ]);

    // speaker
    // Route::resource('/speakers', 'Sermon\SermonSpeakerController', [
    //     'as' => 'sermons',
    //     'except' => ['update', 'edit']
    // ]);
});

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
            'skill' => $faker->jobTitle,
            'coordinates' => array(
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude
            ),
            'description' => $faker->paragraph()
        );
    }

    return json_encode($data);
});
