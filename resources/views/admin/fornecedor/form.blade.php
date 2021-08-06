<div class="form-group row mb-5 {{ $errors->has('razao_social') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="razao_social" class="control-label">{{ 'Razao Social' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="razao_social" type="text" id="razao_social" value="{{ isset($result->razao_social) ? $result->razao_social : ''}}" >
        {!! $errors->first('razao_social', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('nome_fantasia') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome_fantasia" class="control-label">{{ 'Nome Fantasia' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="nome_fantasia" type="text" id="nome_fantasia" value="{{ isset($result->nome_fantasia) ? $result->nome_fantasia : ''}}" >
        {!! $errors->first('nome_fantasia', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('cnpj') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cnpj" class="control-label">{{ 'Cnpj' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control cnpj" name="cnpj" type="text" id="cnpj" value="{{ isset($result->cnpj) ? $result->cnpj : ''}}" >
        {!! $errors->first('cnpj', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('telefone') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="telefone" class="control-label">{{ 'Telefone' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control celular" name="telefone" type="text" id="telefone" value="{{ isset($result->telefone) ? $result->telefone : ''}}" >
        {!! $errors->first('telefone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('cep') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cep" class="control-label">{{ 'Cep' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control cep" name="cep" type="text" id="cep" value="{{ isset($result->cep) ? $result->cep : ''}}" onfocusout="buscaPorCep()">
        {!! $errors->first('cep', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('estado') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="estado" class="control-label">{{ 'Estado' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="estado" maxlength="2" type="text" id="estado" value="{{ isset($result->estado) ? $result->estado : ''}}" >
        {!! $errors->first('estado', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('cidade') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cidade" class="control-label">{{ 'Cidade' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="cidade" type="text" id="cidade" value="{{ isset($result->cidade) ? $result->cidade : ''}}" >
        {!! $errors->first('cidade', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('bairro') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="bairro" class="control-label">{{ 'Bairro' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="bairro" type="text" id="bairro" value="{{ isset($result->bairro) ? $result->bairro : ''}}" >
        {!! $errors->first('bairro', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('endereco') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="endereco" class="control-label">{{ 'Endereco' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="endereco" type="text" id="endereco" value="{{ isset($result->endereco) ? $result->endereco : ''}}" >
        {!! $errors->first('endereco', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('numero') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="numero" class="control-label">{{ 'Numero' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="numero" type="number" id="numero" value="{{ isset($result->numero) ? $result->numero : ''}}" >
        {!! $errors->first('numero', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('complemento') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="complemento" class="control-label">{{ 'Complemento' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="complemento" type="text" id="complemento" value="{{ isset($result->complemento) ? $result->complemento : ''}}" >
        {!! $errors->first('complemento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('status') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="status" class="control-label">{{ 'Status' }}</label>
    </div>
    <div class="radio col-10">
        <label><input name="status" type="radio" value="1" @if (isset($result)) {{ (1 == $result->status) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Ativo</label>
        <label><input name="status" type="radio" value="0" {{ (isset($result) && 0 == $result->status) ? 'checked' : '' }}> Bloqueado</label>
    </div>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group row mb-5">
    <a href="{{ url()->previous() }}" title="Voltar" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
</div>


@push('js')
<script>
    async function buscaPorCep(){
        var cep = document.getElementById('cep').value;

        var resp = await axios.get(`https://viacep.com.br/ws/${cep}/json`)

        document.getElementById("estado").value = resp.data.uf
        document.getElementById("cidade").value = resp.data.localidade
        document.getElementById("bairro").value = resp.data.bairro
        document.getElementById("endereco").value = resp.data.logradouro
    }
</script>
@endpush
