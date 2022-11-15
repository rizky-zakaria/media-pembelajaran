<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Jawaban;
use App\Models\Kuis;
use App\Models\Materi;
use App\Models\ViewHasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KuisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->modul = "kuis";
    }

    public function index()
    {
        $modul = $this->modul;
        $data = Kuis::all();
        return view('kuis.index', compact('data', 'modul'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modul = $this->modul;
        $materi = Materi::where('user_id', Auth::user()->id)->get();
        return view('kuis.create', compact('modul', 'materi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = count(Kuis::where('materi_id', $request->materi)->get());
        if ($cek < 5) {

            $post = Kuis::create([
                'materi_id' => $request->materi,
                'soal' => $request->soal,
                'jawaban' => $request->jawaban,
                'status' => 'close'
            ]);
            if ($post) {
                $opsi = Jawaban::create([
                    'kuis_id' => $post->id,
                    'pertama' => $request->pertama,
                    'kedua' => $request->kedua,
                    'ketiga' => $request->ketiga,
                    'keempat' => $request->keempat
                ]);
                if ($opsi) {
                    toast('Berhasil menambahkan data!', 'success');
                    return redirect(route($this->modul . '.index'));
                } else {
                    toast('Gagal menambahkan data!', 'error');
                    return redirect(route($this->modul . '.index'));
                }
                toast('Gagal menambahkan data!', 'error');
                return redirect(route($this->modul . '.index'));
            }
            toast('Gagal menambahkan data!', 'error');
            return redirect(route($this->modul . '.index'));
        } else {
            toast('Soal sudah cukup!', 'warning');
            return redirect(route('kuis.create'));
        }
    }

    public function open($id)
    {
        $data = Kuis::where('materi_id', $id)
            ->join('jawabans', 'kuis.id', 'kuis_id')
            ->get();
        $opsi = ['pertama', 'kedua', 'ketiga', 'keempat', 'kelima'];
        if (count($data) < 5) {
            toast('Soal belum selesai dibuat!', 'error');
            return redirect(route('materi.index'));
        } else {
            return view('kuis.open', compact('data', 'opsi', 'id'));
        }
    }

    public function jawab(Request $request, $id)
    {
        $opsi = ['pertama', 'kedua', 'ketiga', 'keempat', 'kelima'];
        $data = Kuis::where('materi_id', $id)->get();
        $i = 0;
        for ($i = 0; $i < count($opsi); $i++) {
            if ($data[$i]->jawaban === $request[$opsi[$i]]) {
                Hasil::create([
                    'user_id' => $request->user,
                    'kuis_id' => 1,
                    'hasil' => 'benar'
                ]);
            } else {
                Hasil::create([
                    'user_id' => $request->user,
                    'kuis_id' => 1,
                    'hasil' => 'salah'
                ]);
            }
        }

        $hasil = count(Hasil::where('user_id', $request->user)->where('hasil', 'benar')->get());
        $post = new ViewHasil;
        $post->jumlah = $hasil;
        $post->nilai = $hasil * 20;
        $post->user_id = $request->user;
        $post->materi_id = $id;
        $post->save();


        $delHasil = Hasil::where('user_id', $request->user)->get();
        for ($i = 0; $i < 5; $i++) {
            $del = Hasil::find($delHasil[$i]->id);
            $del->delete();
        }

        return redirect(route('materi.index'));
    }

    // public function hasil()
    // {

    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
