<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtikelRequest;
use App\Models\Artikel;
use App\Models\ArtikelKategori;
use App\Models\Gambar;
use App\Models\GambarArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AdminArtikelController extends Controller
{
    public function index(Request $request){
        $list_artikel = Artikel::select('id', 'isi', 'judul', 'slug', 'artikel_kategori_id')
        ->orderBy('id', 'desc')
        ->when($request->input('cari'), function ($query, $role) {
            $query->where('artikel.judul', 'like', "%$role%");
        })
        ->paginate(10)
        ->through(function($data) {
            return [
                'id'            => $data->id,
                'judul'         => $data->judul,
                'sampul'        => $data->path_sampul,
                'kategori'      => $data->ArtikelKategori->nama,
                'kategori_slug' => $data->ArtikelKategori->slug,
                'slug'          => $data->slug,
                'waktu'         => $data->waktu,
            ];
        })
        ->withQueryString();
        return Inertia::render('Admin/Artikel/Index', compact('list_artikel'));
    }
    
    public function tambah(){
        $kategori = ArtikelKategori::select('id','nama')->get();
        return Inertia::render('Admin/Artikel/Tambah', compact('kategori'));
    }

    public function simpan(ArtikelRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();

            // Create the Artikel record without saving it to the database yet
            $artikel = new Artikel($validated);
            
            // Save the Artikel record to get an ID
            $artikel->isi = 'temp';
            $artikel->save();

            $artikel = Artikel::find($artikel->id);

            // Update the content with images and Artikel ID
            $isiWithImages = $this->handleImages($request, $artikel->id);
            
            // Update the Artikel record with the content
            $artikel->isi = $isiWithImages;
            $artikel->save();

            DB::commit();

            return redirect()->route('admin.artikel.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menyimpan data Artikel!'
            ]);
        } catch (\Exception $e) {
            
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi!'
            ]);
        }
    }

    public function ubah(Artikel $artikel)
    {
        $kategori = ArtikelKategori::select('id','nama')->get();
        $artikel = collect([$artikel])->transform(function($artikel) {
            return [
                'id'          => $artikel->id,
                'judul'       => $artikel->judul,
                'isi'         => $artikel->isi_with_path,
                'artikel_kategori_id' => $artikel->artikel_kategori_id,
            ];
        })->first();
        return Inertia::render('Admin/Artikel/Ubah', compact('artikel', 'kategori'));
    }

    public function perbarui(ArtikelRequest $request, Artikel $artikel)
    {
        DB::beginTransaction();
        try {
            $validated            = $request->validated();

            // Retrieve the Artikel ID from the request
            $artikelId            = $request->input('id');

            // Update the Artikel record with the provided data
            $artikel->judul       = $validated['judul'];
            $artikel->artikel_kategori_id = $validated['artikel_kategori_id'];

            // Update the content with images and Artikel ID
            $isiWithImages        = $this->handleImages($request);
            // $isiWithImages        = $this->handleImages($request->input('isi'), $artikelId);
            $artikel->isi         = $isiWithImages;

            $artikel->save();

            DB::commit();

            return redirect()->route('admin.artikel.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil memperbarui data Artikel!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi!'
            ]);
        }
    }

    public function hapus(Artikel $artikel)
    {
        DB::beginTransaction();
        try {
            // Delete associated images
            $this->handleImagesDeletion($artikel->id);
        
            // Delete the Artikel record
            $artikel->delete();

            DB::commit();

            return redirect()->route('admin.artikel.index')->with('alert', [
                'status' => 'success',
                'pesan'  => 'Anda berhasil menghapus data Artikel!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat menghapus data. Silakan coba lagi!'
            ]);
        }
    }

    protected function handleImages($artikel, $id = null)
    {
        DB::beginTransaction();
        try {
            $artikelId         = $id ?? $artikel->id;
            $content           = $artikel->isi;

            $imagePath         = 'public/gambar/' . $artikelId; // Adjust the path as needed       
            $storageUrl        = Storage::url('public'); // Get the storage URL
            $gambarArtikels    = collect();
        
            // Regular expression to match <img> tags with 'id' and 'src' attributes
            preg_match_all('/<img[^>]*\ssrc="([^"]+)"(?:\sid="([^"]+)")?[^>]*>/', $content, $matches, PREG_SET_ORDER);
            
            foreach ($matches as $key => $imageTag) {
                $src  = $matches[$key][1];
            
                if (Str::contains($src, request()->getHttpHost())) {
                    $uniqueFileName = Str::afterLast($src, '/');
                    
                    if (Storage::exists($imagePath . '/' . $uniqueFileName)) {
                        $uuid      = $matches[$key][2] ?? Str::before($uniqueFileName, '.');
                        $extension = Str::afterLast($uniqueFileName, '.');

                        $content = str_replace($matches[$key][0], '<img src="' . Storage::url($imagePath . '/' . $uniqueFileName) . '" id="' . $uuid . '"', $content);
                    } else {
                        $content = str_replace($matches[$key][0], '', $content);
                    }
                } else {
                    $uuid = Str::uuid()->toString();

                    if (strpos($src, 'data:image') === 0) {
                        // Check if the 'src' attribute is a base64-encoded image

                        // Handle base64-encoded image (adjust as needed)
                        $base64Image = $src;
                        $extension   = str_replace('data:image/', '', strstr($src, ';', true));

                        // Handle the base64 image data (e.g., decode and save)
                        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

                        $uniqueFileName = $uuid . '.' . $extension;

                        // Attempt to upload the image, and handle any errors
                        if (!Storage::put($imagePath . '/' . $uniqueFileName, $imageData)) {
                            return back()->withInput()->with('alert', [
                                'status' => 'danger',
                                'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                            ]);
                        }

                        // Update the HTML <img> tag with the new id and src attribute
                        $content = str_replace($matches[$key][0], '<img src="' . Storage::url($imagePath . '/' . $uniqueFileName) . '" id="' . $uuid . '"', $content);
                    } else {
                        // Handle external image path (adjust as needed)
                        $imageData = file_get_contents($src);
                    
                        // Extract the file extension from the URL
                        $extension = pathinfo($src, PATHINFO_EXTENSION);

                        if ($extension == '') {
                            $extension = 'png';
                        }

                        $uniqueFileName = $uuid. '.' . $extension;
                        // Attempt to upload the image, and handle any errors
                        if (!Storage::put($imagePath . '/' . $uniqueFileName, $imageData)) {
                            return back()->withInput()->with('alert', [
                                'status' => 'danger',
                                'pesan'  => 'Terjadi kesalahan saat mengunggah gambar. Silakan coba lagi!'
                            ]);
                        }
                    
                        // Update the HTML <img> tag with the new id and src attribute
                        $content = str_replace($imageTag, '<img src="' . Storage::url($imagePath . '/' . $uniqueFileName) . '" id="' . $uuid . '"', $content);
                    }

                    $gambarId = Gambar::create([
                        'id'         => $uuid,
                        'ext'        => $extension,
                    ]);

                    GambarArtikel::create([
                        'gambar_id'  => $gambarId->id,
                        'artikel_id' => $artikelId,
                    ]);
                }
                
                $gambarArtikels->push([$uuid, $extension]);
            }
            
            // Retrieve the data from the database with the necessary relationships
            $idGambarArtikels = $gambarArtikels->map(function($gambar) {
                return $gambar[0]; 
             })->toArray();

            $filenameGambarArtikels = $gambarArtikels->map(function($gambar) use ($imagePath) {
                return $imagePath . '/' . $gambar[0] . '.' . $gambar[1]; 
             })->toArray();

            // Now, you have the filtered results in $filteredGambarArtikels
            // Do whatever you need with these filtered items
   
            // If you want to delete items that don't exist in storage:
            // $gambarArtikelsToDelete = $idGambarArtikels->diff($filteredGambarArtikels);
            
            // Delete rows in the Gambar table with the retrieved IDs
            $gambarIDsToDelete = GambarArtikel::select('gambar_id')
                ->where('artikel_id', '=', $artikelId)
                ->whereNotIn('gambar_id', $idGambarArtikels)
                ->get()
                ->map(function($gambar) {
                    return $gambar['gambar_id']; 
                })
                ->toArray();
            
            Gambar::whereIn('id', $gambarIDsToDelete)->delete();
            
            // Get the list of all file paths in storage within $imagePath
            $allFilePathsInStorage = Storage::files($imagePath);
            
            // Calculate the file paths to delete (those not in $filePathsInGambarArtikels)
            $filesToDelete = array_diff($allFilePathsInStorage, $filenameGambarArtikels);
                
            // Delete the files in storage that are not in $filePathsInGambarArtikels
            foreach ($filesToDelete as $fileToDelete) {
                Storage::delete($fileToDelete);
            }

            DB::commit();

            return $content;
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs during image handling
            DB::rollBack();
            
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat memproses gambar. Silakan coba lagi!'
            ]);
        }
    }

    protected function handleImagesDeletion($artikelId)
    {
        DB::beginTransaction();
        try {
            $imagePath  = 'public/gambar/' . $artikelId; // Adjust the path as needed       
            $storageUrl = Storage::url('public'); // Get the storage URL
  
            if (Storage::exists($imagePath)) {
                if (!Storage::deleteDirectory($imagePath)) {
                    return back()->withInput()->with('alert', [
                        'status' => 'danger',
                        'pesan'  => 'Terjadi kesalahan saat menghapus gambar. Silakan coba lagi!'
                    ]);
                }
            }    

            // Delete rows from the database if the ID is not in the current content's <img> tags
            // Build a query to check if the IDs exist in GambarArtikel
            $gambarArtikelIds = GambarArtikel::where('artikel_id', $artikelId)->pluck('gambar_id');

            // Delete records from Gambar where the ID exists in GambarArtikel
            Gambar::whereIn('id', $gambarArtikelIds)->delete(); 

            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs during image handling
            DB::rollBack();
            
            return back()->withInput()->with('alert', [
                'status' => 'danger',
                'pesan'  => 'Terjadi kesalahan saat memproses gambar. Silakan coba lagi!'
            ]);
        }
    }
}

