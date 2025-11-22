<?php

namespace App\Http\Controllers;

use App\Models\EmployeeList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FrontendController extends Controller
{
    public function index()
    {
      $employees = EmployeeList::all();
       $employee = EmployeeList::where('employee_id_number', Auth::id())->first();
      return view('frontend.user.dashboard', compact('employees', 'employee'));
    }
}