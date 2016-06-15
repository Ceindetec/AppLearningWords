<?php

namespace LearningWords;

use Illuminate\Database\Eloquent\Model;
use LearningWords\palabrasEsp;

class traducciones extends Model
{
   protected $table = 'traducciones';
   protected $fillable = ['palabra_id', 'idiomas_id','traduccion','tipo_id','padre_id','tiempoverbal_id'];

   public function getTraduccion()
   {
      $traduccion = traducciones::select('traduccion')->where('palabra_id', $this->id)->where('idiomas_id', 1)->get();
      if (count($traduccion)>0)
         return $traduccion[0]->traduccion;
      else
         return "error";
   }

   public function palabra_esp(){
      $esp = palabrasEsp::select('palabra')->where('id', $this->palabra_id)->get();
      return $esp[0]->palabra;
   }
}
