<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Karyawan extends Authenticatable
{
    use Notifiable;

    protected $table = 'karyawans';
    protected $primarykey = 'id_karyawan';
    protected $fillable = [
        'nama_karyawan',
        'email_karyawan',
        'password_karyawan',
        'role',
    ];

    protected $hidden = [
        'password_karyawan',
    ];
    
    public function getAuthIdentifierName()
    {
        return 'id_karyawan';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
