@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Form tambah materi</h3>
                    </div>
                    <form method="POST" action="{{ url('materi/detail-materi/store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="materi">Materi</label>
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="text" class="form-control" name="materi" id="materi"
                                    placeholder="Materi pelajaran" value="{{ $data->materi }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="teks">Teks</label>
                                <textarea class="form-control" id="teks" rows="3" name="teks" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Gambar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile"
                                            name="gambar">
                                        <label class="custom-file-label" for="exampleInputFile">Pilih gambar</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="video">Video</label>
                                <input type="text" class="form-control" name="video" id="video"
                                    placeholder="Link Video">
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

@push('js')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('teks');
    </script>
@endpush
