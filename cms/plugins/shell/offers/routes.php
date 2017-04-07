<?php

Route::get('/api', 'Shell\Offers\Classes\ApiDiscoveryController@index');

Route::get('/api/offers', 'Shell\Offers\Classes\OffersController@index');
Route::get('/api/offers/{id}', 'Shell\Offers\Classes\OffersController@get');
Route::get('/api/job-titles', 'Shell\Offers\Classes\JobTitlesController@index');
Route::get('/api/provinces', 'Shell\Offers\Classes\ProvincesController@index');
Route::get('/api/cities', 'Shell\Offers\Classes\CitiesController@index');
Route::post('/api/applications', 'Shell\Offers\Classes\ApplicationsController@save');
