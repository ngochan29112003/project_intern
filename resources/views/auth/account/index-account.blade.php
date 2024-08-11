@extends('auth.main')
@section('contents')
    <div class="pagetitle">
        <h1>Account</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">System</a></li>
                <li class="breadcrumb-item active">Account</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new account
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
    <div class="modal fade" id="addAccountModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add account</h4>
                </div>
                <div class="modal-body">
                    <form id="addAccountForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="employee_name" class="form-label">Employee name</label>
                            <select class="form-select" aria-label="Default" name="id_employee" id="id_employee">
                                @foreach ($employee_list as $item)
                                    <option value="{{ $item->employee_id}}">{{$item->first_name.' '.$item->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="repassword" class="form-label">Re-password</label>
                            <input type="text" class="form-control" id="repassword" name="repassword">
                        </div>

                        <div class="mb-3">
                            <label for="permission" class="form-label">Permission</label>
                            <select class="form-select" aria-label="Default" name="permission" id="permission">
                                @foreach ($permis_list as $item)
                                    <option value="{{ $item->permission_id }}">{{ $item->permission_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Account</h3>
        <div class="table-responsive">
            <table id="accountTable" class="table table-hover table-borderless">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Permission</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="accountTableBody">
                @php($stt = 1)
                @foreach($account_list as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->permission_name}}</td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->id}}">
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
        var table = $('#accountTable').DataTable();

        $('#addAccountForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-account') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        $('#addAccountModal').modal('hide');
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

        $('#accountTableBody').on('click', '.delete-btn', function () {
            var accountId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this account ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-account', ':id') }}'.replace(':id', accountId),
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
                                toastr.error("Failed to delete the account.",
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

        {{--//Hiện chi tiết của dữ liệu--}}
        {{--$('#AccountTableBody').on('click', '.edit-btn', function () {--}}
        {{--    var accountId = $(this).data('id');--}}

        {{--    $('#editAccountForm').data('id', accountId);--}}
        {{--    var url = "{{ route('edit-account', ':id') }}";--}}
        {{--    url = url.replace(':id', accountId);--}}
        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        method: 'GET',--}}
        {{--        success: function (response) {--}}
        {{--            var data = response.account;--}}
        {{--            $('#username').val(data.username);--}}
        {{--            $('#password').val(data.password);--}}
        {{--            $('#permission').val(data.permission);--}}
        {{--            $('#id_employee').val(data.id_employee);--}}
        {{--            $('#editAccountModal').modal('show');--}}
        {{--        },--}}
        {{--        error: function (xhr) {--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        {{--//Lưu lại dữ liệu khi chỉnh sửa--}}
        {{--$('#editAccountForm').submit(function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    var AccountId = $(this).data('id');--}}
        {{--    var url = "{{ route('update-account', ':id') }}";--}}
        {{--    url = url.replace(':id', accountId);--}}
        {{--    var formData = new FormData(this);--}}
        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        method: 'POST',--}}
        {{--        data: formData,--}}
        {{--        contentType: false,--}}
        {{--        processData: false,--}}
        {{--        success: function (response) {--}}
        {{--            if (response.success) {--}}
        {{--                $('#editAccountModal').modal('hide');--}}
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
