<?php

namespace App\Http\Controllers;

use App\Models\ProfileModel;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function getView()
    {
        $model = new ProfileModel();
        $profile_info_list = $model->getProfile();
//        dd($profile_info_list);
        return view('auth.profile', compact('profile_info_list'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'edit_employees_name' => 'string',
            'edit_birth_place' => 'string',
            'edit_birth_date' => 'date',
            'edit_permanent_address' => 'string',
            'edit_email' => 'string',
            'edit_place_of_resident' => 'string',
        ]);

        ProfileModel::create([
            'employees_name' =>$validated['edit_employees_name'],
            'birth_date' =>$validated['edit_birth_date'],
            'birth_place' =>$validated['edit_birth_place'],
            'permanent_address' =>$validated['edit_permanent_address'],
            'email' =>$validated['edit_email'],
            'place_of_resident' =>$validated['edit_place_of_resident'],
        ]);

        $profile = ProfileModel::findOrFail($id);
        $profile->update($validated);

        return response()->json([
            'success' => true,
            'profile' => $profile,
        ]);
    }
}
