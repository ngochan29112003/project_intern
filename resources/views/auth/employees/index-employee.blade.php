@extends('auth.main')

@section('contents')
    <style>
        #employeeTable th, td {
            text-align: left !important;
        }
    </style>
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
                    <h5 class="modal-title fw-bold">Add employee</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="add_employee_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name"
                                           name="first_name"
                                           required>
                                </div>
                                <div class="col-6">
                                    <label for="add_employee_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name"
                                           name="last_name"
                                           required>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="img" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="img" name="img">
                                </div>
                                <div class="col-6">
                                    <fieldset class="row">
                                        <legend class="col-form-label col-sm-4 pt-0">Gender</legend>
                                        <div class="d-flex">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                       value="0" checked>
                                                <label class="form-check-label" for="male">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                       value="1">
                                                <label class="form-check-label" for="female">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="col-6">
                                    <label for="add_idcard" class="form-label">Citizen identity Card Number</label>
                                    <input type="number" class="form-control" id="cic_number" name="cic_number"
                                           required>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="birth_date" class="form-label">Birth day</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                                           required>
                                </div>
                                <div class="col-6">
                                    <label for="birth_place" class="form-label">Birth place</label>
                                    <select class="form-select" aria-label="Default" name="birth_place"
                                            id="birth_place">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="place_of_resident" class="form-label">Place of Residence</label>
                                    <input type="text" class="form-control" id="place_of_resident"
                                           name="place_of_resident" required>
                                </div>
                                <div class="col-6">
                                    <label for="permanent_address" class="form-label">Permanent Address</label>
                                    <input type="text" class="form-control" id="permanent_address"
                                           name="permanent_address" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="education_level_id" class="form-label">Education level</label>
                                    <select class="form-select" aria-label="Default" name="education_level_id"
                                            id="education_level_id">
                                        @foreach ($edu_level_list as $item)
                                            <option
                                                value="{{ $item->education_level_id}}">{{ $item->education_level_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="job_position_id" class="form-label">Job position</label>
                                    <select class="form-select" aria-label="Default" name="job_position_id"
                                            id="job_position_id">
                                        @foreach ($position_list as $item)
                                            <option
                                                value="{{ $item->job_position_id }}">{{ $item->job_position_name . ' - ' . $item->position_level}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default" name="status" id="status">
                                        <option value="0">No longer employed</option>
                                        <option value="1">Currently employed</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="type_employee_id" class="form-label">Employee type</label>
                                    <select class="form-select" aria-label="Default" name="type_employee_id"
                                            id="type_employee_id">
                                        @foreach ($type_employee_list as $item)
                                            <option
                                                value="{{ $item->type_employee_id}}">{{ $item->type_employee_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="department_id" class="form-label">Department</label>
                                    <select class="form-select" aria-label="Default" name="department_id"
                                            id="department_id">
                                        @foreach ($department_list as $item)
                                            <option
                                                value="{{ $item->department_id}}">{{ $item->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                    <h5 class="modal-title fw-bold">Edit employee</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <div class="row">
                                <div class="col-3">
                                    <img class="border rounded-pill object-fit-cover" width="125px" height="125px"
                                         id="current_img" src="">
                                </div>
                                <div class="col-9">
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label for="add_employee_name" class="form-label">First Name</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="edit_first_name"
                                                   name="first_name"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3">
                                            <label for="add_employee_name" class="form-label">Last Name</label>
                                        </div>
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="edit_last_name"
                                                   name="last_name"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <fieldset class="row">
                                            <div class="col-3">
                                                <legend class="col-form-label col-sm-4 pt-0">Gender</legend>
                                            </div>
                                            <div class="col-9">
                                                <div class="d-flex">
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                               id="male"
                                                               value="0" checked>
                                                        <label class="form-check-label" for="male">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                               id="female"
                                                               value="1">
                                                        <label class="form-check-label" for="female">
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input type="file" id="edit_img" name="img" class="d-none">
                                <label for="edit_img" class="btn btn-primary">
                                    <i class="bi bi-upload"></i> New image
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="edit_email" name="email">
                                </div>
                                <div class="col-6">
                                    <label for="edit_cic_number" class="form-label">Citizen identity Card Number</label>
                                    <input type="number" class="form-control" id="edit_cic_number" name="cic_number">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="birth_date" class="form-label">Birth day</label>
                                    <input type="date" class="form-control" id="edit_birth_date" name="birth_date">
                                </div>
                                <div class="col-6">
                                    <label for="birth_place" class="form-label">Birth place</label>
                                    <select class="form-select" aria-label="Default" id="edit_birth_place"
                                            name="birth_place">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="place_of_resident" class="form-label">Place of Residence</label>
                                    <input type="text" class="form-control" id="edit_place_of_resident"
                                           name="place_of_resident">
                                </div>
                                <div class="col-6">
                                    <label for="permanent_address" class="form-label">Permanent Address</label>
                                    <input type="text" class="form-control" id="edit_permanent_address"
                                           name="permanent_address">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="education_level_id" class="form-label">Education level</label>
                                    <select class="form-select" aria-label="Default" name="education_level_id"
                                            id="edit_education_level_id">
                                        @foreach ($edu_level_list as $item)
                                            <option
                                                value="{{ $item->education_level_id }}">{{ $item->education_level_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="job_position_id" class="form-label">Job position</label>
                                    <select class="form-select" aria-label="Default" name="job_position_id"
                                            id="edit_job_position_id">
                                        @foreach ($position_list as $item)
                                            <option
                                                value="{{ $item->job_position_id }}">{{$item->job_position_name . ' - ' . $item->position_level}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default" name="status" id="edit_status">
                                        <option value="0">No longer employed</option>
                                        <option value="1">Currently employed</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="type_employee_id" class="form-label">Employee type</label>
                                    <select class="form-select" aria-label="Default" name="type_employee_id"
                                            id="edit_type_employee_id">
                                        @foreach ($type_employee_list as $item)
                                            <option
                                                value="{{ $item->type_employee_id }}">{{ $item->type_employee_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="edit_department_id" class="form-label">Department</label>
                                    <select class="form-select" aria-label="Default" name="department_id"
                                            id="edit_department_id">
                                        @foreach ($department_list as $item)
                                            <option
                                                value="{{ $item->department_id}}">{{ $item->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Employee</h3>
        <div class="table-responsive">
            <table id="employeeTable" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>img</th>
                    <th>Gender</th>
                    <th>Birth Day</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="employeeTableBody">
                @php($stt = 0)
                @foreach($employee_list as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->first_name}}</td>
                        <td>{{$item->last_name}}</td>
                        <td class="text-center"><img class="rounded-pill object-fit-cover"
                                                     src="{{asset('assets/employee_img/'.$item->img)}}" alt=""
                                                     width="75"
                                                     height="75"></td>
                        <td>{{ $item->gender === 0 ? 'Male' : 'Female' }}</td>
                        <td>{{$item->birth_date}}</td>
                        <td>
                            @if($item->status === 0)
                                <span class="badge rounded-pill bg-danger">
                                    No longer employed
                                </span>
                            @else
                                <span class="badge rounded-pill bg-success">
                                    Currently employed
                                </span>
                            @endif
                        </td>
                        <td>
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

        $.ajax({
            url: 'https://esgoo.net/api-tinhthanh/1/0.htm',
            method: 'GET',
            success: function (response) {
                if (response.error === 0) {
                    var provinces = response.data;
                    $.each(provinces, function (index, province) {
                        $('#birth_place').append('<option value="' + province.name + '">' + province.name + '</option>');
                        $('#edit_birth_place').append('<option value="' + province.name + '">' + province.name + '</option>');
                    });
                } else {
                    console.log('Không thể tải dữ liệu tỉnh thành.');
                }
            },
            error: function () {
                console.log('Có lỗi xảy ra khi gọi API.');
            }
        });

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
                    var data = response.employee;
                    $('#edit_first_name').val(data.first_name);
                    $('#edit_last_name').val(data.last_name);
                    if (data.img) {
                        var imagePath = '{{asset('assets/employee_img')}}' + '/' + data.img;
                        $('#current_img').attr('src', imagePath)
                    }
                    $('input[name="gender"][value="' + data.gender + '"]').prop('checked', true);
                    $('#edit_email').val(data.email);
                    $('#edit_cic_number').val(data.cic_number);
                    $('#edit_birth_date').val(data.birth_date);
                    $('#edit_birth_place').val(data.birth_place);
                    $('#edit_place_of_resident').val(data.place_of_resident);
                    $('#edit_permanent_address').val(data.permanent_address);
                    $('#edit_education_level_id').val(data.education_level_id);
                    $('#edit_job_position_id').val(data.job_position_id);
                    $('#edit_status').val(data.status);
                    $('#edit_type_employee_id').val(data.type_employee_id);
                    $('#edit_department_id').val(data.department_id);
                    $('#editEmployeeModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        $('#editEmployeeForm').submit(function (e) {
            e.preventDefault();
            var employee_id = $(this).data('id'); // Lấy ID từ form
            var url = "{{ route('update-employees', ':id') }}";
            url = url.replace(':id', employee_id);
            var formData = new FormData(this);
            console.log(formData.get('img'));
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#editEmployeeModal').modal('hide');
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
                                setTimeout(function () {
                                    location.reload()
                                }, 500);
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
