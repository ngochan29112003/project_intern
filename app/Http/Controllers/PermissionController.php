<?php
namespace App\Http\Controllers;

use App\Models\PermissionModel;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    function getView()
    {
        $model = new PermissionModel();
        $permission_list = $model->getPermission();
//        dd($permission_list);
        return view('auth.permission.index-permission', compact('permission_list'));
    }

    function add(Request $request){
        $validated = $request->validate([
            'add_permission_name'=>'required|string',
        ]);

        PermissionModel::create([
            'permission_name' =>$validated['add_permission_name'],
        ]);

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'permission added successfully',
        ]);
    }

    public function delete($id)
    {
        $permission = PermissionModel::findOrFail($id);

        $permission->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reward deleted successfully'
        ]);
    }
    public function edit($id)
    {
        $permission = PermissionModel::findOrFail($id);
        return response()->json([
            'permission' => $permission
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'permission_name' => 'string',
        ]);
        $permission = PermissionModel::findOrFail($id);
        $permission->update($validated);

        return response()->json([
            'success' => true,
            'permission' => $permission,
        ]);
    }
}
