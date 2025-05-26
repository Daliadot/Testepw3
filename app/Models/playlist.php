<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class playlist extends Model
{
 protected $fillable = [
    'nm_musica',
    'artista',
    'gravadora',
 ];
}
