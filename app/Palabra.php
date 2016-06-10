<?php

namespace accesorfid;

use Illuminate\Database\Eloquent\Model;

class Palabra extends Model
{
    protected $table = 'palabras';
    protected $fillable = ['id_vocabulario', 'palabra_esp', 'palabra_ing'];

    public function crearPalabra($id_vocabulario, $palabra_esp, $palabra_ing)
        {
        \DB::table('palabras')->insert(
            ['id_vocabulario'=>$id_vocabulario, 'palabra_esp'=>$palabra_esp, 'palabra_ing'=>$palabra_ing]
        );
        }

    public function consultarPalabras($id_vocabulario)
        {
        $palabras = \DB::table('palabras')->where('id_vocabulario', '=', $id_vocabulario)->select('palabra_esp', 'palabra_ing', 'id')->get();
        return $palabras;
        }

    public function getIdPalabra($palabra_esp)
        {
        $id = \DB::table('palabras')->where('palabra_esp', '=', $palabra_esp)->select('id')->get();
        if (empty($id))
            return "no encontrado";
        else
            return $id[0]->id;
        }

    public function updatePalabra($palabra_esp, $palabra_ing, $id)
    {
        \DB::table('palabras')->where('id', $id)->update(['palabra_esp' => $palabra_esp, 'palabra_ing' => $palabra_ing]);
    }

    public function borrarPalabra($id)
    {
        \DB::table('palabras')->where('id', '=', $id)->delete();
    }
}