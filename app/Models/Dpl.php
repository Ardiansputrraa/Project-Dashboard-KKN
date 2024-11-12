<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dpl extends Model
{
    use HasFactory;
    protected $table = 'dpl';


    protected $fillable = [
        'username',
        'foto',
        'namaLengkap',
        'gelar',
        'inisial',
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
