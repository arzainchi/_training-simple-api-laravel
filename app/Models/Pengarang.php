<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengarang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pengarang";
    protected $fillable = ["nama", "jenis_kelamin", "tanggal_lahir", "alamat"];
}
