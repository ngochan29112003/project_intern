@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Discipline</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Discipline</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addDiscipline">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new discipline
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
    <div class="modal fade" id="addDiscipline">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add discipline</h4>
                </div>
                <div class="modal-body">
                    <form id="addDisciplineForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_discipline_name" class="form-label">Disciplinary action name</label>
                            <select class="form-select" aria-label="Default" name="add_action_id" id="add_action_id">
                                @foreach ($type_discipline_list as $item)
                                    <option value="{{$item->action_id}}">{{$item->disciplinary_action}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_employee_id" class="form-label">Employee id</label>
                            <select class="form-select" aria-label="Default" name="add_employee_id" id="add_employee_id">
                                @foreach ($employee_list as $item)
                                    <option value="{{ $item->employee_id}}">{{$item->first_name.' '.$item->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ======= Modal sửa ======= -->
    <div class="modal fade" id="editDisciplineModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Discipline</h4>
                </div>
                <div class="modal-body">
                    <form id="editDisciplineForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="action_id" class="form-label">Action id</label>
                            <input type="text" class="form-control" id="action_id" name="action_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee id</label>
                            <input type="text" class="form-control" id="employee_id" name="employee_id" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save change</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Discipline</h3>
        <div class="table-responsive">
            <table id="DisciplineTable" class="table table-hover table-borderless">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Disciplinary type</th>
                    <th>Employee id</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="disciplineTableBody">
                @php($stt = 0)
                @foreach ($discipline_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->disciplinary_action}}</td>
                        <td>{{$item->first_name.' '.$item->last_name}}</td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->discipline_id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->discipline_id}}">
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
        var table = $('#DisciplineTable').DataTable();

        $('#addDisciplineForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-discipline') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addDisciplineModal').modal('hide');
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


        $('#disciplineTableBody').on('click', '.delete-btn', function () {
            var disciplineId = $(this).data('id');
            var row = $(this).closest('tr');
            // console.log(disciplineId)
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this discipline ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-discipline', ':id') }}'.replace(':id', disciplineId),
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
                                toastr.error("Failed to delete the discipline.",
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
        $('#disciplineTableBody').on('click', '.edit-btn', function () {
            var disciplineId = $(this).data('id');

            $('#editDisciplineForm').data('id', disciplineId);
            var url = "{{ route('edit-discipline', ':id') }}";
            url = url.replace(':id', disciplineId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var data = response.discipline;
                    $('#action_id').val(data.action_id);
                    $('#employee_id').val(data.employee_id);
                    $('#editDisciplineModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        //Lưu lại dữ liệu khi chỉnh sửa
        $('#editDisciplineForm').submit(function (e) {
            e.preventDefault();
            var disciplineId = $(this).data('id');
            var url = "{{ route('update-discipline', ':id') }}";
            url = url.replace(':id', disciplineId);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#editDisciplineModal').modal('hide');
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
