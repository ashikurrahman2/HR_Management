@extends('frontend.app')
@section('title', 'বেতন লিস্ট')

@section('content')
<div class="container py-4">
    <h4 class="text-center mb-4 text-primary fw-bold">বেতন লিস্ট</h4>

    <!-- বেতন কার্ড ১ -->
    <div class="card salary-card">
        <div class="card-header text-center py-3">
            <h5 class="mb-0">মোঃ রাকিব হোসেন</h5>
            <small>পদবী: সিনিয়র ডেভেলপার</small><br>
            <span class="badge-month mt-2">অক্টোবর ২০২৫</span>
        </div>
        
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <span>মূল বেতন</span>
                <span class="amount-positive">৳ ৫৫,০০০</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>বাড়ি ভাড়া ভাতা</span>
                <span class="amount-positive">৳ ২২,০০০</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>চিকিৎসা ভাতা</span>
                <span class="amount-positive">৳ ৫,০০০</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>বোনাস</span>
                <span class="amount-positive">৳ ১০,০০০</span>
            </li>
            <li class="list-group-item d-flex justify-content-between text-danger">
                <span><strong>মোট কর্তন (ট্যাক্স + অন্যান্য)</strong></span>
                <span class="amount-negative">-৳ ৮,৫০০</span>
            </li>
        </ul>
        
        <div class="net-salary text-center">
            নেট বেতন: ৳ ৮৩,৫০০
        </div>
    </div>
</div>
@endsection