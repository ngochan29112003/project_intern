@extends('auth.main')
@section('contents')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

@endsection

@section('scripts')
    <script>
        var table = $('#proposalApplicationsTable').DataTable();
    </script>
@endsection
