<div class="form-group row mb-5 {{ $errors->has('setor_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="setor_id" class="control-label">{{ 'Setor Id' }}</label>
    </div>
    <div class="col-10">
        <select name="setor_id" class="form-control" id="setor_id" >
    <option value="">Selecione ...</option>
    @foreach ($selectModelFields[] as $optionKey => $optionValue)
        <option value="{{ $optionValue->id }}" 
            {{ (isset($result->setor_id) && $result->setor_id == $optionValue->id) ? 'selected' : ''}}
            {{ old('setor_id') == $optionValue->id ? "selected" : "" }} 
        >{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('setor_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('idpermissao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="idpermissao" class="control-label">{{ 'Idpermissao' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="idpermissao" type="number" id="idpermissao" value="{{ isset($result->idpermissao) ? $result->idpermissao : ''}}" >
        {!! $errors->first('idpermissao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('tipo_usuario') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_usuario" class="control-label">{{ 'Tipo Usuario' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="tipo_usuario" type="text" id="tipo_usuario" value="{{ isset($result->tipo_usuario) ? $result->tipo_usuario : ''}}" >
        {!! $errors->first('tipo_usuario', '<p class="help-block">:message</p>') !!}
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
