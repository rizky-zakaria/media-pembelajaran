<?php

namespace App\Http\Controllers;

use App\Models\DetailMateri;
use App\Models\Kuis;
use App\Models\Materi;
use App\Models\ViewHasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->modul = "materi";
    }

    public function index()
    {
        $modul = $this->modul;
        return view('materi.jenis', compact('modul'));
    }

    public function video()
    {
        // $modul = $this->modul;
        // if (Auth::user()->role === 'guru') {
        //     $data = Materi::where('user_id', Auth::user()->id)->get();
        // } else {
        //     $data = Materi::all();
        // }
        // $jenis = 'video';
        // return view('materi.index', compact('modul', 'data', 'jenis'));
        $modul = $this->modul;
        $materi = Materi::find(1);
        $data = DetailMateri::all();
        $jenis = 'video';
        return view('materi.video', compact(
            'data',
            'modul',
            'materi',
            'jenis'
        ));
    }

    public function detail_video($id)
    {
        $modul = $this->modul;
        $materi = Materi::find($id);
        $data = DetailMateri::where('materi_id', $id)->get();
        $jenis = 'video';
        return view('detail_materi.show', compact('data', 'modul', 'materi', 'jenis'));
    }


    public function teks()
    {
        $modul = $this->modul;
        if (Auth::user()->role === 'guru') {
            $data = Materi::where('user_id', Auth::user()->id)->get();
        } else {
            $data = Materi::all();
        }
        $jenis = 'teks';
        return view('materi.index', compact('modul', 'data', 'jenis'));
    }

    public function detail_teks($id)
    {
        $modul = $this->modul;
        $materi = Materi::find($id);
        $data = DetailMateri::where('materi_id', $id)->get();
        $jenis = 'teks';
        return view('detail_materi.show', compact('data', 'modul', 'materi', 'jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modul = $this->modul;
        return view('materi.create', compact('modul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Materi::create([
            'materi' => $request->materi,
            'deskripsi' => $request->deskripsi,
            'user_id' => Auth::user()->id,
            'status' => 'close'
        ]);
        if ($post) {
            toast('Berhasil menambahkan data!', 'success');
            return redirect(route($this->modul . '.index'));
        } else {
            toast('Gagal menambahkan data!', 'wrong');
            return redirect(route($this->modul . '.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modul = $this->modul;
        $materi = Materi::find($id);
        $data = DetailMateri::where('materi_id', $id)->get();
        // dd($data[0]->id);
        if (isset($data[0]->id)) {
            return view('materi.show', compact('data', 'materi', 'modul'));
        } else {
            return redirect(url('materi/detail-materi/create/' . $id));
        }
    }

    public function update_status($id)
    {
        $post = Materi::find($id);
        if ($post->status === 'open') {
            $post->status = 'close';
            $post->update();
        } else {
            $post->status = 'open';
            $post->update();
        }
        toast('Berhasil mengubah status!', 'success');
        return redirect(route($this->modul . '.index'));
    }

    public function open($id)
    {
        $modul = $this->modul;
        $materi = Materi::find($id);
        $data = DetailMateri::where('materi_id', $id)->get();
        return view('detail_materi.show', compact('data', 'modul', 'materi'));
    }

    public function close($id)
    {
        toast('Materi ini bersifat privat!', 'error');
        return redirect(route($this->modul . '.index'));
    }

    public function create_detail($id)
    {
        $modul = $this->modul;
        $data = Materi::find($id);

        return view('detail_materi.create', compact('data', 'modul'));
    }

    public function store_detail(Request $request)
    {
        if ($request->hasFile('gambar')) {
            $materi_id = $request->id;
            $teks = $request->teks;
            $video = $request->video;
            $uploadPath = public_path('uploads/materi');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $gambar = $request->file('gambar');
            $extension = $gambar->getClientOriginalExtension();
            $rename = 'materi' . date('YmdHis') . '.' . $extension;

            if ($gambar->move($uploadPath, $rename)) {
                $post = new DetailMateri;
                $post->text = $teks;
                $post->gambar = $rename;
                $post->video = $video;
                $post->materi_id = $materi_id;
                $post->save();
                toast('Berhasil menambahkan data', 'success');
                return redirect(route($this->modul . '.show', $materi_id));
            }
            toast('Tidak dapat menambahkan data', 'error');
            return redirect(route($this->modul . '.show', $materi_id));
        } else {
            $materi_id = $request->id;
            $teks = $request->teks;
            $video = $request->video;
            $post = new DetailMateri;
            $post->text = $teks;
            $post->gambar = "-";
            $post->video = $video;
            $post->materi_id = $materi_id;
            $post->save();
            if ($post) {
                toast('Berhasil menambahkan data', 'success');
                return redirect(route($this->modul . '.show', $materi_id));
            }

            toast('Tidak dapat menambahkan data', 'error');
            return redirect(route($this->modul . '.show', $materi_id));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vh = ViewHasil::where('materi_id', $id);
        if (count($vh->get()) > 0) {
            $vh->delete();
        }
        $kuis = Kuis::where('materi_id', $id);
        if (count($kuis->get()) > 0) {
            $kuis->delete();
        }
        $data = Materi::find($id);
        if ($data) {
            $data->delete();
            toast('Berhasil menghapus data!', 'success');
            return redirect(route('materi.index'));
        } else {
            toast('Gagal menghapus data!', 'error');
            return redirect(route('materi.index'));
        }
    }

    public function detail_destroy($id)
    {
        $data = DetailMateri::find($id);
        $data->delete();
        toast('Berhasil menghapus data!', 'success');
        return redirect(route('materi.index'));
    }
}
