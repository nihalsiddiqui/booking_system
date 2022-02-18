<?php
    Route::group(['prefix'=>'airline'],function (){
        Route::get('/getForSelect2','CompanyController@getForSelect2')->name('train.admin.airline.getForSelect2');
    });
    Route::group(['prefix'=>'airport'],function (){
        Route::get('/getForSelect2','StationController@getForSelect2')->name('train.admin.airport.getForSelect2');
    });
    Route::group(['prefix'=>'seat-type'],function (){
        Route::get('getForSelect2','SeatTypeController@getForSelect2')->name('train.admin.seat_type.getForSelect2');
    });
    Route::group(['prefix'=>'attribute'],function (){
        Route::get('getForSelect2','AttributeController@getForSelect2')->name('train.admin.attribute.term.getForSelect2');
    });
    ;?>
