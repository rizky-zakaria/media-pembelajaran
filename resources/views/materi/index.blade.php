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
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Materi</th>
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
                                        <td>{{ $item->materi }}</td>
                                        <td>
                                            @if (Auth::user()->role === 'guru')
                                                <a href="{{ route($modul . '.show', $item->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                                {{-- <a href="" class="btn btn-sm btn-success"><i
                                                        class="fas fa-edit"></i></a> --}}
                                                <a href="javascript:;" data-toggle="modal"
                                                    onclick="deleteData({{ $item->id }})" data-target="#DeleteModal"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i>
                                                </a>
                                                @if ($item->status === 'close')
                                                    <a href="{{ url('materi/update-status/' . $item->id) }}"
                                                        class="btn btn-sm btn-warning"><i class="fa fa-folder"></i></a>
                                                @else
                                                    <a href="{{ url('materi/update-status/' . $item->id) }}"
                                                        class="btn btn-sm btn-warning"><i
                                                            class="fas fa-folder-open"></i></a>
                                                @endif
                                            @endif
                                            @if ($item->status === 'close')
                                                <a href="{{ url('materi/close/' . $item->id) }}"
                                                    class="btn btn-sm btn-secondary"><i class="fa fa-file"></i></a>
                                            @else
                                                <a href="{{ url('materi/open/' . $item->id) }}"
                                                    class="btn btn-sm btn-secondary"><i class="fa fa-file"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Materi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="DeleteModal" class="modal fade" aria-hidden="true">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <p class="text-center">Are you sure want to delete this data ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="" class="btn btn-outline-danger" data-dismiss="modal"
                            onclick="formSubmit()">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @include('layouts.script.delete')
@endsection
