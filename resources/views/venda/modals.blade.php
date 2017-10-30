@forelse($lista as $item)
    <div id="modal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ $item->nome }}</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Valor unitário</th>
                                <th>Quantidade</th>
                                <th>subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->medicamentos as $medicamento)
                                <tr>
                                    <td>{{ $medicamento->nome }}</td>
                                    <td>{{ $medicamento->pivot->valor_unitario }}</td>
                                    <td>{{ $medicamento->pivot->quantidade }}</td>
                                    <td>{{ number_format($medicamento->pivot->quantidade * $medicamento->pivot->valor_unitario, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-right">Total:</th>
                                <td colspan="3">{{ number_format($item->total, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@empty
@endforelse