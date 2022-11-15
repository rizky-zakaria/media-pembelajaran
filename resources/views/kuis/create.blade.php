@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Form Buat Kuis</h3>
                    </div>
                    <form method="POST" action="{{ route($modul . '.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Materi</label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="materi" required>
                                    <option selected>Pilih Materi</option>
                                    @foreach ($materi as $item)
                                        <option value="{{ $item->id }}">{{ $item->materi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="soal">Soal</label>
                                <input type="text" class="form-control" name="soal" id="soal"
                                    placeholder="Deskripsi">
                            </div>
                            <div class="form-group">
                                <label for="pertama">Opsi 1</label>
                                <input type="text" class="form-control" name="pertama" id="pertama"
                                    placeholder="Opsi pertama">
                            </div>
                            <div class="form-group">
                                <label for="kedua">Opsi 2</label>
                                <input type="text" class="form-control" name="kedua" id="kedua"
                                    placeholder="Opsi Kedua">
                            </div>
                            <div class="form-group">
                                <label for="ketiga">opsi 3</label>
                                <input type="text" class="form-control" name="ketiga" id="ketiga"
                                    placeholder="Opsi ketiga">
                            </div>
                            <div class="form-group">
                                <label for="keempat">Opsi 4</label>
                                <input type="text" class="form-control" name="keempat" id="keempat"
                                    placeholder="Opsi Keempat">
                            </div>
                            <div class="form-group">
                                <label for="jawaban">Jawaban</label>
                                <input type="text" class="form-control" name="jawaban" id="jawaban"
                                    placeholder="Jawaban">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
