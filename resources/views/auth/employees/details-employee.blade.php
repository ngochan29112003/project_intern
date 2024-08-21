@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Nhân sự</h1>
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
            <div class="card mb-0 shadow-none">
                <div class="card-header bg-light fw-semibold text-primary fs-5 text-primary">Thông tin cá nhân</div>
                <div class="card-body p-3">
                    <div class="row gx-3">
                        <div class="col-lg-2">
                            <div class="row mb-3">
                                <div class="col-3">
                                    <img class="border rounded-pill object-fit-cover" width="150px" height="150px"
                                         id="current_img" src="">
                                </div>
                                <div class="col-12">
                                    <input type="file" id="edit_img" name="img" class="d-none">
                                    <label for="edit_img" class="btn btn-primary" style="width: 150px;">
                                        <i class="bi bi-upload"></i> Hình ảnh mới
                                    </label>
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
                                                   required>
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
                                                   required>
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
                                            <input type="date" class="form-control" id="birth_date" name="birth_date"
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
                                            <input type="text" class="form-control" id="ethnic"
                                                   name="ethnic"
                                                   required>
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
                                                   required>
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
                                <input type="number" class="form-control" id="cic_number" name="cic_number"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="place_of_issue" class="form-label fw-bold">Nơi cấp</label>
                                <input type="text" class="form-control" id="place_of_issue" name="place_of_issue">
                            </div>
                            <div class="mb-3">
                                <label for="date_of_issue" class="form-label fw-bold">Ngày cấp</label>
                                <input type="date" class="form-control" id="date_of_issue" name="date_of_issue"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_exp" class="form-label fw-bold">Ngày hết hạn</label>
                                <input type="date" class="form-control" id="date_of_exp" name="date_of_exp"
                                       required>
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
                                <input type="text" class="form-control" id="job_position_code" name="job_position_code" required>
                            </div>
                            <div class="mb-3">
                                <label for="job_position_id" class="form-label fw-bold">Vị trí công việc</label>
                                <select class="form-select" aria-label="Default" name="job_position_id"
                                        id="job_position_id">
                                    {{--                            @foreach ($position_list as $item)--}}
                                    {{--                                <option--}}
                                    {{--                                    value="{{ $item->job_position_id }}">{{$item->job_position_name . ' - ' . $item->position_level}}</option>--}}
                                    {{--                            @endforeach--}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="position_level" class="form-label fw-bold">Cấp bậc chức vụ</label>
                                <select class="form-select" aria-label="Default" name="position_level"
                                        id="position_level">
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
                                    {{--                            @foreach ($department_list as $item)--}}
                                    {{--                                <option--}}
                                    {{--                                    value="{{ $item->department_id}}">{{ $item->department_name}}</option>--}}
                                    {{--                            @endforeach--}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="type_employee_id" class="form-label fw-bold">Loại nhân viên</label>
                                <select class="form-select" aria-label="Default" name="type_employee_id"
                                        id="type_employee_id">
                                    {{--                            @foreach ($type_employee_list as $item)--}}
                                    {{--                                <option--}}
                                    {{--                                    value="{{ $item->type_employee_id }}">{{ $item->type_employee_name }}</option>--}}
                                    {{--                            @endforeach--}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">Trạng thái</label>
                                <select class="form-select" aria-label="Default" name="status" id="edit_status">
                                    <option value="0">Đã nghỉ việc</option>
                                    <option value="1">Đang làm việc</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="education_level_id" class="form-label fw-bold">Trình độ học vấn</label>
                                <select class="form-select" aria-label="Default" name="education_level_id"
                                        id="edit_education_level_id">
                                    {{--                            @foreach ($edu_level_list as $item)--}}
                                    {{--                                <option--}}
                                    {{--                                    value="{{ $item->education_level_id }}">{{ $item->education_level_name }}</option>--}}
                                    {{--                            @endforeach--}}
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



@endsection

@section('scripts')

@endsection

