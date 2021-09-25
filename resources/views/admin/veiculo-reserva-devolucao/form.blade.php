<div class="form-group row mb-5 {{ $errors->has('tipo_veiculo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_veiculo" class="control-label">{{ 'Tipo Veiculo' }}</label>
    </div>
    <div class="col-10">
        <div class="radio form-check d-none">
            <label><input name="tipo_veiculo" type="radio" value="1" onclick="tipo_veiculoFn(1)" @if (isset($result)) {{ (1 == $result->tipo_veiculo) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Próprio</label>
            <label><input name="tipo_veiculo" type="radio" value="0" onclick="tipo_veiculoFn(0)" {{ (isset($result) && 0 == $result->tipo_veiculo) ? 'checked' : '' }}> Alugado</label>
        </div>
        @if (isset($result)) {{ (1 == $result->tipo_veiculo) ? 'Próprio' : 'Alugado' }} @endif
        {!! $errors->first('tipo_veiculo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="hide_show_nome_proprietario" class="form-group row mb-5 {{ $errors->has('nome_proprietario') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome_proprietario" class="control-label">{{ 'Nome Proprietario' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" readonly name="nome_proprietario" type="text" id="nome_proprietario" value="{{ isset($result->nome_proprietario) ? $result->nome_proprietario : old('nome_proprietario')}}" >
        {!! $errors->first('nome_proprietario', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('disponivel_outros_departamentos') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="disponivel_outros_departamentos" class="control-label">{{ 'Disponivel Outros Departamentos' }}</label>
    </div>
    <div class="col-10">
        <div class="radio d-none">
            <label><input name="disponivel_outros_departamentos" type="radio" value="1" @if (isset($result)) {{ (1 == $result->disponivel_outros_departamentos) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
            <label><input name="disponivel_outros_departamentos" type="radio" value="0" {{ (isset($result) && 0 == $result->disponivel_outros_departamentos) ? 'checked' : '' }}> Não</label>
        </div>

        @if (isset($result)) {{ (1 == $result->disponivel_outros_departamentos) ? 'Sim' : 'Não' }} @endif

        {!! $errors->first('disponivel_outros_departamentos', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('tipo_veiculo_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_veiculo_id" class="control-label">{{ 'Tipo Veiculo' }}</label>
    </div>
    <div class="col-10">
        <select name="tipo_veiculo_id" disabled class="form-control" id="tipo_veiculo_id" >
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
        <input disabled class="form-control" name="renavan" type="text" id="renavan" value="{{ isset($result->renavan) ? $result->renavan : old('renavan')}}" >
        {!! $errors->first('renavan', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('placa') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="placa" class="control-label">{{ 'Placa' }}</label>
    </div>
    <div class="col-10">
        <input disabled class="form-control" name="placa" type="text" id="placa" value="{{ isset($result->placa) ? $result->placa : old('placa')}}" >
        {!! $errors->first('placa', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('chassi') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="chassi" class="control-label">{{ 'Chassi' }}</label>
    </div>
    <div class="col-10">
        <input disabled class="form-control" name="chassi" type="text" id="chassi" value="{{ isset($result->chassi) ? $result->chassi : old('chassi')}}" >
        {!! $errors->first('chassi', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('especie_tipo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="especie_tipo" class="control-label">{{ 'Especie Tipo' }}</label>
    </div>
    <div class="col-10">
        <input disabled class="form-control" name="especie_tipo" type="text" id="especie_tipo" value="{{ isset($result->especie_tipo) ? $result->especie_tipo : old('especie_tipo')}}" >
        {!! $errors->first('especie_tipo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('tipo_combustivel_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_combustivel_id" class="control-label">{{ 'Tipo Combustivel' }}</label>
    </div>
    <div class="col-10">
        <select disabled name="tipo_combustivel_id" class="form-control" id="tipo_combustivel_id" >
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
        <select disabled name="marca_id" class="form-control" id="marca_id" onchange="loadModelosByMarca(this, null)">
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
        <select disabled name="modelo_id" class="form-control" id="modelo_id" >
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
        <input disabled class="form-control" name="veiculo" type="text" id="veiculo" value="{{ isset($result->veiculo) ? $result->veiculo : old('veiculo')}}" >
        {!! $errors->first('veiculo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('ano_fabricacao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="ano_fabricacao" class="control-label">{{ 'Ano Fabricacao' }}</label>
    </div>
    <div class="col-10">
        <input disabled class="form-control ano" name="ano_fabricacao" type="text" id="ano_fabricacao" value="{{ isset($result->ano_fabricacao) ? $result->ano_fabricacao : old('ano_fabricacao')}}" >
        {!! $errors->first('ano_fabricacao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('ano_modelo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="ano_modelo" class="control-label">{{ 'Ano Modelo' }}</label>
    </div>
    <div class="col-10">
        <input disabled class="form-control ano" name="ano_modelo" type="text" id="ano_modelo" value="{{ isset($result->ano_modelo) ? $result->ano_modelo : old('ano_modelo')}}" >
        {!! $errors->first('ano_modelo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('capacidade') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="capacidade" class="control-label">{{ 'Capacidade' }}</label>
    </div>
    <div class="col-10">
        <input disabled class="form-control" name="capacidade" type="text" id="capacidade" value="{{ isset($result->capacidade) ? $result->capacidade : old('capacidade')}}" >
        {!! $errors->first('capacidade', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('cor') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cor" class="control-label">{{ 'Cor' }}</label>
    </div>
    <div class="col-10">
        <input disabled class="form-control" name="cor" type="text" id="cor" value="{{ isset($result->cor) ? $result->cor : old('cor')}}" >
        {!! $errors->first('cor', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('patrimonio') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="patrimonio" class="control-label">{{ 'Patrimonio' }}</label>
    </div>
    <div class="col-10">
        <input disabled class="form-control" name="patrimonio" type="text" id="patrimonio" value="{{ isset($result->patrimonio) ? $result->patrimonio : old('patrimonio')}}" >
        {!! $errors->first('patrimonio', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('estado_veiculo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="estado_veiculo" class="control-label">{{ 'Estado Veiculo' }}</label>
    </div>
    <div class="col-10">
        <textarea disabled class="form-control" rows="5" name="estado_veiculo" type="textarea" id="estado_veiculo" >{{ isset($result->estado_veiculo) ? $result->estado_veiculo : old('estado_veiculo')}}</textarea>
        {!! $errors->first('estado_veiculo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('km_inicial') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="km_inicial" class="control-label">{{ 'Km Inicial' }}</label>
    </div>
    <div class="col-10">
        <input
            disabled
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
            <input disabled class="form-control decimal" readonly type="text" value="{{ isset($result->km_atual) ? number_format((float) $result->km_atual, 0) : old('km_atual')}}" >
            {!! $errors->first('km_atual', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif

<div class="form-group row mb-5 {{ $errors->has('dut') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="dut" class="control-label">{{ 'Dut' }}</label>
    </div>
    <div class="col-10">
{{--        <input disabled class="form-control" name="dut" type="file" id="dut" value="{{ isset($result->dut) ? $result->dut : old('dut')}}" >--}}
        {!! $errors->first('dut', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('dut') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    @include('parts.imagem-pdf', [
        'value' => isset($result->dut) ? $result->dut : null
    ])
</div>

<div class="form-group row mb-5 {{ $errors->has('foto') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="foto" class="control-label">{{ 'Foto do veículo' }}</label>
    </div>
    <div class="col-10">
{{--        <input class="form-control" name="foto" type="file" id="foto" value="{{ isset($result->foto) ? removePublicPath($result->foto) : old('foto')}}" >--}}
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
        <div class="radio d-none">
            <label><input name="tipo_responsavel" type="radio" value="1" onclick="tipo_responsavelFn(1)" @if (isset($result)) {{ (1 == $result->tipo_responsavel) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
            <label><input name="tipo_responsavel" type="radio" value="0" onclick="tipo_responsavelFn(0)" {{ (isset($result) && 0 == $result->tipo_responsavel) ? 'checked' : '' }}> Não</label>
        </div>

        @if (isset($result)) {{ (1 == $result->tipo_responsavel) ? 'Sim' : 'Não' }} @endif

        {!! $errors->first('tipo_responsavel', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="hide_show_responsavel_id" class="form-group row mb-5 {{ $errors->has('tipo_responsavel_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_responsavel_id" class="control-label">{{ 'Responsável' }}</label>
    </div>
    <div class="col-10">
        <select disabled name="tipo_responsavel_id" class="form-control" id="tipo_responsavel_id" >
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


{{--<div style="background-color: #F4F6F9; padding: 5px;">--}}
    <div class="form-group row mb-5 {{ $errors->has('controle_frota_id') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="controle_frota_id" class="control-label">{{ 'Veículo' }}</label>
        </div>
        <div class="col-10">
            <select disabled name="controle_frota_id" class="form-control" id="controle_frota_id">
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

    <div class="form-group row mb-5 {{ $errors->has('entrada_forma_substituicao') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="entrada_forma_substituicao" class="control-label">{{ 'Entrada Forma Substituicao' }}</label>
        </div>
        <div class="col-10">
            <textarea disabled class="form-control" rows="5" name="entrada_forma_substituicao" type="textarea" id="entrada_forma_substituicao" >{{ isset($result->entrada_forma_substituicao) ? $result->entrada_forma_substituicao : old('entrada_forma_substituicao')}}</textarea>
            {!! $errors->first('entrada_forma_substituicao', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row mb-5 {{ $errors->has('entrada_data') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="entrada_data" class="control-label">{{ 'Entrada Data' }}</label>
        </div>
        <div class="col-10">
            <input disabled class="form-control" name="entrada_data" type="date" id="entrada_data" value="{{ isset($result->entrada_data) ? $result->entrada_data : ''}}" >
            {!! $errors->first('entrada_data', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row mb-5 {{ $errors->has('entrada_horario') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="entrada_horario" class="control-label">{{ 'Entrada Horario' }}</label>
        </div>
        <div class="col-10">
            <input disabled class="form-control" name="entrada_horario" type="time" id="entrada_horario" value="{{ isset($result->entrada_horario) ? $result->entrada_horario : old('entrada_horario')}}" >
            {!! $errors->first('entrada_horario', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
{{--    <div class="form-group row mb-5 {{ $errors->has('entrada_km_atual') ? 'has-error' : ''}}">--}}
{{--        <div class="col-2">--}}
{{--            <label for="entrada_km_atual" class="control-label">{{ 'Entrada Km Atual' }}</label>--}}
{{--        </div>--}}
{{--        <div class="col-10">--}}
{{--            <input disabled class="form-control decimal" name="entrada_km_atual" type="text" id="entrada_km_atual" value="{{ isset($result->entrada_km_atual) ? number_format((float) $result->entrada_km_atual, 0) : ''}}" >--}}
{{--            {!! $errors->first('entrada_km_atual', '<p class="help-block">:message</p>') !!}--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="form-group row mb-5 {{ $errors->has('entrada_combustivel') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="entrada_combustivel" class="control-label">{{ 'Entrada Combustivel' }}</label>
        </div>
        <div class="col-10">
            <input disabled class="form-control" name="entrada_combustivel" type="text" id="entrada_combustivel" value="{{ isset($result->entrada_combustivel) ? $result->entrada_combustivel : ''}}" >
            {!! $errors->first('entrada_combustivel', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row mb-5 {{ $errors->has('entrada_recebido_por') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="entrada_recebido_por" class="control-label">{{ 'Entrada Recebido Por' }}</label>
        </div>
        <div class="col-10">
            <input disabled class="form-control" name="entrada_recebido_por" type="text" id="entrada_recebido_por" value="{{ isset($result->entrada_recebido_por) ? $result->entrada_recebido_por : ''}}" >
            {!! $errors->first('entrada_recebido_por', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row mb-5 {{ $errors->has('entrada_observacao') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="entrada_observacao" class="control-label">{{ 'Entrada Observacao' }}</label>
        </div>
        <div class="col-10">
            <textarea disabled class="form-control" rows="5" name="entrada_observacao" type="textarea" id="entrada_observacao" >{{ isset($result->entrada_observacao) ? $result->entrada_observacao : old('entrada_observacao')}}</textarea>
            {!! $errors->first('entrada_observacao', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row mb-5 {{ $errors->has('documento') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="documento" class="control-label">{{ 'Documento referente a entrada' }}</label>
        </div>
        <div class="col-10">
    {{--        <input disabled class="form-control" name="documento" type="file" id="documento" value="{{ isset($result->documento) ? $result->documento : old('documento')}}" >--}}
            {!! $errors->first('documento', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row mb-5 {{ $errors->has('documento') ? 'has-error' : ''}}">
        <div class="col-2">
        </div>
        
        @include('parts.imagem-pdf', [
            'value' => isset($result->documento) ? $result->documento : null
        ])
    </div>

{{--</div>--}}



<h3 class="text-danger">Informações do Veículo que está voltando</h3>
<br>


{{--FORM--}}
<div class="form-group row mb-5 {{ $errors->has('devolucao_data') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="devolucao_data" class="control-label">{{ 'Data' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="devolucao_data" type="date" id="data" value="{{ isset($result->devolucao_data) ? $result->devolucao_data : old('devolucao_data')}}" >
        {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('devolucao_horario') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="devolucao_horario" class="control-label">{{ 'Horario' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="devolucao_horario" type="time" id="devolucao_horario" value="{{ isset($result->devolucao_horario) ? $result->devolucao_horario : old('devolucao_horario')}}" >
        {!! $errors->first('horario', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('km_atual') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="km_atual" class="control-label">{{ 'Km Atual' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control decimal" name="devolucao_km_atual" type="text" id="devolucao_km_atual" value="{{ isset($result->devolucao_km_atual) ? number_format((float) $result->devolucao_km_atual, 0) :  old('devolucao_km_atual')}}" >
        {!! $errors->first('km_atual', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('devolucao_combustivel') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="devolucao_combustivel" class="control-label">{{ 'Combustivel' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="devolucao_combustivel" type="text" id="combustivel" value="{{ isset($result->devolucao_combustivel) ? $result->devolucao_combustivel : old('devolucao_combustivel')}}" >
        {!! $errors->first('devolucao_combustivel', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('devolucao_recebido_por') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="devolucao_recebido_por" class="control-label">{{ 'Recebido Por' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="devolucao_recebido_por" type="text" id="devolucao_recebido_por" value="{{ isset($result->devolucao_recebido_por) ? $result->devolucao_recebido_por : old('devolucao_recebido_por')}}" >
        {!! $errors->first('devolucao_recebido_por', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('documento_devolucao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="documento_devolucao" class="control-label">{{ 'Anexar documento referente a saída' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="documento_devolucao" type="file" id="documento_devolucao" value="{{ isset($result->documento_devolucao) ? $result->documento_devolucao : old('documento_devolucao')}}" >
        {!! $errors->first('documento_devolucao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('documento_devolucao') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    @include('parts.imagem-pdf', [
        'value' => isset($result->documento_devolucao) ? $result->documento_devolucao : null
    ])
</div>

<div class="form-group row mb-5 {{ $errors->has('devolucao_observacao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="devolucao_observacao" class="control-label">{{ 'Observacao' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="devolucao_observacao" type="textarea" id="devolucao_observacao" >{{ isset($result->devolucao_observacao) ? $result->devolucao_observacao : old('devolucao_observacao')}}</textarea>
        {!! $errors->first('devolucao_observacao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 d-none {{ $errors->has('auth_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="auth_id" class="control-label">{{ 'Auth Id' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="auth_id" type="number" id="auth_id" value="{{ isset($result->auth_id) ? $result->auth_id : ''}}" >
        {!! $errors->first('auth_id', '<p class="help-block">:message</p>') !!}
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
    <script src="{{ asset('js/ajax_veiculo.js') }}"></script>

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
