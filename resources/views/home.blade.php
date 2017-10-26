@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Carrinho</div>

                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Laboratório</th>
                                <th>Quantidade</th>
                                <th>Valor (un)</th>
                                <th>Subtotal</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total = 0;
                            @endphp
                            @forelse($carrinho as $item)
                                @php
                                $total += $item['medicamento']->valor_venda * $item['quantidade'];
                                @endphp
                                <tr>
                                    <td>{{ $item['medicamento']->nome }}</td>
                                    <td>{{ $item['medicamento']->laboratorio->nome }}</td>
                                    <td>{{ $item['quantidade'] }}</td>
                                    <td>{{ $item['medicamento']->valor_venda_formatado }}</td>
                                    <td>R${{ number_format($item['medicamento']->valor_venda * $item['quantidade'], 2, ',', '.') }}</td>
                                    <td>
                                        <form method="post" action="{{ route('remover-do-carrinho', $item['medicamento']->id) }}">
                                            {{ csrf_field() }}
                                            <button class="btn btn-info btn-sm" type="submit">Remover</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Carrinho vazio</td>
                                </tr>
                            @endforelse
                            <tr>
                                <th class="text-right" colspan="4">Total:</th>
                                <td colspan="2">R${{ number_format($total, 2, ',', '.') }}</td>
                            </tr>
                            @if(count($carrinho) > 0)
                                <tr>
                                    <td class="text-right" colspan="6">
                                        <a class="btn btn-success btn-sm" href="{{ route('finalizar') }}">Finalizar compra</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Filtro</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="filter[nome]" class="col-md-4 control-label">Nome</label>
                            <div class="col-md-6">
                                <input id="filter[nome]" type="text" class="form-control" name="filter[nome]" value="{{ Request::input('filter.nome') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="filter[tipo]" class="col-md-4 control-label">Tipo</label>
                            <div class="col-md-6">
                                <select class="form-control" name="filter[tipo]">
                                    <option value>Selecione um Tipo</option>
                                    @foreach($tipos as $id => $tipo)
                                        <option {{ Request::input('filter.tipo') == $id ? 'selected' : '' }} value="{{ $id }}">{{ $tipo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="filter[laboratorio_id]" class="col-md-4 control-label">Laboratório</label>
                            <div class="col-md-6">
                                <select class="form-control" name="filter[laboratorio_id]">
                                    <option value>Selecione um Laboratório</option>
                                    @foreach($laboratorios as $laboratorio)
                                        <option {{ Request::input('filter.laboratorio_id') == $laboratorio->id ? 'selected' : '' }} value="{{ $laboratorio->id }}">{{ $laboratorio->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Buscar
                                </button>
                                <a href="{{ url()->current() }}" class="btn btn-default">
                                    Resetar filtro
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de medicamentos</div>

                <div class="panel-heading text-right">
                    <a href="{{ route('medicamentos.create') }}">
                        <i class="glyphicon glyphicon-plus"> Adicionar medicamento</i>
                    </a>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Tipo</th>
                                <th>Estoque</th>
                                <th>Laboratório</th>
                                <th width="20%">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lista as $item)
                                <tr>
                                    <td>{{ $item->nome }}</td>
                                    <td>R$ {{ number_format($item->valor_venda, 2, ',', '.') }}</td>
                                    <td>{{ $item->tipo_como_texto }}</td>
                                    <td>{{ $item->estoque }}</td>
                                    <td>{{ $item->laboratorio->nome }}</td>
                                    <td>
                                        @if($item->tem_no_estoque)
                                            <a href="#" class="btn btn-info btn-sm open-modal-medicamento"  data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                                Adicionar ao carrinho
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="panel-footer text-center">
                    {{ $lista->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@include('medicamento.modals')
@endsection
