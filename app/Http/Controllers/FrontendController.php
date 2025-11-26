<?php

namespace App\Http\Controllers;

use App\Models\EmployeeList;
use App\Models\Salary;
use App\Models\Attendance;
use App\Models\Overtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



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
         $salaries = Salary::with('employeeList')
            ->orderBy('salary_month', 'desc')
            ->get();
        return view('frontend.user.pages.list_salary', compact('salaries'));
    }

    public function attendanceList(Request $request)
{
    $query = Attendance::query();

    // Filter
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


 // ✅ Overtime Methods
    public function TimeOver()
    {
        $employees = EmployeeList::select('id', 'employee_name')->get();
        $overtimes = Overtime::with('employeeList')
            ->orderBy('ot_date', 'desc')
            ->get();
        
        return view('frontend.user.pages.overtime', compact('employees', 'overtimes'));
    }

  public function store(Request $request)
{
    $request->validate([
        'employee_list_id' => 'required|exists:employee_lists,id',
        'ot_date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
    ]);

    // ✅ সঠিক ঘণ্টা ক্যালকুলেশন
    $start = Carbon::parse($request->start_time);
    $end = Carbon::parse($request->end_time);
    
    // যদি শেষ সময় শুরু সময়ের আগে হয় (পরের দিন বুঝায়)
    if ($end->lt($start)) {
        $end->addDay();
    }
    
    $hours = $start->diffInMinutes($end) / 60; // মিনিট থেকে ঘণ্টা

    // Employee name লোড
    $employee = EmployeeList::find($request->employee_list_id);

    Overtime::create([
        'employee_list_id' => $request->employee_list_id,
        'employee_name' => $employee->employee_name,
        'ot_date' => $request->ot_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'hours' => $hours,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'ওভারটাইম যোগ হয়েছে!'
    ]);
}
    public function destroy($id)
    {
        try {
            $overtime = Overtime::findOrFail($id);
            $overtime->delete();

            return response()->json([
                'success' => true,
                'message' => 'ওভারটাইম মুছে ফেলা হয়েছে!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'সমস্যা হয়েছে!'
            ], 500);
        }
    }

    public function getEmployeeOvertimes($employeeId)
    {
        $overtimes = Overtime::where('employee_list_id', $employeeId)
            ->orderBy('ot_date', 'desc')
            ->get();

        return response()->json($overtimes);
    }


   
}