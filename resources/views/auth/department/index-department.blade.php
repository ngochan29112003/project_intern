@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Department</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Department</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new department
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
                    <h4 class="modal-title">Add department</h4>
                </div>
                <div class="modal-body">
                    <form id="addDepartmentForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_department_name" class="form-label">Department Code</label>
                            <input type="text" class="form-control" id="add_department_code" name="add_department_code"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_department_name" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="add_department_name" name="add_department_name"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Department</h3>
        <table id="departmentTable" class="table table-hover table-borderless">
            <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Department Code</th>
                <th>Department Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="departmentTableBody">
            @php($stt = 0)
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
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
@endsection

@section('scripts')
    <script>
        var table = $('#departmentTable').DataTable();

        $('#addDepartmentForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-department') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addDepartmentModalModal').modal('hide');
                        toastr.success(response.message, "Successful");
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
