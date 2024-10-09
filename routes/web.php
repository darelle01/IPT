<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminNewPatient;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\BackBtnController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaveBtnController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginPageController;
use App\Http\Controllers\DeleteFileController;
use App\Http\Controllers\SeemoreBtnController;
use App\Http\Controllers\UpdateFileController;
use App\Http\Controllers\MedicalLogsController;
use App\Http\Controllers\AdminSaveBtnController;
use App\Http\Controllers\SearchResultController;
use App\Http\Controllers\AddImageIndexController;
use App\Http\Controllers\AdminLoginBtnController;
use App\Http\Controllers\PatientFullInfoController;
use App\Http\Controllers\PatientListViewController;
use App\Http\Controllers\ViewMedicalLogsController;
use App\Http\Controllers\ConsultationListController;
use App\Http\Controllers\DeleteImageIndexController;
use App\Http\Controllers\SearchResultViewController;
use App\Http\Controllers\PatientListFilterController;
use App\Http\Controllers\ViewMedicalImagesController;
use App\Http\Controllers\ViewPatientRecordController;
use App\Http\Controllers\AdminCreateAccountController;
use App\Http\Controllers\AdminCreateAccountBtnController;
use App\Http\Controllers\ViewMedicalLogsImagesController;


// IPT System Routes
Route::get('/Login-Page',[LoginPageController::class,'ViewLoginPage'])->name('Login');
Route::post('/Login-Page',[AdminLoginBtnController::class,'AdminLoginBtn'])->name('Login.Process');


// Admin Only
Route::get('/Create-Account',[AdminCreateAccountController::class,'ViewAdminCreateAccount'])->name('Admin.Create');
Route::post('/Create-Account',[AdminCreateAccountBtnController::class,'CreateAccountBtn'])->name('Admin.Store');

Route::get('/RHU-Dashboard', [DashboardController::class, 'ShowDashboard'])->middleware('AdminMiddle:Staff')->name('Admin.Dashboard');

Route::get('/New-Patient',[AdminNewPatient::class,'ViewAdminNewPatient'])->name('Admin.New');
Route::post('/New-Patient',[AdminSaveBtnController::class,'AdminSaveBtn'])->name('Admin.Save');

Route::get('/Search-Result',[SearchResultController::class,'SearchResult'])->name('Admin.Result');
Route::get('/Search-Result-View',[SearchResultViewController::class,'SearchResultView'])->name('Admin.SearchResult');
Route::get('/Search-View',[SeemoreBtnController::class,'SeemoreBtn'])->name('Admin.FullView');

Route::get('/Patient-Full-Informations',[PatientFullInfoController::class,'ViewFullInfo'])->name('Admin.patientFullView');
Route::post('/Patient-Full-Information-Save', [SaveBtnController::class,'SaveBtn'])->name('Admin.SaveMedicalLogs');

Route::get('/Patient-Medical-Logs',[ViewMedicalLogsController::class,'ViewMedicalLogs'])->name('Admin.ViewMedicalLogs');
Route::get('/Patient-Medical-Logs-Records',[MedicalLogsController::class,'ViewMedicalLogsRecords'])->name('Admin.ViewMedicalLogsRecords');

Route::get('/Patient-Medical-Logs-Records-View',[ViewMedicalImagesController::class,'ViewMedicalRecords'])->name('Admin.ViewMedicalRecords');

Route::get('/View-Medical-Logs-Image/{PatientNumber}/{id}',[ViewMedicalLogsImagesController::class,'ViewMedicalLogsImages'])->name('Admin.ViewImages');
Route::get('/PatientMedicalLogs',[BackBtnController::class,'BackBtn'])->name('Admin.BackBtn');

Route::patch('/View-Medical-Logs-Image/delete',[DeleteImageIndexController::class,'DeleteImageIndex'])->name('Admin.DeleteIndex');
Route::put('/View-MedicalLogs-Image/update', [AddImageIndexController::class, 'AddImageIndex'])->name('Admin.AddNewImages');

Route::put('/View-Medical-Logs-Image/{PatientNumber}/{id}/update', [UpdateFileController::class,'UpdateFile'])->name('Admin.UpdateFile');

Route::delete('/View-Medical-Logs-Image/{PatientNumber}/delete', [DeleteFileController::class,'DeleteFile'])->name('Admin.DeleteFile');
Route::get('/View-Medical-Logs-Image/Filter', [FilterController::class, 'Filter'])->name('Admin.Filter');
Route::get('/Patient-List-View', [PatientListViewController::class,'PatientListView'])->name('Admin.PatientList');

Route::get('/Patient-List-View', [PatientListFilterController::class,'PatientListFilter'])->name('Admin.PatientListFilter');
Route::get('/Patient-Full-Information',[ViewPatientRecordController::class,'ViewMore'])->name('Admin.ViewMore');

Route::get('/Add-New-Program', [ConsultationListController::class,'ConsultationListPage'])->name('Admin.AddProgramView');
Route::get('/Add-New-Program', [ConsultationListController::class,'FetchConsultationList'])->name('Admin.AddProgramView');
Route::post('/Add-New-Program', [ConsultationListController::class,'ConsultationList'])->name('Admin.AddProgram');



    
// web.php
Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return 'Database connection is successful!';
    } catch (\Exception $e) {
        return 'Could not connect to the database. Please check your configuration. Error: ' . $e->getMessage();
    }
});






Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
