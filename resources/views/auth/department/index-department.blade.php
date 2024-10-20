@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Phòng ban</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Quản lý</a></li>
                <li class="breadcrumb-item active">Phòng ban</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Thêm phòng ban mới
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Modal thêm (tìm hiểu Modal này trên BS5) ======= -->
    <div class="modal fade" id="addDepartmentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm phòng ban</h4>
                </div>
                <div class="modal-body">
                    <form id="addDepartmentForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_department_name" class="form-label">Mã phòng ban</label>
                            <input type="text" class="form-control" id="add_department_code" name="add_department_code"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_department_name" class="form-label">Tên phòng ban</label>
                            <input type="text" class="form-control" id="add_department_name" name="add_department_name"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
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
                    <h4 class="modal-title">Chỉnh sửa phòng ban</h4>
                </div>
                <div class="modal-body">
                    <form id="editDepartmentForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="department_code" class="form-label">Mã phòng ban</label>
                            <input type="text" class="form-control" id="department_code" name="department_code"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Tên phòng ban</label>
                            <input type="text" class="form-control" id="department_name" name="department_name"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Danh sách phòng ban</h3>
        <div class="table-responsive">
            <table id="departmentTable" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Mã phòng ban</th>
                    <th>Tên phòng ban</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="departmentTableBody">
                @php($stt = 1)
                @foreach ($department_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->department_code }}</td>
                        <td>{{ $item->department_name }}</td>
                        <td>
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->department_id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->department_id }}">
                                <i class="bi bi-trash3"></i>
                            </button>
                            |
                            <a
                                class="btn p-0 btn-primary border-0 bg-transparent text-success shadow-none details-depart-btn"
                                href="{{route('employee-of-department-index', $item->department_id)}}">
                                <i class="bi bi-eye-fill"></i>
                            </a>
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

        $('#addDepartmentForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-department') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        $('#addDepartmentModal').modal('hide');
                        toastr.success(response.message, "Successful");
                        setTimeout(function () {
                            location.reload()
                        }, 500);
                    } else {
                        toastr.error(response.message, "Error");
                    }
                },
                error: function (xhr) {
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

        $('#departmentTableBody').on('click', '.delete-btn', function () {
            var departmentId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this department ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-department', ':id') }}'.replace(':id', departmentId),
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
                                toastr.error("Failed to delete the department.",
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

        //Hiện chi tiết của dữ liệu
        $('#departmentTableBody').on('click', '.edit-btn', function () {
            var departmentId = $(this).data('id');

            $('#editDepartmentForm').data('id', departmentId);
            var url = "{{ route('edit-department', ':id') }}";
            url = url.replace(':id', departmentId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var data = response.department;
                    $('#department_code').val(data.department_code);
                    $('#department_name').val(data.department_name);
                    $('#editDepartmentModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        //Lưu lại dữ liệu khi chỉnh sửa
        $('#editDepartmentForm').submit(function (e) {
            e.preventDefault();
            var departmentId = $(this).data('id');
            var url = "{{ route('update-department', ':id') }}";
            url = url.replace(':id', departmentId);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#editDepartmentModal').modal('hide');
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

    </script>
@endsection
