@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Nhân sự</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Quản lý</a></li>
                <li class="breadcrumb-item active">Nhân sự</li>
                <li class="breadcrumb-item active">Thông tin nhân sự</li>
            </ol>
        </nav>
    </div>

    <div class="card mb-0 shadow-none">
        <div class="card-header bg-light fw-semibold">Thông tin cá nhân</div>
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
                <div class="col-lg-6">
                    <div class="row mb-5">
                        <div class="col-5">
                            <div class="row">
                                <div class="col-2">
                                    <label for="add_employee_name" class="form-label">Họ</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control" id="edit_first_name"
                                           name="first_name"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-2">
                                    <label for="add_employee_name" class="form-label">Tên</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" class="form-control" id="edit_last_name"
                                           name="last_name"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="birth_date" class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control" id="edit_birth_date" name="birth_date">
                            </div>
                            <div class="col-6">
                                <label for="birth_place" class="form-label">Nơi sinh</label>
                                <select class="form-select" aria-label="Default" id="edit_birth_place"
                                        name="birth_place">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <fieldset class="row">
                            <div class="col-3">
                                <legend class="col-form-label pt-0">Giới tính</legend>
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
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender"
                                               id="female"
                                               value="1">
                                        <label class="form-check-label" for="female">
                                            Nữ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection

