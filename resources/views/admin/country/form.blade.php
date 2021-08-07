<div class="form-group row mb-5 {{ $errors->has('nome') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome" class="control-label">{{ 'Nome' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($result->nome) ? $result->nome : ''}}" >
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('nome_pt') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome_pt" class="control-label">{{ 'Nome Pt' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="nome_pt" type="text" id="nome_pt" value="{{ isset($result->nome_pt) ? $result->nome_pt : ''}}" >
        {!! $errors->first('nome_pt', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('sigla') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="sigla" class="control-label">{{ 'Sigla' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="sigla" type="text" id="sigla" value="{{ isset($result->sigla) ? $result->sigla : ''}}" >
        {!! $errors->first('sigla', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('bacen') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="bacen" class="control-label">{{ 'Bacen' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="bacen" type="number" id="bacen" value="{{ isset($result->bacen) ? $result->bacen : ''}}" >
        {!! $errors->first('bacen', '<p class="help-block">:message</p>') !!}
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
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
</div>
