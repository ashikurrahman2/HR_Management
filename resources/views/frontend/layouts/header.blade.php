 <div class="main-content" id="mainContent">

<!-- Navbar -->
        <nav class="navbar navbar-custom">
            <div class="container-fluid">
                <div class="d-flex align-items-center w-100">
                    <button class="btn btn-link text-dark me-3" id="sidebarToggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                    
                    <div class="search-wrapper flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="অনুসন্ধান করুন...">
                    </div>
                    
                    <div class="ms-auto d-flex align-items-center gap-3">
                        <button class="btn btn-link text-dark position-relative">
                            <i class="fas fa-bell fa-lg"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                5
                            </span>
                        </button>
                        
                        <div class="user-profile">
                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                            <div class="d-none d-md-block">
                              <div class="fw-bold" style="font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                           <small class="text-muted">
                                {{ \App\Models\EmployeeList::where('employee_id_number', Auth::user()->id)->value('designation') ?? 'এইচআর ম্যানেজার' }}
                            </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

 </div>