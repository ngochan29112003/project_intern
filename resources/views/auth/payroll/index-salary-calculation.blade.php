@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Salary Calculation</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Salary Calculation</li>
            </ol>
        </nav>
    </div>

    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addSalaryCalculationModal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new salary salculation
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

    <div class="modal fade" id="addSalaryCalculationModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add salary salculation</h4>
                </div>
                <div class="modal-body">
                    <form id="addSalaryCalculationForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="add_payroll_code" class="form-label">Payroll Code</label>
                            <input type="text" class="form-control" id="add_payroll_code" name="add_payroll_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_employee_id" class="form-label">Employee Name</label>
                            <select class="form-select" aria-label="Default" name="add_employee_id" id="add_employee_id">
                                @foreach ($employee_list as $item)
                                    <option value="{{ $item->employee_id}}">{{$item->first_name.' '.$item->last_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="add_work_day" class="form-label">Work days</label>
                            <input type="text" class="form-control" id="add_work_day" name="add_work_day" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_allowance" class="form-label">Allowance</label>
                            <select class="form-select" aria-label="Default" name="add_allowance" id="add_allowance">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_advance" class="form-label">Advance</label>
                            <select class="form-select" aria-label="Default" name="add_advance" id="add_advance">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="add_description" name="add_description" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Salary calculation</h3>
        <div class="table-responsive">
            <table id="salarycalculationTable" class="table table-hover table-borderless">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Payroll code</th>
                    <th>Employee name</th>
                    <th>Work day</th>
                    <th>Allowance</th>
                    <th>Advance</th>
                    <th>Description</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="salarycalculationTableBody">
                @php($stt = 0)
                @foreach($salarycalculation_list as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->payroll_code}}</td>
                        <td>{{$item->first_name.' '.$item->last_name}}</td>
                        <td>{{$item->work_days}}</td>
                        <td>{{$item->allowance === 0 ? 'Yes' : 'No'}}</td>
                        <td>{{$item->advance === 0 ? 'Yes' : 'No'}}</td>
                        <td>{{$item->description}}</td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->salary_calculation_id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->salary_calculation_id}}">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var table = $('#salarycalculationTable').DataTable();

        // JS Add position
        $('#addSalaryCalculationForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('add-salary-calculation') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $('#addSalaryCalculationModal').modal('hide');
                        toastr.success(response.message, "Successful");
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    } else {
                        toastr.error(response.message, "Error");
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 400) {
                        var response = xhr.responseJSON;
                        toastr.error(response.message, "Error");
                    } else {
                        toastr.error("An error occurred", "Error");
                    }
                }
            });
        });

        //JS Delete position
        $('#salarycalculationTableBody').on('click', '.delete-btn', function() {
            var positionId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this position ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-employees', ':id') }}'.replace(':id', positionId),
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                table.row(row).remove().draw();
                                toastr.success(response.message, "Deleted successfully");
                            } else {
                                toastr.error("Failed to delete the employee.",
                                    "Operation Failed");
                            }
                        },
                        error: function(xhr) {
                            toastr.error("An error occurred.", "Operation Failed");
                        }
                    });
                }
            });
        });
    </script>
@endsection
