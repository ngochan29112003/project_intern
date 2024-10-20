@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Quyền</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Hệ thống</a></li>
                <li class="breadcrumb-item active">Quyền</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addPermission">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Thêm quyền mới
                </div>
            </div>
            <div class="btn btn-success mx-2 btn-export">
                <a href="" class="d-flex align-items-center text-white">
                    <i class="bi bi-file-earmark-arrow-down pe-2"></i>
                    Xuất file excel
                </a>
            </div>
        </div>
    </div>

    <!-- ======= Modal thêm (tìm hiểu Modal này trên BS5) ======= -->
    <div class="modal fade" id="addPermission">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm quyền</h4>
                </div>
                <div class="modal-body">
                    <form id="addPermissionForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_permission_name" class="form-label">Tên quyền</label>
                            <input type="text" class="form-control" id="add_permission_name" name="add_permission_name"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ======= Modal sửa ======= -->
    <div class="modal fade" id="editPermissionModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sửa quyền</h4>
                </div>
                <div class="modal-body">
                    <form id="editPermissionForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="permission_name" class="form-label">Tên quyền</label>
                            <input type="text" class="form-control" id="permission_name" name="permission_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Danh sách quyền</h3>
        <table id="PermissionTable" class="table table-hover table-bordered">
            <thead class="table-light">
            <tr>
                <th>STT</th>
                <th>Tên quyền</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody id="permissionTableBody">
            @php($stt = 0)
            @foreach ($permission_list as $item)
                <tr>
                    <td>{{ $stt++ }}</td>
                    <td>{{ $item->permission_name}}</td>
                    <td class="text-center">
                        <button
                            class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                            data-id="{{ $item->permission_id}}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        |
                        <button
                            class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                            data-id="{{ $item->permission_id}}">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
@endsection

@section('scripts')
    <script>
        var table = $('#PermissionTable').DataTable();

        $('#addPermissionForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-permission') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addPermissionModalModal').modal('hide');
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

        $('#permissionTableBody').on('click', '.delete-btn', function () {
            var permissionId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this permission ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-permission', ':id') }}'.replace(':id', permissionId),
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
                                toastr.error("Failed to delete the reward.",
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
        $('#permissionTableBody').on('click', '.edit-btn', function () {
            var permissionId = $(this).data('id');

            $('#editPermissionForm').data('id', permissionId);
            var url = "{{ route('edit-permission', ':id') }}";
            url = url.replace(':id', permissionId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var data = response.permission;
                    $('#permission_name').val(data.permission_name);
                    $('#editPermissionModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });


        //Lưu lại dữ liệu khi chỉnh sửa
        $('#editPermissionForm').submit(function (e) {
            e.preventDefault();
            var permissionId = $(this).data('id');
            var url = "{{ route('update-permission', ':id') }}";
            url = url.replace(':id', permissionId);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#editPermissionModal').modal('hide');
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
