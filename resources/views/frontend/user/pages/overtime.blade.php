@extends('frontend.app')
@section('title', 'ওভারটাইম হিসাব')

@section('content')
<!-- Bootstrap Icons CDN যোগ করুন -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    :root {
        --primary: #1d4ed8;
        --success: #10b981;
        --danger: #ef4444;
        --dark: #1f2937;
        --light: #f8fafc;
    }
    
    body {
        font-family: 'Hind Siliguri', sans-serif;
        background: var(--light);
    }

    .header {
        background: linear-gradient(135deg, var(--primary), #2563eb);
        color: white;
        text-align: center;
        padding: 2rem 1rem 1.5rem;
        border-radius: 0 0 24px 24px;
        box-shadow: 0 10px 25px rgba(29, 78, 216, 0.3);
        margin-bottom: 2rem;
    }
    .header h1 { font-size: 1.8rem; font-weight: 700; margin: 0; }
    .header p { font-size: 0.95rem; opacity: 0.9; margin: 0.4rem 0 0; }

    .add-section {
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        padding: 1.5rem;
        border-radius: 20px;
        margin-bottom: 1.5rem;
    }

    .form-control, .form-select {
        border-radius: 14px;
        padding: 0.9rem 1rem;
        font-size: 1.05rem;
        border: 1.5px solid #cbd5e1;
    }

    .btn-add {
        background: var(--success);
        border: none;
        border-radius: 50px;
        padding: 0.9rem 1.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        width: 100%;
        margin-top: 0.8rem;
        box-shadow: 0 6px 15px rgba(16, 185, 129, 0.3);
        color: white;
    }
    .btn-add:hover {
        background: #059669;
    }

    .card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .table th {
        background: var(--primary);
        color: white;
        font-weight: 600;
        text-align: center;
        font-size: 0.9rem;
        padding: 0.9rem 0.6rem;
    }
    .table td {
        padding: 1rem 0.6rem;
        text-align: center;
        vertical-align: middle;
    }
    .hours {
        font-weight: 600;
        color: var(--success);
        font-size: 1.05rem;
    }

    .total-box {
        background: linear-gradient(135deg, var(--primary), #3b82f6);
        color: white;
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 10px 25px rgba(29, 78, 216, 0.3);
    }
    .total-box h2 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0.5rem 0;
    }

    .remove-btn {
        font-size: 1.4rem;
        color: var(--danger);
        cursor: pointer;
        transition: all 0.2s;
    }
    .remove-btn:hover { transform: scale(1.2); }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #64748b;
        font-size: 1.1rem;
    }

    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>

<div class="header">
    <h1>ওভারটাইম হিসাব</h1>
    <p>মোট ওটি ট্র্যাক করুন সহজে</p>
</div>

<div class="container" style="max-width: 480px;">

    <!-- Add New OT -->
    <div class="add-section">
        <h5 class="mb-3 fw-bold text-primary">
            <i class="bi bi-plus-circle-dotted"></i> নতুন এন্ট্রি
        </h5>
        <form id="otForm">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <select class="form-select" id="employeeSelect" name="employee_list_id" required>
                        <option value="">কর্মচারী নির্বাচন করুন</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <input type="date" class="form-control" id="otDate" name="ot_date" required>
                </div>
                <div class="col-6">
                    <input type="time" class="form-control" id="otStart" name="start_time" value="18:00" required>
                </div>
                <div class="col-6">
                    <input type="time" class="form-control" id="otEnd" name="end_time" value="22:00" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-add">
                        <i class="bi bi-plus-lg"></i> যোগ করুন
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Employee Filter -->
    <div class="mb-3">
        <select class="form-select" id="filterEmployee" onchange="filterByEmployee()">
            <option value="">সব কর্মচারী দেখান</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Table Card -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead>
                        <tr>
                            <th>নাম</th>
                            <th>তারিখ</th>
                            <th>শুরু</th>
                            <th>শেষ</th>
                            <th>ঘণ্টা</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="otBody">
                        @forelse($overtimes as $ot)
                        <tr data-id="{{ $ot->id }}" data-employee="{{ $ot->employee_list_id }}" data-hours="{{ $ot->hours }}">
                            <td>{{ $ot->employee_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($ot->ot_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($ot->start_time)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($ot->end_time)->format('H:i') }}</td>
                            <td class="hours">{{ number_format($ot->hours, 2) }}</td>
                            <td>
                                <i class="bi bi-trash3-fill remove-btn" onclick="deleteOT({{ $ot->id }})"></i>
                            </td>
                        </tr>
                        @empty
                        <tr id="emptyRow">
                            <td colspan="6" class="empty-state">
                                <i class="bi bi-clock-history display-4 text-muted"></i>
                                <p class="mt-3">কোনো ওভারটাইম এন্ট্রি নেই</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Total -->
    <div class="total-box">
        <h5 class="mb-0 opacity-90">মোট ওভারটাইম</h5>
        <h2 id="totalHours">0.00 ঘণ্টা</h2>
        <p class="mb-0" id="totalDays">≈ 0.00 দিন (৮ ঘণ্টা = ১ দিন)</p>
    </div>

</div>

<script>
    // Initialize date to today
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('otDate').value = today;
        calculateTotal();
    });

    // Add OT Form Submit
    document.getElementById('otForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = {
            employee_list_id: formData.get('employee_list_id'),
            ot_date: formData.get('ot_date'),
            start_time: formData.get('start_time'),
            end_time: formData.get('end_time'),
        };

        console.log('Sending data:', data); // Debug

        fetch('{{ route("overtime.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            console.log('Response status:', response.status); // Debug
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data); // Debug
            if(data.success) {
                showAlert('success', data.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                showAlert('danger', 'সমস্যা হয়েছে!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'সমস্যা হয়েছে! ' + error.message);
        });
    });

    // Delete OT
    function deleteOT(id) {
        if (!confirm('এই এন্ট্রিটি মুছে ফেলবেন?')) return;

        fetch(`/overtime/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.querySelector(`tr[data-id="${id}"]`).remove();
                calculateTotal();
                showAlert('success', data.message);
                
                // Show empty state if no rows
                if(document.querySelectorAll('#otBody tr[data-id]').length === 0) {
                    document.getElementById('otBody').innerHTML = `
                        <tr id="emptyRow">
                            <td colspan="6" class="empty-state">
                                <i class="bi bi-clock-history display-4 text-muted"></i>
                                <p class="mt-3">কোনো ওভারটাইম এন্ট্রি নেই</p>
                            </td>
                        </tr>
                    `;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'সমস্যা হয়েছে!');
        });
    }

    // Filter by Employee
    function filterByEmployee() {
        const employeeId = document.getElementById('filterEmployee').value;
        const rows = document.querySelectorAll('#otBody tr[data-id]');
        
        rows.forEach(row => {
            if (!employeeId || row.getAttribute('data-employee') == employeeId) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        calculateTotal();
    }

    // Calculate Total
    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('#otBody tr[data-id]').forEach(tr => {
            if (tr.style.display !== 'none') {
                total += parseFloat(tr.getAttribute('data-hours')) || 0;
            }
        });
        
        const days = (total / 8).toFixed(2);
        document.getElementById('totalHours').textContent = total.toFixed(2) + ' ঘণ্টা';
        document.getElementById('totalDays').textContent = `≈ ${days} দিন (৮ ঘণ্টা = ১ দিন)`;
    }

    // Show Alert Function
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(alertDiv);
        
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    }
</script>
@endsection