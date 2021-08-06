<div class="form-group row mb-5 {{ $errors->has('controle_frota_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="controle_frota_id" class="control-label">{{ 'Controle Frota Id' }}</label>
    </div>
    <div class="col-10">
        <select name="controle_frota_id" class="form-control" id="controle_frota_id" >
            <option value="">Selecione...</option>
            @foreach ($selectModelFields['ControleFrotum'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->departamento) && $result->departamento == $optionValue->id) ? 'selected' : ''}}
                    {{ old('departamento') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->veiculo }}</option>
            @endforeach
        </select>
        {!! $errors->first('controle_frota_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('departamento') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="departamento" class="control-label">{{ 'Departamento' }}</label>
    </div>
    <div class="col-10">
        <select name="departamento" class="form-control" id="departamento" >
            @foreach (json_decode('{"manha": "Manhã", "tarde": "Tarde", "integral": "Integral"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($veiculoagendamento->departamento) && $veiculoagendamento->departamento == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('departamento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('periodo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="periodo" class="control-label">{{ 'Periodo' }}</label>
    </div>
    <div class="col-10">
        <select name="periodo" class="form-control" id="periodo" >
            @foreach (json_decode('{"manha": "Manhã", "tarde": "Tarde", "integral": "Integral"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($veiculoagendamento->periodo) && $veiculoagendamento->periodo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('periodo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('telefone') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="telefone" class="control-label">{{ 'Telefone' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="telefone" type="text" id="telefone" value="{{ isset($result->telefone) ? $result->telefone : ''}}" >
        {!! $errors->first('telefone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('local') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="local" class="control-label">{{ 'Local' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="local" type="text" id="local" value="{{ isset($result->local) ? $result->local : ''}}" >
        {!! $errors->first('local', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('previsao_saida') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="previsao_saida" class="control-label">{{ 'Previsao Saida' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="previsao_saida" type="datetime-local" id="previsao_saida" value="{{ isset($result->previsao_saida) ? $result->previsao_saida : old('previsao_saida')}}" >
        {!! $errors->first('previsao_saida', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('previsao_volta') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="previsao_volta" class="control-label">{{ 'Previsao Volta' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="previsao_volta" type="datetime-local" id="previsao_volta" value="{{ isset($result->previsao_volta) ? $result->previsao_volta : old('previsao_volta')}}" >
        {!! $errors->first('previsao_volta', '<p class="help-block">:message</p>') !!}
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

@include('parts/select-setor')

<div class="form-group">
    <a href="{{ url()->previous() }}" title="Voltar" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
</div>

@push('js')
<script src="{{ asset('js/ajax_veiculo.js') }}"></script>
@endpush
