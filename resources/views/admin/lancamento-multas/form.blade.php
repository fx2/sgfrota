<div class="form-group row mb-5 {{ $errors->has('motorista_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="motorista_id" class="control-label">{{ 'Motorista' }}</label>
    </div>
    <div class="col-10">
        <select name="motorista_id" class="form-control" id="motorista_id">
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['Motoristum'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->motorista_id) && $result->motorista_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('motorista_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('motorista_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('controle_frota_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="controle_frota_id" class="control-label">{{ 'Veículo' }}</label>
    </div>
    <div class="col-10">
        <select name="controle_frota_id" class="form-control" id="controle_frota_id">
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['ControleFrotum'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->controle_frota_id) && $result->controle_frota_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('controle_frota_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->veiculo }} - {{ $optionValue->placa }}</option>
            @endforeach
        </select>
        {!! $errors->first('controle_frota_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('tipo_multa_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_multa_id" class="control-label">{{ 'Tipo Multa' }}</label>
    </div>
    <div class="col-10">
        <select name="tipo_multa_id" class="form-control" id="tipo_multa_id" onchange="loadTipoMulta(this.value)">
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['TipoMulta'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->tipo_multa_id) && $result->tipo_multa_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('tipo_multa_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->tipo }}</option>
            @endforeach
        </select>
        {!! $errors->first('tipo_multa_id', '<p class="help-block">:message</p>') !!}

        <span id="load-tipomulta"></span>
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('ocorrencias') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="ocorrencias" class="control-label">{{ 'Ocorrencias' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="ocorrencias" type="text" id="ocorrencias" value="{{ isset($result->ocorrencias) ? $result->ocorrencias : old('ocorrencias')}}" >
        {!! $errors->first('ocorrencias', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('numero_ait') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="numero_ait" class="control-label">{{ 'Numero Ait' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="numero_ait" type="text" id="numero_ait" value="{{ isset($result->numero_ait) ? $result->numero_ait : old('numero_ait')}}" >
        {!! $errors->first('numero_ait', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('estado_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="estado_id" class="control-label">{{ 'Estado' }}</label>
    </div>
    <div class="col-10">
        <select name="estado_id" class="form-control" id="estado_id" onchange="findMunicipio(this)">
        </select>
        {!! $errors->first('estado_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('municipio_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="municipio_id" class="control-label">{{ 'Município' }}</label>
    </div>
    <div class="col-10">
        <select name="municipio_id" class="form-control" id="municipio_id">
        </select>
        {!! $errors->first('municipio_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row mb-5 {{ $errors->has('endereco_multa') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="endereco_multa" class="control-label">{{ 'Endereco Multa' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="endereco_multa" type="text" id="endereco_multa" value="{{ isset($result->endereco_multa) ? $result->endereco_multa : old('endereco_multa')}}" >
        {!! $errors->first('endereco_multa', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('data_multa') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="data_multa" class="control-label">{{ 'Data Multa' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="data_multa" type="date" id="data_multa" value="{{ isset($result->data_multa) ? $result->data_multa : old('data_multa')}}" >
        {!! $errors->first('data_multa', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('hora_multa') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="hora_multa" class="control-label">{{ 'Hora Multa' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="hora_multa" type="time" id="hora_multa" value="{{ isset($result->hora_multa) ? $result->hora_multa : old('hora_multa')}}" >
        {!! $errors->first('hora_multa', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('orgao_correspondente') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="orgao_correspondente" class="control-label">{{ 'Orgao Correspondente' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="orgao_correspondente" type="text" id="orgao_correspondente" value="{{ isset($result->orgao_correspondente) ? $result->orgao_correspondente : old('orgao_correspondente')}}" >
        {!! $errors->first('orgao_correspondente', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('enquadramento') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="enquadramento" class="control-label">{{ 'Enquadramento' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="enquadramento" type="text" id="enquadramento" value="{{ isset($result->enquadramento) ? $result->enquadramento : old('enquadramento')}}" >
        {!! $errors->first('enquadramento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('data_vencimento') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="data_vencimento" class="control-label">{{ 'Data Vencimento' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="data_vencimento" type="date" id="data_vencimento" value="{{ isset($result->data_vencimento) ? $result->data_vencimento : old('data_vencimento')}}" >
        {!! $errors->first('data_vencimento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('valor_multa') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="valor_multa" class="control-label">{{ 'Valor Multa' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control money" name="valor_multa" type="text" id="valor_multa" value="{{ isset($result->valor_multa) ? $result->valor_multa : old('valor_multa')}}" >
        {!! $errors->first('valor_multa', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('pago') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="pago" class="control-label">{{ 'Pago' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="pago" type="radio" value="1" @if (isset($result)) {{ (1 == $result->pago) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
    <label><input name="pago" type="radio" value="0" {{ (isset($result) && 0 == $result->pago) ? 'checked' : '' }}> Não</label>
</div>
        {!! $errors->first('pago', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('foto_multa') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="foto_multa" class="control-label">{{ 'Foto Multa' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="foto_multa" type="file" id="foto_multa" value="{{ isset($result->foto_multa) ? $result->foto_multa : old('foto_multa')}}" >
        {!! $errors->first('foto_multa', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('foto_multa') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    <div class="col-10">
        <label for="foto_multa" class="control-label">{{ '' }}</label>
        <img class="img-fluid" src="{{ isset($result->foto_multa) ? removePublicPath($result->foto_multa) : '' }}" alt="{{ isset($result->foto_multa) ? $result->foto_multa : '' }}" >
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
    <script src="{{ asset('js/ajax_motorista.js') }}"></script>
    <script src="{{ asset('js/ajax_veiculo.js') }}"></script>
<script>
    var result = @json($result ?? ["estado_id" => null, "municipio_id" => null]);
    var tipoMultaAppend = $('#load-tipomulta');

    if (result.estado_id === null ){
        loadStates();
    } else {
        loadState(result.estado_id);
        loadMunicipio(result.municipio_id);
    }

    loadTipoMulta(result.tipo_multa_id);

    async function loadTipoMulta(tipo_multa_id = null){
        if (tipo_multa_id == null)
            return true;

        const resp = await axios.get(`${BASE_URL}/tipo-multas?where=id,=,${tipo_multa_id}&first=true`);
        tipoMultaAppend.find('ul').remove();

        tipoMultaAppend.append(
            `
                <ul class="ml-3 list-unstyled">
                    <li><strong>Tipo</strong>: ${resp.data.tipo} </li>
                    <li><strong>Código</strong>: ${resp.data.codigo} </li>
                    <li><strong>Infrator</strong>: ${resp.data.infrator}</li>
                    <li><strong>Pontuação</strong>: ${resp.data.pontuacao}</li>
                </ul>
            `
        );
    }

    //https://servicodados.ibge.gov.br/api/docs/localidades
    async function loadStates(){
        var resp = await axios.get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados`)
        $('[name="estado_id"]').append('<option value="">Selecione...</option>');
        resp.data.forEach(element => {
            $('[name="estado_id"]').append('<option value="' + element.id + '">' + element.nome + '</option>');
        });
    }

    async function findMunicipio(_this, apagaCampos = true){
        stateId = _this.value !== undefined ? _this.value : result.estado_id;

        if (apagaCampos)
            $('[name="municipio_id"]').children().remove();

        var resp = await axios.get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${stateId}/municipios`)

        $('[name="municipio_id"]').append('<option value="">Selecione...</option>');
        resp.data.forEach((element, i) => {
            $('[name="municipio_id"]').append('<option value="' + element.id + '">' + element.nome + '</option>');
        });
    }

    async function loadState(stateId) {
        var resp = await axios.get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${stateId}`);
        $('[name="estado_id"]').append('<option value="' + resp.data.id + '">' + resp.data.nome + '</option>');

        loadStates()
    }

    async function loadMunicipio(municipioId){
        var resp = await axios.get(`https://servicodados.ibge.gov.br/api/v1/localidades/municipios/${municipioId}`);

        $('[name="municipio_id"]').append('<option value="' + resp.data.id + '">' + resp.data.nome + '</option>');

        findMunicipio(result.estado_id, false)
    }

</script>
@endpush
