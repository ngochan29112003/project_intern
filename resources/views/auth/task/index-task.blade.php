@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Nhiệm vụ</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Quản lý</a></li>
                <li class="breadcrumb-item active">Nhiệm vụ</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addTask">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Thêm nhiệm vụ mới
                </div>
            </div>
            <div class="btn btn-success mx-2 btn-export">
                <a href="{{route('export-task')}}" class="d-flex align-items-center text-white">
                    <i class="bi bi-file-earmark-arrow-down pe-2"></i>
                    Xuất file excel
                </a>
            </div>
        </div>
    </div>

    <!-- ======= Modal thêm (tìm hiểu Modal này trên BS5) ======= -->
    <div class="modal fade" id="addTask">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm nhiệm vụ</h4>
                </div>
                <div class="modal-body">
                    <form id="addTaskForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_task_code" class="form-label">Mã nhiệm vụ</label>
                            <input type="text" class="form-control" id="add_task_code" name="add_task_code"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_employee_id" class="form-label">Tên nhiệm vụ</label>
                            <select class="form-select" aria-label="Default" name="add_employee_id" id="add_employee_id">
                                @foreach ($employee_list as $item)
                                    <option value="{{ $item->employee_id}}">{{$item->first_name.' '.$item->last_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_start_date" class="form-label">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="add_start_date" name="add_start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_end_date" class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="add_end_date" name="add_end_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_location" class="form-label">Vị trí</label>
                            <input type="text" class="form-control" id="add_location" name="add_location" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_purpose" class="form-label">Mục đích</label>
                            <input type="text" class="form-control" id="add_purpose" name="add_purpose" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ======= Modal sửa ======= -->
    <div class="modal fade" id="editTaskModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa nhiệm vụ</h4>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="task_code" class="form-label">Mã nhiệm vụ</label>
                            <input type="text" class="form-control" id="task_code" name="task_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Nhân viên</label>
                            <select class="form-select" aria-label="Default" name="employee_id" id="employee_id">
                                @foreach ($employee_list as $item)
                                    <option value="{{ $item->employee_id}}">{{$item->first_name.' '.$item->last_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Vị trí</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="purpose" class="form-label">Mục đích</label>
                            <input type="text" class="form-control" id="purpose" name="purpose" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Danh sách nhiệm vụ</h3>
        <div class="table-responsive">
            <table id="TaskTable" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Mã nhiệm vụ</th>
                    <th>Nhân viên</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Vị trí</th>
                    <th>Mục đích</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="taskTableBody">
                @php($stt = 0)
                @foreach ($task_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->task_code}}</td>
                        <td>{{$item->first_name.' '.$item->last_name}}</td>
                        <td>{{ $item->start_date}}</td>
                        <td>{{ $item->end_date}}</td>
                        <td>{{ $item->location}}</td>
                        <td>{{ $item->purpose}}</td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->id_task}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->id_task}}">
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
        var table = $('#TaskTable').DataTable();

        $('#addTaskForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-task') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addTaskModalModal').modal('hide');
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

        $('#taskTableBody').on('click', '.delete-btn', function () {
            var taskId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this task ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-task', ':id') }}'.replace(':id', taskId),
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
                                toastr.error("Failed to delete the task.",
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
        $('#taskTableBody').on('click', '.edit-btn', function () {
            var taskId = $(this).data('id');

            $('#editTaskForm').data('id', taskId);
            var url = "{{ route('edit-task', ':id') }}";
            url = url.replace(':id', taskId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var data = response.task;
                    $('#task_code').val(data.task_code);
                    $('#employee_id').val(data.employee_id);
                    $('#start_date').val(data.start_date);
                    $('#end_date').val(data.end_date);
                    $('#location').val(data.location);
                    $('#purpose').val(data.purpose);
                    $('#editTaskModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        //Lưu lại dữ liệu khi chỉnh sửa
        $('#editTaskForm').submit(function (e) {
            e.preventDefault();
            var taskId = $(this).data('id');
            var url = "{{ route('update-task', ':id') }}";
            url = url.replace(':id', taskId);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#editTaskModal').modal('hide');
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
