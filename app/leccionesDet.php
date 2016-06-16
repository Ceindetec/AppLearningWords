<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class leccionesDet extends Model
{
   protected $table = 'lecciones_dets';
   protected $fillable = ['leccion_id', 'palabra_id'];

   public function getpalabra()
    {
        return $this->belongsTo('LearningWords\palabrasEsp', 'palabra_id');
    }

    public function getleccion()
    {
        return $this->belongsTo('LearningWords\leccionesEnc', 'leccion_id');
    }

}
