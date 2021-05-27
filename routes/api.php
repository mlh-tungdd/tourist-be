<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Api'], function () {
    Route::post('/auth/register', 'AuthController@register');
    Route::post('/auth/login', 'AuthController@login');
    Route::post('/auth/logout', 'AuthController@logout');

    // setting
    Route::get('/settings', 'SettingController@show');
    Route::post('/settings', 'SettingController@update');

    // booking
    Route::get('/bookings', 'BookingController@index');
    Route::get('/bookings/all_booking', 'BookingController@all');
    Route::post('/bookings', 'BookingController@store');
    Route::get('/bookings/delete/{id}', 'BookingController@destroy');
    Route::get('/bookings/{id}', 'BookingController@show');
    Route::patch('/bookings/{id}', 'BookingController@update');

    // bank
    Route::get('/banks', 'BankController@index');
    Route::get('/banks/all_bank', 'BankController@all');
    Route::post('/banks', 'BankController@store');
    Route::get('/banks/delete/{id}', 'BankController@destroy');
    Route::get('/banks/{id}', 'BankController@show');
    Route::patch('/banks/{id}', 'BankController@update');

    // rate
    Route::get('/tour_rates/{id}', 'RateController@index');
    Route::get('/rates/all_rate', 'RateController@all');
    Route::post('/rates', 'RateController@store');
    Route::get('/rates/delete/{id}', 'RateController@destroy');
    Route::get('/rates/{id}', 'RateController@show');

    // discount
    Route::get('/discounts', 'DiscountController@index');
    Route::get('/discounts/all_discount', 'DiscountController@all');
    Route::post('/discounts', 'DiscountController@store');
    Route::get('/discounts/delete/{id}', 'DiscountController@destroy');
    Route::get('/discounts/{id}', 'DiscountController@show');
    Route::patch('/discounts/{id}', 'DiscountController@update');

    // room
    Route::get('/rooms/all_room/{id}', 'RoomController@all');
    Route::get('/rooms/by_hotel_id/{id}', 'RoomController@getAllRoomByHotelId');
    Route::post('/rooms', 'RoomController@store');
    Route::get('/rooms/delete/{id}', 'RoomController@destroy');
    Route::get('/rooms/{id}', 'RoomController@show');
    Route::post('/rooms/{id}', 'RoomController@update');

    // hotel
    Route::get('/hotels', 'HotelController@index');
    Route::get('/hotels/all_hotel', 'HotelController@all');
    Route::post('/hotels', 'HotelController@store');
    Route::get('/hotels/delete/{id}', 'HotelController@destroy');
    Route::get('/hotels/{id}', 'HotelController@show');
    Route::post('/hotels/{id}', 'HotelController@update');
    Route::patch('/hotels/{id}', 'HotelController@updateStatus');

    // order
    Route::get('/orders', 'OrderController@index');
    Route::get('/orders/all_order', 'OrderController@all');
    Route::post('/orders', 'OrderController@store');
    Route::get('/orders/delete/{id}', 'OrderController@destroy');
    Route::get('/orders/{id}', 'OrderController@show');
    Route::patch('/orders/{id}', 'OrderController@update');

    Route::get('/tours', 'TourController@index');
    Route::get('/tours/search', 'TourController@filterTour');
    Route::get('/tours/all_tour', 'TourController@all');
    Route::get('/tours/get_by_location_id/{id}', 'TourController@getListTourByLocationId');
    Route::get('/tours/{id}', 'TourController@show');
    Route::patch('/tours_update_view/{id}', 'TourController@updateViews');

    Route::get('/locations/get_filters', 'LocationController@getFilterClient');
    Route::get('/locations/get_navigations', 'LocationController@getListNavigationClient');
    Route::get('/locations/all_location', 'LocationController@all');
    Route::get('/locations/{id}', 'LocationController@show');

    Route::get('/banners', 'BannerController@index');
    Route::get('/banners/all_banner', 'BannerController@all');

    Route::get('/partners', 'PartnerController@index');
    Route::get('/partners/all_partner', 'PartnerController@all');

    Route::group(['middleware' => 'jwt.auth',], function () {
        // user
        Route::get('/user/list', 'UserController@getList');
        Route::get('/user/delete/{id}', 'UserController@delete');
        Route::get('/user/info', 'UserController@showProfile');

        // time
        Route::get('/times', 'TimeController@index');
        Route::get('/times/all_time', 'TimeController@all');
        Route::post('/times', 'TimeController@store');
        Route::get('/times/delete/{id}', 'TimeController@destroy');
        Route::get('/times/{id}', 'TimeController@show');
        Route::post('/times/{id}', 'TimeController@update');

        // location
        Route::get('/locations', 'LocationController@index');
        Route::post('/locations', 'LocationController@store');
        Route::get('/locations/delete/{id}', 'LocationController@destroy');
        Route::post('/locations/{id}', 'LocationController@update');

        // tour
        Route::post('/tours', 'TourController@store');
        Route::get('/tours/delete/{id}', 'TourController@destroy');
        Route::post('/tours/{id}', 'TourController@update');
        Route::patch('/tours/{id}', 'TourController@updateStatus');

        // tour depature
        Route::get('/tour_departures', 'TourDepartureController@index');
        Route::get('/tour_departures/by_tour_id/{id}', 'TourDepartureController@getListByTourId');
        Route::post('/tour_departures', 'TourDepartureController@store');
        Route::get('/tour_departures/delete/{id}', 'TourDepartureController@destroy');
        Route::get('/tour_departures/{id}', 'TourDepartureController@show');
        Route::post('/tour_departures/update', 'TourDepartureController@update');

        // tour price
        Route::get('/tour_prices', 'TourPriceController@index');
        Route::get('/tour_prices/by_tour_id/{id}', 'TourPriceController@getListByTourId');
        Route::post('/tour_prices', 'TourPriceController@store');
        Route::get('/tour_prices/delete/{id}', 'TourPriceController@destroy');
        Route::get('/tour_prices/{id}', 'TourPriceController@show');
        Route::post('/tour_prices/update', 'TourPriceController@update');

        // tour schedule
        Route::get('/tour_schedules', 'TourScheduleController@index');
        Route::get('/tour_schedules/by_tour_id/{id}', 'TourScheduleController@getListByTourId');
        Route::post('/tour_schedules', 'TourScheduleController@store');
        Route::get('/tour_schedules/delete/{id}', 'TourScheduleController@destroy');
        Route::get('/tour_schedules/{id}', 'TourScheduleController@show');
        Route::post('/tour_schedules/update', 'TourScheduleController@update');

        // tour image
        Route::get('/tour_images', 'TourImageController@index');
        Route::get('/tour_images/by_tour_id/{id}', 'TourImageController@getListByTourId');
        Route::post('/tour_images', 'TourImageController@store');
        Route::get('/tour_images/delete/{id}', 'TourImageController@destroy');
        Route::get('/tour_images/{id}', 'TourImageController@show');
        Route::post('/tour_images/update', 'TourImageController@update');

        // news
        Route::get('/news', 'NewsController@index');
        Route::post('/news', 'NewsController@store');
        Route::get('/news/delete/{id}', 'NewsController@destroy');
        Route::get('/news/{id}', 'NewsController@show');
        Route::post('/news/{id}', 'NewsController@update');

        // banner
        Route::post('/banners', 'BannerController@store');
        Route::get('/banners/delete/{id}', 'BannerController@destroy');
        Route::get('/banners/{id}', 'BannerController@show');
        Route::post('/banners/{id}', 'BannerController@update');
        Route::patch('/banners/{id}', 'BannerController@updateStatus');

        // partner
        Route::post('/partners', 'PartnerController@store');
        Route::get('/partners/delete/{id}', 'PartnerController@destroy');
        Route::get('/partners/{id}', 'PartnerController@show');
        Route::post('/partners/{id}', 'PartnerController@update');

        // category news
        Route::get('/categories_news', 'CategoryNewsController@index');
        Route::get('/categories_news/all_category_news', 'CategoryNewsController@all');
        Route::post('/categories_news', 'CategoryNewsController@store');
        Route::get('/categories_news/delete/{id}', 'CategoryNewsController@destroy');
        Route::get('/categories_news/{id}', 'CategoryNewsController@show');
        Route::post('/categories_news/{id}', 'CategoryNewsController@update');

        // album
        Route::get('/albums', 'AlbumController@index');
        Route::get('/albums/all_album', 'AlbumController@all');
        Route::post('/albums', 'AlbumController@store');
        Route::get('/albums/delete/{id}', 'AlbumController@destroy');
        Route::get('/albums/{id}', 'AlbumController@show');
        Route::post('/albums/{id}', 'AlbumController@update');

        // album image
        Route::get('/album_images', 'AlbumImageController@index');
        Route::get('/album_images/by_album_id/{id}', 'AlbumImageController@getListByAlbumId');
        Route::post('/album_images', 'AlbumImageController@store');
        Route::get('/album_images/delete/{id}', 'AlbumImageController@destroy');
        Route::get('/album_images/{id}', 'AlbumImageController@show');
        Route::post('/album_images/update', 'AlbumImageController@update');

        // user profile
        Route::get('/user/show_profile', 'UserController@showProfile');
        Route::post('/user/edit_profile', 'UserController@editProfile');
        Route::post('/user/change_password_profile', 'UserController@changePasswordProfile');
    });
});
