@extends('frontend.app')

@section('title', 'Dashboard')

@section('content')
<div class="main-content">
        <h1 class="page-title">ড্যাশবোর্ড</h1>

         <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-label">মোট কর্মচারী</div>
                <div class="stat-value">১২৫</div>
                <i class="fas fa-users stat-icon" style="color: var(--primary-color);"></i>
            </div>
            <div class="stat-card success">
                <div class="stat-label">আজকের উপস্থিত</div>
                <div class="stat-value">১১৮</div>
                <i class="fas fa-check-circle stat-icon" style="color: var(--success-color);"></i>
            </div>
            <div class="stat-card warning">
                <div class="stat-label">মাসিক বেতন</div>
                <div class="stat-value">৳৫২.৫L</div>
                <i class="fas fa-money-bill-wave stat-icon" style="color: var(--warning-color);"></i>
            </div>
            <div class="stat-card danger">
                <div class="stat-label">ছুটির আবেদন</div>
                <div class="stat-value">১২</div>
                <i class="fas fa-calendar-times stat-icon" style="color: var(--danger-color);"></i>
            </div>
        </div>
@endsection