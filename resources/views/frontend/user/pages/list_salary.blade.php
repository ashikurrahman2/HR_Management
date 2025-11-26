@extends('frontend.app')
@section('title', 'বেতন লিস্ট')

@section('content')
<div class="container py-4">
    <h4 class="text-center mb-4 text-primary fw-bold">বেতন লিস্ট</h4>

    @forelse($salaries as $salary)
    <!-- বেতন কার্ড -->
    <div class="card salary-card mb-4">
        <div class="card-header text-center py-3">
            <h5 class="mb-0">{{ $salary->employee_name ?? $salary->employeeList->employee_name }}</h5>
            <small>পদবী: {{ $salary->designation ?? $salary->employeeList->designation }}</small><br>
            <span class="badge-month mt-2">
                {{ \Carbon\Carbon::parse($salary->salary_month)->locale('bn')->translatedFormat('F Y') }}
            </span>
        </div>
        
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <span>মূল বেতন</span>
                <span class="amount-positive">৳ {{ number_format($salary->basic_salary, 0) }}</span>
            </li>
            
            @if($salary->house_rent > 0)
            <li class="list-group-item d-flex justify-content-between">
                <span>বাড়ি ভাড়া ভাতা</span>
                <span class="amount-positive">৳ {{ number_format($salary->house_rent, 0) }}</span>
            </li>
            @endif
            
            @if($salary->medical_allowance > 0)
            <li class="list-group-item d-flex justify-content-between">
                <span>চিকিৎসা ভাতা</span>
                <span class="amount-positive">৳ {{ number_format($salary->medical_allowance, 0) }}</span>
            </li>
            @endif
            
            @if($salary->bonus > 0)
            <li class="list-group-item d-flex justify-content-between">
                <span>বোনাস</span>
                <span class="amount-positive">৳ {{ number_format($salary->bonus, 0) }}</span>
            </li>
            @endif
            
            @if($salary->deductions > 0)
            <li class="list-group-item d-flex justify-content-between text-danger">
                <span><strong>মোট কর্তন (ট্যাক্স + অন্যান্য)</strong></span>
                <span class="amount-negative">-৳ {{ number_format($salary->deductions, 0) }}</span>
            </li>
            @endif
        </ul>
        
        <div class="net-salary text-center">
            নেট বেতন: ৳ {{ number_format($salary->net_salary, 0) }}
        </div>
    </div>
    @empty
    <div class="alert alert-info text-center">
        <i class="fas fa-info-circle"></i> কোনো বেতন তথ্য পাওয়া যায়নি।
    </div>
    @endforelse
</div>
@endsection