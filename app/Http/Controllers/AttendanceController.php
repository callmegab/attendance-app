<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use Illuminate\Http\Request;
use PDF; // add this on top

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        return view('attendances.create');
    }

public function store(Request $request)
{
    $request->validate([
        'employee_name' => 'required|string|max:255',
    ]);

    Attendance::create([
        'employee_name' => $request->employee_name,
        'date' => now()->toDateString(), // or a default date you want
        'status' => 'Present',           // or a default status
        // set other required fields or defaults here
    ]);

    return redirect()->route('attendances.index');
}




    public function edit(Attendance $attendance)
    {
        return view('attendances.edit', compact('attendance'));
    }

    public function login(Attendance $attendance)
{
    $attendance->update([
        'employee_name' => $request->employee_name,
        'status' => $request->status,
        'deadline_start' => $request->deadline_start,
        'deadline_end' => $request->deadline_end,
    ]);


    return redirect()->route('attendances.index')->with('success', 'Logged in at ' . now()->format('h:i A'));
}


public function update(Request $request, Attendance $attendance)
{
    $request->validate([
        'employee_name' => 'required|string|max:255',
    ]);

    $attendance->update([
        'employee_name' => $request->employee_name,
    ]);

    return redirect()->route('attendances.index');
}

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted.');
    }

    public function markStatus(Request $request, Attendance $attendance)
{
    $request->validate([
        'status' => 'required|in:Present,Late,Absent',
    ]);

    $attendance->update([
        'status' => $request->status,
        'logged_in_at' => now(),
    ]);

    return redirect()->route('attendances.index')->with('success', 'Status updated to '.$request->status.' at '.now()->format('h:i A'));
}



public function exportPdf()
{
    $attendances = Attendance::all();

    $pdf = PDF::loadView('attendances.pdf', compact('attendances'));

    return $pdf->download('attendance_report.pdf');
}

public function show($attendance)
{
    abort(404); // or handle properly if you want to display a single attendance record
}



public function reset()
{
    // Reset status to default string (e.g., empty or 'Pending') and logged_in_at to null
    \App\Models\Attendance::query()->update([
        'status' => '',            // or 'Pending' or 'Not marked'
        'logged_in_at' => null,
        'updated_at' => now(),
    ]);

    return redirect()->route('attendances.index')->with('success', 'All attendance statuses and login times have been reset.');
}

}

