@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Đơn xin nghỉ phép</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Quản lý</a></li>
                <li class="breadcrumb-item active">Báo cáo đơn xin nghỉ phép</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-success mx-2 btn-export">
                <a href="{{route('export-leave-application')}}" class="d-flex align-items-center text-white">
                    <i class="bi bi-file-earmark-arrow-down pe-2"></i>
                    Xuất file excel
                </a>
            </div>
        </div>
    </div>


    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Báo cáo đơn xin nghỉ phép</h3>
        <div class="table-responsive">
            <table id="LeaveApplicationReportTable" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Nhân viên</th>
                    <th>Loại nghỉ phép</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="LeaveApplicationReportTableBody">
                @php($stt = 0)
                @foreach ($leaveReport as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->first_name.' '.$item->last_name }}</td>
                        <td>{{ $item->type_leave_name}}</td>
                        <td>{{ $item->start_date}}</td>
                        <td>{{ $item->end_date}}</td>
                        <td class="w-25">
                            <div class="progress">
                                @if ($item->leave_status == 0)
                                    <div class="progress-bar bg-danger text-white fw-bold" role="progressbar"
                                         style="width: 50%;"
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        Not approve
                                    </div>
                                @elseif($item->leave_status == 1)
                                    <div class="progress-bar bg-success text-white fw-bold" role="progressbar"
                                         style="width: 100%;"
                                         aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                        Done
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="text-center">
                            @if ($item->leave_status == 0)
                                <button
                                    class="text-secondary btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none btn_approved"
                                    data-id="{{ $item->application_id }}">
                                    <i class="bi bi-check-circle"></i>
                                    Not approve
                                </button>
                            @elseif($item->leave_status == 1)
                                <button
                                    class="text-success btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none btn_approved"
                                    data-id="" disabled>
                                    <i class="bi bi-check-circle-fill"></i>
                                    Done
                                </button>
                                |
                                <button
                                    class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                    data-id="{{ $item->application_id }}">
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
        var table = $('#LeaveApplicationReportTable').DataTable();

        $('#LeaveApplicationReportTable').on('click', '.btn_approved', function() {
            var leaveAppId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to approve this leave application?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('approve-leave-application', ['id' => ':id']) }}'
                            .replace(':id', leaveAppId),
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.message, "Approved successfully");
                                setTimeout(function() {
                                    location.reload();
                                }, 250);
                            } else {
                                toastr.error("Failed to approve the proposal application.",
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

        $('#LeaveApplicationReportTable').on('click', '.delete-btn', function () {
            var leaveapplicationId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this leave application ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-leave-application', ':id') }}'.replace(':id', leaveapplicationId),
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
                                toastr.error("Failed to delete the leave application.",
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
