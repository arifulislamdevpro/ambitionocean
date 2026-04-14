<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Attendance;

class SyncZKTecoAttendance extends Command
{
    protected $signature = 'attendance:sync';
    protected $description = 'Sync attendance from ZKTeco';

    public function handle()
    {
        $logs = DB::connection('zk')
            ->table('CHECKINOUT')
            ->orderBy('CHECKTIME', 'asc')
            ->get();

        foreach ($logs as $log) {

            $employee = Employee::where('iqama', $log->USERID)->first();
            if (!$employee) continue;

            $date = date('Y-m-d', strtotime($log->CHECKTIME));
            $time = date('H:i:s', strtotime($log->CHECKTIME));

            $attendance = Attendance::firstOrCreate([
                'employee_id' => $employee->id,
                'date' => $date
            ]);

            // ✅ Smart logic (first IN, last OUT)
            if ($log->CHECKTYPE == 'I') {
                if (!$attendance->check_in || $time < $attendance->check_in) {
                    $attendance->check_in = $time;
                }
            } else {
                if (!$attendance->check_out || $time > $attendance->check_out) {
                    $attendance->check_out = $time;
                }
            }

            $attendance->save();
        }

        $this->info('Attendance Synced');
    }
}
