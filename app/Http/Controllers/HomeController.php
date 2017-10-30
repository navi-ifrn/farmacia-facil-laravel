<?php

namespace App\Http\Controllers;

use App\Exceptions\EmptyCartExeption;
use App\Exceptions\EstoqueInsuficienteExeption;
use App\Laboratorio;
use App\Medicamento;
use App\Venda;
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

    private function iniciarCarrinho()
    {
        if(!session()->has('carrinho'))
        {
            session()->put('carrinho', []);
        }
    }

    private function esvaziarCarrinho()
    {
        session()->put('carrinho', []);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->iniciarCarrinho();

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
        $item = $carrinho[$id]['medicamento'];
        unset($carrinho[$id]);
        $request->session()->put('carrinho', $carrinho);
        return redirect('/')->with('success', "Medicamento {$item->nome} removido com sucesso");

    }

    public function adicionarAoCarrinho(Request $request, $id)
    {

        $this->validate($request, ['quantidade' => ['required']]);
        $item = Medicamento::findOrFail($id);
        $quantidade = (int) $request->get('quantidade');
        if($item->estoque < $quantidade)
        {
            throw new EstoqueInsuficienteExeption('O medicamento ' . $item->nome . ' possui apenas ' . $item->estoque . ' unidades em estoque');
        }

        $carrinho = $request->session()->get('carrinho');
        $carrinho[$id] = ['medicamento' => $item, 'quantidade' => $quantidade, 'valor_unitario' => $item->valor_venda];
        $request->session()->put('carrinho', $carrinho);
        return redirect('/')->with('success', "Medicamento {$item->nome} adicionado com sucesso");

    }

    public function finalizar(Request $request)
    {
        $carrinho = $request->session()->get('carrinho');
        if(empty($carrinho))
        {
            throw new EmptyCartExeption;
        }
        $sync = [];
        $total = 0;
        foreach($carrinho as $item)
        {
            $quantidade = $item['quantidade'];
            $valor_unitario = $item['valor_unitario'];
            $total += $quantidade * $valor_unitario;

            $sync[$item['medicamento']->id] = [
                'quantidade' => $quantidade,
                'valor_unitario' => $valor_unitario
            ];
        }

        $venda = new Venda([
            'usuario_id' => $request->user()->id,
            'total' => $total,
        ]);
        $venda->save();
        $venda->medicamentos()->sync($sync);

        $this->esvaziarCarrinho();

        return redirect('/')->with('success', 'Venda efetuada com sucesso');
    }
}
