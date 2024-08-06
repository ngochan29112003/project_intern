@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Customer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Customer</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addCustomer">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new customer
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
    <div class="modal fade" id="addCustomer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add customer</h4>
                </div>
                <div class="modal-body">
                    <form id="addCustomerForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_customer_name" class="form-label">Customer name</label>
                            <input type="text" class="form-control" id="add_customer_name" name="add_customer_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_customer_name" class="form-label">Phone number</label>
                            <input type="text" class="form-control" id="add_phone_number" name="add_phone_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_customer_name" class="form-label">Email</label>
                            <input type="text" class="form-control" id="add_email" name="add_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_customer_name" class="form-label">Employee id</label>
                            <input type="text" class="form-control" id="add_employee_id" name="add_employee_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_customer_name" class="form-label">Address</label>
                            <input type="text" class="form-control" id="add_address" name="add_address" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_customer_name" class="form-label">Project</label>
                            <input type="text" class="form-control" id="add_project" name="add_project" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Customer</h3>
        <div class="table-responsive">
            <table id="CustomerTable" class="table table-hover table-borderless">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Employee Name</th>
                    <th>Address</th>
                    <th>Project</th>
                </tr>
                </thead>
                <tbody id="customerTableBody">
                @php($stt = 1)
                @foreach ($customer_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->customer_name}}</td>
                        <td>{{ $item->phone_number}}</td>
                        <td>{{ $item->email}}</td>
                        <td>{{ $item->employee_id}}</td>
                        <td>{{ $item->address}}</td>
                        <td>{{ $item->project}}</td>

                        <td>
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->customer_id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->customer_id}}">
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
        var table = $('#customerTable').DataTable();

        $('#addCustomerForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-customer') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addCustomerModalModal').modal('hide');
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
