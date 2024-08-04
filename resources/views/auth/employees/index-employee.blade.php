@extends('auth.main')

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

    <div class="modal fade" id="addEmployeeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add employee</h4>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="add_employee_name" class="form-label">Employee name</label>
                            <input type="text" class="form-control" id="add_employee_name" name="add_employee_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_img" class="form-label">Image</label>
                            <input type="file" class="form-control" id="add_img" name="add_img">
                        </div>
                        <div class="mb-3">
                            <label for="add_gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="add_gender" name="add_gender" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_birthday" class="form-label">Birth day</label>
                            <input type="date" class="form-control" id="add_birthday" name="add_birthday" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_birthplace" class="form-label">Birth place</label>
                            <input type="text" class="form-control" id="add_birthplace" name="add_birthplace" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_idcard" class="form-label">ID CARD</label>
                            <input type="text" class="form-control" id="add_idcard" name="add_idcard" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_edu" class="form-label">Education level</label>
                            <input type="text" class="form-control" id="add_edu" name="add_edu" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="add_status" name="add_status" required>
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
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody id="employeeTableBody">
            @php($stt = 0)
            @foreach($employee_list as $item)
                <tr>
                    <td>{{$stt++}}</td>
                    <td>{{$item->employee_name}}</td>
                    <td class="text-center"><img class="rounded-pill object-fit-cover" src="{{asset('assets/employee_img/'.$item->img)}}" alt="" width="75" height="75"></td>
                    <td>{{$item->gender}}</td>
                    <td>{{$item->birth_date}}</td>
                    <td>{{$item->birth_place}}</td>
                    <td>{{$item->id_card_number}}</td>
                    <td>{{$item->education_level}}</td>
                    <td>{{$item->status}}</td>
                    <td class="text-center">
                        <button
                            class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                            data-id="{{ $item->employee_id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        |
                        <button
                            class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                            data-id="{{ $item->employee_id }}">
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
        var table = $('#employeeTable').DataTable();

        // JS Add employee
        $('#addEmployeeForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('add-employees') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $('#addEmployeeModal').modal('hide');
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

        //JS Delete employee
        $('#employeeTableBody').on('click', '.delete-btn', function() {
            var employeeId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this employee ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-employees', ':id') }}'.replace(':id', employeeId),
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
    </script>
@endsection
