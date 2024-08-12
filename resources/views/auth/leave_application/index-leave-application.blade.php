@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Leave Application</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Leave Application</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addLeaveApplication">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new leave application
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
    <div class="modal fade" id="addLeaveApplication">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Leave Application</h4>
                </div>
                <div class="modal-body">
                    <form id="addLeaveApplicationForm" enctype="multipart/form-data">
                        @csrf
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
                            <label for="edit_leave_type" class="form-label">Leave Type</label>
                            <select class="form-select" aria-label="Default" name="add_leave_type" id="add_leave_type">
                                @foreach ($leave_types as $item)
                                    <option value="{{ $item->type_leave_id}}">{{ $item->type_leave_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_start_date" class="form-label">Start date</label>
                            <input type="date" class="form-control" id="add_start_date" name="add_start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_end_date" class="form-label">End date</label>
                            <input type="date" class="form-control" id="add_end_date" name="add_end_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="add_status" name="add_status"  style="color: #6c757d; background-color: #e9ecef;" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Leave application</h3>
        <div class="table-responsive">
            <table id="LeaveApplicationTable" class="table table-hover table-borderless">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Employee name</th>
                    <th>Leave type</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="LeaveApplicationTableBody">
                @php($stt = 0)
                @foreach ($leave_application_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{$item->first_name.' '.$item->last_name}}</td>
                        <td>{{ $item->type_leave_name}}</td>
                        <td>{{ $item->start_date}}</td>
                        <td>{{ $item->end_date}}</td>
                        <td>
                            @if($item->status === 0)
                                <span class="badge rounded-pill bg-danger">
                                    No approved
                                </span>
                            @else
                                <span class="badge rounded-pill bg-success">
                                    Approved
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->application_id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->application_id }}">
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

        var table = $('#LeaveApplicationTable').DataTable();

        $('#addLeaveApplicationForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-leave-application') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addLeaveApplication').modal('hide');
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


        $('#LeaveApplicationTableBody').on('click', '.delete-btn', function () {
            var leaveapplicationId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this leave application ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-leave-application', ':id') }}'.replace(':id', leaveapplicationId),
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
                                toastr.error("Failed to delete the leave application.",
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
