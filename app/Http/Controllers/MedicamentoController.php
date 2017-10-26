<?php

namespace App\Http\Controllers;

use App\Laboratorio;
use App\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class MedicamentoController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lista = Medicamento::where(function($q) use ($request) {
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
        })->orderBy('nome', 'asc')->paginate();

        $laboratorios = Laboratorio::all();
        $tipos = Medicamento::TIPOS;
        return view('medicamento.index', compact('lista', 'laboratorios', 'tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $laboratorios = Laboratorio::all();
        $tipos = Medicamento::TIPOS;
        return view('medicamento.create', compact('laboratorios', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => ['required'],
            'bula' => ['required'],
            'valor_compra' => ['required', 'numeric'],
            'porcentagem_lucro' => ['required', 'numeric'],
            'tipo' => ['required', Rule::in(array_keys(Medicamento::TIPOS))],
            'laboratorio_id' => ['required', 'exists:laboratorios,id']
        ]);

        $item = new Medicamento;
        $item->fill($request->toArray());
        $item->save();

        return redirect()->route('medicamentos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Medicamento::findOrFail($id);
        $laboratorios = Laboratorio::all();
        $tipos = Medicamento::TIPOS;
        return view('medicamento.edit', compact('item', 'laboratorios', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => ['required'],
            'bula' => ['required'],
            'valor_compra' => ['required', 'numeric'],
            'porcentagem_lucro' => ['required', 'numeric'],
            'tipo' => ['required', Rule::in(array_keys(Medicamento::TIPOS))],
            'laboratorio_id' => ['required', 'exists:laboratorios,id']
        ]);

        $item = Medicamento::findOrFail($id);
        $item->fill($request->toArray());
        $item->save();

        return redirect()->route('medicamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
