@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Vendas</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuário</th>
                                <th>Medicamentos</th>
                                <th>Valor</th>
                                <th>Data</th>
                                <th width="20%">Opçoes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($lista as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->usuario->name }}</td>
                                    <td>{{ $item->medicamentos->count() }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $item->total_formatado }}</td>
                                    <td>
                                        <a class="btn btn-default" href="#" data-toggle="modal" data-target="#modal-{{ $item->id }}">
                                            <i class="fa fa-eye">Ver medicamentos</i>
                                        </a>
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
    @include('venda.modals')
@endsection
