@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        {{-- Kuis --}}
                        {{-- <a href="{{ route($modul . '.create') }}" class="btn btn-primary float-right">Tambah</a> --}}
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Materi</th>
                                    <th>Jumlah Benar</th>
                                    <th>Nilai</th>
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
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            {{ $item->materi->materi }}
                                        </td>
                                        <td>
                                            {{ $item->jumlah }}
                                        </td>
                                        <td>
                                            {{ $item->nilai }}
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-secondary">No Action</a>
                                            {{-- <a href="" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Materi</th>
                                    <th>Jumlah Benar</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
