@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de laboratórios</div>

                    <div class="panel-heading text-right">
                        <a href="{{ route('laboratorios.create') }}">
                            <i class="glyphicon glyphicon-plus"> Adicionar laboratório</i>
                        </a>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th width="20%">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lista as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nome }}</td>
                                        <td>
                                            <a href="{{ route('laboratorios.edit', $item->id) }}" class="btn btn-info btn-sm">
                                                Editar
                                            </a>
                                            <form action="{{ route('laboratorios.destroy', $item->id) }}" method="POST">
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
