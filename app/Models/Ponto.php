<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_entrada',
        'entrada',
        'saida_intervalo',
        'retorno_intervalo',
        'saida',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    
    public function getWorkedTimeAttribute() {

        $entrada = new Carbon($this->entrada);
        $saida_intervalo = new Carbon($this->saida_intervalo);
        $retorno_intervalo = new Carbon($this->retorno_intervalo);
        $saida = new Carbon($this->saida);

        $diffPeriodoUm = $saida_intervalo->diffAsCarbonInterval($entrada);
        $diffPeriodoDois = $saida->diffAsCarbonInterval($retorno_intervalo);
        $diffPeriodosSomados = $diffPeriodoUm->add($diffPeriodoDois)->cascade();

        return $diffPeriodosSomados->format('%H:%I:%S'); // retorna a hora trabalhada

        /*
        if ($this->entrada && $this->saida_intervalo && $this->retorno_intervalo && $this->saida) {
            
            $saida_intervalo = new Carbon($this->saida_intervalo);
    
            $entrada = new Carbon($this->entrada);   
            
            $saida = new Carbon($this->saida);

            $retorno_intervalo = new Carbon($this->retorno_intervalo);   
    
            $diffPeriodoUm = $saida_intervalo->diff($entrada);

            //dd($diffPeriodoUm);
    
            $diffPeriodoDois = $saida->diff($retorno_intervalo);
    
            //dd($diffPeriodoDois);

            $diffPeriodoUm->addMinutes($diffPeriodoDois->m);
            $diffPeriodoUm->addSeconds($diffPeriodoDois->s);
            $diffPeriodoUm->addHours($diffPeriodoDois->h);
    
            return [$diffPeriodoUm->h, $diffPeriodoUm->m, $diffPeriodoUm->s];
        }
        return [0,0,0];
        */
    }
    

}
