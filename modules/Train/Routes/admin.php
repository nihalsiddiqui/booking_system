<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','TrainController@index')->name('train.admin.index');
Route::get('/create','TrainController@create')->name('train.admin.create');
Route::get('/edit/{id}','TrainController@edit')->name('train.admin.edit');
Route::post('/store/{id}','TrainController@store')->name('train.admin.store');
Route::post('/bulkEdit','TrainController@bulkEdit')->name('train.admin.bulkEdit');
Route::get('/recovery','TrainController@recovery')->name('train.admin.recovery');

Route::group(['prefix'=>'{flight_id}/flight-seat'],function (){
    Route::get('/','TrainSeatController@index')->name('train.admin.flight.seat.index');
    Route::get('edit/{id}','TrainSeatController@edit')->name('train.admin.flight.seat.edit');
    Route::post('store/{id}','TrainSeatController@store')->name('train.admin.flight.seat.store');
    Route::post('/bulkEdit','TrainSeatController@bulkEdit')->name('train.admin.flight.seat.bulkEdit');
});
Route::group(['prefix'=>'airline'],function (){
    Route::get('/','CompanyController@index')->name('train.admin.airline.index');
    Route::get('edit/{id}','CompanyController@edit')->name('train.admin.airline.edit');
    Route::post('store/{id}','CompanyController@store')->name('train.admin.airline.store');
    Route::post('/bulkEdit','CompanyController@bulkEdit')->name('train.admin.airline.bulkEdit');
});
Route::group(['prefix'=>'airport'],function (){
    Route::get('/','StationController@index')->name('train.admin.airport.index');
    Route::get('edit/{id}','StationController@edit')->name('train.admin.airport.edit');
    Route::post('store/{id}','StationController@store')->name('train.admin.airport.store');
    Route::post('/bulkEdit','StationController@bulkEdit')->name('train.admin.airport.bulkEdit');

});
Route::group(['prefix'=>'seat-type'],function (){
    Route::get('/','SeatTypeController@index')->name('train.admin.seat_type.index');
    Route::get('edit/{id}','SeatTypeController@edit')->name('train.admin.seat_type.edit');
    Route::post('store/{id}','SeatTypeController@store')->name('train.admin.seat_type.store');
    Route::post('/bulkEdit','SeatTypeController@bulkEdit')->name('train.admin.seat_type.bulkEdit');

});
Route::group(['prefix'=>'attribute'],function (){
    Route::get('/','AttributeController@index')->name('train.admin.attribute.index');
    Route::get('edit/{id}','AttributeController@edit')->name('train.admin.attribute.edit');
    Route::post('store/{id}','AttributeController@store')->name('train.admin.attribute.store');
    Route::post('/editAttrBulk','AttributeController@editAttrBulk')->name('train.admin.attribute.bulkEdit');

    Route::get('terms/{id}','AttributeController@terms')->name('train.admin.attribute.term.index');
    Route::get('term_edit/{id}','AttributeController@term_edit')->name('train.admin.attribute.term.edit');
    Route::match(['get','post'],'term_store','AttributeController@term_store')->name('train.admin.attribute.term.store');
    Route::post('/editTermBulk','AttributeController@editTermBulk')->name('train.admin.attribute.editTermBulk');
});
