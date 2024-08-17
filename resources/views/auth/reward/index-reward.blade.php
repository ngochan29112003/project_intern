@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Reward</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Reward</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addReward">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new reward
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
    <div class="modal fade" id="addReward">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add reward</h4>
                </div>
                <div class="modal-body">
                    <form id="addRewardForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_reward_type" class="form-label">Reward type</label>
                            <select class="form-select" aria-label="Default" name="add_reward_type" id="add_reward_type">
                                @foreach ($reward_type_list as $item)
                                    <option value="{{$item->type_reward_id}}">{{$item->type_reward_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_employee_id" class="form-label">Employee name</label>
                            <select class="form-select" aria-label="Default" name="add_employee_id" id="add_employee_id">
                                @foreach ($employee_list as $item)
                                    <option value="{{ $item->employee_id}}">{{$item->first_name.' '.$item->last_name}}
                                    </option>
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
    <div class="modal fade" id="editRewardModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit reward</h4>
                </div>
                <div class="modal-body">
                    <form id="editRewardForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="type_reward_id" class="form-label">Reward type</label>
{{--                            <input type="text" class="form-control" id="type_reward_id" name="type_reward_id"--}}
{{--                                   required>--}}
                            <select class="form-select" aria-label="Default" name="type_reward_id" id="type_reward_id">
                                @foreach ($reward_type_list as $item)
                                    <option value="{{$item->type_reward_id}}">{{$item->type_reward_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee name</label>
                            <select class="form-select" aria-label="Default" name="employee_id" id="employee_id">
                                @foreach ($employee_list as $item)
                                    <option value="{{ $item->employee_id}}">{{$item->first_name.' '.$item->last_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Reward</h3>
        <div class="table-responsive">
            <table id="rewardTable" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Reward type</th>
                    <th>Employee</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="rewardTableBody">
                @php($stt = 0)
                @foreach ($reward_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->type_reward_name}}</td>
                        <td>{{$item->first_name.' '.$item->last_name}}</td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->rewards_id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->rewards_id}}">
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

        var table = $('#rewardTable').DataTable();

        $('#addRewardForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-reward') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addRewardModal').modal('hide');
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


        $('#rewardTableBody').on('click', '.delete-btn', function () {
            var rewardId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this reward ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-reward', ':id') }}'.replace(':id', rewardId),
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
                                toastr.error("Failed to delete the reward.",
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
        $('#rewardTable').on('click', '.edit-btn', function () {
            var rewardId = $(this).data('id');
            console.log(rewardId)
            $('#editRewardForm').data('id', rewardId);
            var url = "{{ route('edit-reward', ':id') }}";
            url = url.replace(':id', rewardId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var data = response.reward;
                    $('#type_reward_id').val(data.type_reward_id);
                    $('#employee_id').val(data.employee_id);
                    $('#editRewardModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        //Lưu lại dữ liệu khi chỉnh sửa
        $('#editRewardForm').submit(function (e) {
            e.preventDefault();
            var rewardId = $(this).data('id');
            var url = "{{ route('update-reward', ':id') }}";
            url = url.replace(':id', rewardId);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#editRewardModal').modal('hide');
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
