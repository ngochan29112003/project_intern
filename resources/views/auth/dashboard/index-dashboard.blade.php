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

@endsection

@section('scripts')
    <script>
        var table = $('#proposalApplicationsTable').DataTable();
    </script>
@endsection
