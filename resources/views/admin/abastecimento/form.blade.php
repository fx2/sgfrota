<div class="form-group row mb-5 {{ $errors->has('controle_frota_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="controle_frota_id" class="control-label">{{ 'Veículo' }}</label>
    </div>
    <div class="col-10">
        <select name="controle_frota_id" class="form-control" id="controle_frota_id" onchange="loadControleFrotum(this.value)">
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['ControleFrotum'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}" 
                    {{ (isset($result->controle_frota_id) && $result->controle_frota_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('controle_frota_id') == $optionValue->id ? "selected" : "" }} 
                >{{ $optionValue->veiculo }}</option>
            @endforeach
        </select>
        {!! $errors->first('controle_frota_id', '<p class="help-block">:message</p>') !!}

        <span id="load-veiculo"></span>
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

<div class="form-group row mb-5 {{ $errors->has('km_atual') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="km_atual" class="control-label">{{ 'Km Atual' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="km_atual" type="number" id="km_atual" value="{{ isset($result->km_atual) ? $result->km_atual : old('km_atual')}}" >
        {!! $errors->first('km_atual', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('responsavel') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="responsavel" class="control-label">{{ 'Responsavel' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="responsavel" type="text" id="responsavel" value="{{ isset($result->responsavel) ? $result->responsavel : old('responsavel')}}" >
        {!! $errors->first('responsavel', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{-- <div class="form-group row mb-5 {{ $errors->has('foto') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="foto" class="control-label">{{ 'Foto' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="foto" type="text" id="foto" value="{{ isset($result->foto) ? $result->foto : ''}}" >
        {!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}

<div class="form-group row {{ $errors->has('foto') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="foto" class="control-label">{{ 'Anexar documento' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="foto" type="file" id="foto" value="{{ isset($result->foto) ? $result->foto : ''}}" >
        {!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('foto') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    <div class="col-10">
        <label for="foto" class="control-label">{{ '' }}</label>
        <img class="img-fluid" src="{{ isset($result->foto) ? removePublicPath(asset($result->foto)) : '' }}" alt="{{ isset($result->foto) ? $result->foto : '' }}" >
    </div>  
</div>

<div class="form-group row mb-5 {{ $errors->has('qtd_litros') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="qtd_litros" class="control-label">{{ 'Quantidade de Litros' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="qtd_litros" type="number" step="0.01" id="qtd_litros" value="{{ isset($result->qtd_litros) ? $result->qtd_litros : old('qtd_litros')}}" >
        {!! $errors->first('qtd_litros', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('valor') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="valor" class="control-label">{{ 'Valor R$' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="valor" type="number" step="0.01" id="valor" value="{{ isset($result->valor) ? $result->valor : old('valor')}}" >
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


<div class="form-group">
    <a href="{{ url()->previous() }}" title="Voltar" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
</div>


@push('js')
<script>
    var result = @json($result ?? ["controle_frota_id" => null, "fornecedor_id" => null]);
    var veiculoAppend = $('#load-veiculo');
    var fornecedorAppend = $('#load-fornecedor');
    
    loadControleFrotum(result.controle_frota_id);
    loadFornecedor(result.fornecedor_id);

    async function loadControleFrotum(controle_frota_id = null){
        if (controle_frota_id == null)
            return true;

        const resp = await axios.get(`${BASE_URL}/controle-frota?with=tipo_veiculoHasOne,tipo_combustivel,marca,modelo&where=id,=,${controle_frota_id}&first=true`);
        veiculoAppend.find('ul').remove();

        veiculoAppend.append(
            `
                <ul class="ml-3 list-unstyled">
                    <li><strong>Proprietário</strong>: ${resp.data.nome_proprietario} </li>
                    <li><strong>Marca</strong>: ${resp.data.marca.nome} </li>
                    <li><strong>Modelo</strong>: ${resp.data.modelo.modelo}</li>
                    <li><strong>Tipo de combustível</strong>: ${resp.data.tipo_combustivel.nome}</li>
                    <li><strong>Cor</strong>: ${resp.data.cor}</li>
                    <li><strong>Capacidade</strong>: ${resp.data.capacidade}</li>
                    <li><strong>Ano</strong>: ${moment(resp.data.ano_modelo).format('YYYY')}</li>
                    <li><strong>Km inicial</strong>: ${resp.data.km_inicial}</li>
                    <li><strong>Placa</strong>: ${resp.data.placa}</li>
                    <li><strong>Renavan</strong>: ${resp.data.renavan}</li>
                </ul>
            `
        );
    }

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