<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function view_account(){
        $users = User::where('status','submitted')->paginate(5);
        $residents = Resident::where('user_id', null)->get();

        return view('pages.account-request.index', [
            'users' => $users, 
            'residents' => $residents, 
        ]);
    }

    public function account_approval(Request $request, $userId){
        $request->validate([
            'for' => ['required', Rule::in(['approve', 'reject', 'activate', 'deactivate'])],
            'resident_id' => ['nullable', 'exists:residents,id']
        ]);
        $for = $request->input('for');
        $user = User::findOrFail($userId);
        $user->status = $for == 'approve' || $for == 'activate' ? 'approved' : 'rejected';
        $user->save();

        $residentId = $request->input('resident_id');

        if ($request->has('resident_id') && isset($residentId)) {
            Resident::where('id', $residentId)->update([
                'user_id' => $user->id,
            ]);
        }
        
        if ($for == 'activate') {
            return back()->with('success', 'Berhasil mengaktifkan akun');
        } else if($for == 'deactivate')
            return back()->with('reject', 'Berhasil menonaktifkan akun');

        return back()->with('success', $for == 'approve' ? 'Berhasil menyetujui akun' : 'Berhasil menolak akun');
    }
    
    public function account_list(){
        $users = User::where('role_id', 2)->where('status', '!=', 'submitted')->paginate(5);
        return view('pages.account-list.index', [
            'users' => $users,
        ]);
    }

    public function profil_view(){
        return view('pages.profil.index');
    }

    public function update_profil(Request $request, $userId)
    {
        $request->validate([
            'name' => 'required|min:3',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = User::findOrFail($userId);

        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($user->profile_picture) {
                // Ensure the path is correct if your old pictures are in a specific subfolder
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store the new picture in the 'profile_pictures' folder within 'storage/app/public'
            // The 'public' disk is configured to use storage/app/public
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path; // Save the path to the database
        }

        $user->name = $request->input('name');
        $user->save();

        return back()->with('success', 'Berhasil mengubah detail profil.');
    }

    public function ubah_pw(){
        return view('pages.profil.ubah-pw');
    }
    
    public function ubah_pww(Request $request, $userId){
        $request->validate([
            'old_password' => 'required|min:4',
            'new_password' => 'required|min:4',
        ]);

        $user = User::findOrFail($userId);
        $oldPasswordValid = Hash::check($request->input('old_password'), $user->password);

        if ($oldPasswordValid) {
            $user->password = $request->input('new_password');
            $user->save();

            return back()->with('success', 'Berhasil mengubah password.');
        }
        
        return back()->with('error', 'Gagal mengubah password, karena password lama tidak valid.');
    }
}