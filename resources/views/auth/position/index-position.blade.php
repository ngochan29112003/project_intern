@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Position</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Position</li>
            </ol>
        </nav>
    </div>

    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addPositionModal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new position
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

    <div class="modal fade" id="addPositionModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add position</h4>
                </div>
                <div class="modal-body">
                    <form id="addPositionForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="add_job_position_code" class="form-label">Job Position Code</label>
                            <input type="text" class="form-control" id="add_job_position_code" name="add_job_position_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_job_position_name" class="form-label">Job Position Name</label>
                            <input type="text" class="form-control" id="add_job_position_name" name="add_job_position_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="add_job_position_salary" class="form-label">Job Position Salary</label>
                            <input type="text" class="form-control" id="add_job_position_salary" name="add_job_position_salary" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="add_description" name="add_description" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPositionModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit position</h4>
                </div>
                <div class="modal-body">
                    <form id="editPositionForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="job_position_code" class="form-label">Job Position Code</label>
                            <input type="text" class="form-control" id="job_position_code" name="job_position_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="job_position_name" class="form-label">Job Position Name</label>
                            <input type="text" class="form-control" id="job_position_name" name="job_position_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="job_position_salary" class="form-label">Job Position Salary</label>
                            <input type="text" class="form-control" id="job_position_salary" name="job_position_salary" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Position</h3>
        <div class="table-responsive">
            <table id="positionTable" class="table table-hover table-borderless">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Job Position Code</th>
                    <th>Job Position Name</th>
                    <th>Job Position Salary</th>
                    <th>Description</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="positionTableBody">
                @php($stt = 1)
                @foreach($position_list as $item)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$item->job_position_code}}</td>
                        <td>{{$item->job_position_name}}</td>
                        <td>{{$item->job_position_salary}}</td>
                        <td>{{$item->description}}</td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->job_position_id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->job_position_id }}">
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
        var table = $('#positionTable').DataTable();

        // JS Add position
        $('#addPositionForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('add-position') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $('#addPositionModal').modal('hide');
                        toastr.success(response.message, "Successful");
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    } else {
                        toastr.error(response.message, "Error");
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 400) {
                        var response = xhr.responseJSON;
                        toastr.error(response.message, "Error");
                    } else {
                        toastr.error("An error occurred", "Error");
                    }
                }
            });
        });

        //JS Delete position
        $('#positionTableBody').on('click', '.delete-btn', function() {
            var positionId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this position ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-position', ':id') }}'.replace(':id', positionId),
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                table.row(row).remove().draw();
                                toastr.success(response.message, "Deleted successfully");
                            } else {
                                toastr.error("Failed to delete the employee.",
                                    "Operation Failed");
                            }
                        },
                        error: function(xhr) {
                            toastr.error("An error occurred.", "Operation Failed");
                        }
                    });
                }
            });
        });

        //Hiện chi tiết của dữ liệu
        $('#positionTableBody').on('click', '.edit-btn', function () {
            var positionId = $(this).data('id');

            $('#editPositionForm').data('id', positionId);
            var url = "{{ route('edit-position', ':id') }}";
            url = url.replace(':id', positionId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var data = response.position;
                    $('#job_position_code').val(data.job_position_code);
                    $('#job_position_name').val(data.job_position_name);
                    $('#job_position_salary').val(data.job_position_salary);
                    $('#description').val(data.description);
                    $('#editPositionModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        //Lưu lại dữ liệu khi chỉnh sửa
        $('#editPositionForm').submit(function (e) {
            e.preventDefault();
            var positionId = $(this).data('id');
            var url = "{{ route('update-position', ':id') }}";
            url = url.replace(':id', positionId);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#editPositionModal').modal('hide');
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
