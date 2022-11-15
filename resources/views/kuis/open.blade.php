@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <form action="{{ url('kuis/jawab/' . $id) }}" method="post">
                        @csrf
                        <div class="card-header">
                            Kuis
                            <button type="submit" class="btn btn-success float-right">Kirim Jawaban</button>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="user" value="{{ Auth::user()->id }}">
                            <?php
                            $no = 1;
                            $o = 0;
                            ?>
                            @foreach ($data as $item)
                                <?php
                                $pilihan = $opsi[$o++];
                                ?>
                                {{ $no++ }}. {{ $item->soal }}

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $pilihan }}"
                                        id="{{ $pilihan }}" value="{{ $item->pertama }}">
                                    <label class="form-check-label" for="{{ $pilihan }}">
                                        {{ $item->pertama }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $pilihan }}"
                                        id="{{ $pilihan }}" value="{{ $item->kedua }}">
                                    <label class="form-check-label" for="{{ $pilihan }}">
                                        {{ $item->kedua }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $pilihan }}"
                                        id="{{ $pilihan }}" value="{{ $item->ketiga }}">
                                    <label class="form-check-label" for="{{ $pilihan }}">
                                        {{ $item->ketiga }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $pilihan }}"
                                        id="{{ $pilihan }}" value="{{ $item->keempat }}">
                                    <label class="form-check-label" for="{{ $pilihan }}">
                                        {{ $item->keempat }}
                                    </label>
                                </div>
                                <br>
                            @endforeach

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
