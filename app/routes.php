<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home');
});

Route::get('howitworks', function()
{
	return View::make('howitworks');
});

Route::get('mapdata/{floornum}', function($floornum)
{
	if ($floornum > 14 || $floonum < 1) $floornum = 14;
	switch ($floonum){
		case 1: return View::make('Robarts1stFloor');
		case 2: return View::make('Robarts2ndFloor');
		case 3: return View::make('Robarts3rdFloor');
		case 4: return View::make('Robarts4thFloor');
		case 5: return View::make('Robarts5thstFloor');
		case 6: return View::make('home');
		case 7: return View::make('home');
		case 8: return View::make('Robarts8thFloor');
		case 9: return View::make('Robarts9thFloor');
		case 10: return View::make('Robarts10thFloor');
		case 11: return View::make('Robarts11thFloor');
		case 12: return View::make('Robarts12thFloor');
		case 13: return View::make('Robarts13thFloor');
		case 14: return View::make('home');
	}
});

Route::get('floor/{floornum}', function($floornum)
{
    return View::make('floor')->with('floornum', $floornum);

});


// Tests


Route::get('charttest', function()
{
	return View::make('charttest');
});

Route::get('datatest', function()
{
	return View::make('datatest');
});

Route::get('graphdatatest', function()
{
	return View::make('graphdatatest');
});

Route::get('buildings', function()
{
    $buildings = buildings::all();
    $populations = populations::all();
    return View::make('buildings')->with('buildings', $buildings)->with('populations', $populations);
});

Route::get('test', function()
{
	return View::make('test');
});

Route::get('test2', function()
{
	return View::make('test2');
});

