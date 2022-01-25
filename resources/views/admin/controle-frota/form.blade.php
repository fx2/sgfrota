<div class="form-group row mb-5 {{ $errors->has('tipo_veiculo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_veiculo" class="control-label">{{ 'Tipo Veiculo' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
            <label><input name="tipo_veiculo" type="radio" value="1" onclick="tipo_veiculoFn(1)" @if (isset($result)) {{ (1 == $result->tipo_veiculo) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Próprio</label>
            <label><input name="tipo_veiculo" type="radio" value="0" onclick="tipo_veiculoFn(0)" {{ (isset($result) && 0 == $result->tipo_veiculo) ? 'checked' : '' }}> Alugado</label>
        </div>
        {!! $errors->first('tipo_veiculo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="hide_show_nome_proprietario" class="form-group row mb-5 {{ $errors->has('nome_proprietario') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome_proprietario" class="control-label">{{ 'Nome Proprietario' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="nome_proprietario" type="text" id="nome_proprietario" value="{{ isset($result->nome_proprietario) ? $result->nome_proprietario : old('nome_proprietario')}}" >
        {!! $errors->first('nome_proprietario', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('disponivel_outros_departamentos') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="disponivel_outros_departamentos" class="control-label">{{ 'Disponivel Outros Departamentos' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
            <label><input name="disponivel_outros_departamentos" type="radio" value="1" @if (isset($result)) {{ (1 == $result->disponivel_outros_departamentos) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
            <label><input name="disponivel_outros_departamentos" type="radio" value="0" {{ (isset($result) && 0 == $result->disponivel_outros_departamentos) ? 'checked' : '' }}> Não</label>
        </div>
        {!! $errors->first('disponivel_outros_departamentos', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{-- <div class="form-group row mb-5 {{ $errors->has('veiculo_escolar') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="veiculo_escolar" class="control-label">{{ 'Veiculo Escolar' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
            <label><input name="veiculo_escolar" type="radio" value="1" onclick="veiculo_escolarFn(1)" @if (isset($result)) {{ (1 == $result->veiculo_escolar) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
            <label><input name="veiculo_escolar" type="radio" value="0" onclick="veiculo_escolarFn(0)" {{ (isset($result) && 0 == $result->veiculo_escolar) ? 'checked' : '' }}> Não</label>
        </div>
        {!! $errors->first('veiculo_escolar', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="hide_show_certificado_vistoria" class="form-group row  {{ $errors->has('certificado_vistoria') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="certificado_vistoria" class="control-label">{{ 'Certificado Vistoria' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="certificado_vistoria" type="file" id="certificado_vistoria" value="{{ isset($result->certificado_vistoria) ? $result->certificado_vistoria : old('certificado_vistoria')}}" >
        {!! $errors->first('certificado_vistoria', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="hide_show_certificado_vistoria_imagem" class="form-group row mb-5 {{ $errors->has('certificado_vistoria') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    <div class="col-10">
        <label for="certificado_vistoria" class="control-label">{{ '' }}</label>
        <img class="img-fluid" id="img_upload" src="{{ isset($result->certificado_vistoria) ? asset($result->certificado_vistoria) : '' }}" alt="{{ isset($result->certificado_vistoria) ? $result->certificado_vistoria : '' }}" >
    </div>
</div>

<div id="hide_show_vencto_vistoria_escolar" class="form-group row mb-5 {{ $errors->has('vencto_vistoria_escolar') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="vencto_vistoria_escolar" class="control-label">{{ 'Vencto Vistoria Escolar' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="vencto_vistoria_escolar" type="date" id="vencto_vistoria_escolar" value="{{ isset($result->vencto_vistoria_escolar) ? $result->vencto_vistoria_escolar : old('vencto_vistoria_escolar')}}" >
        {!! $errors->first('vencto_vistoria_escolar', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}

<div class="form-group row mb-5 {{ $errors->has('tipo_veiculo_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_veiculo_id" class="control-label">{{ 'Tipo Veiculo' }}</label>
    </div>
    <div class="col-10">
        <select name="tipo_veiculo_id" class="form-control" id="tipo_veiculo_id" >
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['TipoVeiculo'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->tipo_veiculo_id) && $result->tipo_veiculo_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('tipo_veiculo_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('tipo_veiculo_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('renavan') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="renavan" class="control-label">{{ 'Renavan' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="renavan" type="text" id="renavan" value="{{ isset($result->renavan) ? $result->renavan : old('renavan')}}" >
        {!! $errors->first('renavan', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('placa') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="placa" class="control-label">{{ 'Placa' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="placa" type="text" id="placa" value="{{ isset($result->placa) ? $result->placa : old('placa')}}" >
        {!! $errors->first('placa', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('chassi') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="chassi" class="control-label">{{ 'Chassi' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="chassi" type="text" id="chassi" value="{{ isset($result->chassi) ? $result->chassi : old('chassi')}}" >
        {!! $errors->first('chassi', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('especie_tipo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="especie_tipo" class="control-label">{{ 'Especie Tipo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="especie_tipo" type="text" id="especie_tipo" value="{{ isset($result->especie_tipo) ? $result->especie_tipo : old('especie_tipo')}}" >
        {!! $errors->first('especie_tipo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('tipo_combustivel_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_combustivel_id" class="control-label">{{ 'Tipo Combustivel' }}</label>
    </div>
    <div class="col-10">
        <select name="tipo_combustivel_id" class="form-control" id="tipo_combustivel_id" >
    <option value="">Selecione ...</option>
    @foreach ($selectModelFields['TipoCombustivel'] as $optionKey => $optionValue)
        <option value="{{ $optionValue->id }}"
            {{ (isset($result->tipo_combustivel_id) && $result->tipo_combustivel_id == $optionValue->id) ? 'selected' : ''}}
            {{ old('tipo_combustivel_id') == $optionValue->id ? "selected" : "" }}
        >{{ $optionValue->nome }}</option>
    @endforeach
</select>
        {!! $errors->first('tipo_combustivel_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('marca_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="marca_id" class="control-label">{{ 'Marca' }}</label>
    </div>
    <div class="col-10">
        <select name="marca_id" class="form-control" id="marca_id" onchange="loadModelosByMarca(this, null)">
    <option value="">Selecione ...</option>
    @foreach ($selectModelFields['Marca'] as $optionKey => $optionValue)
        <option value="{{ $optionValue->id }}"
            {{ (isset($result->marca_id) && $result->marca_id == $optionValue->id) ? 'selected' : ''}}
            {{ old('marca_id') == $optionValue->id ? "selected" : "" }}
        >{{ $optionValue->nome }}</option>
    @endforeach
</select>
        {!! $errors->first('marca_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('modelo_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="modelo_id" class="control-label">{{ 'Modelo' }}</label>
    </div>
    <div class="col-10">
        <select name="modelo_id" class="form-control" id="modelo_id" >
    <option value="">Selecione ...</option>
    {{-- @foreach ($selectModelFields['Modelo'] as $optionKey => $optionValue)
        <option value="{{ $optionValue->id }}"
            {{ (isset($result->modelo_id) && $result->modelo_id == $optionValue->id) ? 'selected' : ''}}
            {{ old('modelo_id') == $optionValue->id ? "selected" : "" }}
        >{{ $optionValue->modelo }}</option>
    @endforeach --}}
</select>
        {!! $errors->first('modelo_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('veiculo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="veiculo" class="control-label">{{ 'Veiculo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="veiculo" type="text" id="veiculo" value="{{ isset($result->veiculo) ? $result->veiculo : old('veiculo')}}" >
        {!! $errors->first('veiculo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('ano_fabricacao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="ano_fabricacao" class="control-label">{{ 'Ano Fabricacao' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control ano" name="ano_fabricacao" type="text" id="ano_fabricacao" value="{{ isset($result->ano_fabricacao) ? $result->ano_fabricacao : old('ano_fabricacao')}}" >
        {!! $errors->first('ano_fabricacao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('ano_modelo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="ano_modelo" class="control-label">{{ 'Ano Modelo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control ano" name="ano_modelo" type="text" id="ano_modelo" value="{{ isset($result->ano_modelo) ? $result->ano_modelo : old('ano_modelo')}}" >
        {!! $errors->first('ano_modelo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('capacidade') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="capacidade" class="control-label">{{ 'Capacidade' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="capacidade" type="text" id="capacidade" value="{{ isset($result->capacidade) ? $result->capacidade : old('capacidade')}}" >
        {!! $errors->first('capacidade', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('cor') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cor" class="control-label">{{ 'Cor' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="cor" type="text" id="cor" value="{{ isset($result->cor) ? $result->cor : old('cor')}}" >
        {!! $errors->first('cor', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('patrimonio') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="patrimonio" class="control-label">{{ 'Patrimonio' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="patrimonio" type="text" id="patrimonio" value="{{ isset($result->patrimonio) ? $result->patrimonio : old('patrimonio')}}" >
        {!! $errors->first('patrimonio', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('estado_veiculo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="estado_veiculo" class="control-label">{{ 'Estado Veiculo' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="estado_veiculo" type="textarea" id="estado_veiculo" >{{ isset($result->estado_veiculo) ? $result->estado_veiculo : old('estado_veiculo')}}</textarea>
        {!! $errors->first('estado_veiculo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('km_inicial') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="km_inicial" class="control-label">{{ 'Km Inicial' }}</label>
    </div>
    <div class="col-10">
        <input
            class="form-control decimal"
            name="km_inicial" type="text"
            id="km_inicial"
            value="{{ isset($result->km_inicial) ? number_format((float) $result->km_inicial, 0) : old('km_inicial')}}"
            @if ($formMode != 'create')
                readonly
            @endif
        >
        {!! $errors->first('km_inicial', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if($formMode != 'create')
    <div class="form-group row mb-5 {{ $errors->has('km_atual') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="km_atual" class="control-label">{{ 'Km Atual' }}</label>
        </div>
        <div class="col-10">
            <input class="form-control decimal" readonly name="km_atual" type="text" id="km_atual" value="{{ isset($result->km_atual) ? number_format((float) $result->km_atual, 0) : old('km_atual')}}" >
            {!! $errors->first('km_atual', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif

<div class="form-group row mb-5 {{ $errors->has('dut') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="dut" class="control-label">{{ 'Dut' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="dut" type="file" id="dut" value="{{ isset($result->dut) ? $result->dut : old('dut')}}" >
        {!! $errors->first('dut', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('dut') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    @include('parts.imagem-pdf', [
        'value' => isset($result->dut) ? $result->dut : null,
        'id' => 'img_upload'
    ])
</div>

<div class="form-group row mb-5 {{ $errors->has('foto') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="foto" class="control-label">{{ 'Foto do veículo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="foto" type="file" id="foto" value="{{ isset($result->foto) ? removePublicPath($result->foto) : old('foto')}}" >
        {!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('foto') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    @include('parts.imagem-pdf', [
        'value' => isset($result->foto) ? $result->foto : null
    ])
</div>

<div class="form-group row mb-5 {{ $errors->has('tipo_responsavel') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_responsavel" class="control-label">{{ 'Veículo pertencente a algum gabinete' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
            <label><input name="tipo_responsavel" type="radio" value="1" onclick="tipo_responsavelFn(1)" @if (isset($result)) {{ (1 == $result->tipo_responsavel) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
            <label><input name="tipo_responsavel" type="radio" value="0" onclick="tipo_responsavelFn(0)" {{ (isset($result) && 0 == $result->tipo_responsavel) ? 'checked' : '' }}> Não</label>
        </div>
        {!! $errors->first('tipo_responsavel', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="hide_show_responsavel_id" class="form-group row mb-5 {{ $errors->has('tipo_responsavel_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_responsavel_id" class="control-label">{{ 'Responsável' }}</label>
    </div>
    <div class="col-10">
        <select name="tipo_responsavel_id" class="form-control" id="tipo_responsavel_id" >
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['TipoResponsavel'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->tipo_responsavel_id) && $result->tipo_responsavel_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('tipo_responsavel_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('tipo_responsavel_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('revisao_com_data') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="revisao_com_data" class="control-label">{{ 'Revisão KM com: ' }}</label>
    </div>

    <div class="col-4">
        KM: <input
            class="form-control decimal"
            name="revisao_com_km" type="text"
            id="revisao_com_km"
            value="{{ isset($result->revisao_com_km) ? number_format((float) $result->revisao_com_km, 0) : old('revisao_com_km')}}"
{{--            @if ($formMode != 'create')--}}
{{--                readonly--}}
{{--            @endif--}}
        >
        {!! $errors->first('revisao_com_km', '<p class="help-block">:message</p>') !!}
    </div>
    ou

    <div class="col-1"></div>

    <div class="col-4">
        Data: <input class="form-control" name="revisao_com_data" type="date" id="revisao_com_data" value="{{ isset($result->revisao_com_data) ? $result->revisao_com_data : old('revisao_com_data')}}" >
        {!! $errors->first('revisao_com_data', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('vencimento_licenciamento') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="vencimento_licenciamento" class="control-label">{{ 'Vencimento do licenciamento' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="vencimento_licenciamento" type="date" id="vencimento_licenciamento" value="{{ isset($result->vencimento_licenciamento) ? $result->vencimento_licenciamento : old('vencimento_licenciamento')}}" >
        {!! $errors->first('vencimento_licenciamento', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('data_vencimento_seguro') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="data_vencimento_seguro" class="control-label">{{ 'Vencimento do Seguro do Veículo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="data_vencimento_seguro" type="date" id="data_vencimento_seguro" value="{{ isset($result->data_vencimento_seguro) ? $result->data_vencimento_seguro : old('data_vencimento_seguro')}}" >
        {!! $errors->first('data_vencimento_seguro', '<p class="help-block">:message</p>') !!}
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
<script>
    const tipo_veiculo = $('[name="tipo_veiculo"]');
    const nome_proprietario = $('[name="nome_proprietario"]');
    const hide_show_nome_proprietario = $('#hide_show_nome_proprietario');
    const responsavel_id = $('[name="responsavel_id"]');
    const hide_show_responsavel_id = $('#hide_show_responsavel_id');
    const marca_id = {{ $result->marca_id ?? 'undefined' }}
    const modelo_id = {{ $result->modelo_id ?? 'undefined' }}

    $(function () {
        tipo_veiculoFn({{ $result->tipo_veiculo ?? 1 }});
        tipo_responsavelFn({{ $result->tipo_responsavel ?? 1 }});
        loadModelosByMarca(marca_id, modelo_id)
    });

    function tipo_veiculoFn(value){
        if (value == 0){
            hide_show_nome_proprietario.fadeIn();

            return true;
        }

        hide_show_nome_proprietario.fadeOut();
        nome_proprietario.val(null);
    }

    function tipo_responsavelFn(value){
        if (value == 1){
            hide_show_responsavel_id.fadeIn();

            return true;
        }

        hide_show_responsavel_id.fadeOut();
        responsavel_id.val(null);
    }

    async function loadModelosByMarca(_this, modelo = null){
        if (_this === undefined)
            return true;

        marcaId = _this.value !== undefined ? _this.value : _this;


        $('[name="modelo_id"]').children().remove();

        const resp = await axios.get(`${BASE_URL}/modelo?select=id,modelo&where=marca_id,=,${marcaId}&get=true`);

        $('[name="modelo_id"]').append('<option value="">Selecione...</option>');
        resp.data.forEach((element, i) => {
            if (modelo === element.id) {
                $('[name="modelo_id"]').append(`<option value="${element.id}" selected>${element.modelo}</option>`);
            }

            $('[name="modelo_id"]').append(`<option value="${element.id}">${element.modelo} - ${element.id}</option>`);
        });
    }
</script>
@endpush
