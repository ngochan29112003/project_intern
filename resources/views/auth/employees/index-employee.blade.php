<!-- ======= Lấy lại giao diện từ main (kế thừa) ======= -->
@extends('auth.main')

<!-- ======= Viết nội dung của chức năng hiện có để bỏ vào yield('contents') bên main======= -->
@section('contents')
    <div class="pagetitle">
        <h1>Employee</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Employee</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new employee
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
    <div class="modal fade" id="addEmployeeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add employee</h4>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Employee name</label>
                            <input type="text" class="form-control" id="add_employee_name" name="add_employee_name">
                        </div>
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Img</label>
                            <input type="file" class="form-control" id="add_img" name="add_img">
                        </div>
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="add_gender" name="add_gender">
                        </div>
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Birth day</label>
                            <input type="date" class="form-control" id="add_birthday" name="add_birthday">
                        </div>
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Birth place</label>
                            <input type="text" class="form-control" id="add_birthplace" name="add_birthplace">
                        </div>
                        <div class="mb-3">
                            <label for="department_name" class="form-label">ID CARD</label>
                            <input type="text" class="form-control" id="add_idcard" name="add_idcard">
                        </div>
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Education level</label>
                            <input type="text" class="form-control" id="add_edu" name="add_edu">
                        </div>
                        <div class="mb-3">
                            <label for="department_name" class="form-label">Status</label>
                            <input type="text" class="form-control" id="add_status" name="add_status">
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Employee</h3>
        <table id="employeeTable" class="table table-hover table-borderless">
            <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Employee name</th>
                <th>img</th>
                <th>Gender</th>
                <th>Birth Day</th>
                <th>Birth place</th>
                <th>Id card number</th>
                <th>Education</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody id="employeeTableBody">
            @php($stt = 0)
            @foreach($employee_list as $item)
                <tr>
                    <td>{{$stt++}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->img}}</td>
                    <td>{{$item->gender}}</td>
                    <td>{{$item->birth_date}}</td>
                    <td>{{$item->birth_place}}</td>
                    <td>{{$item->id_card_number}}</td>
                    <td>{{$item->education_level}}</td>
                    <td>{{$item->status}}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
@endsection

<!-- ======= Viết nội dung của chức năng hiện có để bỏ vào yield('scripts') bên main======= -->
@section('scripts')
    <script>
        var table = $('#employeeTable').DataTable();

        $('#addEmployeeForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-employees') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addEmployeeModal').modal('hide');
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
