@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Materi
                        @if (Auth::user()->role === 'guru')
                            <a href="{{ route($modul . '.create') }}" class="btn btn-primary float-right">Tambah</a>
                        @endif
                    </div>
                    <div class="card-body text-center">
                        <a href="{{ url('materi/video') }}" class="btn btn-danger" style="width: 200px"> <b>VIDEO </b> <i
                                class="fas fa-play"></i></a><br>
                        <a href="{{ url('materi/teks') }}" class="btn btn-primary mt-3" style="width: 200px"> <b>TULISAN
                                MATERI </b>
                            <i class="fas fa-file"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.script.delete')
@endsection
