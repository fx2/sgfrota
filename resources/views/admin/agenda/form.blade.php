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
<div class="form-group row mb-5 {{ $errors->has('titulo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="titulo" class="control-label">{{ 'Titulo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="titulo" type="text" id="titulo" value="{{ isset($result->titulo) ? $result->titulo : ''}}" >
        {!! $errors->first('titulo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="descricao" class="control-label">{{ 'Descricao' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="descricao" type="textarea" id="descricao" >{{ isset($result->descricao) ? $result->descricao : old('descricao')}}</textarea>
        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('data') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="data" class="control-label">{{ 'Data' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="data" type="date" id="data" value="{{ isset($result->data) ? $result->data : ''}}" >
        {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('horario') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="horario" class="control-label">{{ 'Horario' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="horario" type="time" id="horario" value="{{ isset($result->horario) ? $result->horario : old('horario')}}" >
        {!! $errors->first('horario', '<p class="help-block">:message</p>') !!}
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
