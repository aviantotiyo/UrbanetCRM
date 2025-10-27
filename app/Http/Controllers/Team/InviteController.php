<?php

namespace App\Http\Controllers\Team;

use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\JobNewPasswordSuccess;
use App\Http\Controllers\Controller;
use App\Jobs\JobSendEmailInvitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class InviteController extends Controller
{


    /**
     * Tampilkan semua user team.
     */
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(10);
        return view('admin.teams.index', compact('users'));
    }

    /**
     * Tampilkan form tambah user team.
     */
    public function create()
    {
        return view('admin.teams.tambah'); // ✅ sesuai dengan file di resources/views/admin/teams/tambah.blade.php
    }

    /**
     * Simpan user baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role'     => ['required', 'in:Admin,Finance,NOC,CustomerCare,Installer'],
            'active'   => ['required', 'boolean'],
        ]);

        // Simpan user baru
        $user = User::create([
            'name'            => $validated['name'],
            'email'           => mb_strtolower($validated['email']),
            'password'        => Hash::make($validated['password']),
            'role'            => $validated['role'],
            'active'          => (bool) $validated['active'],
            'is_first_login'  => true,
        ]);

        // Dispatch job kirim email
        JobSendEmailInvitation::dispatch(
            $user->name,
            $user->email,
            $request->password, // gunakan password plain dari input
            $user->role
        );

        return redirect()
            ->route('admin.team.index')
            ->with('success', 'User berhasil ditambahkan dan email undangan telah dikirim.');
    }

    /**
     * Form ganti password pertama kali.
     */
    public function showNewPasswordForm()
    {
        return view('admin.teams.new_password'); // ✅ gunakan file new_password.blade.php
    }

    /**
     * Proses update password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->is_first_login = false;
        $user->email_verified_at = now();
        $user->save();

        JobNewPasswordSuccess::dispatch($user->name, $user->email);
        return redirect()->route('admin.dashboard')->with('success', 'Password berhasil diperbarui.');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.teams.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'role'   => ['required', 'in:Admin,Finance,NOC,CustomerCare,Installer'],
            'active' => ['required', 'boolean'],
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'User berhasil diperbarui.');
    }
}
