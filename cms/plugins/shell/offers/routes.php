<?php

Route::get('/api-v2', 'Shell\Offers\Classes\ApiDiscoveryController@index');

Route::get('/api-v2/offers', 'Shell\Offers\Classes\OffersController@index');
Route::get('/api-v2/job-titles', 'Shell\Offers\Classes\JobTitlesController@index');
Route::get('/api-v2/provinces', 'Shell\Offers\Classes\ProvincesController@index');
Route::get('/api-v2/cities', 'Shell\Offers\Classes\CitiesController@index');
Route::post('/api-v2/applications', 'Shell\Offers\Classes\ApplicationsController@save');
