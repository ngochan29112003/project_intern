@extends('auth.main')
@section('contents')
    <div class="pagetitle">
        <h1>Tổng quan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active">Tổng quan</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row gx-5">
            <div class="col-lg-12">
                <div class="row">

                    <!-- Nhân sự -->
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>Nhân sự</b></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                        <i class="bi bi-people fs-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$countEmployees}} Người</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Phòng Ban -->
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>Phòng Ban</b></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                        <i class="bi bi-building fs-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$countDeparts}} phòng ban</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Phòng Ban -->
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>Tiền Lương</b></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                        <i class="bi bi-building fs-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($salary, 0, ',', '.') }} VND</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bảo hiểm -->
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>Tiền BHXH</b></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                        <i class="bi bi-shield-check fs-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>100000 VND</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chức Vụ -->
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>Chức Vụ</b></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                        <i class="bi bi-briefcase fs-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$countJob}} vị trí</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nhiệm Vụ -->
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>Nhiệm Vụ</b></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                        <i class="bi bi-clipboard-check fs-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$countTask}} nhiệm vụ</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Khen Thưởng -->
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>Khen Thưởng</b></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                        <i class="bi bi-award fs-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$countReward}} Người</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kỷ Luật -->
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>Kỷ Luật</b></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                        <i class="bi bi-exclamation-triangle fs-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$countDisciplines}} Người</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Đề Xuất -->
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>Đề Xuất</b></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                        <i class="bi bi-lightbulb fs-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$countProposal}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Đơn Xin Nghỉ Phép -->
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>Đơn Xin Nghỉ Phép</b></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                        <i class="bi bi-calendar-x fs-4"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$countLeave}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection


@section('scripts')

@endsection
