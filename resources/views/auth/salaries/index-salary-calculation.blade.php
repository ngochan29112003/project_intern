@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Bảng tính lương</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Quản lý</a></li>
                <li class="breadcrumb-item active">Bảng tính lương</li>
            </ol>
        </nav>
    </div>

    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-success mx-2 btn-export">
                <a href="{{route('export-salary')}}" class="d-flex align-items-center text-white">
                    <i class="bi bi-file-earmark-arrow-down pe-2"></i>
                    Xuất file excel
                </a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editSalaryModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông tin bảng lương</h4>
                </div>
                <div class="modal-body">
                    <form id="editSalaryForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="employee_name" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="employee_name"
                                           style="color: #6c757d; background-color: #e9ecef;" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="job_level" class="form-label">Cấp bậc chức vụ</label>
                                    <input type="text" class="form-control" id="job_level"
                                           style="color: #6c757d; background-color: #e9ecef;" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="salary_code" class="form-label">Mã số ngạch lương</label>
                                    <input type="text" class="form-control" id="salary_code"
                                           style="color: #6c757d; background-color: #e9ecef;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="salary_coefficient" class="form-label">Hệ số lương <span class="text-danger fs-6 fw-light fst-italic">(trường này rỗng sẽ không tính được lương)</span></label>
                                    <input type="number" class="form-control" id="salary_coefficient" name="salary_coefficient" step="0.01">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="allowance_salary_coefficient" class="form-label">HSPCCV</label>
                                    <input type="number" class="form-control" id="allowance_salary_coefficient" name="allowance_salary_coefficient" step="0.01">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="gross_salary" class="form-label">Thành tiền <span class="text-danger fs-6 fw-light fst-italic">(HSL + HSPCCV x 2.340.000đ)</span></label>
                                <input type="number" class="form-control" id="gross_salary" name="gross_salary" style="color: #6c757d; background-color: #e9ecef;" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="social_insurance" class="form-label">BHXH <span class="text-danger fs-6 fw-light fst-italic">(Thành tiền x 8%)</span></label>
                                    <input type="text" class="form-control" id="social_insurance" name="social_insurance" style="color: #6c757d; background-color: #e9ecef;" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="health_insurance" class="form-label">BHYT <span class="text-danger fs-6 fw-light fst-italic">(Thành tiền x 1.5%)</span></label>
                                    <input type="text" class="form-control" id="health_insurance" name="health_insurance" style="color: #6c757d; background-color: #e9ecef;" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="accident_insurance" class="form-label">BHTN <span class="text-danger fs-6 fw-light fst-italic">(Thành tiền x 1%)</span></label>
                                    <input type="text" class="form-control" id="accident_insurance" name="accident_insurance" style="color: #6c757d; background-color: #e9ecef;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="net_salary" class="form-label">Tổng lương nhận <span class="text-danger fs-6 fw-light fst-italic">(Thành tiền - (BHXH + BHYT + BHTN))</span></label>
                            <input type="number" class="form-control" id="net_salary" name="net_salary" style="color: #6c757d; background-color: #e9ecef;" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Save change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Bảng tính lương</h3>
        <div class="table-responsive">
            <table id="salarycalculationTable" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Họ và tên</th>
                    <th>Cấp bậc chức vụ</th>
                    <th>Mã số ngạch lương</th>
                    <th>Hệ số lương</th>
                    <th>HSPCCV</th>
                    <th>Thành tiền</th>
                    <th>BHXH</th>
                    <th>BHYT</th>
                    <th>BHTN</th>
                    <th>Tổng lương nhận</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="salarycalculationTableBody">
                @foreach ($salaries as $index => $salary)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $salary->first_name }} {{ $salary->last_name }}</td>
                        <td>{{ $salary->job_position_name.' - '.$salary->position_level }}</td>
                        <td>{{ $salary->salary_code}}</td>
                        <td>{{ $salary->salary_coefficient}}</td>
                        <td>{{ $salary->allowance_salary_coefficient }}</td>
                        @if(!$salary->salary_coefficient)
                            <td colspan="5" class="text-center">N/A</td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                        @else
                            <td>{{ number_format($salary->gross_salary, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->social_insurance, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->health_insurance, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->accident_insurance, 0, ',', '.') }}</td>
                            <td>{{ number_format($salary->net_salary, 0, ',', '.') }}</td>
                        @endif
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $salary->salary_id }}">
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
        var table = $('#salarycalculationTable').DataTable();


        //Hiện chi tiết của dữ liệu
        $('#salarycalculationTableBody').on('click', '.edit-btn', function () {
            var salary_id = $(this).data('id');

            $('#editSalaryForm').data('id', salary_id);
            var url = "{{ route('edit-salary', ':id') }}";
            url = url.replace(':id', salary_id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    var data = response.salary;
                    console.log(data)
                    $('#employee_name').val(data.first_name + ' ' + data.last_name);
                    $('#job_level').val(data.job_position_name + ' - ' + data.position_level);
                    $('#salary_code').val(data.salary_code);
                    $('#salary_coefficient').val(data.salary_coefficient || ''); // Xử lý trường hợp null
                    $('#allowance_salary_coefficient').val(data.allowance_salary_coefficient || ''); // Xử lý trường hợp null
                    $('#gross_salary').val(data.gross_salary);
                    $('#social_insurance').val(data.social_insurance);
                    $('#health_insurance').val(data.health_insurance);
                    $('#accident_insurance').val(data.accident_insurance);
                    $('#net_salary').val(data.net_salary);
                    $('#editSalaryModal').modal('show');
                },
                error: function (xhr) {
                }
            });
        });

        //Lưu lại dữ liệu khi chỉnh sửa
        $('#editSalaryForm').submit(function (e) {
            e.preventDefault();
            var salary_id = $(this).data('id');
            var url = "{{ route('update-salary', ':id') }}";
            url = url.replace(':id', salary_id);
            var formData = new FormData(this);
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#editSalaryModal').modal('hide');
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
