<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMateri extends Model
{
    use HasFactory;
    protected $fillable = ['materi_id', 'text', 'gambar', 'video'];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
