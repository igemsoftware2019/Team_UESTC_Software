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

// Route::get('/', function () {
//     return redirect(route('main'));
// });
Auth::routes();
Route::any('/', 'MainController@home')->name('main');

Route::get('/home', 'HomeController@index')->name('home');


// Detail
Route::any('detail/{igemid?}/{uniid?}', 'DetailController@result')->name('result');


// Prediction
Route::prefix('prediction')->group(function (){
    Route::any('ec/sqr', 'PredController@ec_sqr')->name('ec_sqr')->middleware('ecsqr');
    Route::any('ec/file', 'PredController@ec_file')->name('ec_file')->middleware('ecfile');
    Route::any('ec/wait', 'PredController@ec_wait')->name('ec_wait');
    Route::any('ec/okey', 'PredController@ec_okey')->name('ec_okey')->middleware('eckey');
    Route::any('promoter/okey', 'PredController@promoter_okey')->name('promoter_okey');
    Route::any('promoter/file', 'PredController@promoter_file')->name('promoter_file')->middleware('promoterfile');
    Route::any('promoter/sqr', 'PredController@promoter_sqr')->name('promoter_sqr')->middleware('promotersqr');
    Route::any('promoter/wait', 'PredController@promoter_wait')->name('promoter_wait');
});

// Blast
Route::any('blast/result', 'BlastController@result')->name('blast')->middleware('blastresult');


// Main
Route::prefix('main')->group(function () {
    Route::any('home', 'MainController@home')->name('main');
    Route::any('search', 'MainController@search')->name('search');
    Route::any('searchafter', 'MainController@searchafter')->name('searchafter')->middleware('mainsearch');
    Route::any('teamwiki', 'MainController@teamsearch')->name('teamsearch');
    Route::any('prediction', 'MainController@prediction')->name('prediction');
    Route::any('tools', 'MainController@tools')->name('tools');
    Route::any('best', 'MainController@best')->name('best')->middleware('aftermatch');
    Route::any('type', 'MainController@type')->name('type')->middleware('aftermatch');
    Route::any('recommended', 'MainController@recommended')->name('recommended')->middleware('aftermatch');
    Route::any('download', 'MainController@download')->name('download');
    Route::get('catalog', 'MainController@catalog')->name('catalog');
    Route::get('catalog2', 'MainController@catalog2')->name('catalog2');
    Route::get('catalog3', 'MainController@catalog3')->name('catalog3');
    Route::get('sbol', 'MainController@sbol')->name('sbol');
    Route::get('test', 'MainController@test')->name('test');

});

// Tools
Route::prefix('tools')->group(function(){
    Route::any('uniprot/process', 'ToolsController@process')->name('tools_process');
    Route::any('blast/api', 'ToolsController@blast_api')->name('blast_api');
});

// Comment
Route::prefix('comment')->group(function(){
    Route::any('write', 'CommentController@write')->name('comment_write')->middleware('auth','writecomment');
});

// Download
Route::prefix('download')->group(function(){
    Route::any('xmldownload', 'DownloadController@xmldownload')->name('xml_download');
    Route::any('csvdownload', 'DownloadController@csvdownload')->name('csv_download');
    Route::any('sqldownload', 'DownloadController@sqldownload')->name('sql_download');
    Route::any('detaildownload/{igemid?}/{type?}', 'DownloadController@detaildownload')->name('detail_download');
});

