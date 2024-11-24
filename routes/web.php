<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataChartController;
use App\Http\Controllers\DataReportController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function () {
//     return view('dashboard.index');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

//Store trigger sensor to DB
Route::get('suhu/{temperature}/{humidity}', [SensorController::class, 'getValueSensor'])->name('get.sensor.value');

//Handle value sensor card
Route::get('data/sensor/card', [DashboardController::class, 'dataCardSensor'])->name('card.data.sensor');
//Handle data Chart
Route::get('collection/data/sensor', [DataChartController::class, 'collectionDataSensor'])->name('collection.data.sensor');
Route::get('collection/data/sensor/daya', [DataChartController::class, 'collectionDataSensorDaya'])->name('collection.data.sensor.daya');
//Handle data table
Route::get('data/sensor/table', [DataTableController::class, 'dataTableSensor'])->name('table.data.sensor');

//Laporan Handle
Route::get('data/all/report', [DataReportController::class, 'allReportPage'])->name('all.report.page');
Route::get('list/all/data/sensor', [DataReportController::class, 'listAllDataSensor'])->name('list.all.data.sensor');

//handle Export data
Route::post('data/export/xlsx', [DataReportController::class, 'exportXlxsAllData'])->name('export.xlsx.all.data');
Route::post('data/export/cvs', [DataReportController::class, 'exportCsvAllData'])->name('export.csv.all.data');
Route::post('data/export/pdf', [DataReportController::class, 'exportPdfAllData'])->name('export.pdf.all.data');

