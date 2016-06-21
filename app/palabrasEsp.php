<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;
use LearningWords\traducciones;

class palabrasEsp extends Model
{
    protected $table = 'palabras_esp';
    protected $fillable = ['palabra'];

    /**
     * [getCategoria Consulta las categorias de la palabra actual]
     * @return [json] [Categorias a las que pertenece la palabra]
     *         [error] [Cuando la palabra no tiene categorias registradas]
     */
    public function getCategoria(){
    {
        $nombre = categoria::SELECT('nombre')->where('id', $this->categorias_id)->get();
        if ($nombre != null)
            return $nombre;
        else
            return "error";
    }

    public function getTraduccion(){
        //TO DO
        //REEMPLAZAR EL 1 POR LA VARIABLE DE SESSION IDIOMA
        if($this->hasOne('LearningWords\traducciones'))
        {
            return $this->hasOne('LearningWords\traducciones','palabra_id')->where('idiomas_id',1);           
        }
        return null;
    }

}
