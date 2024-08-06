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
                            <label for="edit_discipline_name" class="form-label">Discipline code</label>
                            <input type="text" class="form-control" id="add_discipline_code" name="add_discipline_code"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_discipline_name" class="form-label">Discipline name</label>
                            <input type="text" class="form-control" id="add_discipline_name" name="add_discipline_name"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_discipline_name" class="form-label">Employee id</label>
                            <input type="text" class="form-control" id="add_employee_id" name="add_employee_id"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_discipline_name" class="form-label">	Description</label>
                            <input type="text" class="form-control" id="add_description" name="add_description"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
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
                    <th>Discipline code</th>
                    <th>Discipline name</th>
                    <th>Employee id</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody id="disciplineTableBody">
                @php($stt = 0)
                @foreach ($discipline_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->discipline_code}}</td>
                        <td>{{ $item->discipline_name}}</td>
                        <td>{{ $item->employee_id}}</td>
                        <td>{{ $item->description}}</td>

                        <td>
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
        var table = $('#disciplineTable').DataTable();

        $('#addDisciplineForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-discipline') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addDisciplineModalModal').modal('hide');
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
