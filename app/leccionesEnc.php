<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;

class leccionesEnc extends Model
{
	protected $table = 'lecciones_encs';
    protected $fillable = ['nombre', 'usuario_documento'];


    public function getTotalPalabras(){
        $total = leccionesDet::where('leccion_id', $this->id)->get();
//        dd ($total);
        return count($total);
    }

}
