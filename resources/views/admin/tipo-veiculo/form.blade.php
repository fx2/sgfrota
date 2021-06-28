<div class="form-group row mb-5 {{ $errors->has('nome') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome" class="control-label">{{ 'Nome' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($result->nome) ? $result->nome : ''}}" >
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
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
