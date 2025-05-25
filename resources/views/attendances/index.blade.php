@extends('layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
<div class="container">

    <h4>Attendance Records</h4>

    <a href="{{ route('attendances.exportPdf') }}" class="btn btn-warning" target="_blank">Export PDF</a>

    <a href="{{ route('attendances.create') }}" class="btn btn-primary">Add Student</a>

    <form action="{{ route('attendances.reset') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reset all statuses and login times?');">
            Reset All
        </button>
    </form>

</div>

    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Student Name</th>
                <!-- <th>Deadline</th> -->
                <th>Log In Time</th>
                <th>Status</th>
                <th>Mark Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($attendances as $attendance)
            <tr>
                <td>{{ $attendance->employee_name }}</td>
                <!-- <td>{{ \Carbon\Carbon::parse($attendance->date)->format('Y-m-d') }}</td>
                <td>{{ $attendance->date }}</td> -->

                <!-- <td>
                    @if($attendance->deadline_start && $attendance->deadline_end)
                        {{ \Carbon\Carbon::parse($attendance->deadline_start)->format('h:i A') }} -
                        {{ \Carbon\Carbon::parse($attendance->deadline_end)->format('h:i A') }}
                    @else
                        -
                    @endif
                </td> -->
                <td>
                    {{ $attendance->logged_in_at ? \Carbon\Carbon::parse($attendance->logged_in_at)->format('h:i A') : '-' }}
                </td>
                <td>
                    @if($attendance->status)
                        @if($attendance->status == 'Present')
                            <span class="badge bg-success">{{ $attendance->status }}</span>
                        @elseif($attendance->status == 'Late')
                            <span class="badge bg-warning text-dark">{{ $attendance->status }}</span>
                        @elseif($attendance->status == 'Absent')
                            <span class="badge bg-danger">{{ $attendance->status }}</span>
                        @else
                            {{ $attendance->status }}
                        @endif
                    @else
                        <span class="text-muted">Not Marked</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('attendances.markStatus', $attendance->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <input type="hidden" name="status" value="Present" />
                        <button type="submit" class="btn btn-sm btn-success">Present</button>
                    </form>

                    <form action="{{ route('attendances.markStatus', $attendance->id) }}" method="POST" style="display:inline-block; margin-left: 5px;">
                        @csrf
                        <input type="hidden" name="status" value="Late" />
                        <button type="submit" class="btn btn-sm btn-warning">Late</button>
                    </form>


                    <form action="{{ route('attendances.markStatus', $attendance->id) }}" method="POST" style="display:inline-block; margin-left: 5px;">
                        @csrf
                        <input type="hidden" name="status" value="Absent" />
                        <button type="submit" class="btn btn-sm btn-danger">Absent</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display:inline-block; margin-left: 5px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this record?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No records found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
