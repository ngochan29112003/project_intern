@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Task</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Task</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addTask">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new task
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
    <div class="modal fade" id="addTask">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add task</h4>
                </div>
                <div class="modal-body">
                    <form id="addTaskForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_task_name" class="form-label">Task code</label>
                            <input type="text" class="form-control" id="add_task_code" name="add_task_code"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_task_name" class="form-label">Employee id</label>
                            <input type="text" class="form-control" id="add_employee_id" name="add_employee_id"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_task_name" class="form-label">	Start_date</label>
                            <input type="text" class="form-control" id="add_start_date" name="add_start_date"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_task_name" class="form-label">End_date</label>
                            <input type="text" class="form-control" id="add_end_date" name="add_end_date"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_task_name" class="form-label">Location</label>
                            <input type="text" class="form-control" id="add_location" name="add_location"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_task_name" class="form-label">Purpose</label>
                            <input type="text" class="form-control" id="add_purpose" name="add_purpose"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Task</h3>
        <div class="table-responsive">
            <table id="TaskTable" class="table table-hover table-borderless">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Task code</th>
                    <th>Employee id</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Location</th>
                    <th>Purpose</th>
                </tr>
                </thead>
                <tbody id="TaskTableBody">
                @php($stt = 0)
                @foreach ($Task_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->task_code}}</td>
                        <td>{{ $item->employee_id}}</td>
                        <td>{{ $item->start_date}}</td>
                        <td>{{ $item->end_date}}</td>
                        <td>{{ $item->location}}</td>
                        <td>{{ $item->purpose}}</td>
                        <td>
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
        var table = $('#taskTable').DataTable();

        $('#addTaskForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-Task') }}',
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
    </script>
@endsection
