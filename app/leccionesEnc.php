<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class leccionesEnc extends Model
{
	protected $table = 'lecciones_encs';
    protected $fillable = ['nombre', 'usuario_documento'];
}
