<?php

use App\Constants;
use App\Http\Controllers\Admin\EmployeeCrudController;
use App\Http\Controllers\Admin\EmployeeEvaluationCrudController;
use App\Http\Controllers\Admin\FieldOfStudyCrudController;
use App\Http\Controllers\Admin\LeaveCrudController;
use App\Http\Controllers\Admin\PlacementChoiceCrudController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IdAttributeController;
use App\Http\Controllers\IDCardController;
use App\Http\Controllers\IDController;
use App\Http\Controllers\IDSignaturesController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PlacementChoiceController;
use App\Http\Controllers\UnitController;
use App\Models\Unit;
use App\Models\Employee;
use App\Models\EmployeeEvaluation;
use App\Models\Unit as ModelsUnit;
use App\Score\ExperienceScore;
use Illuminate\Support\Facades\Auth;

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
    if (!backpack_user()) {
        return redirect('logout');
    }
    if (!backpack_user()->hasRole(Constants::USER_TYPE_EMPLOYEE)) {
        return redirect(route('dashboard'));
    }
    dd('sd');
    return redirect(route('home'));
});

Route::redirect('/admin/login', '/home');
// Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
// Route::redirect('/admin/login','/login');
// Route::get('/', function () {
//     return redirect(route('backpack.dashboard'));
// });
Route::redirect('/', '/home');
Route::redirect('/admin/login', '/login');
Route::get('/import', [ImportController::class, 'import'])->middleware('auth');
Route::get('/home', [EmployeeController::class, 'home'])->name('home')->middleware(['admin']);
Route::get('import_page', [EmployeeController::class, 'importPage'])->middleware('auth');
Route::post('import', [EmployeeController::class, 'import'])->middleware('auth');
Route::get('/login', [AuthController::class, 'userLoginView'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.auth')->middleware('guest');
//Route::post('insertbatch', [EmployeeCrudController::class, 'insertbatch'])->name('insertbatch');

///////////////////////////////////////////////////////////////////////////////////////////
 Route::get('/result', [PlacementChoiceCrudController::class, 'result'])->name('result');
// Route::get('/details', [PlacementChoiceCrudController::class, 'details'])->name('details');
 Route::get('employee/{employee_id}/show', [EmployeeCrudController::class, 'show'])->name('employee');
 Route::get('{new_position_id?}/details', [PlacementChoiceCrudController::class, 'details'])->name('PlacementChoice.details');
/////////////////////////////////////////////////////////////////////////////////////////////////////////

// Route::get('/result', [PlacementChoiceController::class, 'index']);
 //Route::get('/result',[PlacementChoiceController::class,'result'])->name('result');
Route::get('/calculate', [EmployeeController::class, 'calculate'])->middleware('auth');
Route::resource('employeeEvaluation', EmployeeEvaluationCrudController::class)->middleware('auth');
// Route::resource('leave', LeaveCrudController::class);
Route::get( '/hierarchy',
    function () {
        $org = Unit::where('parent_unit_id')->latest()->get();
        return view('unit.tree', ['orgs' => $org]);
    }
)->name('hierarchy')->middleware('auth');


Route::get('pdf', function(){

    return response()->file(public_path('/doc/JU_Approved_Structure_Description_August30-2022.pdf'));

})->name('structure-pdf')->middleware('auth');

Route::get('legistlation', function(){

    return response()->file(public_path('/doc/ሰራተኛ_ድልድል_2014.pdf'));

})->name('legistlation')->middleware('auth');

Route::get('{evaluation_id}/evaluation_show', [EmployeeEvaluationCrudController::class, 'evaluation_show'])->name('evaluation.evaluation_show')->middleware('auth');
Route::resource('idcard', IDCardController::class)->middleware('auth');
Route::get('idcard/{idcard}/show', [IDCardController::class, 'design'])->middleware('auth')->name('idcard.design');
Route::resource('attribute', IdAttributeController::class)->middleware('auth');
Route::post('{idcard}/save/design', [IDCardController::class, 'saveDesign'])->name('save.design')->middleware('auth');


Route::get('/employee/list', [IDCardController::class, 'printList'])->name('emp.list')->middleware('auth');
Route::get('{employee}/print/ID', [IDCardController::class, 'printID'])->name('print.id')->middleware('auth');
Route::resource('signature', IDSignaturesController::class)->middleware('auth');
Route::get('field_of_study/sync',[ FieldOfStudyCrudController::class,'syncFieldOfStudy'])->name('field_of_study.sync')->middleware('auth');

//Route::resource('round/{placement_round}/placement-choice', PlacementChoiceController::class);
Route::post('choice-based-employee', [PlacementChoiceController::class, 'choiceBasedEmployee']);
Route::post('remove-choosed-position', [PlacementChoiceController::class, 'removeChoosedPosition']);
Route::get('placement-round/{placement_round}/placement-choice',[PlacementChoiceController::class,'listAll'])->name('placement_choice.list_all');

Route::get('choice-download-pdf', [PlacementChoiceController::class, 'pdfDownload'])->name('pdf.download')->middleware('auth');

Route::get('/choice-download-excel', [ImportExportController::class, 'exportResourceVolunteer'])->name('resource.volunteers.export');