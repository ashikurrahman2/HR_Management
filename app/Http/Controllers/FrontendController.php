<?php

namespace App\Http\Controllers;

use App\Models\EmployeeList;
use App\Models\Salary;
use App\Models\Attendance;
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

      public function employeelist()
    {
            $employees = EmployeeList::latest()->get();
      return view('frontend.user.pages.list_worker', compact('employees'));
    }


       public function SalaryList()
    {
        // $salaries = Salary::where('user_id', auth()->id())
        //                  ->orderBy('salary_month', 'desc')
        //                  ->paginate(10);
        
        return view('frontend.user.pages.list_salary');
    }

    public function attendanceList(Request $request)
{
    $query = Attendance::query();

    // ফিল্টার প্রয়োগ
    if ($request->filled('date_from')) {
        $query->whereDate('date', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('date', '<=', $request->date_to);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // লগইন ইউজারের জন্য
    if (!auth()->user()->is_admin) {
        $query->where('user_id', auth()->id());
    }

    $attendances = $query->orderBy('date', 'desc')
                        ->orderBy('check_in', 'desc')
                        ->paginate(15);

    // সামারি তৈরি
    $summary = [
        'present' => Attendance::where('status', 'present')->count(),
        'absent' => Attendance::where('status', 'absent')->count(),
        'late' => Attendance::where('status', 'late')->count(),
        'leave' => Attendance::where('status', 'leave')->count(),
    ];

    return view('frontend.user.pages.attendance', compact('attendances', 'summary'));
}

   
}