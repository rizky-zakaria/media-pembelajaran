@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Form tambah materi</h3>
                    </div>
                    <form method="POST" action="{{ route($modul . '.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="materi">Materi</label>
                                <input type="text" class="form-control" name="materi" id="materi"
                                    placeholder="Materi pelajaran">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsi" id="deskripsi"
                                    placeholder="Deskripsi">
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
