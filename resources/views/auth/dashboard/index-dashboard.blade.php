@extends('auth.main')
<head>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<style>
    .widget-card-title {
        font-family: 'Nunito', sans-serif;
        font-weight: 650;
        text-transform: capitalize;
        letter-spacing: 1px;
        color: #003366;
        line-height: 1.4;
        font-size: 1.25rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    .card-subtitle {
        font-family: 'Roboto', sans-serif;
        font-weight: 500;
        color: #34495e;
    }
</style>
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
    <section class="pb-3 pb-md-4 pb-xl-5 bg-light">
        <div class="container">
            <div class="row gy-3 gy-md-4">
                <!-- Nhân sự -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card widget-card border-0 shadow-lg">
                        <div class="card-body p-4 bg-gradient">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="widget-card-title mb-3 text-primary">Nhân sự</h5>
                                    <h4 class="card-subtitle text-dark m-0">100 người</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bi bi-people fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Phòng Ban -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card widget-card border-0 shadow-lg">
                        <div class="card-body p-4 bg-gradient">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="widget-card-title mb-3 text-primary">Phòng Ban</h5>
                                    <h4 class="card-subtitle text-dark m-0">10 phòng</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bi bi-building fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tiền Lương -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card widget-card border-0 shadow-lg">
                        <div class="card-body p-4 bg-gradient">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="widget-card-title mb-3 text-primary">Tiền Lương</h5>
                                    <h4 class="card-subtitle text-dark m-0">$21,900</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bi bi-currency-dollar fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bảo hiểm -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card widget-card border-0 shadow-lg">
                        <div class="card-body p-4 bg-gradient">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="widget-card-title mb-3 text-primary">Bảo hiểm</h5>
                                    <h4 class="card-subtitle text-dark m-0">10 BHXH</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bi bi-shield-check fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chức Vụ -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card widget-card border-0 shadow-lg">
                        <div class="card-body p-4 bg-gradient">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="widget-card-title mb-3 text-primary">Chức Vụ</h5>
                                    <h4 class="card-subtitle text-dark m-0">25 vị trí</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bi bi-briefcase fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Nhiệm Vụ -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card widget-card border-0 shadow-lg">
                        <div class="card-body p-4 bg-gradient">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="widget-card-title mb-3 text-primary">Nhiệm Vụ</h5>
                                    <h4 class="card-subtitle text-dark m-0">200 nhiệm vụ</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bi bi-clipboard-check fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Khen Thưởng -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card widget-card border-0 shadow-lg">
                        <div class="card-body p-4 bg-gradient">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="widget-card-title mb-3 text-primary">Khen Thưởng</h5>
                                    <h4 class="card-subtitle text-dark m-0">15 giải thưởng</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bi bi-award fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Kỷ Luật -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card widget-card border-0 shadow-lg">
                        <div class="card-body p-4 bg-gradient">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="widget-card-title mb-3 text-primary">Kỷ Luật</h5>
                                    <h4 class="card-subtitle text-dark m-0">8 trường hợp</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bi bi-exclamation-triangle fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Đề Xuất -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card widget-card border-0 shadow-lg">
                        <div class="card-body p-4 bg-gradient">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="widget-card-title mb-3 text-primary">Đề Xuất</h5>
                                    <h4 class="card-subtitle text-dark m-0">5 đề xuất</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bi bi-lightbulb fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Đơn Xin Nghỉ Phép -->
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card widget-card border-0 shadow-lg">
                        <div class="card-body p-4 bg-gradient">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="widget-card-title mb-3 text-primary">Đơn Xin Nghỉ Phép</h5>
                                    <h4 class="card-subtitle text-dark m-0">12 đơn</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center shadow-sm">
                                            <i class="bi bi-calendar-x fs-4"></i>
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
    <script>
        var table = $('#proposalApplicationsTable').DataTable();
    </script>
@endsection
