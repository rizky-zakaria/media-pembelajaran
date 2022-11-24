@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        {{-- {{ $materi->materi }}
                        <a href="{{ url('kuis/open/' . $materi->id) }}" class="btn btn-primary float-right">Soal</a> --}}
                    </div>
                    <div class="card-body">
                        @foreach ($data as $item)
                            <iframe width="560" height="315" src="{{ $item->video }}" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
