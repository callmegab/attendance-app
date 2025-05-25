@extends('layout')

@section('content')
    <h2>{{ isset($attendance) ? 'Edit' : 'Add' }} Attendance</h2>

    <form action="{{ isset($attendance) ? route('attendances.update', $attendance->id) : route('attendances.store') }}" method="POST">
        @csrf
        @if(isset($attendance))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label class="form-label">Employee Name</label>
            <input 
                type="text" 
                name="employee_name" 
                class="form-control" 
                value="{{ old('employee_name', $attendance->employee_name ?? '') }}" 
                required
            >
        </div>

        <button type="submit" class="btn btn-success">
            {{ isset($attendance) ? 'Update' : 'Submit' }}
        </button>
    </form>
@endsection
