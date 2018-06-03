<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\fasilitas;
use App\RuanganFasilitas;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Image;

class fasilitasController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $fas = fasilitas::where('id','=','4')->pluck('nama','nama');;
        // dd($fas);
    	$fasilitas = fasilitas::all();
        // dd($fasilitas);
        return view('fasilitas.index',compact('fasilitas'));
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$request->validate([
            'nama' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif'
        ]);


         if ($request->hasFile('photo')) { //photo berasal dari form
            $path = config('central.path.avatars'); //tidak tau berasal dari mana :v kemungkinana nama file avatars di public/img/avatars

            $fasi = new fasilitas; //dari model
            $oldfile = $fasi->foto; //dari table

            $fileext = $request->photo->extension(); //mengambil nama foto
            $filename = uniqid("avatars-").'.'.$fileext; //merubak nama foto menjadi avatar-nama foto

            //Real File
            $filepath = $request->file('photo')->storeAs($path, $filename, 'local'); //copy file ke ke lokasi path d atas
            //Avatar File
            $realpath = storage_path('app/'.$filepath); //menambil foto yang telah di copy tadi
            $img = Image::make($realpath) //merubah ukuran
                ->resize(null, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path(config('central.path.avatars').'/'.$filename)); //mereplace foto tadi kembali kedalam file public/img/avatars

            $fasi->foto = $filename; //save data
            $fasi->nama = $request->nama; //save data
            $fasi->merek = $request->merek; //save data
            $fasi->model = $request->model; //save data
            if ($fasi->save()) {
                toast()->success("Berhasil Menambahkan Fasilitas");
                if ($filename != $oldfile) { //kalau file yang lama dan yang baru namanya tidak sama, maka akan melakukan
                    File::delete(storage_path('app'.'/'. $path . '/' . $oldfile)); //menghapus foto lama
                    File::delete(public_path($path . '/' . $oldfile)); //menghapus foto lama 
                }
            } else {
                toast()->danger("Oh...snap... Gagal Menambah Fasilitas");
            }
        }

        
        
        


        $fasi->save();
        return redirect()->route('fasilitas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $detail = fasilitas::find($id);
       $tampil = DB::select(DB::raw(" SELECT ruangan_fasilitas.id as id, ruangan.nama as nmruangan, gedung.nama as nmgedung, ruangan.lantai as ltruangan, ruangan_fasilitas.jumlah from ruangan_fasilitas join fasilitas on ruangan_fasilitas.fasilitas_id = fasilitas.id join ruangan on ruangan_fasilitas.ruangan_id = ruangan.id join gedung on ruangan.gedung_id=gedung.id where fasilitas.id = '$id' "));
        return view('fasilitas.show', compact('detail','tampil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fasilitas = fasilitas::find($id);
        return view('fasilitas.edit')->with('fasilitas', $fasilitas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $fasi = fasilitas::find($id);
        $fasi->nama = $request->nama;
        $fasi->save();
        $fasilitas = fasilitas::all();
        return view('fasilitas.index',compact('fasilitas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fasi = fasilitas::find($id);
        $detail = fasilitas::find($id);
        $tampil = DB::select(DB::raw(" SELECT ruangan_fasilitas.id as id, ruangan.nama as nmruangan, gedung.nama as nmgedung, ruangan.lantai as ltruangan, ruangan_fasilitas.jumlah from ruangan_fasilitas join fasilitas on ruangan_fasilitas.fasilitas_id = fasilitas.id join ruangan on ruangan_fasilitas.ruangan_id = ruangan.id join gedung on ruangan.gedung_id=gedung.id where fasilitas.id = '$id' "));
       if (count($tampil)>0) {
           toast()->error('Tidak Berhasil Mengahpus Data karena Memiliki Relasi');  
       }else{
            $fasi->delete();
       }
       return redirect()->route('fasilitas.index');
    }

    public function profilePicture(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif'
        ]);

        if ($request->hasFile('photo')) {
            $path = config('central.path.avatars');

            $fasi = fasilitas::find($id);
            $oldfile = $fasi->foto;

            $fileext = $request->photo->extension();
            $filename = uniqid("avatars-").'.'.$fileext;

            //Real File
            $filepath = $request->file('photo')->storeAs($path, $filename, 'local');
            //Avatar File
            $realpath = storage_path('app/'.$filepath);
            $img = Image::make($realpath)
                ->resize(null, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path(config('central.path.avatars').'/'.$filename));

            $fasi->foto = $filename;
            if ($fasi->save()) {
                toast()->success("Berhasil mengganti foto Anda");
                if ($filename != $oldfile) {
                    File::delete(storage_path('app'.'/'. $path . '/' . $oldfile));
                    File::delete(public_path($path . '/' . $oldfile));
                }
            } else {
                toast()->danger("Oh...snap... Gagal mengganti foto Anda");
            }

        }

       
        return redirect()->back();
    }


}
