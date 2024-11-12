<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';


    protected $fillable = [
        'username',
        'foto',
        'namaLengkap',
        'email',
        'nomerWhatsapp',
    ];

    public $timestamps = false;

    public function users(){
        return $this->belongsTo(User::class, 'username', 'username');  
    }
}
