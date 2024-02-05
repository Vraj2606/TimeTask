<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Helper::view();
        return view('employees.index', compact('employees'));
    }
    public function search(Request $request)
    {
        $employees = Helper::view($request->input('search'));
        return response()->json($employees);
    }
    public function create()
    {
        return view('employees.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'date.*' => 'required|date',
            'in_time.*' => 'required|date_format:H:i',
            'out_time.*' => 'required|date_format:H:i',
        ]);
        $employee = Employee::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        $attendanceData = [];
        foreach ($request->input('date') as $key => $date) {
            $attendanceData[] = new EmployeeAttendance([
                'date' => $date,
                'in_time' => $request->input('in_time')[$key],
                'out_time' => $request->input('out_time')[$key],
            ]);
        }
        $employee->attendance()->saveMany($attendanceData);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
}