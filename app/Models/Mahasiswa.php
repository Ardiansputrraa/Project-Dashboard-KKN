<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';


    protected $fillable = [
        'username',
        'foto',
        'namaLengkap',
        'npm',
        'fakultas',
        'prodi',
        'email',
        'nomerWhatsapp',
        'status',
    ];

    public $timestamps = false;

    public function users(){
        return $this->belongsTo(User::class, 'username', 'username');  
    }
}
