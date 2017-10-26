@forelse($lista as $item)
    <div id="modal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="post" action="{{ route('adicionar-ao-carrinho', $item->id) }}">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{ $item->nome }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="quantidade" class="col-md-4 control-label">Quantidade</label>
                            <div class="col-md-6">
                                <input id="quantidade" type="number" min="1" max="{{ $item->estoque }}" class="form-control" name="quantidade" placeholder="Máximo {{ $item->estoque }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@empty
@endforelse