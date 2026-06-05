<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Artigo extends Model
{
    //
    use HasFactory;
    protected $fillable =
    ['descricao', 'caracteristicas', 'preco', 'foto', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
        // return $this->belongsTo(Categoria::class, 'categoria_id');//o segundo parâmetro é opcional, pois o Laravel já segue a convenção de nomear a chave estrangeira como 'categoria_id' com base no nome do modelo relacionado 'Categoria'.

        
    }


}
