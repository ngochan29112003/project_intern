@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1><a href="{{ route('index-employees') }}">Nhân sự</a></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Quản lý</li>
                <li class="breadcrumb-item active">Nhân sự</li>
                <li class="breadcrumb-item active">Thông tin nhân sự</li>
            </ol>
        </nav>
    </div>
    <div class="container-fluid p-0 m-0">
        <form id="editEmployeeForm" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="employee_id" name="employee_id" value="{{$employee_current->employee_id}}">
            <div class="card mb-0 shadow-none">
                <div class="card-header bg-light fw-semibold text-primary fs-5 text-primary">Thông tin cá nhân</div>
                <div class="card-body p-3">
                    <div class="row gx-3">
                        <div class="col-lg-2">
                            <div class="row mb-3">
                                <div class="col-3 mb-2">
                                    <img class="border rounded-pill object-fit-cover" width="150px" height="150px"
                                         id="current_img" src="{{asset('assets/employee_img/'.$employee_current->img)}}">
                                </div>
                                <div class="col-12">
                                    <input type="file" class="form-control d-none" id="img" name="img">
                                    <button type="button" class="btn btn-primary" id="imgButton"><i class="bi bi-upload"></i> Hình ảnh mới</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-inline-grid">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="add_employee_name" class="form-label fw-bold">Họ</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="edit_first_name"
                                                   name="first_name"
                                                   required value="{{$employee_current->first_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-2">
                                            <label for="add_employee_name" class="form-label fw-bold">Tên</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="edit_last_name"
                                                   name="last_name"
                                                   required value="{{$employee_current->last_name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="birth_date" class="form-label fw-bold">Ngày sinh</label>
                                        </div>
                                        <div class="col-7">
                                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{$employee_current->birth_date}}"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="birth_place" class="form-label fw-bold">Nơi sinh</label>
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
                                                   name="religion"
                                                   value="{{$employee_current->religion}}">
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
                                                   value="0" {{ $employee_current->gender == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="male">
                                                Nam
                                            </label>
                                        </div>
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   id="female"
                                                   value="1" {{ $employee_current->gender == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="female">
                                                Nữ
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   id="other"
                                                   value="3" {{ $employee_current->gender == 3 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="other">
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
                                                   value="0" {{ $employee_current->marital_status == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="Single">
                                                Chưa kết hôn
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="marital_status"
                                                   id="Married"
                                                   value="1" {{ $employee_current->marital_status == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="Married">
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
                                        <option
                                            value=""></option>
                                    </select>
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
                                <input type="email" class="form-control" id="email" name="email" value="{{$employee_current->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label fw-bold">Số điện thoại</label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{$employee_current->phone_number}}">
                            </div>
                            <div class="mb-3">
                                <label for="place_of_resident" class="form-label fw-bold">Nơi cư trú</label>
                                <input type="text" class="form-control" id="place_of_resident"
                                       name="place_of_resident" value="{{$employee_current->place_of_resident}}">
                            </div>
                            <div class="mb-3">
                                <label for="permanent_address" class="form-label fw-bold">Địa chỉ thường trú</label>
                                <input type="text" class="form-control" id="permanent_address"
                                       name="permanent_address" value="{{$employee_current->permanent_address}}">
                            </div>
                        </div>
                        <div class="col-lg-6 d-inline-grid">
                            <div class="mb-3">
                                <label for="cic_number" class="form-label fw-bold">CMND/CCCD</label>
                                <input type="number" class="form-control" id="cic_number" name="cic_number"
                                       value="{{$employee_current->cic_number}}">
                            </div>
                            <div class="mb-3">
                                <label for="place_of_issue" class="form-label fw-bold">Nơi cấp</label>
                                <input type="text" class="form-control" id="place_of_issue" name="place_of_issue"
                                       value="{{$employee_current->place_of_issue}}">
                            </div>
                            <div class="mb-3">
                                <label for="date_of_issue" class="form-label fw-bold">Ngày cấp</label>
                                <input type="date" class="form-control" id="date_of_issue" name="date_of_issue"
                                       value="{{$employee_current->date_of_issue}}">
                            </div>
                            <div class="mb-3">
                                <label for="date_of_exp" class="form-label fw-bold">Ngày hết hạn</label>
                                <input type="date" class="form-control" id="date_of_exp" name="date_of_exp"
                                       value="{{$employee_current->date_of_exp}}">
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
                                <input type="text" class="form-control" id="job_position_code" name="job_position_code" style="color: #6c757d; background-color: #e9ecef;"
                                       readonly
                                        value="{{$employee_current->job_position_code}}">
                            </div>
                            <div class="mb-3">
                                <label for="job_position_id" class="form-label fw-bold">Vị trí công việc</label>
                                <select class="form-select" aria-label="Default" name="job_position_id" id="job_position_id">
                                    @foreach ($position_list as $item)
                                        <option
                                            value="{{ $item->job_position_id }}" {{ $item->job_position_id == $employee_current->job_position_id ? 'selected' : '' }}>
                                            {{ $item->job_position_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="position_level" class="form-label fw-bold">Cấp bậc chức vụ</label>
                                <select class="form-select" aria-label="Default" name="position_level" id="position_level">
                                    <option value="1" {{ $employee_current->job_level == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $employee_current->job_level == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $employee_current->job_level == 3 ? 'selected' : '' }}>3</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="salary_code" class="form-label fw-bold">Mã số ngạch lương</label>
                                <input type="text" class="form-control" id="salary_code" name="salary_code" value="{{$employee_current->salary_code}}">
                            </div>
                        </div>
                        <div class="col-lg-6 d-inline-grid">
                            <div class="mb-3">
                                <label for="department_id" class="form-label fw-bold">Phòng ban</label>
                                <select class="form-select" aria-label="Default" name="department_id"
                                        id="department_id">
                                    @foreach ($department_list as $item)
                                        <option
                                            value="{{ $item->department_id}}" {{ $item->department_id == $employee_current->department_id ? 'selected' : '' }}>{{ $item->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="type_employee_id" class="form-label fw-bold">Loại nhân viên</label>
                                <select class="form-select" aria-label="Default" name="type_employee_id"
                                        id="type_employee_id">
                                    @foreach ($type_employee_list as $item)
                                        <option
                                            value="{{ $item->type_employee_id }}" {{ $item->type_employee_id == $employee_current->type_employee_id ? 'selected' : '' }}>{{ $item->type_employee_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">Trạng thái</label>
                                <select class="form-select" aria-label="Default" name="status" id="edit_status">
                                    <option value="0" {{ $employee_current->status == 0 ? 'selected' : '' }}>Đã nghỉ việc</option>
                                    <option value="1" {{ $employee_current->status == 1 ? 'selected' : '' }}>Đang làm việc</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="education_level_id" class="form-label fw-bold">Trình độ học vấn</label>
                                <select class="form-select" aria-label="Default" name="education_level_id"
                                        id="edit_education_level_id">
                                    @foreach ($edu_level_list as $item)
                                        <option
                                            value="{{ $item->education_level_id }}" {{ $item->education_level_id == $employee_current->education_level_id ? 'selected' : '' }}>{{ $item->education_level_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
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

                        // Hiển thị modal
                        var cropImageModal = new bootstrap.Modal(document.getElementById('cropImageModal'), {
                            keyboard: false
                        });
                        cropImageModal.show();

                        // Khởi tạo Cropper sau khi ảnh được tải
                        cropImageModal._element.addEventListener('shown.bs.modal', function () {
                            if (cropper) {
                                cropper.destroy(); // Hủy bỏ cropper cũ nếu có
                            }
                            cropper = new Cropper(imageToCrop, {
                                aspectRatio: 1,
                                viewMode: 2,
                                autoCropArea: 1,
                                responsive: true,
                                restore: true,
                            });
                        });
                    };
                    reader.readAsDataURL(file);
                } else {
                    toastr.error('File không phải là hình ảnh. Vui lòng chọn file định dạng .jpg, .png, .gif, hoặc .webp.');
                    this.value = ''; // Reset input
                }
            }
        });

        document.getElementById('cropButton').addEventListener('click', function () {
            var canvas = cropper.getCroppedCanvas();

            // Chuyển đổi canvas thành blob để gửi trong form, với chất lượng gốc (1 là giữ nguyên chất lượng)
            canvas.toBlob(function(blob) {
                var formData = new FormData();
                formData.append('cropped_image', blob, 'cropped_image.png');

                // Gán blob vào một biến toàn cục hoặc gắn vào form data trong hàm submit
                window.croppedImageBlob = blob;
            }, 'image/png', 1); // 'image/png' định dạng ảnh và 1 là giữ nguyên chất lượng

            // Hiển thị preview ảnh đã crop (không ảnh hưởng đến chất lượng)
            var previewImage = document.getElementById('current_img');
            previewImage.src = canvas.toDataURL('image/png');

            // Đóng modal sau khi crop
            var cropImageModal = bootstrap.Modal.getInstance(document.getElementById('cropImageModal'));
            cropImageModal.hide();
        });

        // Fill birthplace
        $.ajax({
            url: 'https://esgoo.net/api-tinhthanh/1/0.htm',
            method: 'GET',
            success: function (response) {
                if (response.error === 0) {
                    var provinces = response.data;
                    var currentBirthPlace = "{{ $employee_current->birth_place }}"; // Lấy giá trị birth_place hiện tại
                    $.each(provinces, function (index, province) {
                        var selected = province.name === currentBirthPlace ? 'selected' : ''; // Kiểm tra nếu nơi sinh hiện tại khớp với giá trị trong danh sách
                        $('#birth_place').append('<option value="' + province.name + '" ' + selected + '>' + province.name + '</option>');
                    });
                } else {
                    console.log('Không thể tải dữ liệu tỉnh thành.');
                }
            },
            error: function () {
                console.log('Có lỗi xảy ra khi gọi API.');
            }
        });

        // Fill nationality
        function populateCountrySelect(selectElementId, countrySelete) {
            $(document).ready(function () {
                $.ajax({
                    url: 'https://restcountries.com/v3.1/all',
                    method: 'GET',
                    success: function (data) {
                        var currentNation = "{{ $employee_current->nation }}"; // Lấy giá trị nation hiện tại
                        $.each(data, function (index, country) {
                            const selected = country.name.common === currentNation ? 'selected' : '';
                            const $option = $('<option></option>')
                                .val(country.name.common)
                                .text(country.name.common)
                                .prop('selected', selected);
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

        // Fill ethnic
        function populateEthnicSelect(selectElementId, selectedEthnic) {
            $(document).ready(function () {
                $.ajax({
                    url: "https://api.nosomovo.xyz/ethnic/getalllist",
                    method: "GET",
                    success: function (data) {
                        // Kiểm tra nếu data là chuỗi, cần parse thành JSON
                        if (typeof data === 'string') {
                            data = JSON.parse(data);
                        }

                        var currentEthnic = "{{ $employee_current->ethnic }}"; // Lấy giá trị ethnic hiện tại
                        $.each(data, function (index, item) {
                            const selected = item.name === currentEthnic ? 'selected' : '';
                            const $option = $('<option></option>')
                                .val(item.name)
                                .text(item.name)
                                .prop('selected', selected);
                            $(`#${selectElementId}`).append($option);
                        });
                    },
                    error: function (error) {
                        console.error("Đã xảy ra lỗi khi lấy danh sách dân tộc:", error);
                    }
                });
            });
        }

        populateEthnicSelect('ethnic', 'Kinh');

        $('#editEmployeeForm').submit(function (e) {
            e.preventDefault();
            var employee_id = $('#employee_id').val(); // Lấy ID từ input hidden trong form
            var url = "{{ route('update-employees', ':id') }}";
            url = url.replace(':id', employee_id);
            var formData = new FormData(this);

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.response, "Edit successful");
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    }
                },
                error: function (xhr) {
                    toastr.error("Error occurred during update.");
                }
            });
        });

    </script>
@endsection

