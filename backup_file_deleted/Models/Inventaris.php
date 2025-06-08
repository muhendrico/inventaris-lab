<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    protected $fillable = ['nama', 'deskripsi', 'kategori_id', 'jumlah'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
