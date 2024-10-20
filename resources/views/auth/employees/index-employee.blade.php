@extends('auth.main')

@section('contents')
    <style>
        #employeeTable th, td {
            text-align: left !important;
        }
    </style>
    <div class="pagetitle">
        <h1>Nhân sự</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Quản lý</li>
                <li class="breadcrumb-item active">Nhân sự</li>
            </ol>
        </nav>
    </div>

    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2">
                <a href="{{route('add-employees-index')}}" class="d-flex align-items-center text-white">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Thêm nhân sự mới
                </a>
            </div>
            <div class="btn btn-success mx-2 btn-export">
                <a href="{{route('export-employees')}}" class="d-flex align-items-center text-white">
                    <i class="bi bi-file-earmark-arrow-down pe-2"></i>
                    Xuất file excel
                </a>
            </div>
        </div>
    </div>

    <!-- ======= Add Model  ======= -->
{{--    <div class="modal fade" id="addEmployeeModal">--}}
{{--        <div class="modal-dialog modal-lg">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title fw-bold">Thêm nhân sự</h5>--}}
{{--                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form id="addEmployeeForm" method="post" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="add_employee_name" class="form-label">Họ</label>--}}
{{--                                    <input type="text" class="form-control" id="first_name"--}}
{{--                                           name="first_name"--}}
{{--                                           required>--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="add_employee_name" class="form-label">Tên</label>--}}
{{--                                    <input type="text" class="form-control" id="last_name"--}}
{{--                                           name="last_name"--}}
{{--                                           required>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="img" class="form-label">Hình ảnh</label>--}}
{{--                                    <input type="file" class="form-control" id="img" name="img">--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <fieldset class="row">--}}
{{--                                        <legend class="col-form-label col-sm-4 pt-0">Giới tính</legend>--}}
{{--                                        <div class="d-flex">--}}
{{--                                            <div class="form-check me-3">--}}
{{--                                                <input class="form-check-input" type="radio" name="gender" id="male"--}}
{{--                                                       value="0" checked>--}}
{{--                                                <label class="form-check-label" for="male">--}}
{{--                                                    Nam--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="radio" name="gender" id="female"--}}
{{--                                                       value="1">--}}
{{--                                                <label class="form-check-label" for="female">--}}
{{--                                                    Nữ--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </fieldset>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="email" class="form-label">Email</label>--}}
{{--                                    <input type="email" class="form-control" id="email" name="email">--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="add_idcard" class="form-label">CMND/CCCD</label>--}}
{{--                                    <input type="number" class="form-control" id="cic_number" name="cic_number"--}}
{{--                                           required>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row mb-3">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="birth_date" class="form-label">Ngày sinh</label>--}}
{{--                                    <input type="date" class="form-control" id="birth_date" name="birth_date"--}}
{{--                                           required>--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="birth_place" class="form-label">Nơi sinh</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="birth_place"--}}
{{--                                            id="birth_place">--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row mb-3">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="place_of_resident" class="form-label">Nơi cư trú</label>--}}
{{--                                    <input type="text" class="form-control" id="place_of_resident"--}}
{{--                                           name="place_of_resident" required>--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="permanent_address" class="form-label">Địa chỉ thường trú</label>--}}
{{--                                    <input type="text" class="form-control" id="permanent_address"--}}
{{--                                           name="permanent_address" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="education_level_id" class="form-label">Trình độ học vấn</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="education_level_id"--}}
{{--                                            id="education_level_id">--}}
{{--                                        @foreach ($edu_level_list as $item)--}}
{{--                                            <option--}}
{{--                                                value="{{ $item->education_level_id}}">{{ $item->education_level_name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="job_position_id" class="form-label">Vị trí công việc</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="job_position_id"--}}
{{--                                            id="job_position_id">--}}
{{--                                        @foreach ($position_list as $item)--}}
{{--                                            <option--}}
{{--                                                value="{{ $item->job_position_id }}">{{ $item->job_position_name . ' - ' . $item->position_level}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-4">--}}
{{--                                    <label for="status" class="form-label">Trạng thái</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="status" id="status">--}}
{{--                                        <option value="0">Đã nghỉ việc</option>--}}
{{--                                        <option value="1">Đang làm việc</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="col-4">--}}
{{--                                    <label for="type_employee_id" class="form-label">Loại nhân viên</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="type_employee_id"--}}
{{--                                            id="type_employee_id">--}}
{{--                                        @foreach ($type_employee_list as $item)--}}
{{--                                            <option--}}
{{--                                                value="{{ $item->type_employee_id}}">{{ $item->type_employee_name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="col-4">--}}
{{--                                    <label for="department_id" class="form-label">Phòng ban</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="department_id"--}}
{{--                                            id="department_id">--}}
{{--                                        @foreach ($department_list as $item)--}}
{{--                                            <option--}}
{{--                                                value="{{ $item->department_id}}">{{ $item->department_name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="btn btn-primary">Thêm</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- ======= Edit Model  ======= -->
{{--    <div class="modal fade" id="editEmployeeModal">--}}
{{--        <div class="modal-dialog modal-lg">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title fw-bold">Chỉnh sửa thông tin nhân sự</h5>--}}
{{--                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form id="editEmployeeForm" method="post" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-3">--}}
{{--                                    <img class="border rounded-pill object-fit-cover" width="125px" height="125px"--}}
{{--                                         id="current_img" src="">--}}
{{--                                </div>--}}
{{--                                <div class="col-9">--}}
{{--                                    <div class="row mb-3">--}}
{{--                                        <div class="col-3">--}}
{{--                                            <label for="add_employee_name" class="form-label">Họ</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-9">--}}
{{--                                            <input type="text" class="form-control" id="edit_first_name"--}}
{{--                                                   name="first_name"--}}
{{--                                                   required>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="row mb-3">--}}
{{--                                        <div class="col-3">--}}
{{--                                            <label for="add_employee_name" class="form-label">Tên</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-9">--}}
{{--                                            <input type="text" class="form-control" id="edit_last_name"--}}
{{--                                                   name="last_name"--}}
{{--                                                   required>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="row">--}}
{{--                                        <fieldset class="row">--}}
{{--                                            <div class="col-3">--}}
{{--                                                <legend class="col-form-label col-sm-4 pt-0">Giới tính</legend>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-9">--}}
{{--                                                <div class="d-flex">--}}
{{--                                                    <div class="form-check me-3">--}}
{{--                                                        <input class="form-check-input" type="radio" name="gender"--}}
{{--                                                               id="male"--}}
{{--                                                               value="0" checked>--}}
{{--                                                        <label class="form-check-label" for="male">--}}
{{--                                                            Nam--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-check">--}}
{{--                                                        <input class="form-check-input" type="radio" name="gender"--}}
{{--                                                               id="female"--}}
{{--                                                               value="1">--}}
{{--                                                        <label class="form-check-label" for="female">--}}
{{--                                                            Nữ--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </fieldset>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                            <div class="row mb-3">--}}
{{--                                <div class="col-12">--}}
{{--                                    <input type="file" id="edit_img" name="img" class="d-none">--}}
{{--                                    <label for="edit_img" class="btn btn-primary">--}}
{{--                                        <i class="bi bi-upload"></i> Hình ảnh mới--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="email" class="form-label">Email</label>--}}
{{--                                    <input type="email" class="form-control" id="edit_email" name="email">--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="edit_cic_number" class="form-label">CMND/CCCD</label>--}}
{{--                                    <input type="number" class="form-control" id="edit_cic_number" name="cic_number">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row mb-3">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="birth_date" class="form-label">Ngày sinh</label>--}}
{{--                                    <input type="date" class="form-control" id="edit_birth_date" name="birth_date">--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="birth_place" class="form-label">Nơi sinh</label>--}}
{{--                                    <select class="form-select" aria-label="Default" id="edit_birth_place"--}}
{{--                                            name="birth_place">--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row mb-3">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="place_of_resident" class="form-label">Nơi cư trú</label>--}}
{{--                                    <input type="text" class="form-control" id="edit_place_of_resident"--}}
{{--                                           name="place_of_resident">--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="permanent_address" class="form-label">Địa chỉ thường trú</label>--}}
{{--                                    <input type="text" class="form-control" id="edit_permanent_address"--}}
{{--                                           name="permanent_address">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="education_level_id" class="form-label">Trình độ học vấn</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="education_level_id"--}}
{{--                                            id="edit_education_level_id">--}}
{{--                                        @foreach ($edu_level_list as $item)--}}
{{--                                            <option--}}
{{--                                                value="{{ $item->education_level_id }}">{{ $item->education_level_name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="col-6">--}}
{{--                                    <label for="job_position_id" class="form-label">Vị trí công việc</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="job_position_id"--}}
{{--                                            id="edit_job_position_id">--}}
{{--                                        @foreach ($position_list as $item)--}}
{{--                                            <option--}}
{{--                                                value="{{ $item->job_position_id }}">{{$item->job_position_name . ' - ' . $item->position_level}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-4">--}}
{{--                                    <label for="status" class="form-label">Trạng thái</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="status" id="edit_status">--}}
{{--                                        <option value="0">Đã nghỉ việc</option>--}}
{{--                                        <option value="1">Đang làm việc</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="col-4">--}}
{{--                                    <label for="type_employee_id" class="form-label">Loại nhân viên</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="type_employee_id"--}}
{{--                                            id="edit_type_employee_id">--}}
{{--                                        @foreach ($type_employee_list as $item)--}}
{{--                                            <option--}}
{{--                                                value="{{ $item->type_employee_id }}">{{ $item->type_employee_name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="col-4">--}}
{{--                                    <label for="edit_department_id" class="form-label">Phòng ban</label>--}}
{{--                                    <select class="form-select" aria-label="Default" name="department_id"--}}
{{--                                            id="edit_department_id">--}}
{{--                                        @foreach ($department_list as $item)--}}
{{--                                            <option--}}
{{--                                                value="{{ $item->department_id}}">{{ $item->department_name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Danh sách nhân sự</h3>
        <div class="table-responsive">
            <table id="employeeTable" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Họ</th>
                    <th>Tên</th>
                    <th>Hình ảnh</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Trạng thái</th>
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
                        <td>{{ $item->gender === 0 ? 'Nam' : 'Nữ' }}</td>
                        <td>{{$item->birth_date}}</td>
                        <td>
                            @if($item->status === 0)
                                <span class="badge rounded-pill bg-danger">
                                    Đã nghỉ việc
                                </span>
                            @else
                                <span class="badge rounded-pill bg-success">
                                    Đang làm việc
                                </span>
                            @endif
                        </td>
                        <td>
                            <a
                                href="{{route('details-employees', $item->employee_id)}}"
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn">
                                <i class="bi bi-pencil-square"></i>
                            </a>
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
