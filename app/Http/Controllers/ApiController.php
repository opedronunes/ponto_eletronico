<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ponto;
use Brick\Math\BigInteger;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getAllPontos(){

        $user = new User();

        //$id = Auth::user()->getAuthIdentifier();

        $data = Carbon::now(new DateTimeZone('America/Sao_Paulo'));

        $data_agora =  $data->toDateString();

        //$ponto = Ponto::where('user_id', $id)->where('data_entrada', $data_agora)->first();
        
        //$horaTrabalho = $ponto->worked_time;

        //dd($horaTrabalho);

        //dd($ponto);

        $todos_pontos = DB::table('pontos')
            ->select(['data_entrada', 'entrada', 'saida_intervalo', 'retorno_intervalo', 'saida'])
            //->where('user_id', $id)
            ->orderBy('data_entrada', 'ASC')
            ->get()->toJson(JSON_PRETTY_PRINT);

        return response($todos_pontos, 200);
    }
}
