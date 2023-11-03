<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\EmployeeCategory;
use App\Models\HrBranch;
use App\Models\Position;
use App\Models\PositionCode;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

//     public function countEmployeesAbove60()
// {
//     $count = Employee::whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 60')->count();

//     return $count;
// }

    
    public function index(){
        $users = DB::table('users')->count();
        $employees = DB::table('employees')->count();
        $employeeTypes = EmployeeCategory::all();
        $males    = Employee::where('gender', 'Male')->count();
        $females  = Employee::where('gender', 'Female')->count();
        $units    = Unit::count();
        $offices = HrBranch::all();
       // $positions = Position::count();
        $active_leaves = Employee::where('employment_status_id','!=',  1)->count();
        $retired       = Employee::whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 60')->count();
        $permanets = DB::table('employees')->where('employment_type_id', 1)->count();
       // $contracts = DB::table('employees')->where('employment_type_id', 2)->count();

        $freepositions = PositionCode::where('employee_id', null)->count();
        $ocuupiedpositions = PositionCode::where('employee_id', '!=', null)->count();

        $probations = Employee::whereBetween('employement_date', [Carbon::now()->subMonths(6), Carbon::now()])->count();
        $non_permanets = Employee::whereNotIn('employment_type_id', [1])->where('employment_type_id','!=', null)->count();
     
            return view('dashboard', compact('users','permanets', 'freepositions','active_leaves', 'offices','units', 'employees', 'non_permanets','employeeTypes', 'males', 'females','retired','probations'));

       
}

public function notice()
{
    return view('notice');
}

}