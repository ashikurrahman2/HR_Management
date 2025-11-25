@extends('frontend.app')
@section('title', 'উপস্থিতি তালিকা')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="text-center text-primary fw-bold mb-4">
                <i class="bi bi-calendar-check"></i> কর্মচারী উপস্থিতি তালিকা
            </h4>
        </div>
    </div>

    <!-- ফিল্টার সেকশন -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('attendance.list') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">তারিখ থেকে</label>
                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">তারিখ পর্যন্ত</label>
                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">স্ট্যাটাস</label>
                        <select name="status" class="form-select">
                            <option value="">সব</option>
                            <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>উপস্থিত</option>
                            <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>অনুপস্থিত</option>
                            <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>বিলম্বে</option>
                            <option value="leave" {{ request('status') == 'leave' ? 'selected' : '' }}>ছুটি</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> অনুসন্ধান
                        </button>
                        <a href="{{ route('attendance.list') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-clockwise"></i> রিসেট
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- টেবিল সেকশন -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">ক্রমিক</th>
                            <th>কর্মচারীর নাম</th>
                            <th>পদবী</th>
                            <th class="text-center">তারিখ</th>
                            <th class="text-center">প্রবেশ সময়</th>
                            <th class="text-center">প্রস্থান সময়</th>
                            <th class="text-center">মোট সময়</th>
                            <th class="text-center">স্ট্যাটাস</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $index => $attendance)
                        <tr>
                            <td class="text-center">{{ $attendances->firstItem() + $index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle bg-primary text-white me-2">
                                        {{ substr($attendance->employee_name, 0, 1) }}
                                    </div>
                                    <strong>{{ $attendance->employee_name }}</strong>
                                </div>
                            </td>
                            <td>{{ $attendance->designation }}</td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark">
                                    {{ \Carbon\Carbon::parse($attendance->date)->locale('bn')->translatedFormat('d M, Y') }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($attendance->check_in)
                                    <span class="text-success fw-bold">
                                        <i class="bi bi-box-arrow-in-right"></i>
                                        {{ \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($attendance->check_out)
                                    <span class="text-danger fw-bold">
                                        <i class="bi bi-box-arrow-right"></i>
                                        {{ \Carbon\Carbon::parse($attendance->check_out)->format('h:i A') }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($attendance->total_hours)
                                    <span class="badge bg-info">{{ $attendance->total_hours }} ঘণ্টা</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($attendance->status == 'present')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> উপস্থিত
                                    </span>
                                @elseif($attendance->status == 'absent')
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle"></i> অনুপস্থিত
                                    </span>
                                @elseif($attendance->status == 'late')
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock"></i> বিলম্বে
                                    </span>
                                @elseif($attendance->status == 'leave')
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-calendar-x"></i> ছুটি
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    <h5>কোনো উপস্থিতি রেকর্ড পাওয়া যায়নি</h5>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($attendances->hasPages())
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-center">
                {{ $attendances->links() }}
            </div>
        </div>
        @endif
    </div>

    <!-- সামারি কার্ড -->
    <div class="row mt-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-center border-success shadow-sm">
                <div class="card-body">
                    <h3 class="text-success mb-0">{{ $summary['present'] ?? 0 }}</h3>
                    <small class="text-muted">মোট উপস্থিত</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-center border-danger shadow-sm">
                <div class="card-body">
                    <h3 class="text-danger mb-0">{{ $summary['absent'] ?? 0 }}</h3>
                    <small class="text-muted">মোট অনুপস্থিত</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-center border-warning shadow-sm">
                <div class="card-body">
                    <h3 class="text-warning mb-0">{{ $summary['late'] ?? 0 }}</h3>
                    <small class="text-muted">মোট বিলম্বে</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-center border-secondary shadow-sm">
                <div class="card-body">
                    <h3 class="text-secondary mb-0">{{ $summary['leave'] ?? 0 }}</h3>
                    <small class="text-muted">মোট ছুটি</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
    }
    
    .table thead th {
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .badge {
        padding: 6px 12px;
        font-size: 0.875rem;
    }
</style>
@endsection