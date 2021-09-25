{{-- <div class="form-group row mb-5 {{ $errors->has('motorista_escolar') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="motorista_escolar" class="control-label">{{ 'Motorista Escolar' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
            <label><input name="motorista_escolar" type="radio" value="1" onclick="motorista_escolarFn(1)" @if (isset($result)) {{ (1 == $result->motorista_escolar) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Sim</label>
            <label><input name="motorista_escolar" type="radio" value="0" onclick="motorista_escolarFn(0)" {{ (isset($result) && 0 == $result->motorista_escolar) ? 'checked' : '' }}> Não</label>
        </div>
        {!! $errors->first('motorista_escolar', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="hide_show_tipo_motorista" class="form-group row mb-5 {{ $errors->has('tipo_motorista') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_motorista" class="control-label">{{ 'Tipo Motorista' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
            <label><input name="tipo_motorista[]" type="checkbox" value="Carro" @if (isset($result)) {{ ('Carro' == $result->tipo_motorista OR str_contains($result->tipo_motorista, 'Carro')) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Carro</label>
            <label><input name="tipo_motorista[]" type="checkbox" value="Caminhão" {{ (isset($result) && ('Caminhão' == $result->tipo_motorista OR str_contains($result->tipo_motorista, 'Caminhão'))) ? 'checked' : '' }}> Caminhão</label>
            <label><input name="tipo_motorista[]" type="checkbox" value="Ônibus" {{ (isset($result) && ('Ônibus' == $result->tipo_motorista OR str_contains($result->tipo_motorista, 'Ônibus'))) ? 'checked' : '' }}> Ônibus</label>
            <label><input name="tipo_motorista[]" type="checkbox" value="Todos" {{ (isset($result) && ('Todos' == $result->tipo_motorista OR str_contains($result->tipo_motorista, 'Todos'))) ? 'checked' : '' }}> Todos</label>
        </div>
        {!! $errors->first('tipo_motorista', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row hide_show_certificado_transporte_escolar {{ $errors->has('certificado_transporte_escolar') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="certificado_transporte_escolar" class="control-label">{{ 'Certificado de curso de transporte escolar' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="certificado_transporte_escolar" type="file" id="certificado_transporte_escolar" value="{{ isset($result->certificado_transporte_escolar) ? $result->certificado_transporte_escolar : ''}}" >
        {!! $errors->first('certificado_transporte_escolar', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 hide_show_certificado_transporte_escolar {{ $errors->has('certificado_transporte_escolar') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    <div class="col-10">
        <label for="certificado_transporte_escolar" class="control-label">{{ '' }}</label>
        <img class="img-fluid" src="{{ isset($result->certificado_transporte_escolar) ? removePublicPath(asset($result->certificado_transporte_escolar)) : '' }}" alt="{{ isset($result->certificado_transporte_escolar) ? $result->certificado_transporte_escolar : '' }}" >
    </div>
</div>

<div class="form-group row mb-5 hide_show_certificado_transporte_escolar {{ $errors->has('data_conclusao_curso') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="data_conclusao_curso" class="control-label">{{ 'Data da Conclusão do curso' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="data_conclusao_curso" type="date" id="data_conclusao_curso" value="{{ isset($result->data_conclusao_curso) ? $result->data_conclusao_curso : old('data_conclusao_curso')}}" >
        {!! $errors->first('data_conclusao_curso', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}

<div class="form-group row mb-5 {{ $errors->has('nome') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome" class="control-label">{{ 'Nome' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($result->nome) ? $result->nome : old('nome')}}" >
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('imagem') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="imagem" class="control-label">{{ 'Foto' }}</label>
    </div>
    <div class="col-10">
        <div id="upload">

        </div>

        <div id="webcam">
            <div class="row">
                <div class="col-md-6">
                    <div id="my_camera"></div>
                    <br/>
                    <input type=button class="btn btn-success" value="Bater Foto" onClick="take_snapshot()">
                    <input class="form-control" name="imagem" type="file" id="imagem" value="{{ isset($result->imagem) ? $result->imagem : ''}}">
                    {!! $errors->first('imagem', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-md-6">
                    <div id="results"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('imagem') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    <div class="col-10">
        <label for="imagem" class="control-label">{{ '' }}</label>
        <img class="img-fluid" id="img_upload" src="{{ isset($result->imagem) ? removePublicPath(asset($result->imagem)) : '' }}" >
    </div>
</div>

{{-- <div class="form-group row mb-5 {{ $errors->has('fornecedor_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="fornecedor_id" class="control-label">{{ 'Fornecedor' }}</label>
    </div>
    <div class="col-10">
        <select name="fornecedor_id" class="form-control" id="fornecedor_id" >
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['Fornecedor'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->fornecedor_id) && $result->fornecedor_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('fornecedor_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->razao_social }}</option>
            @endforeach
        </select>
        {!! $errors->first('fornecedor_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}

<div class="form-group row mb-5 {{ $errors->has('rg') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="rg" class="control-label">{{ 'Rg' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control rg" name="rg" type="text" id="rg" value="{{ isset($result->rg) ? $result->rg : old('rg')}}" >
        {!! $errors->first('rg', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('cpf') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cpf" class="control-label">{{ 'Cpf' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control cpf" name="cpf" type="text" id="cpf" value="{{ isset($result->cpf) ? $result->cpf : old('cpf')}}" >
        {!! $errors->first('cpf', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('data_nascimento') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="data_nascimento" class="control-label">{{ 'Data de Nascimento' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="data_nascimento" type="date" id="data_nascimento" value="{{ isset($result->data_nascimento) ? $result->data_nascimento : old('data_nascimento')}}" >
        {!! $errors->first('data_nascimento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('email') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="email" class="control-label">{{ 'Email' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ isset($result->email) ? $result->email : old('email')}}" >
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('telefone') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="telefone" class="control-label">{{ 'Telefone' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control telefone" name="telefone" type="text" id="telefone" value="{{ isset($result->telefone) ? $result->telefone : old('telefone')}}" >
        {!! $errors->first('telefone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('celular') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="celular" class="control-label">{{ 'Celular' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control celular" name="celular" type="text" id="celular" value="{{ isset($result->celular) ? $result->celular : old('celular')}}" >
        {!! $errors->first('celular', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row mb-5 {{ $errors->has('cnh') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cnh" class="control-label">{{ 'CNH' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control cnh" name="cnh" type="text" id="cnh" value="{{ isset($result->cnh) ? $result->cnh : old('cnh')}}" >
        {!! $errors->first('cnh', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('tipo_cnh_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_cnh_id" class="control-label">{{ 'Cnh Categoria' }}</label>
    </div>
    <div class="col-10">
        <select name="tipo_cnh_id" class="form-control" id="tipo_cnh_id" >
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['TipoCnh'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->tipo_cnh_id) && $result->tipo_cnh_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('tipo_cnh_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('tipo_cnh_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('cnh_primeira') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cnh_primeira" class="control-label">{{ 'Data 1ª CNH' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="cnh_primeira" type="date" id="cnh_primeira" value="{{ isset($result->cnh_primeira) ? $result->cnh_primeira : old('cnh_primeira')}}" >
        {!! $errors->first('cnh_primeira', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('cnh_validade') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cnh_validade" class="control-label">{{ 'Data de validade da CNH' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="cnh_validade" type="date" id="cnh_validade" value="{{ isset($result->cnh_validade) ? $result->cnh_validade : old('cnh_validade')}}" >
        {!! $errors->first('cnh_validade', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('cnh_emissao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cnh_emissao" class="control-label">{{ 'CNH data de Emissao' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="cnh_emissao" type="date" id="cnh_emissao" value="{{ isset($result->cnh_emissao) ? $result->cnh_emissao : old('cnh_emissao')}}" >
        {!! $errors->first('cnh_emissao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row {{ $errors->has('cnh_imagem') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="cnh_imagem" class="control-label">{{ 'Cnh Imagem' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="cnh_imagem" type="file" id="cnh_imagem" value="{{ isset($result->cnh_imagem) ? $result->cnh_imagem : ''}}" >
        {!! $errors->first('cnh_imagem', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('cnh_imagem') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    @include('parts.imagem-pdf', [
        'value' => isset($result->cnh_imagem) ? $result->cnh_imagem : null
    ])
</div>

<div class="form-group row mb-5 {{ $errors->has('avisar_antes_qtddias') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="avisar_antes_qtddias" class="control-label">{{ 'Avisar Venc. antes de' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="avisar_antes_qtddias" type="number" id="avisar_antes_qtddias" value="{{ isset($result->avisar_antes_qtddias) ? $result->avisar_antes_qtddias : old('avisar_antes_qtddias')}}" >
        {!! $errors->first('avisar_antes_qtddias', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('observacoes') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="observacoes" class="control-label">{{ 'Observacoes' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="observacoes" type="textarea" id="observacoes" >{{ isset($result->observacoes) ? $result->observacoes : old('observacoes')}}</textarea>
        {!! $errors->first('observacoes', '<p class="help-block">:message</p>') !!}
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
<script src="{{ asset('js/webcamsupport.js') }}"></script>
<script>
    let motorista_escolar = $('[name="motorista_escolar"]');

    $(function () {
        motorista_escolarFn({{ $result->motorista_escolar ?? 1 }});
    });

    function motorista_escolarFn(value){
        let hide_show_tipo_motorista = $('#hide_show_tipo_motorista');
        let hide_show_certificado_transporte_escolar = $('.hide_show_certificado_transporte_escolar');

        if (value == 0){
            hide_show_tipo_motorista.fadeIn();
            hide_show_certificado_transporte_escolar.fadeOut();
        }

        if (value == 1){
            hide_show_tipo_motorista.fadeOut();
            hide_show_certificado_transporte_escolar.fadeIn();

            $('input[type=checkbox]').each(function() {
                this.checked = false;
            });
        }
    }
</script>
@endpush
