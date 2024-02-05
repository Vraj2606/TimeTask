<?php

namespace Database\Seeders;

// EmployeeAttendanceSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [
            [
                'name' => 'John',
                'email' => 'john@yahoo.com',
                'attendance' => [
                    ['date' => '2022-08-09', 'in_time' => '09:00:00', 'out_time' => '13:00:00'],
                    ['date' => '2022-08-09', 'in_time' => '14:00:00', 'out_time' => '18:30:00'],
                ],
            ],
            [
                'name' => 'Peter',
                'email' => 'peter@yahoo.com',
                'attendance' => [
                    ['date' => '2022-08-09', 'in_time' => '09:05:00', 'out_time' => '13:05:00'],
                    ['date' => '2022-08-09', 'in_time' => '14:00:00', 'out_time' => '18:00:00'],
                ],
            ],
            [
                'name' => 'Mark',
                'email' => 'mark@yahoo.com',
                'attendance' => [
                    ['date' => '2022-08-09', 'in_time' => '09:10:00', 'out_time' => '13:00:00'],
                    ['date' => '2022-08-09', 'in_time' => '14:05:00', 'out_time' => '19:00:00'],
                ],
            ],
            [
                'name' => 'Sandra',
                'email' => 'sandra@yahoo.com',
                'attendance' => [
                    ['date' => '2022-08-09', 'in_time' => '09:01:00', 'out_time' => '13:15:00'],
                    ['date' => '2022-08-09', 'in_time' => '13:30:00', 'out_time' => '18:10:00'],
                ],
            ],
            [
                'name' => 'Kyle',
                'email' => 'kyle@yahoo.com',
                'attendance' => [
                    ['date' => '2022-08-09', 'in_time' => '10:00:00', 'out_time' => '13:00:00'],
                    ['date' => '2022-08-09', 'in_time' => '14:00:00', 'out_time' => '18:00:00'],
                ],
            ],
            [
                'name' => 'Rachel',
                'email' => 'rachel@yahoo.com',
                'attendance' => [
                    ['date' => '2022-08-09', 'in_time' => '09:30:00', 'out_time' => '18:15:00'],
                ],
            ],
            [
                'name' => 'Marcus',
                'email' => 'marcus@yahoo.com',
                'attendance' => [
                    ['date' => '2022-08-09', 'in_time' => '09:04:00', 'out_time' => '14:00:00'],
                    ['date' => '2022-08-09', 'in_time' => '14:45:00', 'out_time' => '18:05:00'],
                ],
            ],
            [
                'name' => 'Ram',
                'email' => 'ram@yahoo.com',
                'attendance' => [
                    ['date' => '2022-08-09', 'in_time' => '09:02:00', 'out_time' => '13:00:00'],
                    ['date' => '2022-08-09', 'in_time' => '14:00:00', 'out_time' => '17:30:00'],
                ],
            ],
            [
                'name' => 'Max',
                'email' => 'max@yahoo.com',
                'attendance' => [
                    ['date' => '2022-08-09', 'in_time' => '09:14:00', 'out_time' => '13:05:00'],
                    ['date' => '2022-08-09', 'in_time' => '14:00:00', 'out_time' => '18:04:00'],
                ],
            ],
            [
                'name' => 'Sam',
                'email' => 'sam@yahoo.com',
                'attendance' => [
                    ['date' => '2022-08-09', 'in_time' => '09:15:00', 'out_time' => '13:00:00'],
                ],
            ],

        ];

        foreach ($employees as $employee) {
            $employeeId = DB::table('employees')->insertGetId([
                'name' => $employee['name'],
                'email' => $employee['email'],
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            foreach ($employee['attendance'] as $attendance) {
                DB::table('employee_attendance')->insert([
                    'employee_id' => $employeeId,
                    'date' => $attendance['date'],
                    'in_time' => $attendance['in_time'],
                    'out_time' => $attendance['out_time'],
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ]);
            }
        }
    }
}
