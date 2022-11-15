@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Materi <b>{{ $materi->materi }}</b>
                        <a href="{{ url('materi/detail-materi/create/' . $materi->id) }}"
                            class="btn btn-primary float-right">Tambah</a>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 50%">Teks</th>
                                    <th style="width: 25%">Gambar</th>
                                    <th>Video</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{!! Str::substr($item->text, 0, 50) !!}</td>
                                        <td>
                                            @if ($item->gambar === '-')
                                                {{ $item->gambar }}
                                            @else
                                                <img src="{{ asset('uploads/materi/' . $item->gambar) }}" alt=""
                                                    width="50px">
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->video === '-')
                                                {{ $item->video }}
                                            @else
                                                <a href="{{ $item->video }}">{{ $item->video }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route($modul . '.show', $item->id) }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a> --}}
                                            {{-- <a href="" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a> --}}
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#exampleModal">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Teks</th>
                                    <th>Gambar</th>
                                    <th>Video</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin Ingin Menghapus Item Ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ url('materi/detail-destroy/' . $item->id) }}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection
