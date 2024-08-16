@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Department</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Department</li>
                <li class="breadcrumb-item active">{{$deparmentInfo->department_name}}</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add employees
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
    <div class="modal fade" id="addDepartmentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new employees to the department</h4>
                </div>
                <div class="modal-body">
                    <form id="addDepartmentListForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="add_employeeNotDepart" class="form-label">Employee list</label>
                            <select class="form-select" aria-label="Default" name="employeeNotDepart"
                                    id="add_employeeNotDepart">
                                @foreach ($employee_list as $item)
                                    @if($item->department_id === 0)
                                        <option value="{{$item->employee_id}}">{{$item->first_name.' '.$item->last_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <input type="int" class="form-control" id="add_department_id" name="department_id" value="{{$deparmentInfo->department_id}}" hidden>


                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ======= Modal sửa ======= -->
    <div class="modal fade" id="editDepartmentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit department</h4>
                </div>
                <div class="modal-body">
                    <form id="editDepartmentForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="department_code" class="form-label">Department Code</label>
                            <input type="text" class="form-control" id="department_code" name="department_code"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="department_name" name="department_name"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save change</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Employees of {{$deparmentInfo->department_name}} list</h3>
        <div class="table-responsive">
            <table id="departmentList" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>img</th>
                    <th>Gender</th>
                    <th style="width: 50px">Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="departmentListTableBody">
                @php($stt = 0)
                @foreach($employee_list_in_depart as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->first_name}}</td>
                        <td>{{$item->last_name}}</td>
                        <td><img class="rounded-pill object-fit-cover"
                                                     src="{{asset('assets/employee_img/'.$item->img)}}" alt=""
                                                     width="75"
                                                     height="75"></td>
                        <td>{{ $item->gender === 0 ? 'Male' : 'Female' }}</td>
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
        var table = $('#departmentTable').DataTable();

        {{--$('#addDepartmentForm').submit(function (e) {--}}
        {{--    e.preventDefault();--}}

        {{--    $.ajax({--}}
        {{--        url: '{{ route('add-department') }}',--}}
        {{--        method: 'POST',--}}
        {{--        data: $(this).serialize(),--}}
        {{--        success: function (response) {--}}
        {{--            if (response.success) {--}}
        {{--                $('#addDepartmentModal').modal('hide');--}}
        {{--                toastr.success(response.message, "Successful");--}}
        {{--                setTimeout(function () {--}}
        {{--                    location.reload()--}}
        {{--                }, 500);--}}
        {{--            } else {--}}
        {{--                toastr.error(response.message, "Error");--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function (xhr) {--}}
        {{--            toastr.error(response.message, "Error");--}}
        {{--            if (xhr.status === 400) {--}}
        {{--                var response = xhr.responseJSON;--}}
        {{--                toastr.error(response.message, "Error");--}}
        {{--            } else {--}}
        {{--                toastr.error("An error occurred", "Error");--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        {{--$('#departmentTableBody').on('click', '.delete-btn', function () {--}}
        {{--    var departmentId = $(this).data('id');--}}
        {{--    var row = $(this).closest('tr');--}}

        {{--    Swal.fire({--}}
        {{--        title: 'Are you sure?',--}}
        {{--        text: "Do you want to delete this department ?",--}}
        {{--        icon: 'warning',--}}
        {{--        showCancelButton: true,--}}
        {{--        confirmButtonColor: '#3085d6',--}}
        {{--        cancelButtonColor: '#d33',--}}
        {{--        confirmButtonText: 'Yes, delete it!'--}}
        {{--    }).then((result) => {--}}
        {{--        if (result.isConfirmed) {--}}
        {{--            $.ajax({--}}
        {{--                url: '{{ route('delete-department', ':id') }}'.replace(':id', departmentId),--}}
        {{--                method: 'DELETE',--}}
        {{--                data: {--}}
        {{--                    _token: '{{ csrf_token() }}'--}}
        {{--                },--}}
        {{--                success: function (response) {--}}
        {{--                    if (response.success) {--}}
        {{--                        table.row(row).remove().draw();--}}
        {{--                        toastr.success(response.message, "Deleted successfully");--}}
        {{--                        setTimeout(function () {--}}
        {{--                            location.reload()--}}
        {{--                        }, 500);--}}
        {{--                    } else {--}}
        {{--                        toastr.error("Failed to delete the department.",--}}
        {{--                            "Operation Failed");--}}
        {{--                    }--}}
        {{--                },--}}
        {{--                error: function (xhr) {--}}
        {{--                    toastr.error("An error occurred.", "Operation Failed");--}}
        {{--                }--}}
        {{--            });--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        {{--//Hiện chi tiết của dữ liệu--}}
        {{--$('#departmentTableBody').on('click', '.edit-btn', function () {--}}
        {{--    var departmentId = $(this).data('id');--}}

        {{--    $('#editDepartmentForm').data('id', departmentId);--}}
        {{--    var url = "{{ route('edit-department', ':id') }}";--}}
        {{--    url = url.replace(':id', departmentId);--}}
        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        method: 'GET',--}}
        {{--        success: function (response) {--}}
        {{--            var data = response.department;--}}
        {{--            $('#department_code').val(data.department_code);--}}
        {{--            $('#department_name').val(data.department_name);--}}
        {{--            $('#editDepartmentModal').modal('show');--}}
        {{--        },--}}
        {{--        error: function (xhr) {--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        {{--//Lưu lại dữ liệu khi chỉnh sửa--}}
        {{--$('#editDepartmentForm').submit(function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    var departmentId = $(this).data('id');--}}
        {{--    var url = "{{ route('update-department', ':id') }}";--}}
        {{--    url = url.replace(':id', departmentId);--}}
        {{--    var formData = new FormData(this);--}}
        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        method: 'POST',--}}
        {{--        data: formData,--}}
        {{--        contentType: false,--}}
        {{--        processData: false,--}}
        {{--        success: function (response) {--}}
        {{--            if (response.success) {--}}
        {{--                $('#editDepartmentModal').modal('hide');--}}
        {{--                toastr.success(response.response, "Edit successful");--}}
        {{--                setTimeout(function () {--}}
        {{--                    location.reload()--}}
        {{--                }, 500);--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function (xhr) {--}}
        {{--            toastr.error("Error");--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endsection
