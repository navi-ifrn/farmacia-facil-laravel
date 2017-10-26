@extends('layouts.app')

@section('content')
    <div class="container">
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
                                    <th>#</th>
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
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nome }}</td>
                                        <td>{{ $item->valor_venda_formatado }}</td>
                                        <td>{{ $item->tipo_como_texto }}</td>
                                        <td>{{ $item->estoque }}</td>
                                        <td>{{ $item->laboratorio->nome }}</td>
                                        <td>
                                            <a href="{{ route('medicamentos.edit', $item->id) }}" class="btn btn-info btn-sm">
                                                Editar
                                            </a>
                                            <form action="{{ route('medicamentos.destroy', $item->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-info btn-sm">Excluir</button>
                                            </form>
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
@endsection
