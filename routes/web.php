<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/show', function (Request $request) {
    /**
     * Assignment: filter data in php
     * docs on data: http://data.cabq.gov/business/filmlocations/MetaData.pdf/view
     * 
     * Filter data based on start and end date inputs (shoot date must fall between the start and end dates)
     * Adjust for your timezone
     * Filter out duplicate productions
     * Data should be returned as a json in this format:
     * {
     *      count: 1,
     *      productions: [
     *          {
     *              title: "production name",
     *              type: "movie, tv or other",
     *              sites: [
     *                  {
     *                      name: "site name",
     *                      shoot_date: "Month Date, Year"
     *                  }
     *              ]
     *          }
     *      ]
     * }
     * 
     * On the front end (show.blade.php):
     * Display all data to user (just a bulleted list is fine)
     * Display date in a human readable format in your timezone
     */
    $data = $request->input('productions');
    return view('show', ['data' => $data]);
})->middleware('filter.movies');