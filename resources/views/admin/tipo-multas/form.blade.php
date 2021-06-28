<div class="form-group row mb-5 {{ $errors->has('tipo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo" class="control-label">{{ 'Tipo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="tipo" type="text" id="tipo" value="{{ isset($result->tipo) ? $result->tipo : ''}}" >
        {!! $errors->first('tipo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="descricao" class="control-label">{{ 'Descricao' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="descricao" type="textarea" id="descricao" >{{ isset($result->descricao) ? $result->descricao : ''}}</textarea>
        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('pontuacao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="pontuacao" class="control-label">{{ 'Pontuacao' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="pontuacao" type="number" id="pontuacao" value="{{ isset($result->pontuacao) ? $result->pontuacao : ''}}" >
        {!! $errors->first('pontuacao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('infrator') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="infrator" class="control-label">{{ 'Infrator' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="infrator" type="text" id="infrator" value="{{ isset($result->infrator) ? $result->infrator : ''}}" >
        {!! $errors->first('infrator', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('codigo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="codigo" class="control-label">{{ 'Codigo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="codigo" type="text" id="codigo" value="{{ isset($result->codigo) ? $result->codigo : ''}}" >
        {!! $errors->first('codigo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('status') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="status" class="control-label">{{ 'Status' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="status" type="radio" value="1" @if (isset($result)) {{ (1 == $result->status) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Ativo</label>
    <label><input name="status" type="radio" value="0" {{ (isset($result) && 0 == $result->status) ? 'checked' : '' }}> Bloqueado</label>
</div>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <a href="{{ url()->previous() }}" title="Voltar" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
</div>
