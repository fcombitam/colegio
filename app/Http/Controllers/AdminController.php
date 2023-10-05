<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function profile()
    {
        $admin = auth()->user()->admin;

        return view('admins.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'idtype' => ['required', 'in:' . Admin::ADMIN_IDTYPE_DI . ',' . Admin::ADMIN_IDTYPE_PASSPORT . ',' . Admin::ADMIN_IDTYPE_DE],
            'identification' => ['required', 'integer', 'min_digits:5', 'max_digits:20'],
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)],
            'date_of_birth' => ['required', 'date_format:Y-m-d'],
            'gender' => ['required', 'in:' . Admin::ADMIN_GENDER_MALE . ',' . Admin::ADMIN_GENDER_FEMALE . ',' . Admin::ADMIN_GENDER_OTHER],
            'address' => ['required', 'string', 'max:250'],
            'profile_picture' => ['nullable', 'image']
        ]);

        $user = auth()->user();
        $admin = auth()->user()->admin;

        $user->fill([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $admin->fill([
            'idtype' => $request->idtype,
            'identification' => $request->identification,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        if ($request->hasFile('profile_picture')) {
            $oldProfilePicture = $admin->profile_picture;

            $newProfilePicturePath = $request->file('profile_picture')->store('public/photo-profiles');

            $newProfilePicturePath = str_replace('public/', '', $newProfilePicturePath);

            $admin->profile_picture = $newProfilePicturePath;

            if ($oldProfilePicture && File::exists(storage_path("app/public/$oldProfilePicture"))) {
                File::delete(storage_path("app/public/$oldProfilePicture"));
            }
        }

        if (!$user->isDirty() && !$admin->isDirty()) {
            return redirect()->back()->withError('Debes modificar al menos un campo');
        }

        $user->save();
        $admin->save();

        return redirect()->back()->withSuccess('Perfil de administrador actualizado correctamente');
    }
}
