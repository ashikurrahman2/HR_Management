   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- html2pdf.js (PDF তৈরির জন্য) -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script> --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #4e73df;
            --success-color: #1cc88a;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --info-color: #36b9cc;
            --dark-color: #2c3e50;
            --light-bg: #f8f9fc;
            --white: #ffffff;
            --border-color: #e3e6f0;
            --text-muted: #858796;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            padding-bottom: 70px;
            overflow-x: hidden;
        }

        /* Header */
        .mobile-header {
            background: linear-gradient(135deg, var(--primary-color), #2e59d9);
            color: white;
            padding: 15px 20px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title h4 {
            font-size: 1.2rem;
            margin-bottom: 2px;
        }

        .header-title small {
            font-size: 0.75rem;
            opacity: 0.9;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .header-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* Main Content */
        .main-content {
            margin-top: 70px;
            padding: 15px;
        }

        .page-title {
            font-size: 1.5rem;
            color: var(--dark-color);
            margin-bottom: 20px;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-left: 4px solid;
            position: relative;
        }

        .stat-card.primary { border-left-color: var(--primary-color); }
        .stat-card.success { border-left-color: var(--success-color); }
        .stat-card.warning { border-left-color: var(--warning-color); }
        .stat-card.danger { border-left-color: var(--danger-color); }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--dark-color);
        }

        .stat-icon {
            font-size: 1.8rem;
            opacity: 0.3;
            position: absolute;
            right: 15px;
            top: 15px;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 15px;
        }

        .card-header {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: var(--dark-color);
        }

        .card-body {
            padding: 15px;
        }

        /* Employee & Attendance Items */
        .employee-item, .attendance-item, .leave-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .employee-item:last-child, .attendance-item:last-child, .leave-item:last-child {
            border-bottom: none;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), #2e59d9);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 12px;
            flex-shrink: 0;
            font-size: 1rem;
        }

        .employee-info, .attendance-info {
            flex: 1;
            min-width: 0;
        }

        .employee-name, .attendance-name {
            font-weight: 600;
            color: var(--dark-color);
            font-size: 0.95rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .employee-designation, .attendance-designation {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .employee-salary, .time-value {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .badge.success { background: #d4edda; color: #155724; }
        .badge.danger { background: #f8d7da; color: #721c24; }

        .btn {
            padding: 8px 15px;
            border-radius: 8px;
            border: none;
            font-size: 0.85rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary { background: var(--primary-color); color: white; }
        .btn-success { background: var(--success-color); color: white; }
        .btn-danger { background: var(--danger-color); color: white; }
        .btn-sm { padding: 5px 10px; font-size: 0.75rem; }
        .btn-action { width: 32px; height: 32px; padding: 0; justify-content: center; }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 10px 0 5px;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 0.7rem;
            padding: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
            min-width: 60px;
            position: relative;
        }

        .nav-item i {
            font-size: 1.3rem;
            margin-bottom: 3px;
        }

        .nav-item.active {
            color: var(--primary-color);
        }

        .nav-item.active i {
            transform: scale(1.1);
        }

        /* আরও মেনু ড্রপআপ */
        .more-menu-wrapper {
            position: relative;
        }

        .more-dropdown {
            position: absolute;
            bottom: 70px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            min-width: 210px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .more-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(-10px);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            color: var(--dark-color);
            text-decoration: none;
            font-size: 0.95rem;
            transition: background 0.2s;
            border-bottom: 1px solid var(--border-color);
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background: #f8f9fc;
            color: var(--primary-color);
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .more-overlay {
            position: fixed;
            inset: 0;
            background: transparent;
            z-index: 999;
            display: none;
        }

        .more-overlay.active {
            display: block;
        }

        @media (max-width: 360px) {
            .stats-grid { grid-template-columns: 1fr; }
            .nav-item { font-size: 0.65rem; min-width: 50px; }
            .nav-item i { font-size: 1.1rem; }
        }

.card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
        }
        .salary-card {
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            overflow: hidden;
            position: relative;
        }
        .list-group-item { border-left:0; border-right:0; padding:12px 20px; font-size:15px; }
        .list-group-item:first-child { border-top:0; }
        .list-group-item:last-child { border-bottom:0; }
        .amount-positive { color:#28a745; font-weight:600; }
        .amount-negative { color:#dc3545; font-weight:600; }
        .net-salary {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            font-size: 1.4rem;
            font-weight: bold;
            padding: 15px 20px;
            border-radius: 0 0 15px 15px;
        }
        .badge-month {
            background: rgba(255,255,255,0.2);
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 14px;
        }
        .btn-pdf {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 10;
            background: rgba(255,255,255,0.9);
            border: none;
            border-radius: 50px;
            padding: 8px 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        .btn-pdf i { color: #e74c3c; font-size: 1.3rem; }
    </style>