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
<div class="form-group row mb-5 {{ $errors->has('tipo_manutencao_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_manutencao_id" class="control-label">{{ 'Tipo Manutenção/Despesa' }}</label>
    </div>
    <div class="col-10">
        <select name="tipo_manutencao_id" class="form-control" id="tipo_manutencao_id" >
    <option value="">Selecione ...</option>
    @foreach ($selectModelFields['TipoManutencao'] as $optionKey => $optionValue)
        <option value="{{ $optionValue->id }}"
            {{ (isset($result->tipo_manutencao_id) && $result->tipo_manutencao_id == $optionValue->id) ? 'selected' : ''}}
            {{ old('tipo_manutencao_id') == $optionValue->id ? "selected" : "" }}
        >{{ $optionValue->nome }}</option>
    @endforeach
</select>
        {!! $errors->first('tipo_manutencao_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('fornecedor_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="fornecedor_id" class="control-label">{{ 'Fornecedor' }}</label>
    </div>
    <div class="col-10">
        <select name="fornecedor_id" class="form-control" id="fornecedor_id" onchange="loadFornecedor(this.value)">
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['Fornecedor'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->fornecedor_id) && $result->fornecedor_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('fornecedor_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->razao_social }}</option>
            @endforeach
        </select>
        {!! $errors->first('fornecedor_id', '<p class="help-block">:message</p>') !!}

        <span id="load-fornecedor"></span>
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('responsavel_retirada') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="responsavel_retirada" class="control-label">{{ 'Responsavel Retirada' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="responsavel_retirada" type="text" id="responsavel_retirada" value="{{ isset($result->responsavel_retirada) ? $result->responsavel_retirada : ''}}" >
        {!! $errors->first('responsavel_retirada', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('descricao_manutencao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="descricao_manutencao" class="control-label">{{ 'Descricao Manutenção/Despesa' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="descricao_manutencao" type="textarea" id="descricao_manutencao" >{{ isset($result->descricao_manutencao) ? $result->descricao_manutencao : old('descricao_manutencao')}}</textarea>
        {!! $errors->first('descricao_manutencao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('numero_processo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="numero_processo" class="control-label">{{ 'Numero Processo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="numero_processo" type="text" id="numero_processo" value="{{ isset($result->numero_processo) ? $result->numero_processo : ''}}" >
        {!! $errors->first('numero_processo', '<p class="help-block">:message</p>') !!}
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
<div class="form-group row mb-5 {{ $errors->has('hora') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="hora" class="control-label">{{ 'Hora' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="hora" type="time" id="hora" value="{{ isset($result->hora) ? $result->hora : old('hora')}}" >
        {!! $errors->first('hora', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row mb-5 {{ $errors->has('tipo_correcao_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_correcao_id" class="control-label">{{ 'O problema foi corrigido?' }}</label>
    </div>
    <div class="col-10">
        <select name="tipo_correcao_id" class="form-control" id="tipo_correcao_id" >
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['TipoCorrecao'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->tipo_correcao_id) && $result->tipo_correcao_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('tipo_correcao_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('tipo_correcao_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('valor') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="valor" class="control-label">{{ 'Valor R$' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control money" name="valor" type="text" id="valor" value="{{ isset($result->valor) ? $result->valor : old('valor')}}" >
        {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
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
        <script src="{{ asset('js/ajax_veiculoTemporario.js') }}"></script>
<script>
    var result = @json($result ?? ["controle_frota_id" => null, "fornecedor_id" => null]);
    var fornecedorAppend = $('#load-fornecedor');

    loadFornecedor(result.fornecedor_id);

    async function loadFornecedor(fornecedor_id = null){
        if (fornecedor_id == null)
            return true;

        const resp = await axios.get(`${BASE_URL}/fornecedor?where=id,=,${fornecedor_id}&first=true`);

        fornecedorAppend.find('ul').remove();

        fornecedorAppend.append(
            `
                <ul class="ml-3 list-unstyled">
                    <li><strong>Razão Social</strong>: ${resp.data.razao_social} </li>
                    <li><strong>Nome Fantasia</strong>: ${resp.data.nome_fantasia}</li>
                    <li><strong>CNPJ</strong>: ${resp.data.cnpj}</li>
                    <li><strong>Telefone</strong>: ${resp.data.telefone}</li>
                </ul>
            `
        );
    }
</script>
@endpush
