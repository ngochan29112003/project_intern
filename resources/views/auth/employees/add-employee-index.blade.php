@extends('auth.main')

@section('contents')
    <style>
        .img-container img {
            width: 100%; /* Đảm bảo ảnh chiếm toàn bộ chiều rộng vùng chứa */
            height: auto; /* Đảm bảo tỉ lệ ảnh không bị thay đổi */
            max-height: 500px; /* Giới hạn chiều cao tối đa nếu cần */
            display: block;
            margin: 0 auto;
        }

        .img-container {
            max-width: 100%;
            height: auto; /* Cho phép chiều cao tự điều chỉnh theo chiều rộng */
            overflow: hidden;
            text-align: center;
            margin-bottom: 15px;
        }

    </style>
    <div class="pagetitle">
        <h1>Nhân sự</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Quản lý</li>
                <li class="breadcrumb-item active">Nhân sự</li>
                <li class="breadcrumb-item active">Thêm mới nhân sự</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid p-0 m-0">
        <form id="addEmployeeForm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card mb-0 shadow-none">
                <div class="card-header bg-light fw-semibold text-primary fs-5 text-primary">Thông tin cá nhân</div>
                <div class="card-body p-3">
                    <div class="row gx-3">
                        <div class="col-lg-6 d-inline-grid">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="add_employee_name" class="form-label fw-bold">Họ<span
                                                    class="text-danger fs-6 fw-lighter">*</span></label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="edit_first_name"
                                                   name="first_name"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="add_employee_name" class="form-label fw-bold">Tên<span
                                                    class="text-danger fs-6 fw-lighter">*</span></label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="edit_last_name"
                                                   name="last_name"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="birth_date" class="form-label fw-bold">Ngày sinh<span
                                                    class="text-danger fs-6 fw-lighter">*</span></label>
                                        </div>
                                        <div class="col-7">
                                            <input type="date" class="form-control" id="birth_date" name="birth_date"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="birth_place" class="form-label fw-bold">Nơi sinh<span
                                                    class="text-danger fs-6 fw-lighter">*</span></label>
                                        </div>
                                        <div class="col-7">
                                            <select class="form-select" aria-label="Default" name="birth_place"
                                                    id="birth_place">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="ethnic" class="form-label fw-bold">Dân tộc</label>
                                        </div>
                                        <div class="col-7">
                                            <select class="form-select" aria-label="Default" name="ethnic"
                                                    id="ethnic">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="religion" class="form-label fw-bold">Tôn giáo</label>
                                        </div>
                                        <div class="col-7">
                                            <input type="text" class="form-control" id="religion"
                                                   name="religion">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-inline-grid">
                            <fieldset class="row mb-3">
                                <div class="col-3">
                                    <legend class="col-form-label pt-0 fw-bold">Giới tính</legend>
                                </div>
                                <div class="col-9">
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   id="male"
                                                   value="0" checked>
                                            <label class="form-check-label" for="male">
                                                Nam
                                            </label>
                                        </div>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   id="female"
                                                   value="1">
                                            <label class="form-check-label" for="female">
                                                Nữ
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   id="other"
                                                   value="3">
                                            <label class="form-check-label" for="female">
                                                Khác
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="row mb-3">
                                <div class="col-3">
                                    <legend class="col-form-label pt-0 fw-bold">Hôn nhân</legend>
                                </div>
                                <div class="col-9">
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="marital_status"
                                                   id="Single"
                                                   value="0" checked>
                                            <label class="form-check-label" for="male">
                                                Chưa kết hôn
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="marital_status"
                                                   id="Married"
                                                   value="1">
                                            <label class="form-check-label" for="female">
                                                Đã kết hôn
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <div class="col-3">
                                    <label for="nation" class="form-label fw-bold">Quốc tịch</label>

                                </div>
                                <div class="col-9">
                                    <select class="form-select" aria-label="Default" name="nation"
                                            id="nation">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="row mb-3">
                                <div class="col-12 text-center">
                                    <label for="img" class="form-label fw-bold">Hình ảnh</label>
                                    <input type="file" class="form-control d-none" id="img" name="img">
                                    <div class="previewIMG mb-2 d-none">
                                        <img id="previewImage" class="rounded-pill object-fit-cover border" src=""
                                             alt="Preview" width="100" height="100">
                                    </div>
                                    <button type="button" class="btn btn-primary" id="imgButton">Chọn ảnh</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-0 shadow-none">
                <div class="card-header bg-light fw-semibold text-primary fs-5">Thông tin liên lạc</div>
                <div class="card-body p-3">
                    <div class="row gx-3">
                        <div class="col-lg-6 d-inline-grid">
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label fw-bold">Số điện thoại</label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number">
                            </div>
                            <div class="mb-3">
                                <label for="place_of_resident" class="form-label fw-bold">Nơi cư trú</label>
                                <input type="text" class="form-control" id="place_of_resident"
                                       name="place_of_resident">
                            </div>
                            <div class="mb-3">
                                <label for="permanent_address" class="form-label fw-bold">Địa chỉ thường trú</label>
                                <input type="text" class="form-control" id="permanent_address"
                                       name="permanent_address">
                            </div>
                        </div>
                        <div class="col-lg-6 d-inline-grid">
                            <div class="mb-3">
                                <label for="cic_number" class="form-label fw-bold">CMND/CCCD</label>
                                <input type="number" class="form-control" id="cic_number" name="cic_number">
                            </div>
                            <div class="mb-3">
                                <label for="place_of_issue" class="form-label fw-bold">Nơi cấp</label>
                                <input type="text" class="form-control" id="place_of_issue" name="place_of_issue">
                            </div>
                            <div class="mb-3">
                                <label for="date_of_issue" class="form-label fw-bold">Ngày cấp</label>
                                <input type="date" class="form-control" id="date_of_issue" name="date_of_issue">
                            </div>
                            <div class="mb-3">
                                <label for="date_of_exp" class="form-label fw-bold">Ngày hết hạn</label>
                                <input type="date" class="form-control" id="date_of_exp" name="date_of_exp">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-0 shadow-none">
                <div class="card-header bg-light fw-semibold text-primary fs-5">Thông tin công việc</div>
                <div class="card-body p-3">
                    <div class="row gx-3">
                        <div class="col-lg-6 d-inline-grid">
                            <div class="mb-3">
                                <label for="job_position_code" class="form-label fw-bold">Mã chức vụ</label>
                                <input type="text" class="form-control" id="job_position_code" name="job_position_code" style="color: #6c757d; background-color: #e9ecef;" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="job_position_id" class="form-label fw-bold">Vị trí công việc</label>
                                <select class="form-select" aria-label="Default" name="job_position_id"
                                        id="job_position_id">
                                        <option value="">None</option>
                                    @foreach ($position_list as $item)
                                        <option
                                            value="{{ $item->job_position_id }}">{{$item->job_position_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="job_level" class="form-label fw-bold">Cấp bậc chức vụ</label>
                                <select class="form-select" aria-label="Default" name="job_level"
                                        id="job_level">
                                    <option value=""></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="salary_code" class="form-label fw-bold">Mã số ngạch lương</label>
                                <input type="text" class="form-control" id="salary_code" name="salary_code">
                            </div>
                        </div>
                        <div class="col-lg-6 d-inline-grid">
                            <div class="mb-3">
                                <label for="department_id" class="form-label fw-bold">Phòng ban</label>
                                <select class="form-select" aria-label="Default" name="department_id"
                                        id="department_id">
                                    @foreach ($department_list as $item)
                                        <option
                                            value="{{ $item->department_id}}">{{ $item->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="type_employee_id" class="form-label fw-bold">Loại nhân viên<span
                                        class="text-danger fs-6 fw-lighter">*</span></label>
                                <select class="form-select" aria-label="Default" name="type_employee_id"
                                        id="type_employee_id">
                                    @foreach ($type_employee_list as $item)
                                        <option
                                            value="{{ $item->type_employee_id }}">{{ $item->type_employee_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">Trạng thái<span
                                        class="text-danger fs-6 fw-lighter">*</span></label>
                                <select class="form-select" aria-label="Default" name="status" id="edit_status">
                                    <option value="0">Đã nghỉ việc</option>
                                    <option value="1">Đang làm việc</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="education_level_id" class="form-label fw-bold">Trình độ học vấn</label>
                                <select class="form-select" aria-label="Default" name="education_level_id"
                                        id="edit_education_level_id">
                                    @foreach ($edu_level_list as $item)
                                        <option
                                            value="{{ $item->education_level_id }}">{{ $item->education_level_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="cropImageModal" tabindex="-1" aria-labelledby="cropImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropImageModalLabel">Chỉnh sửa hình ảnh</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="imageToCrop" src="" alt="Image to Crop" style="max-width: 100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="cropButton">Cắt và chọn</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.getElementById('imgButton').addEventListener('click', function () {
            document.getElementById('img').click();
        });

        var cropper;
        document.getElementById('img').addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                var file = this.files[0];
                var fileType = file.type;
                var validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

                if (validImageTypes.includes(fileType)) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var imageToCrop = document.getElementById('imageToCrop');
                        imageToCrop.src = e.target.result;

                        // Hiển thị modal và khởi tạo Cropper sau khi modal hiển thị
                        var cropImageModal = new bootstrap.Modal(document.getElementById('cropImageModal'), {
                            keyboard: false
                        });

                        $('#cropImageModal').on('shown.bs.modal', function () {
                            cropper = new Cropper(imageToCrop, {
                                aspectRatio: 1,
                                viewMode: 2,
                                autoCropArea: 1,
                                responsive: true,
                                restore: true,
                            });
                        });

                        cropImageModal.show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    toastr.error('File không phải là hình ảnh. Vui lòng chọn file định dạng .jpg, .png, .gif, hoặc .webp.');
                    this.value = ''; // Reset input
                }
            }
        });

        document.getElementById('cropButton').addEventListener('click', function () {
            var canvas = cropper.getCroppedCanvas({
                width: 100,
                height: 100,
            });

            // Chuyển đổi canvas thành base64 và hiển thị ảnh
            var previewImage = document.getElementById('previewImage');
            previewImage.src = canvas.toDataURL();
            document.querySelector('.previewIMG').classList.remove('d-none');

            // Đóng modal sau khi crop
            var cropImageModal = bootstrap.Modal.getInstance(document.getElementById('cropImageModal'));
            cropImageModal.hide();
        });

        $.ajax({
            url: 'https://esgoo.net/api-tinhthanh/1/0.htm',
            method: 'GET',
            success: function (response) {
                if (response.error === 0) {
                    var provinces = response.data;
                    $.each(provinces, function (index, province) {
                        $('#birth_place').append('<option value="' + province.name + '">' + province.name + '</option>');
                    });
                } else {
                    console.log('Không thể tải dữ liệu tỉnh thành.');
                }
            },
            error: function () {
                console.log('Có lỗi xảy ra khi gọi API.');
            }
        });

        function populateCountrySelect(selectElementId, countrySelete) {
            $(document).ready(function () {
                $.ajax({
                    url: 'https://restcountries.com/v3.1/all',
                    method: 'GET',
                    success: function (data) {
                        $.each(data, function (index, country) {
                            const $option = $('<option></option>')
                                .val(country.name.common)
                                .text(country.name.common);
                            if (country.name.common === countrySelete) {
                                $option.prop('selected', true);
                            }

                            $(`#${selectElementId}`).append($option);
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching countries:', textStatus, errorThrown);
                    }
                });
            });
        }

        populateCountrySelect('nation', 'Vietnam');

        $(document).ready(function () {
            $.ajax({
                url: "https://api.nosomovo.xyz/ethnic/getalllist",
                method: "GET",
                success: function (data) {
                    // Kiểm tra nếu data là chuỗi, cần parse thành JSON
                    if (typeof data === 'string') {
                        data = JSON.parse(data);
                    }

                    var ethnicSelect = $('#ethnic');
                    ethnicSelect.empty(); // Xóa các option cũ nếu có
                    $.each(data, function (index, item) {
                        var option = $('<option>', {
                            value: item.name,
                            text: item.name
                        });

                        // Nếu id là 2 (dân tộc Kinh), thì chọn option này mặc định
                        if (item.id === "2") {
                            option.attr('selected', 'selected');
                        }

                        ethnicSelect.append(option);
                    });
                },
                error: function (error) {
                    console.error("Đã xảy ra lỗi khi lấy danh sách dân tộc:", error);
                }
            });
        });

        $(document).ready(function() {
            $('#job_position_id').change(function() {
                var jobPositionId = $(this).val();
                var url = "{{ route('getPositionCode', ':id') }}";
                url = url.replace(':id', jobPositionId);
                if (jobPositionId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            console.log(response);
                            if (response.job_position_code) {
                                $('#job_position_code').val(response.job_position_code);
                            } else {
                                $('#job_position_code').val('');
                            }
                        },
                        error: function() {
                            console.error('Đã xảy ra lỗi khi lấy mã chức vụ.');
                            $('#job_position_code').val('');
                        }
                    });
                } else {
                    $('#job_position_code').val('');
                }
            });
        });


        // JS Add employee
        $('#addEmployeeForm').submit(function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('add-employees') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message, "Successful");
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    } else {
                        toastr.error(response.message, "Error");
                    }
                },
                error: function (xhr) {
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

