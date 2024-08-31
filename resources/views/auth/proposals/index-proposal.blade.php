@extends('auth.main')

@section('contents')
    @php
        $data = \Illuminate\Support\Facades\DB::table('employees')
                ->join('accounts', 'accounts.id_employee','=','employees.employee_id')
                ->join('job_details','employees.employee_id','=','job_details.employee_id')
                ->where('accounts.id', \Illuminate\Support\Facades\Request::session()->get(\App\StaticString::ACCOUNT_ID))
                ->first();
    @endphp
    <div class="pagetitle">
        <h1>Đề xuất</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Quản lý</a></li>
                @if(($data->permission === 2 && $data->job_position_id === 10) || ($data->permission === 2 && $data->job_position_id === 7))
                    <li class="breadcrumb-item active">Báo cáo đề xuất</li>
                @else
                    <li class="breadcrumb-item active">Danh sách đề xuất</li>
                @endif
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addProposal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Thêm đề xuất mới
                </div>
            </div>
            @if(($data->permission === 2 && $data->job_position_id === 10) || ($data->permission === 2 && $data->job_position_id === 7))
                <div class="btn btn-success mx-2 btn-export">
                    <a href="" class="d-flex align-items-center text-white">
                        <i class="bi bi-file-earmark-arrow-down pe-2"></i>
                        Xuất file excel
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- ======= Modal thêm (tìm hiểu Modal này trên BS5) ======= -->
    <div class="modal fade" id="addProposal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm đề xuất</h4>
                </div>
                <div class="modal-body">
                    <form id="addProposalForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="add_employee_id" class="form-label">Nhân viên</label>
                                    <select class="form-select" aria-label="Default" name="employee_id"
                                            id="employee_id">
                                        @if(($data->permission === 2 && $data->job_position_id === 10))
                                            @foreach($employee_list_dm as $item)
                                                <option
                                                        value="{{$item->employee_id}}">{{$item->first_name.' '.$item->last_name}}
                                                </option>
                                            @endforeach
                                        @elseif(($data->permission === 2 && $data->job_position_id === 7))
                                            @foreach($employee_list_dir as $item)
                                                <option
                                                        value="{{$item->employee_id}}">{{$item->first_name.' '.$item->last_name}}
                                                </option>
                                            @endforeach
                                        @else
                                            <option
                                                    value="{{$current_employee->employee_id}}">{{$current_employee->first_name.' '.$current_employee->last_name}}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="add_type_proposal_id" class="form-label">Loại đề xuất</label>
                                    <select class="form-select" aria-label="Default" name="type_proposal_id"
                                            id="type_proposal_id">
                                        @foreach ($type_proposal_list as $item)
                                            <option
                                                    value="{{ $item->type_proposal_id}}">{{ $item->proposal_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="proposal_description" class="form-label">Ghi chú</label>
                            <textarea class="form-control" placeholder="Proposal a description here"
                                      id="add_proposal_description"
                                      name="proposal_description" style="height: 200px"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Tải lên tệp của bạn</label>
                            <input class="form-control" type="file" id="file" name="files[]" multiple>
                            <ul id="fileList" class="list-unstyled mt-2"></ul>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Modal sửa ======= -->
    <div class="modal fade" id="editProposalModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa đề xuất</h4>
                </div>
                <div class="modal-body">
                    <form id="editProposalForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <input type="hidden" id="edit_proposal_id" name="proposal_id">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="edit_employee_id" class="form-label">Nhân viên</label>
                                    <select class="form-select" aria-label="Default" name="employee_id"
                                            id="edit_employee_id">
                                        @if(($data->permission === 2 && $data->job_position_id === 10))
                                            @foreach($employee_list_dm as $item)
                                                <option
                                                        value="{{$item->employee_id}}">{{$item->first_name.' '.$item->last_name}}
                                                </option>
                                            @endforeach
                                        @elseif(($data->permission === 2 && $data->job_position_id === 7))
                                            @foreach($employee_list_dir as $item)
                                                <option
                                                        value="{{$item->employee_id}}">{{$item->first_name.' '.$item->last_name}}
                                                </option>
                                            @endforeach
                                        @else
                                            <option
                                                    value="{{$current_employee->employee_id}}">{{$current_employee->first_name.' '.$current_employee->last_name}}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="edit_type_proposal_id" class="form-label">Loại đề xuất</label>
                                    <select class="form-select" aria-label="Default" name="type_proposal_id"
                                            id="edit_type_proposal_id">
                                        @foreach ($type_proposal_list as $item)
                                            <option
                                                    value="{{ $item->type_proposal_id}}">{{ $item->proposal_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_proposal_description" class="form-label">Ghi chú</label>
                            <textarea class="form-control" placeholder="Proposal a description here"
                                      id="edit_proposal_description"
                                      name="proposal_description" style="height: 200px"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="proposal_files">Tải lên tệp của bạn</label>
                            <div class="mb-3 table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tải lên tệp của bạn</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="overflow-y-scroll">
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <label for="edit_files" class="form-label">Thêm tệp tin</label>
                                <input class="form-control" type="file" id="edit_files" name="files[]" multiple>
                                <ul id="editFileList" class="list-unstyled mt-2"></ul>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        @if(($data->permission === 2 && $data->job_position_id === 10) || ($data->permission === 2 && $data->job_position_id === 7))
            <h3 class="text-left mb-4">Báo cáo đề xuất</h3>
        @else
            <h3 class="text-left mb-4">Đề xuất của bạn</h3>
        @endif
        <div class="table-responsive">
            <table id="ProposalTable" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Nhân viên</th>
                    <th>Loại đề xuất</th>
                    <th>Ghi chú</th>
                    <th>Trạng thái</th>
                    <th>
                        @if(($data->permission === 2 && $data->job_position_id === 10))
                            Trưởng phòng
                        @elseif(($data->permission === 2 && $data->job_position_id === 7))
                            Giám đốc
                        @endif
                    </th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="proposalTableBody">
                @php($stt = 0)
                @foreach ($proposal_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{$item->first_name.' '.$item->last_name}}</td>
                        <td>{{ $item->proposal_name}}</td>
                        <td>{{ $item->proposal_description}}</td>
                        <td class="w-25">
                            <div class="progress">
                                @if ($item->proposal_status === 0)
                                    <div class="progress-bar bg-danger text-white fw-bold" role="progressbar"
                                         style="width: 33%;"
                                         aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
                                        Chưa duyệt
                                    </div>
                                @elseif($item->proposal_status === 1)
                                    <div class="progress-bar bg-warning text-white fw-bold" role="progressbar"
                                         style="width: 66%;"
                                         aria-valuenow="66" aria-valuemin="0" aria-valuemax="100">
                                        Trưởng phòng đã duyệt
                                    </div>
                                @elseif($item->proposal_status === 2)
                                    <div class="progress-bar bg-success text-white fw-bold" role="progressbar"
                                         style="width: 100%;"
                                         aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                        Giám đốc đã duyệt
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if(($data->permission === 2 && $data->job_position_id === 10))
                                @if ( $item->proposal_status === 0)
                                    <button
                                            class="text-secondary btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none btn_approved"
                                            data-id="{{ $item->proposal_id }}"
                                            data-permission="{{$data->permission}}"
                                            data-position="{{$data->job_position_id}}">
                                        <i class="bi bi-check-circle"></i>
                                        Chưa duyệt
                                    </button>
                                @elseif($item->proposal_status === 1)
                                    <button
                                            class="text-warning btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none"
                                            data-id="{{ $item->proposal_id }}" disabled>
                                        <i class="bi bi-check-circle-fill"></i>
                                        Trưởng phòng đã duyệt
                                    </button>
                                @elseif($item->proposal_status === 2)
                                    <button
                                            class="text-success btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none btn_approved"
                                            data-id="{{ $item->proposal_id }}"
                                            disabled>
                                        <i class="bi bi-check-circle-fill"></i>
                                        Đã duỵệt xong
                                    </button>
                                @endif
                            @elseif(($data->permission === 2 && $data->job_position_id === 7))
                                @if ( $item->proposal_status === 0)
                                    <button
                                            class="text-secondary btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none btn_approved"
                                            data-id="{{ $item->proposal_id }}" disabled>
                                        <i class="bi bi-check-circle"></i>
                                        Trưởng phòng chưa duyệt
                                    </button>
                                @elseif($item->proposal_status === 1)
                                    <button
                                            class="text-secondary btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none btn_approved"
                                            data-id="{{ $item->proposal_id }}"
                                            data-permission="{{$data->permission}}"
                                            data-position="{{$data->job_position_id}}">
                                        <i class="bi bi-check-circle"></i>
                                        Chưa duyệt
                                    </button>
                                @elseif($item->proposal_status === 2)
                                    <button
                                            class="text-success btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none btn_approved"
                                            data-id="{{ $item->proposal_id }}"
                                            disabled>
                                        <i class="bi bi-check-circle-fill"></i>
                                        Đã duỵệt xong
                                    </button>
                                @endif
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($item->proposal_status === 0)
                                <button
                                        class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                        data-id="{{ $item->proposal_id}}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                |
                                <button
                                        class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                        data-id="{{ $item->proposal_id}}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            @endif
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
        var table = $('#ProposalTable').DataTable();

        const fileArray = [];
        const input = document.getElementById('file');

        input.addEventListener('change', function (event) {
            const fileList = document.getElementById('fileList');

            for (let i = 0; i < input.files.length; i++) {
                fileArray.push(input.files[i]);
            }

            updateFileList();
        });

        function updateFileList() {
            const dataTransfer = new DataTransfer();
            fileArray.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;

            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';
            fileArray.forEach((file, index) => {
                const li = document.createElement('li');
                li.className =
                    'mb-3 d-flex justify-content-between align-items-center text-truncate file-list-item';
                let displayName = file.name;
                const extension = displayName.split('.').pop();
                const baseName = displayName.substring(0, displayName.lastIndexOf('.'));

                if (baseName.length > 30) {
                    displayName = baseName.substring(0, 25) + '...' + '.' + extension;
                } else {
                    displayName = baseName + '.' + extension;
                }

                li.textContent = displayName + ' ';

                const removeBtn = document.createElement('button');
                removeBtn.textContent = 'Remove';
                removeBtn.className = 'text-right btn btn-danger btn-sm ms-2';
                removeBtn.onclick = function () {
                    fileArray.splice(index, 1);
                    updateFileList();
                };

                li.appendChild(removeBtn);
                fileList.appendChild(li);
            });
        }


        $('#addProposalForm').submit(function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            for (var pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }

            $.ajax({
                url: '{{ route('add-proposal') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#addModal').modal('hide');
                        toastr.success(response.message, "Successful");
                        setTimeout(function () {
                            location.reload()
                        }, 500);
                    } else {
                        toastr.error(response.message, "Error");
                    }
                },
                error: function (xhr) {
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

        $('#proposalTableBody').on('click', '.delete-btn', function () {
            var proposalId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this proposal ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-proposal', ':id') }}'.replace(':id', proposalId),
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
                                toastr.error("Failed to delete the proposal.",
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


        const EditfileArray = [];
        const editInput = document.getElementById('edit_files');

        editInput.addEventListener('change', function (event) {
            for (let i = 0; i < editInput.files.length; i++) {
                EditfileArray.push(editInput.files[i]);
            }
            updateEditFileList();
        });

        function updateEditFileList() {
            const fileList = document.getElementById('editFileList');
            fileList.innerHTML = '';

            EditfileArray.forEach((file, index) => {
                const listItem = document.createElement('li');
                listItem.className = 'mb-3 d-flex justify-content-between align-items-center text-truncate';
                listItem.textContent = file.name;
                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
                removeButton.onclick = () => {
                    EditfileArray.splice(index, 1);
                    updateEditFileList();
                };
                listItem.appendChild(removeButton);
                fileList.appendChild(listItem);
            });
        }

        //Hiện chi tiết của dữ liệu
        $('#ProposalTable').on('click', '.edit-btn', function () {
            var proposalId = $(this).data('id');

            $('#editProposalForm').data('id', proposalId);
            var url = "{{ route('edit-proposal', ':id') }}";
            url = url.replace(':id', proposalId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var data = response.proposal;
                    $('#edit_proposal_id').val(data.proposal_id);
                    $('#edit_employee_id').val(data.employee_id);
                    $('#edit_type_proposal_id').val(data.type_proposal_id);
                    $('#edit_proposal_description').val(data.proposal_description);
                    let fileListHtml = '';
                    if (data.files) {
                        data.files.forEach(function (file, index) {
                            fileListHtml +=
                                `<tr>
                                    <td>${index + 1}</td>
                                    <td><a href="{{ asset('proposal_files') }}/${data.employee_id}/${file.proposal_file_name}" download>${file.proposal_file_name}</a></td>
                                    <td><button type="button" class="btn btn-danger btn-sm remove-file" data-id="${file.proposal_file_id}">Remove</button></td>
                                </tr>`;
                        });
                    } else {
                        console.error('No files in response');
                    }
                    $('#editProposalModal table tbody').html(fileListHtml);
                    $('#editProposalModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        $(document).on('click', '.remove-file', function () {
            var fileId = $(this).data('id');
            var row = $(this).closest('tr');

            $.ajax({
                url: '{{ route('removeFile-proposal', ':id') }}'.replace(':id', fileId),
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        row.remove();
                        toastr.success(response.message, "File Removed");
                    }
                },
                error: function (xhr) {
                    toastr.error("An error occurred.", "Error");
                }
            });
        });

        //Lưu lại dữ liệu khi chỉnh sửa
        $('#editProposalForm').submit(function (e) {
            e.preventDefault();
            var proposalId = $(this).data('id');
            var url = "{{ route('update-proposal', ':id') }}";
            url = url.replace(':id', proposalId);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.response, "Update successful");
                        $('#editProposalModal').modal('hide');
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

        $('#ProposalTable').on('click', '.btn_approved', function () {
            var proposalId = $(this).data('id');
            var permis = $(this).data('permission');
            var position = $(this).data('position');
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to approve this proposal ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('approve-proposal', ['id' => ':id', 'permission' => ':permission', 'position'=>':position']) }}'
                            .replace(':id', proposalId)
                            .replace(':permission', permis)
                            .replace(':position', position),
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message, "Approved successfully");
                                setTimeout(function () {
                                    location.reload();
                                }, 250);
                            } else {
                                toastr.error("Failed to approve the proposal application.",
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
    </script>
@endsection
