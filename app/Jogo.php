<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'nome','proprietario', 'descricao', 'demo','data_lancamento', 'requesitos', 'foto'
    ];
    public $timestamps = false;
}
