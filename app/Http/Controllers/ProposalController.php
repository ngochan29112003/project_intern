<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use App\Models\EmployeeModel;
use App\Models\ProposalFileModel;
use App\Models\ProposalModel;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    function getView()
    {
        $account_id = \Illuminate\Support\Facades\Request::session()->get(\App\StaticString::ACCOUNT_ID); //get account_id from session
        $model = new ProposalModel();
        $model_account = new AccountModel();
        $model_employee = new EmployeeModel();
        $employee_id = $model_account->getIdEmployee($account_id); //Get employee_id
        $current_employee = $model_employee->getOneEmployee($employee_id);
        $type_proposal_list = $model->getTypeProposal();
        $proposal_list = $model->getProposalList();
//        dd($proposal_list);
        return view('auth.proposals.index-proposal',
            compact( 'current_employee', 'type_proposal_list', 'proposal_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'int',
            'type_proposal_id' => 'int',
            'proposal_description' => 'string',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,ppt,pptx,txt|max:10000'
        ]);

        $validated['proposal_status'] = 0;
        $proposalApplicaiton = ProposalModel::create($validated);

        if ($request->hasFile('files')) {
            $folderName = $request->employee_id;

            $folderPath = public_path('proposal_files/' . $folderName);

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($folderPath, $fileName);

                ProposalFileModel::create([
                    'proposal_file_name' => $fileName,
                    'proposal_id' => $proposalApplicaiton->proposal_id
                ]);
            }
        }
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Proposal added successfully',
        ]);
    }

    public function delete($id)
    {
        $proposal = ProposalModel::findOrFail($id);
        $directoryPath = public_path('proposal_files/' . $proposal->employee_id);
        foreach ($proposal->files as $file) {
            $filePath = $directoryPath . '/' . $file->proposal_file_name;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $file->delete();
        }
        $proposal->delete();
        return response()->json([
            'success' => true,
            'message' => 'Proposal deleted successfully'
        ]);
    }

    public function edit($id)
    {
        $proposal = ProposalModel::with('employee', 'proposalType', 'files')->findOrFail($id);
//        dd($proposal);
        return response()->json([
            'proposal' => $proposal
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'employee_id' => 'int',
            'type_proposal_id' => 'int',
            'proposal_description' => 'string',
            'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,ppt,pptx,txt|max:10000'
        ]);

        $proposal = ProposalModel::findOrFail($id);
        $proposal->update($validated);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName();
                $employeeId = $proposal->employee_id;
                $filePath = 'proposal_files/' . $employeeId . '/' . $fileName;

                if (!file_exists(public_path('proposal_files/' . $employeeId))) {
                    mkdir(public_path('proposal_files/' . $employeeId), 0777, true);
                }

                $file->move(public_path('proposal_files/' . $employeeId), $fileName);

                ProposalFileModel::create([
                    'proposal_file_name' => $fileName,
                    'proposal_id' => $proposal->proposal_id
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'proposal' => $proposal,
        ]);
    }

    public function removeFile($id)
    {
        $file = ProposalFileModel::findOrFail($id);

        $proposalApp = ProposalModel::findOrFail($file->proposal_id);
        $filePath = public_path('proposal_files/' . $proposalApp->employee_id . '/' . $file->proposal_file_name);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $file->delete();

        return response()->json([
            'success' => true,
            'message' => 'File removed successfully'
        ]);
    }

    public function approve($id,$permission,$postion)
    {
        if($permission == 2 && $postion == 6){
            $proposalApp = ProposalModel::findOrFail($id);
            $proposalApp->proposal_status = 1;
            $proposalApp->save();
        }elseif($permission == 2 && $postion == 7){
            $proposalApp = ProposalModel::findOrFail($id);
            $proposalApp->proposal_status = 2;
            $proposalApp->save();
        }


        return response()->json([
            'success' => true,
            'message' => 'Proposal application approved successfully'
        ]);
    }
}
