<?php

namespace App\Http\Controllers;


use App\Constants;
use App\Imports\EmployeesImport;
use App\Imports\NationalitiesImport;
use App\Imports\RegionsImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Employee;
use App\Models\PlacementChoice;
use App\Models\PlacementRound;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    //

    public function home()
    {
        if ((!backpack_user()->can('employee.home') && backpack_user()->can('dashboard.content')) || backpack_user()->hasRole(Constants::USER_TYPE_SUPER_ADMIN)) {
            return redirect(route('dashboard'));
        }

        if (!Auth::user()->can('employee.home')) {
            return abort(401);
        }
        $user = Auth::user();
        $employee = Employee::where('uas_user_id', $user->username)->get();
        if ($employee->count() == 0 && backpack_user()->hasRole('employee')) {
            Auth::logout();
            return abort(401, 'Please you have no employee profile contact admin');
        }
        if ($employee->count() == 0 && !backpack_user()->hasRole('employee')) {
            return abort(401);
        }
        $employee = $employee->first();
        $employee->totalExperiences();
        $positions = Position::all();
        $placementRound = PlacementRound::where('is_open', true)->first();
        return view('home', compact('user', 'employee', 'positions', 'placementRound'));
    }
    public function importPage()
    {
        $colleges = Constants::COLLEGES;
        return view('employee.import', compact('colleges'));
    }

    public function import(Request $request)
    {
        if ($request->get('type') == 'country') {
            Excel::import(new NationalitiesImport, request()->file('file'));
        }

        if ($request->get('type') == 'region') {
            Excel::import(new RegionsImport, request()->file('file'));
        }
        if ($request->get('type') == 'employee') {
            $college = $request->get('college');
            Excel::import(new EmployeesImport($college), request()->file('file'));
        }
        // Excel::import(new EmployeesImport, "/abc.xl");
        dd('IMPORT DONE');
    }
    public function calculate()
    {
        $placementChoice = PlacementChoice::first();
        $employee = $placementChoice->employee;
        $choiceOne = $placementChoice->choiceOne;
        $choiceTwo = $placementChoice->choiceTwo;
        $employee->calculateEducationalValue($choiceOne);
        $employee->calculateEducationalValue($choiceTwo);
    }
}
