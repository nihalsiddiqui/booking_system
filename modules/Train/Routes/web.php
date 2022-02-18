<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>config('flight.flight_route_prefix')],function(){
    Route::get('/','TrainController@index')->name('flight.search'); // Search
    Route::post('getData/{id}',"TrainController@getData")->name('flight.getData');
});


Route::group(['prefix'=>'user/'.config('flight.flight_route_prefix'),'middleware' => ['auth','verified']],function(){
    Route::get('/','ManageTrainController@manageFlight')->name('flight.vendor.index');
    Route::get('/create','ManageTrainController@createFlight')->name('flight.vendor.create');
    Route::get('/edit/{id}','ManageTrainController@editFlight')->name('flight.vendor.edit');
    Route::get('/del/{id}','ManageTrainController@deleteFlight')->name('flight.vendor.delete');
    Route::post('/store/{id}','ManageTrainController@store')->name('flight.vendor.store');
    Route::get('bulkEdit/{id}','ManageTrainController@bulkEditFlight')->name("flight.vendor.bulk_edit");
    Route::get('/booking-report/bulkEdit/{id}','ManageTrainController@bookingReportBulkEdit')->name("flight.vendor.booking_report.bulk_edit");
	Route::get('clone/{id}','ManageTrainController@cloneFlight')->name("flight.vendor.clone");
    Route::get('/recovery','ManageTrainController@recovery')->name('flight.vendor.recovery');
    Route::get('/restore/{id}','ManageTrainController@restore')->name('flight.vendor.restore');

    Route::group(['prefix'=>'{flight_id}/flight-seat'],function (){
        Route::get('/','ManageTrainSeatController@index')->name('flight.vendor.seat.index');
        Route::get('create','ManageTrainSeatController@create')->name('flight.vendor.seat.create');
        Route::get('edit/{id}','ManageTrainSeatController@edit')->name('flight.vendor.seat.edit');
        Route::post('store/{id}','ManageTrainSeatController@store')->name('flight.vendor.seat.store');
        Route::post('delete/{id}','ManageTrainSeatController@delete')->name('flight.vendor.seat.delete');
        Route::post('/bulkEdit','ManageTrainSeatController@bulkEdit')->name('flight.vendor.seat.bulkEdit');
    });
});

