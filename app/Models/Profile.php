<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';


    protected $fillable = [
        'profile',
        'namaLengkap',
        'username',
        'npm',
        'fakultas',
        'prodi',
        'email',
        'nomerWhatsapp',
        'gelar',
        'inisial',
    ];

    public $timestamps = false;

    public function users(){
        return $this->belongsTo(User::class, 'username', 'username');  
    }
}
