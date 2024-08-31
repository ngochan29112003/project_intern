@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Bảo hiểm xã hội</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Quản lý</a></li>
                <li class="breadcrumb-item active">BHXH</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-success mx-2 btn-export">
                <a href="{{route('export-bhxh')}}" class="d-flex align-items-center text-white">
                    <i class="bi bi-file-earmark-arrow-down pe-2"></i>
                    Xuất file excel
                </a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBHXHModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông tin bảng tính BHXH</h4>
                </div>
                <div class="modal-body">
                    <form id="editBHXHForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="employee_name" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="employee_name"
                                           style="color: #6c757d; background-color: #e9ecef;" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="job_level" class="form-label">Cấp bậc chức vụ</label>
                                    <input type="text" class="form-control" id="job_level"
                                           style="color: #6c757d; background-color: #e9ecef;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="salary_code" class="form-label">Mã số ngạch lương</label>
                                    <input type="text" class="form-control" id="salary_code"
                                           style="color: #6c757d; background-color: #e9ecef;" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="type_employee_id" class="form-label">Loại nhân viên</label>
                                    <input type="text" class="form-control" id="type_employee_id"
                                           style="color: #6c757d; background-color: #e9ecef;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="salary_coefficient" class="form-label">Hệ số lương <span class="text-danger fw-light fst-italic" style="font-size: 12px">(trường này rỗng sẽ không tính được BHXH)</span></label>
                                    <input type="number" class="form-control" id="salary_coefficient" name="salary_coefficient" step="0.01">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="allowance_salary_coefficient" class="form-label">HSPCCV</label>
                                    <input type="number" class="form-control" id="allowance_salary_coefficient" name="allowance_salary_coefficient" step="0.01">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Bảng tính BHXH</h3>
        <div class="table-responsive">
            <table id="BhxhTable" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th class="text-start align-top" rowspan="2">STT</th>
                    <th class="text-start align-top" rowspan="2">Họ và tên</th>
                    <th class="text-start align-top" rowspan="2">Cấp bậc chức vụ</th>
                    <th class="text-start align-top" rowspan="2">Mã số ngạch lương</th>
                    <th class="text-center align-top bg-group-1" colspan="3">Hệ số</th>
                    <th class="text-center align-top bg-group-2" colspan="3">Thành tiền</th>
                    <th class="text-center align-top bg-group-3" colspan="7">Các khoản trừ vào lương 10,5%</th>
                    <th class="text-center align-top bg-group-4" colspan="5">Tổ chức đóng 21,5%</th>
                    <th class="text-center align-middle" rowspan="2">Action</th>
                </tr>
                <tr>
                    <th class="text-start align-top bg-group-1">Hệ số lương</th>
                    <th class="text-start align-top bg-group-1">HS PC CV</th>
                    <th class="text-start align-top bg-group-1">Cộng hệ số</th>
                    <th class="text-center align-middle bg-group-2">Tổng</th>
                    <th class="text-start align-top bg-group-2">Lương theo Hệ số</th>
                    <th class="text-start align-top bg-group-2">Lương theo HS phụ cấp CV</th>
                    <th class="text-start align-top bg-group-3">BHXH (CBCV)</th>
                    <th class="text-start align-top bg-group-3">BHYT (CBCV)</th>
                    <th class="text-start align-top bg-group-3">BHTN (CBCV)</th>
                    <th class="text-start align-top bg-group-3">BHXH (HSCV)</th>
                    <th class="text-start align-top bg-group-3">BHYT (HSCV)</th>
                    <th class="text-start align-top bg-group-3">BHTN (HSCV)</th>
                    <th class="text-start align-top bg-group-3">Cộng</th>
                    <th class="text-start align-top bg-group-4">BHXH</th>
                    <th class="text-start align-top bg-group-4">BHYT</th>
                    <th class="text-start align-top bg-group-4">BHTN</th>
                    <th class="text-start align-top bg-group-4">BHNN</th>
                    <th class="text-start align-top bg-group-4">Cộng</th>
                </tr>
                </thead>

                <tbody id="BHXHTableBody">
                @foreach($bhxh_list as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                        <td>{{ $item->job_position_name }} {{ $item->job_level }}</td>
                        <td>{{ $item->salary_code }}</td>

                        @if(is_null($item->salary_coefficient) && is_null($item->allowance_salary_coefficient))
                            <td colspan="18" class="text-center">N/A</td>
                            <!-- The following td elements are hidden because of colspan -->
                            @for ($i = 0; $i < 17; $i++)
                                <td style="display: none;"></td>
                            @endfor
                        @else
                            <td>{{ number_format($item->salary_coefficient, 2, ',', '.') }}</td>
                            <td>{{ number_format($item->allowance_salary_coefficient, 2, ',', '.') }}</td>
                            <td>{{ number_format(($item->salary_coefficient + $item->allowance_salary_coefficient), 2, ',', '.') }}</td>
                            <td>{{ number_format($item->tong_hs, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->luong_theo_hs, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->luong_theo_hspc, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->bhxh_capbac, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->bhyt_capbac, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->bhtn_capbac, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->bhxh_hscv, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->bhyt_hscv, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->bhtn_hscv, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->tong_tru_luong, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->bhxh_to_chuc, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->bhyt_to_chuc, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->bhtn_to_chuc, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->bhnn_to_chuc, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->tong_to_chuc, 0, ',', '.') }}</td>
                        @endif
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->bhxh_id }}">
                                <i class="bi bi-pencil-square"></i>
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
        var table = $('#BhxhTable').DataTable();

        //Hiện chi tiết của dữ liệu
        $('#BHXHTableBody').on('click', '.edit-btn', function () {
            var bhxh_id = $(this).data('id');

            $('#editBHXHForm').data('id', bhxh_id);
            var url = "{{ route('edit-bhxh', ':id') }}";
            url = url.replace(':id', bhxh_id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var data = response.bhxh;
                    console.log(data)
                    $('#employee_name').val(data.first_name + ' ' + data.last_name);
                    $('#job_level').val(data.job_position_name + ' - ' + data.job_level);
                    $('#type_employee_id').val(data.type_employee_name);
                    $('#salary_code').val(data.salary_code);
                    $('#salary_coefficient').val(data.salary_coefficient || ''); // Xử lý trường hợp null
                    $('#allowance_salary_coefficient').val(data.allowance_salary_coefficient || ''); // Xử lý trường hợp null
                    $('#editBHXHModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        //Lưu lại dữ liệu khi chỉnh sửa
        $('#editBHXHForm').submit(function (e) {
            e.preventDefault();
            var bhxh_id = $(this).data('id');

            var url = "{{ route('update-bhxh', ':id') }}";
            url = url.replace(':id', bhxh_id);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#editBHXHModal').modal('hide');
                        toastr.success(response.response, "Edit successful");
                        setTimeout(function () {
                            location.reload()
                        }, 500);
                        // $('#salarycalculationTable').DataTable().ajax.reload();

                    }
                },
                error: function (xhr) {
                    toastr.error("Error");
                }
            });
        });
    </script>
@endsection
