<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $fillable = ['materi', 'deskripsi', 'user_id', 'status'];

    public function detailmateri()
    {
        return $this->hasMany(DetailMateri::class);
    }

    public function kuis()
    {
        return $this->hasMany(Kuis::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function viewhasil()
    {
        return $this->hasMany(ViewHasil::class);
    }
}
