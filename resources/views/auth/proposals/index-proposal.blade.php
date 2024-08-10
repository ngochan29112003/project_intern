@extends('auth.main')

@section('contents')
    <div class="pagetitle">
        <h1>Proposal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Management</a></li>
                <li class="breadcrumb-item active">Proposal</li>
            </ol>
        </nav>
    </div>

    <!-- ======= Các button chức năng ======= -->
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addProposal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add a new proposal
                </div>
            </div>
            <div class="btn btn-success mx-2 btn-export">
                <a href="" class="d-flex align-items-center text-white">
                    <i class="bi bi-file-earmark-arrow-down pe-2"></i>
                    Export file excel
                </a>
            </div>
        </div>
    </div>

    <!-- ======= Modal thêm (tìm hiểu Modal này trên BS5) ======= -->
    <div class="modal fade" id="addProposal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add proposal</h4>
                </div>
                <div class="modal-body">
                    <form id="addProposalForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="edit_employee_id" class="form-label">Employee name</label>
                            <select class="form-select" aria-label="Default" name="add_employee_id" id="add_employee_id">
                                @foreach ($employee_list as $item)
                                    <option value="{{ $item->employee_id}}">{{ $item->employee_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_type_proposal_id" class="form-label">Type proposal</label>
                            <select class="form-select" aria-label="Default" name="add_type_proposal_id" id="add_type_proposal_id">
                                @foreach ($type_proposal_list as $item)
                                    <option value="{{ $item->type_proposal_id}}">{{ $item->proposal_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_proposal_date" class="form-label">Proposal date</label>
                            <input type="date" class="form-control" id="add_proposal_date" name="add_proposal_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">End date</label>
                            <input type="date" class="form-control" id="add_status" name="add_status" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Proposal</h3>
        <div class="table-responsive">
            <table id="ProposalTable" class="table table-hover table-borderless">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Employee name</th>
                    <th>Type proposal</th>
                    <th>proposal date</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody id="proposalTableBody">
                @php($stt = 0)
                @foreach ($proposal_list as $item)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->employee_name}}</td>
                        <td>{{ $item->proposal_name}}</td>
                        <td>{{ $item->proposal_date}}</td>
                        <td>{{ $item->status}}</td>
                        <td class="text-center">
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-primary shadow-none edit-btn"
                                data-id="{{ $item->proposal_id}}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            |
                            <button
                                class="btn p-0 btn-primary border-0 bg-transparent text-danger shadow-none delete-btn"
                                data-id="{{ $item->proposal_id}}">
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
        var table = $('#ProposalTable').DataTable();

        $('#addProposalForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('add-proposal') }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addModal').modal('hide');
                        toastr.success(response.messMEage, "Successful");
                        setTimeout(function() {
                            location.reload()
                        }, 500);
                    } else {
                        toastr.error(response.message, "Error");
                    }
                },
                error: function(xhr) {
                    toastr.error(response.message, "Error");
                    if (xhr.status === 400) {
                        var response = xhr.responseJSON;
                        toastr.error(response.message, "Error");
                    } else {
                        toastr.error("An error occurred", "Error");
                    }
                }
            });
        });

        $('#proposalTableBody').on('click', '.delete-btn', function () {
            var proposalId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to delete this proposal ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete-proposal', ':id') }}'.replace(':id', proposalId),
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                table.row(row).remove().draw();
                                toastr.success(response.message, "Deleted successfully");
                                setTimeout(function () {
                                    location.reload()
                                }, 500);
                            } else {
                                toastr.error("Failed to delete the proposal.",
                                    "Operation Failed");
                            }
                        },
                        error: function (xhr) {
                            toastr.error("An error occurred.", "Operation Failed");
                        }
                    });
                }
            });
        });
    </script>
@endsection
