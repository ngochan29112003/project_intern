@extends('auth.main')
@section('contents')
    <div class="pagetitle">
        <h1>Proposal Applicaiton</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Proposal Applicaiton</li>
            </ol>
        </nav>
    </div>
    <div class="row gx-3 my-3">
        <div class="col-md-6 m-0">
            <div class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addProposalApplicationModal">
                <div class="d-flex align-items-center at1">
                    <i class="bi bi-file-earmark-plus pe-2"></i>
                    Add Proposal Applicaiton
                </div>
            </div>
            <div class="btn btn-success mx-2 btn-export">
                <a href="" class="d-flex align-items-center text-white">
                    <i class="bi bi-file-earmark-arrow-down pe-2"></i>
                    Export
                </a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editProposalModal" tabindex="-1" aria-labelledby="editProposalModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProposalModalLabel">Edit Proposal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProposalForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editProposalId" name="proposal_application_id">
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee name</label>
                            <input type="text" class="form-control" id="employee_name" readonly>
                            <input type="hidden" id="edit_employee_id" name="employee_id">
                        </div>
                        <div class="mb-3">
                            <label for="proposal_id" class="form-label">Proposal Type</label>
                            <select class="form-select" aria-label="Default" name="proposal_id" id="edit_proposal_id">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_proposal_description">Description</label>
                            <textarea class="form-control" placeholder="Leave a Description here"
                                      id="edit_proposal_description"
                                      name="proposal_description" style="height: 100px"></textarea>
                        </div>
                        <label for="proposal_files">Proposal File Uploaded</label>
                        <div class="mb-3 table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Proposal File Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="overflow-y-scroll">
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label for="edit_files" class="form-label">Add more files</label>
                            <input class="form-control" type="file" id="edit_files" name="files[]" multiple>
                            <ul id="editFileList" class="list-unstyled mt-2"></ul>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow-sm p-3 mb-5 bg-white rounded-4">
        <h3 class="text-left mb-4">Proposal Application</h3>
        <table id="proposalApplicationsTable" class="table table-hover table-borderless">
            <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Employee Name</th>
                <th>Proposal Name Type</th>
                <th>Description</th>
                <th>Progress</th>
            </tr>
            </thead>
            <tbody id="proposalTableBody">
            @php($stt = 0)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>

        </table>
    </div>
@endsection

@section('scripts')
    <script>
        var table = $('#proposalApplicationsTable').DataTable();
    </script>
@endsection
