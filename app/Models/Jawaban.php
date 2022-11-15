<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $fillable = ['kuis_id', 'pertama', 'kedua', 'ketiga', 'keempat'];

    public function kuis()
    {
        return $this->hasMany(Kuis::class);
    }
}
