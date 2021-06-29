<div class="form-group row mb-5 {{ $errors->has('tipo_veiculo_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_veiculo_id" class="control-label">{{ 'Tipo Veículo' }}</label>
    </div>
    <div class="col-10">
        <select name="tipo_veiculo_id" class="form-control" id="tipo_veiculo_id" >
            <option value="">Selecione...</option>
            @foreach ($selectModelFields['TipoVeiculo'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}" {{ (isset($result->tipo_veiculo_id) && $result->tipo_veiculo_id == $optionValue->id) ? 'selected' : ''}}>{{ $optionValue->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('tipo_veiculo_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('marca_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="marca_id" class="control-label">{{ 'Marca' }}</label>
    </div>
    <div class="col-10">
        <select name="marca_id" class="form-control" style="width: 100%;" id="marca_id" onchange="loadMarcas(this)">
            <option value="">Selecione...</option>
            @foreach ($selectModelFields['Marca'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}" {{ (isset($result->marca_id) && $result->marca_id == $optionValue->id) ? 'selected' : ''}}>{{ $optionValue->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('marca_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('modelo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="modelo" class="control-label">{{ 'Modelo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="modelo" type="text" id="modelo" value="{{ isset($result->modelo) ? $result->modelo : ''}}" >
        {!! $errors->first('modelo', '<p class="help-block">:message</p>') !!}
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

@push('js')
<script>
    async function loadMarcas(_this){
        const marca = await axios.get(`${BASE_URL}/modelo?where=marca_id,=,${_this.value}&first=true`); ///modelo?where=marca_id,=,2
        
    }
</script>
@endpush