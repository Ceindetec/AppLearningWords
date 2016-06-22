<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class palabrasEsp_categoria extends Model
{
    protected $table = 'palabras_esp_categorias';
    protected $fillable = ['id_palabraEsp','id_Categoria'];

    public function getpalabra()
    {
        return $this->belongsTo('LearningWords\palabrasEsp', 'id_palabraEsp');
    }
}
