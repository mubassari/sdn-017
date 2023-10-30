<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\SekolahSettingsRequest;
use App\Settings\SekolahSettings;

use App\Http\Requests\SosmedSekolahSettingsRequest;
use App\Settings\SosmedSekolahSettings;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AdminSekolahController extends Controller
{
    public function index(){
        $umum   = new SekolahSettings();
        $sosmed = new SosmedSekolahSettings();
        return Inertia::render('Admin/Sekolah/Index', compact('umum', 'sosmed'));
    }

    public function simpanUmum(SekolahSettingsRequest $request, SekolahSettings $sekolah)
    {  
        DB::beginTransaction();
        try {
            $sekolah_logo = $this->handleImage($request, $sekolah->logo, 'logo');
            $sekolah_ikon = $this->handleImage($request, $sekolah->ikon, 'ikon');

            $sekolah->fill($request->validated());
            $sekolah->logo = $sekolah_logo;
            $sekolah->ikon = $sekolah_ikon;
            $sekolah->save();

            DB::commit();

            return redirect()->route('admin.sekolah.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data Sekolah!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }

    public function simpanSosmed(SosmedSekolahSettingsRequest $request, SosmedSekolahSettings $sosmed)
    {  
        DB::beginTransaction();
        try {
            $sosmed->fill($request->validated());
            $sosmed->save();

            DB::commit();

            return redirect()->route('admin.sekolah.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data Sosial Media Sekolah!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }

    protected function handleImage($request, $old_data, $column)
    {
        DB::beginTransaction();
        try {
            $imagePath  = 'public/gambar/sekolah'; // Adjust the path as needed       
            $storageUrl = Storage::url('public'); // Get the storage URL
            $nameImage  = Str::afterLast($old_data, '/');
            $name_file  = $old_data;

            if ($request->hasFile($column) && $request->file($column)->isValid()){
                $name_file = $request[$column]->hashName();
                if(!Storage::put($imagePath, $request[$column])) {
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                    ]);
                }

                if (Storage::exists($imagePath . '/' . $nameImage) && $nameImage !== 'default.png' && !Storage::delete($imagePath . '/' . $nameImage)){
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat menghapus gambar lama. Silakan coba lagi!'
                    ]);
                }
                $name_file = Storage::url($imagePath . '/' . $name_file);
            }

            DB::commit();

            return $name_file;
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
            ]);
        }
    }
}
