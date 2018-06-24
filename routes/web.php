<?php

Route::get('', 'SiteController@index')->name('home');

Route::get('contact', 'ContactController@index')->name('contact.show');
Route::post('contact', 'ContactController@store')->name('contact.store');