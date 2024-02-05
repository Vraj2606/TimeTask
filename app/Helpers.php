<?php
namespace App\Helpers;

use App\Models\Employee;
use Carbon\Carbon;

class Helper
{
    public static function getEmployeeData($search = null)
    {
        $employeesData = Employee::with('attendance');

        if ($search) {
            $employeesData = $employeesData
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhereHas('attendance', function ($query) use ($search) {
                    $query->where('date', 'LIKE', '%' . $search . '%')
                        ->orWhere('in_time', 'LIKE', '%' . $search . '%')
                        ->orWhere('out_time', 'LIKE', '%' . $search . '%');
                });
        }

        return $employeesData->get()->toArray();
    }
    public static function view($search = null)
    {
        $employeesData = static::getEmployeeData($search);
        $employees = [];
        foreach ($employeesData as $key => $employee) {
            $employee_time = 0;
            $break = 0;
            $count = count($employee['attendance']);
            if ($count < 2) {
                $employee_time = Carbon::parse($employee['attendance'][0]['out_time'])->diffInMinutes(Carbon::parse($employee['attendance'][0]['in_time']));
            } else {
                
                foreach ($employee['attendance'] as $i => $attendance) {
                    if ($i > 0) {
                        $currentTime = $employee['attendance'][$i - 1];
                        $nextTime = $attendance;
                        $outTime = Carbon::parse($currentTime['out_time']);
                        if ($outTime->gte(Carbon::parse('13:00')) && $outTime->lt(Carbon::parse('14:00'))) {
                            $break = Carbon::parse($nextTime['in_time'])->diffInMinutes(Carbon::parse($currentTime['out_time']));
                        }
                        $employee_time += Carbon::parse($currentTime['out_time'])->diffInMinutes(Carbon::parse($currentTime['in_time']));
                        if ($i == $count - 1) {
                            $employee_time += Carbon::parse($nextTime['out_time'])->diffInMinutes(Carbon::parse($nextTime['in_time']));
                        }
                    }
                }
            }
            $employees[$key] = $employee;
            $employees[$key]['break'] = $break;
            $employees[$key]['time'] = $employee_time;
        }
        return $employees;
    }
}
