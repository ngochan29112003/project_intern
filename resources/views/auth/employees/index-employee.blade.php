@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Employee</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Employee</li>
            </ol>
        </nav>
    </div>

    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new employee
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

    <!-- ======= Add Model  ======= -->
    <div class="modal fade" id="addEmployeeModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add employee</h4>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="add_employee_name" class="form-label">Employee name</label>
                            <input type="text" class="form-control" id="add_employee_name" name="add_employee_name"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="add_img" class="form-label">Image</label>
                            <input type="file" class="form-control" id="add_img" name="add_img">
                        </div>
                        <div class="mb-3">
                            <label for="add_gender" class="form-label">Gender</label>
                            <select class="form-select" aria-label="Default" name="add_gender" id="add_gender">
                                <option value="0">Nam</option>
                                <option value="1">Nữ</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_birthday" class="form-label">Birth day</label>
                            <input type="date" class="form-control" id="add_birthday" name="add_birthday" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_birthplace" class="form-label">Birth place</label>
                            <input type="text" class="form-control" id="add_birthplace" name="add_birthplace" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_idcard" class="form-label">ID CARD</label>
                            <input type="text" class="form-control" id="add_idcard" name="add_idcard" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_edu" class="form-label">Education level</label>
                            <select class="form-select" aria-label="Default" name="add_edu" id="add_edu">
                                @foreach ($edu_level_list as $item)
                                    <option value="{{ $item->education_level_id}}">{{ $item->education_level_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_status" class="form-label">Status</label>
                            <select class="form-select" aria-label="Default" name="add_status" id="add_status">
                                <option value="0">Đã nghỉ việc</option>
                                <option value="1">Đang đi làm</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_employee_type" class="form-label">Employee type</label>
                            <select class="form-select" aria-label="Default" name="add_employee_type" id="add_employee_type">
                                @foreach ($type_employee_list as $item)
                                    <option value="{{ $item->type_employee_id}}">{{ $item->type_employee_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_job_position" class="form-label">Job position</label>
                            <select class="form-select" aria-label="Default" name="add_job_position" id="add_job_position">
                                @foreach ($position_list as $item)
                                    <option value="{{ $item->job_position_id }}">{{ $item->job_position_code . ' - ' . $item->job_position_name	}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Edit Model  ======= -->
    <div class="modal fade" id="editEmployeeModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit employee</h4>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_employee_name" class="form-label">Employee name</label>
                            <input type="text" class="form-control" id="edit_employee_name" name="edit_employee_name"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_img" class="form-label">Image</label>
                            <div class="row">
                                <div class="col-lg-2 ">
                                    <img class="border rounded-pill object-fit-cover" width="100px" height="100px" id="profileImage" src="">
                                </div>
                                <div class="col-lg-4 d-flex justify-content-center align-items-center">
                                    <input type="file" class="form-control" id="edit_img" name="edit_img">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_gender" class="form-label">Gender</label>
                            <select class="form-select" aria-label="Default" name="edit_gender" id="edit_gender">
                                <option value="0">Nam</option>
                                <option value="1">Nữ</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_birthday" class="form-label">Birth day</label>
                            <input type="date" class="form-control" id="edit_birthday" name="edit_birthday" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_birthplace" class="form-label">Birth place</label>
                            <input type="text" class="form-control" id="edit_birthplace" name="edit_birthplace" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_idcard" class="form-label">ID CARD</label>
                            <input type="text" class="form-control" id="edit_idcard" name="edit_idcard" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_edu" class="form-label">Education level</label>
                            <select class="form-select" aria-label="Default" name="edit_edu" id="edit_edu">
                                @foreach ($edu_level_list as $item)
                                    <option value="{{ $item->education_level_id}}">{{ $item->education_level_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-select" aria-label="Default" name="edit_status" id="edit_status">
                                <option value="0">Đã nghỉ việc</option>
                                <option value="1">Đang đi làm</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_employee_type" class="form-label">Employee type</label>
                            <select class="form-select" aria-label="Default" name="edit_employee_type" id="edit_employee_type">
                                @foreach ($type_employee_list as $item)
                                    <option value="{{ $item->type_employee_id}}">{{ $item->type_employee_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_job_position" class="form-label">Job position</label>
                            <select class="form-select" aria-label="Default" name="edit_job_position" id="edit_job_position">
                                @foreach ($position_list as $item)
                                    <option value="{{ $item->job_position_id }}">{{ $item->job_position_code . ' - ' . $item->job_position_name	}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Employee</h3>
        <div class="table-responsive">
            <table id="employeeTable" class="table table-hover table-borderless">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Employee name</th>
                    <th>img</th>
                    <th>Gender</th>
                    <th>Birth Day</th>
                    <th>Id card number</th>
                    <th>Education</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="employeeTableBody">
                @php($stt = 0)
                @foreach($employee_list as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->employee_name}}</td>
                        <td class="text-center"><img class="rounded-pill object-fit-cover"
                                                     src="{{asset('assets/employee_img/'.$item->img)}}" alt="" width="75"
                                                     height="75"></td>
                        <td>{{ $item->gender === 0 ? 'Nam' : 'Nữ' }}</td>
                        <td>{{$item->birth_date}}</td>
                        <td>{{$item->id_card_number}}</td>
                        <td>{{$item->education_level_name}}</td>
                        <td>{{$item->status === 1 ? 'Đang đi làm' : 'Đã nghỉ việc' }}</td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->employee_id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->employee_id }}">
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
        var table = $('#employeeTable').DataTable();
        // JS Add employee
        $('#addEmployeeForm').submit(function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('add-employees') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#addEmployeeModal').modal('hide');
                        toastr.success(response.message, "Successful");
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    } else {
                        toastr.error(response.message, "Error");
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 400) {
                        var response = xhr.responseJSON;
                        toastr.error(response.message, "Error");
                    } else {
                        toastr.error("An error occurred", "Error");
                    }
                }
            });
        });

        //Fill dữ liệu lên Modal edit
        $('#employeeTable').on('click', '.edit-btn', function () {
            var employee_id = $(this).data('id'); //Id này được nhận khi bấm btn chỉnh sửa

            $('#editEmployeeForm').data('id', employee_id);
            var url = "{{ route('edit-employees', ':id') }}";
            url = url.replace(':id', employee_id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var data = response.leave_app;
                    // $('#edit_employee_id').val(data.employee_id);
                    // $('#edit_pin').val(data.employee.employee_code);
                    // $('#edit_leave_type').val(data.leave_type.leave_type_id);
                    // $('#edit_apply_date').val(data.apply_date);
                    // $('#edit_start_date').val(data.start_date);
                    // $('#edit_end_date').val(data.end_date);
                    // $('#edit_duration').val(data.duration);
                    // $('#edit_leave_status').val(data.leave_status);
                    $('#editEmployeeModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });


        $('#editApplicationForm').submit(function (e) {
            e.preventDefault();
            var applicationID = $(this).data('id'); // Lấy ID từ form
            var url = "{{ route('update-employees', ':id') }}";
            url = url.replace(':id', applicationID);

            $.ajax({
                url: url,
                method: 'PUT',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        $('#editApplicationModal').modal('hide');
                        $('#successModal').modal('show');
                        toastr.success(response.response, "Edit successful");
                        setTimeout(function () {
                            location.reload()
                        }, 500);
                    }
                },
                error: function (xhr) {
                    toastr.error("Error");
                }
            });
        });

        //JS Delete employee
        $('#employeeTableBody').on('click', '.delete-btn', function () {
            var employeeId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this employee ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-employees', ':id') }}'.replace(':id', employeeId),
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                table.row(row).remove().draw();
                                toastr.success(response.message, "Deleted successfully");
                            } else {
                                toastr.error("Failed to delete the employee.",
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
