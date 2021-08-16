<div class="form-group row mb-5 {{ $errors->has('controle_frota_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="controle_frota_id" class="control-label">{{ 'Veículo' }}</label>
    </div>
    <div class="col-10">
        <select name="controle_frota_id" class="form-control" id="controle_frota_id" >
            @isset($withFields['controle_frota'])
                <option value="{{ $withFields['controle_frota']->id }}" selected>{{ $withFields['controle_frota']->veiculo }}</option>
            @else
                <option value="">Selecione ...</option>
                @foreach ($controleFrotumDisponiveis as $optionKey => $optionValue)
                    <option value="{{ $optionValue->id }}-{{$optionValue->veiculo_saida_id}}"
                    {{ (isset($result->controle_frota_id) && $result->controle_frota_id == $optionValue->id) ? 'selected' : ''}}
{{--                    {{ old('controle_frota_id') == $optionValue->id ? "selected" : "" }}--}}
                    >{{ $optionValue->veiculo }}</option>
                @endforeach
            @endisset
        </select>
        {!! $errors->first('controle_frota_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('motorista_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="motorista_id" class="control-label">{{ 'Motorista' }}</label>
    </div>
    <div class="col-10">
        <select name="motorista_id" class="form-control" id="motorista_id" >
            <option value="">Selecione ...</option>

            @if($formMode == 'show')
                @foreach ($selectModelFields['Motoristum'] as $optionKey => $optionValue)
                    <option value="{{ $optionValue->id }}"
                        {{ (isset($result->motorista_id) && $result->motorista_id == $optionValue->id) ? 'selected' : ''}}
                        {{ old('motorista_id') == $optionValue->id ? "selected" : "" }}
                    >{{ $optionValue->nome }}</option>
                @endforeach
            @endif


        </select>
        {!! $errors->first('motorista_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('km_final') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="km_final" class="control-label">{{ 'Km Final' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control decimal" name="km_final" type="text" id="km_final" value="{{ isset($result->km_final) ? decimal($result->km_final) : old('km_final')}}" >
        {!! $errors->first('km_final', '<p class="help-block">:message</p>') !!}
        <span id="km_final_sugerido"></span>
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('relatorio_trajeto_motorista') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="relatorio_trajeto_motorista" class="control-label">{{ 'Relatorio Trajeto Motorista' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="relatorio_trajeto_motorista" type="textarea" id="relatorio_trajeto_motorista" >{{ isset($result->relatorio_trajeto_motorista) ? $result->relatorio_trajeto_motorista : old('relatorio_trajeto_motorista')}}</textarea>
        {!! $errors->first('relatorio_trajeto_motorista', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('quantidade_combustivel') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="quantidade_combustivel" class="control-label">{{ 'Quantidade Combustivel' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="quantidade_combustivel" type="text" id="quantidade_combustivel" value="{{ isset($result->quantidade_combustivel) ? $result->quantidade_combustivel : old('quantidade_combustivel')}}" >
        {!! $errors->first('quantidade_combustivel', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('observacao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="observacao" class="control-label">{{ 'Observacao' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="observacao" type="textarea" id="observacao" >{{ isset($result->observacao) ? $result->observacao : old('observacao')}}</textarea>
        {!! $errors->first('observacao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('nome_responsavel') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome_responsavel" class="control-label">{{ 'Nome Responsavel' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" readonly name="nome_responsavel" type="text" id="nome_responsavel" value="{{ isset($result->nome_responsavel) ? $result->nome_responsavel : old('nome_responsavel')}}" >
        {!! $errors->first('nome_responsavel', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('mecanica') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="mecanica" class="control-label">{{ 'Mecanica' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="mecanica" type="radio" value="1" @if (isset($result)) {{ (1 == $result->mecanica) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Bom</label>
    <label><input name="mecanica" type="radio" value="0" {{ (isset($result) && 0 == $result->mecanica) ? 'checked' : '' }}> Ruim</label>
</div>
        {!! $errors->first('mecanica', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('eletrica') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="eletrica" class="control-label">{{ 'Eletrica' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="eletrica" type="radio" value="1" @if (isset($result)) {{ (1 == $result->eletrica) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Bom</label>
    <label><input name="eletrica" type="radio" value="0" {{ (isset($result) && 0 == $result->eletrica) ? 'checked' : '' }}> Ruim</label>
</div>
        {!! $errors->first('eletrica', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('funilaria') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="funilaria" class="control-label">{{ 'Funilaria' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="funilaria" type="radio" value="1" @if (isset($result)) {{ (1 == $result->funilaria) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Bom</label>
    <label><input name="funilaria" type="radio" value="0" {{ (isset($result) && 0 == $result->funilaria) ? 'checked' : '' }}> Ruim</label>
</div>
        {!! $errors->first('funilaria', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('pintura') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="pintura" class="control-label">{{ 'Pintura' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="pintura" type="radio" value="1" @if (isset($result)) {{ (1 == $result->pintura) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Bom</label>
    <label><input name="pintura" type="radio" value="0" {{ (isset($result) && 0 == $result->pintura) ? 'checked' : '' }}> Ruim</label>
</div>
        {!! $errors->first('pintura', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('pneus') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="pneus" class="control-label">{{ 'Pneus' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="pneus" type="radio" value="1" @if (isset($result)) {{ (1 == $result->pneus) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Bom</label>
    <label><input name="pneus" type="radio" value="0" {{ (isset($result) && 0 == $result->pneus) ? 'checked' : '' }}> Ruim</label>
</div>
        {!! $errors->first('pneus', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('observacao_situacao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="observacao_situacao" class="control-label">{{ 'Observacao Situacao' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="observacao_situacao" type="textarea" id="observacao_situacao" >{{ isset($result->observacao_situacao) ? $result->observacao_situacao : old('observacao_situacao')}}</textarea>
        {!! $errors->first('observacao_situacao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('macaco') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="macaco" class="control-label">{{ 'Macaco' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="macaco" type="radio" value="1" @if (isset($result)) {{ (1 == $result->macaco) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
    <label><input name="macaco" type="radio" value="0" {{ (isset($result) && 0 == $result->macaco) ? 'checked' : '' }}> Não</label>
</div>
        {!! $errors->first('macaco', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('triangulo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="triangulo" class="control-label">{{ 'Triangulo' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="triangulo" type="radio" value="1" @if (isset($result)) {{ (1 == $result->triangulo) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
    <label><input name="triangulo" type="radio" value="0" {{ (isset($result) && 0 == $result->triangulo) ? 'checked' : '' }}> Não</label>
</div>
        {!! $errors->first('triangulo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('estepe') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="estepe" class="control-label">{{ 'Estepe' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="estepe" type="radio" value="1" @if (isset($result)) {{ (1 == $result->estepe) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
    <label><input name="estepe" type="radio" value="0" {{ (isset($result) && 0 == $result->estepe) ? 'checked' : '' }}> Não</label>
</div>
        {!! $errors->first('estepe', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('extintor') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="extintor" class="control-label">{{ 'Extintor' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="extintor" type="radio" value="1" @if (isset($result)) {{ (1 == $result->extintor) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
    <label><input name="extintor" type="radio" value="0" {{ (isset($result) && 0 == $result->extintor) ? 'checked' : '' }}> Não</label>
</div>
        {!! $errors->first('extintor', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('chave_roda') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="chave_roda" class="control-label">{{ 'Chave Roda' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="chave_roda" type="radio" value="1" @if (isset($result)) {{ (1 == $result->chave_roda) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
    <label><input name="chave_roda" type="radio" value="0" {{ (isset($result) && 0 == $result->chave_roda) ? 'checked' : '' }}> Não</label>
</div>
        {!! $errors->first('chave_roda', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('observacao_acessorio') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="observacao_acessorio" class="control-label">{{ 'Observacao Acessorio' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="observacao_acessorio" type="textarea" id="observacao_acessorio" >{{ isset($result->observacao_acessorio) ? $result->observacao_acessorio : old('observacao_acessorio')}}</textarea>
        {!! $errors->first('observacao_acessorio', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('entrada_data') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="entrada_data" class="control-label">{{ 'Data da Entrada' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="entrada_data" type="date" id="entrada_data" value="{{ isset($result->entrada_data) ? $result->entrada_data : old('entrada_data')}}" >
        {!! $errors->first('entrada_data', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('entrada_hora') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="entrada_hora" class="control-label">{{ 'Hora da Entrada' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="entrada_hora" type="time" id="entrada_hora" value="{{ isset($result->entrada_hora) ? $result->entrada_hora : old('entrada_hora')}}" >
        {!! $errors->first('entrada_hora', '<p class="help-block">:message</p>') !!}
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

<div class="form-group row {{ $errors->has('document') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="document" class="control-label">{{ 'Anexar documento' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="document" type="file" id="document" value="{{ isset($result->document) ? $result->document : ''}}" >
        {!! $errors->first('document', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('document') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    <div class="col-10">
        <label for="document" class="control-label">{{ '' }}</label>
        <img class="img-fluid" src="{{ isset($result->document) ? removePublicPath(asset($result->document)) : '' }}" alt="{{ isset($result->document) ? $result->document : '' }}" >
    </div>
</div>

@if($formMode != 'create')
<div class="form-group row mb-5 {{ $errors->has('status') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="status" class="control-label">{{ 'Registro' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
            {{  App\Models\User::find($result['auth_id'])['name'] ?? '' }}
        </div>
    </div>
</div>
@endif

@include('parts/select-setor')

<div class="form-group">
    <a href="{{ url()->previous() }}" title="Voltar" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
    @if($formMode != 'show')
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
    @endif
</div>


@push('js')
<script src="{{ asset('js/ajax_veiculo.js') }}"></script>

@if($formMode == 'show')
    <script src="{{ asset('js/ajax_motorista.js') }}"></script>
@else

<script>
    $('#controle_frota_id').change(function (e) {
        loadMotorista(e.target.value)
    });

    var motoristaAppend = $('#motorista_id');


    async function loadMotorista(motorista_id = null){
        if (motorista_id == null)
            return true;

        values = motorista_id.split("-");
        // $('[name="veiculo_saida_id"]').val(values[1]);

        $('#motorista-remove-append').remove();
    const resp = await axios.get(`${BASE_URL}/veiculo-saida?select=controle_frotas.km_atual,veiculo_saidas.km_inicial,veiculo_saidas.nome_responsavel,tipo_cnhs.nome%20AS%20cnh_nome,%20motoristas.cnh,motoristas.cnh_validade,motoristas.rg,motoristas.cpf,motoristas.id,motoristas.nome%20as%20moto_nome&join=motoristas,motoristas.id,veiculo_saidas.motorista_id,tipo_cnhs,tipo_cnhs.id,motoristas.tipo_cnh_id,controle_frotas,controle_frotas.id,veiculo_saidas.controle_frota_id&where=controle_frota_id,=,${values[0]}&first=true`);
    // const resp = await axios.get(`${BASE_URL}/veiculo-saida?with=motorista&where=controle_frota_id,=,${motorista_id}&first=true`);

        motoristaAppend.html(
            `
                <option value="${resp.data.id}">${resp.data.moto_nome}</option>
            `
        );

        motoristaAppend.after(
            `
                <ul class="ml-3 list-unstyled" id="motorista-remove-append">
                    <li><strong>TIPO CNH</strong>: ${resp.data.cnh_nome}</li>
                    <li><strong>CNH</strong>: ${resp.data.cnh}</li>
                    <li><strong>Validade da CNH</strong>: ${moment(resp.data.cnh_validade).format('DD/MM/YYYY')}</li>
                    <li><strong>RG</strong>: ${resp.data.rg}</li>
                    <li><strong>CPF</strong>: ${resp.data.cpf}</li>


                </ul>
            `
        );



        str = resp.data.km_atual;
        str = str.substring(0, str.length-5);
        $('#km_final_sugerido').append(`<span>KM atual: ${str}</span>`)
        $('#nome_responsavel').val(resp.data.nome_responsavel);
    }
</script>

@endif
@endpush
