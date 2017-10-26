@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Adicionar Medicamento</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('medicamentos.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label for="nome" class="col-md-4 control-label">Nome</label>
                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" required autofocus>
                                    @if ($errors->has('nome'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('bula') ? ' has-error' : '' }}">
                                <label for="bula" class="col-md-4 control-label">Bula</label>
                                <div class="col-md-6">
                                    <textarea id="bula" class="form-control" name="bula" required>{{ old('bula') }}</textarea>
                                    @if ($errors->has('bula'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('bula') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('valor_compra') ? ' has-error' : '' }}">
                                <label for="nome" class="col-md-4 control-label">Valor de compra</label>
                                <div class="col-md-6">
                                    <input id="valor_compra" type="text" class="form-control" name="valor_compra" value="{{ old('valor_compra') }}" required autofocus>
                                    @if ($errors->has('valor_compra'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('valor_compra') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('porcentagem_lucro') ? ' has-error' : '' }}">
                                <label for="nome" class="col-md-4 control-label">Porcentagem de Lucro</label>
                                <div class="col-md-6">
                                    <input id="porcentagem_lucro" type="text" class="form-control" name="porcentagem_lucro" value="{{ old('porcentagem_lucro') }}" required autofocus>
                                    @if ($errors->has('porcentagem_lucro'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('porcentagem_lucro') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                                <label for="nome" class="col-md-4 control-label">Tipo</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="tipo" required>
                                        <option value>Selecione um Tipo</option>
                                        @foreach($tipos as $id => $tipo)
                                            <option {{ old('tipo') == $id ? 'selected' : '' }} value="{{ $id }}">{{ $tipo }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('tipo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tipo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('estoque') ? ' has-error' : '' }}">
                                <label for="nome" class="col-md-4 control-label">Estoque</label>
                                <div class="col-md-6">
                                    <input id="estoque" type="number" class="form-control" name="estoque" value="{{ old('estoque') }}" required autofocus>
                                    @if ($errors->has('estoque'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('estoque') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('laboratorio_id') ? ' has-error' : '' }}">
                                <label for="nome" class="col-md-4 control-label">Laboratório</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="laboratorio_id" required>
                                        <option value>Selecione um Laboratório</option>
                                        @foreach($laboratorios as $laboratorio)
                                            <option {{ old('laboratorio_id') == $laboratorio->id ? 'selected' : '' }} value="{{ $laboratorio->id }}">{{ $laboratorio->nome }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('laboratorio_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('laboratorio_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Adicionar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
