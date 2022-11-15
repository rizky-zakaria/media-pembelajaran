<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;
    protected $fillable = ['materi_id', 'soal', 'jawaban', 'status'];

    public function materi()
    {
        return $this->belongsTo(DetailMateri::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }

    public function hasil()
    {
        return $this->hasMany(Hasil::class);
    }
}
