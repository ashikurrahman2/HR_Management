@extends('frontend.app')

@section('title', 'কর্মচারীর তালিকা')

@section('content')

<div class="card">
    {{-- <div class="card-header d-flex justify-content-between align-items-center">
        <span>সাম্প্রতিক কর্মচারীগণ</span>
        <button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> যোগ করুন</button>
    </div> --}}

    <div class="card-body">

        @foreach ($employees as $employee)
        <div class="employee-item d-flex justify-content-between align-items-center mb-3">

            <!-- Left Side -->
            <div class="d-flex align-items-center">
                <div class="user-avatar">
                    {{ mb_substr($employee->employee_name, 0, 1) }}
                </div>

                <div class="employee-info ms-2">
                    <div class="employee-name">{{ $employee->employee_name }}(ID: {{  $employee->employee_id_number }})</div>
                    <div class="employee-designation">{{ $employee->designation }}</div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="text-end">
                <div class="employee-salary">৳{{ number_format($employee->salary) }}</div>

                @if ($employee->status == 1)
                    <span class="badge bg-success">সক্রিয়</span>
                @else
                    <span class="badge bg-danger">নিষ্ক্রিয়</span>
                @endif
            </div>

        </div>
        @endforeach

    </div>
</div>

@endsection
