<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $users = DB::table('users')->count();
        $employees = DB::table('employees')->count();

        return view('home', compact('users','employees'));
    }
}
