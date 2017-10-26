<?php

namespace App\Http\Controllers;

use App\Laboratorio;
use App\Medicamento;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $carrinho = session()->get('carrinho');

        $lista = Medicamento::where(function($q) use ($request, $carrinho) {
            if($nome = $request->input('filter.nome'))
            {
                $q->where('nome', 'like', "%{$nome}%");
            }
            if($tipo = $request->input('filter.tipo'))
            {
                $q->where('tipo', $tipo);
            }
            if($laboratorio_id = $request->input('filter.laboratorio_id'))
            {
                $q->where('laboratorio_id', $laboratorio_id);
            }

            if(count($carrinho) > 0)
            {
                $q->whereNotIn('id', collect($carrinho)->map(function($item){
                    return $item['medicamento']->id;
                }));
            }

        })->orderBy('nome', 'asc')->paginate();

        $laboratorios = Laboratorio::all();
        $tipos = Medicamento::TIPOS;
        return view('home', compact('lista', 'tipos', 'laboratorios', 'carrinho'));
    }

    public function removerDoCarrinho(Request $request, $id)
    {
        $carrinho = $request->session()->get('carrinho');
        unset($carrinho[$id]);
        $request->session()->put('carrinho', $carrinho);
        return redirect('/');

    }

    public function adicionarAoCarrinho(Request $request, $id)
    {

        $this->validate($request, ['quantidade' => ['required']]);
        $item = Medicamento::findOrFail($id);
        $carrinho = $request->session()->get('carrinho');
        $carrinho[$id] = ['medicamento' => $item, 'quantidade' => $request->get('quantidade'), 'valor_unitario' => $item->valor_de_venda];
        $request->session()->put('carrinho', $carrinho);
        return redirect('/');
    }
}
