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

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Bảng tính BHXH</h3>
        <div class="table-responsive">
            <table id="BhxhTable" class="table table-hover table-bordered">
                <thead class="table-light">
                <tr>
                    <th rowspan="2">STT</th>
                    <th rowspan="2">Họ và tên</th>
                    <th rowspan="2">Cấp bậc chức vụ</th>
                    <th rowspan="2">Mã số ngạch lương</th>
                    <th colspan="3">Hệ số</th>
                    <th rowspan="2">Tổng</th>
                    <th colspan="2">Thành tiền</th>
                    <th colspan="6">Các khoản trừ vào lương 10,5%</th>
                    <th colspan="6">Tổ chức đóng 21,5%</th>
                </tr>
                <tr>
                    <th>Hệ số lương</th>
                    <th>HS PC CV</th>
                    <th>Cộng hệ số</th>
                    <th>Lương theo Hệ số</th>
                    <th>Lương theo HS phụ cấp CV</th>
                    <th>BHXH</th>
                    <th>BHYT</th>
                    <th>BHTN</th>
                    <th>BHXH</th>
                    <th>BHYT</th>
                    <th>BHTN</th>
                    <th>Cộng</th>
                    <th>BHXH</th>
                    <th>BHYT</th>
                    <th>BHTN</th>
                    <th>BHNN</th>
                    <th>Cộng</th>
                </tr>
                </thead>
                <tbody id="BHXHTableBody">
                @php($stt = 0)
                @foreach ($bhxh_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->bhxh_id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->bhxh_id}}">
                                <i class="bi bi-trash3"></i>
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
        var table = $('#BHXHTable').DataTable();
    </script>
@endsection
