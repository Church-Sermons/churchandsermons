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

// Home Routes
Route::get('/', 'HomeController@index')->name('home');

// About Route
Route::get('/about', 'HomeController@about')->name('about');

// Contact route
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@storeContactMessages')->name(
    'contact.messages.store'
);

// User Routes
Route::prefix('user')->group(function () {
    // Profile Details
    Route::get('/profile', 'User\UserProfileController@index')->name(
        'user.profile.index'
    );
    Route::put(
        '/profile',
        'User\UserProfileController@updateUserProfile'
    )->name('user.profile.update');

    // Password
    Route::get(
        '/profile/security',
        'User\UserProfileController@securityIndex'
    )->name('user.profile.security.index');
    Route::put(
        '/profile/security',
        'User\UserProfileController@securityUpdate'
    )->name('user.profile.security.update');

    // site details
    Route::get('/site/about', 'User\UserSiteController@siteAboutEdit')->name(
        'user.site.about.edit'
    );
    Route::put('/site/about', 'User\UserSiteController@siteAboutUpdate')->name(
        'user.site.about.update'
    );

    // resources
    Route::get('/resources', 'User\UserResourceController@index')->name(
        'resources.index'
    );
    Route::get('/resources/{id}', 'User\UserResourceController@show')->name(
        'resources.show'
    );
    Route::get('/resources/create', 'User\UserResourceController@create')->name(
        'resources.create'
    );
    Route::post('/resources/create', 'User\UserResourceController@store')->name(
        'resources.store'
    );
    Route::get(
        '/resources/{id}/edit',
        'User\UserResourceController@edit'
    )->name('resources.edit');
    Route::put('/resources/{id}', 'User\UserResourceController@update')->name(
        'resources.update'
    );
    Route::delete(
        '/resources/{id}',
        'User\UserResourceController@destroy'
    )->name('resources.destroy');
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
    // slides
    Route::put('/slides', 'OrganisationController@uploadSlides')->name(
        'organisations.slides.update'
    );

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
            'description' => $faker->paragraph(5)
        );
    }

    return json_encode($data);
});
