<?php

namespace App\Http\Controllers;

use App\Models\Ponto;
use App\Models\User;
use Brick\Math\BigInteger;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Validation\Rules\In;
use PhpParser\Node\Expr\Cast\Int_;
use Ramsey\Uuid\Type\Integer;

class PontoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        $user = new User();

        $id = Auth::user()->getAuthIdentifier();

        $data = Carbon::now(new DateTimeZone('America/Sao_Paulo'));

        $data_agora =  $data->toDateString();

        $ponto = Ponto::where('user_id', $id)->where('data_entrada', $data_agora)->first();

        $inicioData = now()->year.'-'.now()->month.'-01';

        $todos_pontos = Ponto::where('user_id', $id)
            ->whereDate('data_entrada', '>=', $inicioData)
            ->orderBy('data_entrada', 'ASC')
            ->get();

            //->select(['data_entrada', 'entrada', 'saida_intervalo', 'retorno_intervalo', 'saida', 'worked_time'])
            

        //dd($todos_pontos);
    
        return view('ponto.ponto', compact('ponto'), ['todos_pontos' => $todos_pontos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Carbon::now(new DateTimeZone('America/Sao_Paulo'));

        $hora_agora = $data->toTimeString();

        $data_agora = $data->toDateString();

        //ID do usuario logado
        $id = Auth::user()->getAuthIdentifier();
        
        $ponto = Ponto::where('user_id', $id)->where('data_entrada', $data_agora)->first();
        
        if (!$ponto) {

            $ponto = Ponto::create([
                'data_entrada' => $data_agora,
                'entrada' => $hora_agora,
                'user_id' => $id,
            ]);

            return redirect()->route('ponto.index')->with('success', 'Entrada registrada!');

        }else{
            //Verificar a utilização de services()

            //$ponto->entrada = $ponto->entrada ?? date("Y-m-d H:i:s");
            if ($ponto->entrada && $ponto->saida_intervalo && $ponto->retorno_intervalo && !$ponto->saida) {
                $ponto->saida = $hora_agora;

                $ponto->save();

                return redirect()->route('ponto.index')->with('success', 'Término do expediente registrado!');
            }

            if ($ponto->entrada && $ponto->saida_intervalo && !$ponto->retorno_intervalo) {
                $ponto->retorno_intervalo = $hora_agora;

                $ponto->save();

                return redirect()->route('ponto.index')->with('success', 'Retorno do intervalo registrado!');
            }


            if ($ponto->entrada && !$ponto->saida_intervalo) {
                $ponto->saida_intervalo = $hora_agora;

                $ponto->save();
    
                return redirect()->route('ponto.index')->with('success', 'Saída para intervalo registrado!');
            }



            return redirect()->route('ponto.index')->with('success', 'Todos os horários do dia foram registrados');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ponto  $ponto
     * @return \Illuminate\Http\Response
     */
    public function show(Ponto $ponto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ponto  $ponto
     * @return \Illuminate\Http\Response
     */
    public function edit(Ponto $ponto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ponto  $ponto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ponto $ponto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ponto  $ponto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($ponto);
        
        if (Ponto::where('id', $id)->exists()) {
            
            $ponto = Ponto::find($id);

            $ponto->delete();

            return redirect()->route('ponto.index')->with('success', 'Último registro deletado!');

        }
        
        
    }
}
