<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\GTK;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function index(Request $request){
        $list_user = User::select('id', 'username', 'gtk_id')
        ->orderBy('id', 'desc')
        ->when($request->input('cari'), function ($query, $role) {
            $query->where(function ($subquery) use ($role) {
                $subquery->where('username', 'like', "%$role%")
                         ->orWhereHas('gtk', function ($subquery) use ($role) {
                             $subquery->where('nama', 'like', "%$role%");
                         });
            });
        })
        ->paginate(10)
        ->through(function($data) {
            return [
                'id'       => $data->id,
                'nama'     => $data->GTK->nama ?? 'Admin',
                'nip'      => $data->GTK->nip ?? null,
                'username' => $data->username,
                'role'     => $data->roles->map(function($role) {
                    return $role->nama;
                }),
            ];
        })
        ->withQueryString();
        
        return Inertia::render('Admin/User/Index', compact('list_user'));
    }
        
    public function tambah(){
        $role = Role::select('id', 'nama')->get();
        $gtk  = GTK::select('id', 'nama', 'slug')
        ->whereDoesntHave('user')
        ->get();
        return Inertia::render('Admin/User/Tambah', compact('role', 'gtk'));
    }
    
    public function simpan(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['password'] = bcrypt($request->password);
            $user = User::create($validated);

            $user->save();

            $user->roles()->attach($validated['role']);

            DB::commit();

            return redirect()->route('admin.user.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data Pengguna!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }
    public function ubah(User $user)
    {
        $user = collect([$user])->map(function($data) {
            return [
                'id' => $data->id,
                'username' => $data->username,
                'gtk_id' => $data->GTK->nama,
                'role' => $data->roles->pluck('id'),
            ];
        })[0];
        $role = Role::select('id', 'nama')->get();
        return Inertia::render('Admin/User/Ubah', compact('user', 'role'));
    }

    public function perbarui(UserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['password'] = bcrypt($request->password);

            $user->username = $validated['username'];
            $user->password = $validated['password'];

            $user->roles()->sync($validated['role']);

            $user->save();

            DB::commit();

            return redirect()->route('admin.user.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil memperbarui data User!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi!'
            ]);
        }
    }

    public function hapus(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();

            DB::commit();

            return redirect()->route('admin.user.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Data pengguna berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.user.index')->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menghapus data pengguna. Silakan coba lagi!'
            ]);
        }
    }
}
