<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_berita extends Model
{
    protected $table = 'berita';
    protected $fillable = [
        'kategori_id',
        'judul_berita',
        'isi_berita',
        'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(M_kategori::class, 'kategori_id');
    }

}

