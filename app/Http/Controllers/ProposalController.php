<?php

namespace App\Http\Controllers;

use App\Models\ProposalModel;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    function getView()
    {
        $model = new ProposalModel();
        $proposal_list = $model->getProposal();
        $employee_list = $model->getEmployee();
        $type_proposal_list = $model->getTypeProposal();
        return view('auth.proposals.index-proposal',
            compact('proposal_list', 'employee_list', 'type_proposal_list'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'add_employee_id' => 'int',
            'add_type_proposal_id' => 'required|string',
            'add_proposal_date' => 'required|string',
            'add_status' => 'required|string',
        ]);

        ProposalModel::create([
            'employee_id' =>$validated['add_employee_id'],
            'type_proposal_id' =>$validated['add_type_proposal_id'],
            'proposal_date' =>$validated['add_proposal_date'],
            'status' =>$validated['add_status'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Proposal added successfully',
        ]);
    }

    public function delete($id)
    {
        $proposal = ProposalModel::findOrFail($id);

        $proposal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Proposal deleted successfully'
        ]);
    }
}
