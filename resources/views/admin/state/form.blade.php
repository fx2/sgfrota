<div class="form-group row mb-5 {{ $errors->has('nome') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome" class="control-label">{{ 'Nome' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($result->nome) ? $result->nome : ''}}" >
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('uf') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="uf" class="control-label">{{ 'Uf' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="uf" type="text" id="uf" value="{{ isset($result->uf) ? $result->uf : ''}}" >
        {!! $errors->first('uf', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('ibge') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="ibge" class="control-label">{{ 'Ibge' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="ibge" type="number" id="ibge" value="{{ isset($result->ibge) ? $result->ibge : ''}}" >
        {!! $errors->first('ibge', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('country_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="country_id" class="control-label">{{ 'Country Id' }}</label>
    </div>
    <div class="col-10">
        <select name="country_id" class="form-control" id="country_id" >
    <option value="">Selecione ...</option>
    @foreach ($selectModelFields[] as $optionKey => $optionValue)
        <option value="{{ $optionValue->id }}" 
            {{ (isset($result->country_id) && $result->country_id == $optionValue->id) ? 'selected' : ''}}
            {{ old('country_id') == $optionValue->id ? "selected" : "" }} 
        >{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('ddd') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="ddd" class="control-label">{{ 'Ddd' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="ddd" type="number" id="ddd" value="{{ isset($result->ddd) ? $result->ddd : ''}}" >
        {!! $errors->first('ddd', '<p class="help-block">:message</p>') !!}
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
