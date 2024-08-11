@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Payroll</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Payroll</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addPayroll">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new payroll
                </div>
            </div>
            <div class="btn btn-success mx-2 btn-export">
                <a href="" class="d-flex align-items-center text-white">
                    <i class="bi bi-file-earmark-arrow-down pe-2"></i>
                    Export file excel
                </a>
            </div>
        </div>
    </div>

    <!-- ======= Modal thêm (tìm hiểu Modal này trên BS5) ======= -->
    <div class="modal fade" id="addPayroll">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add payroll</h4>
                </div>
                <div class="modal-body">
                    <form id="addPayrollForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_payroll_code" class="form-label">Payroll code</label>
                            <input type="text" class="form-control" id="add_payroll_code" name="add_payroll_code"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_employee_id" class="form-label">Employee name</label>
                            <select class="form-select" aria-label="Default" name="add_employee_id" id="add_employee_id">
                                @foreach ($employee_list as $item)
                                    <option value="{{ $item->employee_id}}">{{$item->first_name.' '.$item->last_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_position_id" class="form-label">Position name</label>
                            <select class="form-select" aria-label="Default" name="add_position_id" id="add_position_id">
                                @foreach ($position_list as $item)
                                    <option value="{{ $item->job_position_id }}">{{ $item->job_position_code . ' - ' . $item->job_position_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_monthly_salary" class="form-label">Monthly salary</label>
                            <input type="text" class="form-control" id="add_monthly_salary" name="add_monthly_salary" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_work_days" class="form-label">Work days</label>
                            <input type="text" class="form-control" id="add_work_days" name="add_work_days" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_net_salary" class="form-label">Net salary</label>
                            <input type="text" class="form-control" id="add_net_salary" name="add_net_salary" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Payroll</h3>
        <div class="table-responsive">
            <table id="PayrollTable" class="table table-hover table-borderless">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Payroll code</th>
                    <th>Employee name</th>
                    <th>Position name</th>
                    <th>Monthly salary</th>
                    <th>Work days</th>
                    <th>Net salary</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="payrollTableBody">
                @php($stt = 0)
                @foreach ($payroll_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->payroll_code}}</td>
                        <td>{{ $item->employee_name}}</td>
                        <td>{{ $item->job_position_name}}</td>
                        <td>{{ $item->monthly_salary}}</td>
                        <td>{{ $item->work_days}}</td>
                        <td>{{ $item->net_salary}}</td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->payroll_id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->payroll_id}}">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var table = $('#payrollTable').DataTable();

        $('#addPayrollForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-payroll') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addPayrollModalModal').modal('hide');
                        toastr.success(response.messMEage, "Successful");
                        setTimeout(function() {
                            location.reload()
                        }, 500);
                    } else {
                        toastr.error(response.message, "Error");
                    }
                },
                error: function(xhr) {
                    toastr.error(response.message, "Error");
                    if (xhr.status === 400) {
                        var response = xhr.responseJSON;
                        toastr.error(response.message, "Error");
                    } else {
                        toastr.error("An error occurred", "Error");
                    }
                }
            });
        });


        $('#payrollTableBody').on('click', '.delete-btn', function () {
            var payrollId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this payroll ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-payroll', ':id') }}'.replace(':id', payrollId),
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                table.row(row).remove().draw();
                                toastr.success(response.message, "Deleted successfully");
                                setTimeout(function () {
                                    location.reload()
                                }, 500);
                            } else {
                                toastr.error("Failed to delete the payroll.",
                                    "Operation Failed");
                            }
                        },
                        error: function (xhr) {
                            toastr.error("An error occurred.", "Operation Failed");
                        }
                    });
                }
            });
        });
    </script>
@endsection
