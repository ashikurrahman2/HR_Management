  @extends('frontend.app')

  @section('title', 'Dashboard')
  @section('content')

     <!-- Overlay for mobile -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="fas fa-building"></i> HR Payroll</h4>
            <small>Management System</small>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> ড্যাশবোর্ড</a></li>
            <li><a href="#"><i class="fas fa-users"></i> কর্মচারী তালিকা</a></li>
            <li><a href="#"><i class="fas fa-money-bill-wave"></i> বেতন ব্যবস্থাপনা</a></li>
            <li><a href="#"><i class="fas fa-clock"></i> উপস্থিতি</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> ছুটির আবেদন</a></li>
            <li><a href="#"><i class="fas fa-file-invoice-dollar"></i> বেতন স্লিপ</a></li>
            <li><a href="#"><i class="fas fa-user-tie"></i> বিভাগ</a></li>
            <li><a href="#"><i class="fas fa-briefcase"></i> পদবী</a></li>
            <li><a href="#"><i class="fas fa-chart-line"></i> রিপোর্ট</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> সেটিংস</a></li>
            <li>
                <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> লগআউট
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        
     
        
        <!-- Page Content -->
        <div class="container-fluid p-4">
            <h1 class="page-title">ড্যাশবোর্ড</h1>
            
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card primary">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="stat-label primary-text">মোট কর্মচারী</div>
                                    <div class="stat-value">১২৫</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users stat-icon primary-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card success">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="stat-label success-text">আজকের উপস্থিত</div>
                                    <div class="stat-value">১১৮</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle stat-icon success-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card warning">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="stat-label warning-text">মাসিক বেতন</div>
                                    <div class="stat-value">৳৫২.৫L</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-wave stat-icon warning-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card danger">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="stat-label danger-text">ছুটির আবেদন</div>
                                    <div class="stat-value">১২</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-times stat-icon danger-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Employees Table -->
            <div class="card table-custom mb-4">
                <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                    <span>সাম্প্রতিক কর্মচারীগণ</span>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> নতুন যোগ করুন
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>আইডি</th>
                                    <th>নাম</th>
                                    <th>পদবী</th>
                                    <th>বিভাগ</th>
                                    <th>বেতন</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>কার্যক্রম</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($employees as $employee)
    <tr>
        <td><strong>{{ $employee->employee_id_number }}</strong></td>
        <td>
            <div class="d-flex align-items-center">
                <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem;">
                     {{ mb_strtoupper(mb_substr($employee->employee_name, 0, 2)) }}
                </div>
                <span>{{ $employee->employee_name }}</span>
            </div>
        </td>
        <td>{{ $employee->designation }}</td>
        <td>{{ $employee->section }}</td>
        <td>৳{{ number_format($employee->salary, 2) }}</td>
        <td>
            <span class="badge bg-{{ $employee->status == 'active' ? 'success' : 'danger' }}">
                {{ $employee->status == 'active' ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
            </span>
        </td>
        <td>
            <button class="btn btn-sm btn-primary btn-action"><i class="fas fa-eye"></i></button>
        </td>
    </tr>
@endforeach
                                {{-- <tr>
                                    <td><strong>#EMP002</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem; background: var(--success-color);">ফা</div>
                                            <span>ফাতেমা খাতুন</span>
                                        </div>
                                    </td>
                                    <td>এইচআর ম্যানেজার</td>
                                    <td>এইচআর বিভাগ</td>
                                    <td>৳৬৫,০০০</td>
                                    <td><span class="badge bg-success">সক্রিয়</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary btn-action"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-warning btn-action"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr> --}}
                                {{-- <tr>
                                    <td><strong>#EMP003</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem; background: var(--warning-color);">কা</div>
                                            <span>করিম মিয়া</span>
                                        </div>
                                    </td>
                                    <td>অ্যাকাউন্ট্যান্ট</td>
                                    <td>ফিন্যান্স</td>
                                    <td>৳৪৫,০০০</td>
                                    <td><span class="badge bg-warning">ছুটিতে</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary btn-action"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-warning btn-action"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr> --}}
                                {{-- <tr>
                                    <td><strong>#EMP004</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem; background: var(--info-color);">সা</div>
                                            <span>সালমা বেগম</span>
                                        </div>
                                    </td>
                                    <td>মার্কেটিং অফিসার</td>
                                    <td>মার্কেটিং</td>
                                    <td>৳৪০,০০০</td>
                                    <td><span class="badge bg-success">সক্রিয়</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary btn-action"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-warning btn-action"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr> --}}
                                {{-- <tr>
                                    <td><strong>#EMP005</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem; background: var(--danger-color);">জা</div>
                                            <span>জাহিদ হাসান</span>
                                        </div>
                                    </td>
                                    <td>জুনিয়র ডেভেলপার</td>
                                    <td>আইটি বিভাগ</td>
                                    <td>৳৩৫,০০০</td>
                                    <td><span class="badge bg-success">সক্রিয়</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary btn-action"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-warning btn-action"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger btn-action"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Recent Attendance & Leave Requests -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card table-custom">
                        <div class="card-header card-header-custom">
                            আজকের উপস্থিতি
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem;">রা</div>
                                    <div>
                                        <div class="fw-bold">রহিম আহমেদ</div>
                                        <small class="text-muted">সিনিয়র ডেভেলপার</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="text-success fw-bold">৯:০০ AM</div>
                                    <small class="text-muted">চেক-ইন</small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem; background: var(--success-color);">ফা</div>
                                    <div>
                                        <div class="fw-bold">ফাতেমা খাতুন</div>
                                        <small class="text-muted">এইচআর ম্যানেজার</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="text-success fw-bold">৮:৪৫ AM</div>
                                    <small class="text-muted">চেক-ইন</small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem; background: var(--danger-color);">জা</div>
                                    <div>
                                        <div class="fw-bold">জাহিদ হাসান</div>
                                        <small class="text-muted">জুনিয়র ডেভেলপার</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="text-danger fw-bold">৯:৩০ AM</div>
                                    <small class="text-muted">দেরি</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <div class="card table-custom">
                        <div class="card-header card-header-custom">
                            ছুটির আবেদন
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem; background: var(--warning-color);">কা</div>
                                    <div>
                                        <div class="fw-bold">করিম মিয়া</div>
                                        <small class="text-muted">২৫-২৮ নভেম্বর</small>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-success me-1"><i class="fas fa-check"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem; background: var(--info-color);">সা</div>
                                    <div>
                                        <div class="fw-bold">সালমা বেগম</div>
                                        <small class="text-muted">২২ নভেম্বর</small>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-success me-1"><i class="fas fa-check"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        @endsection
