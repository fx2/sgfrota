@if (isset($result->auth_id))
    <div class="form-group row mb-5 {{ $errors->has('auth_id') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="auth_id" class="control-label">{{ 'Solicitante' }}</label>
        </div>
        <div class="col-10">
            <strong>{{ isset($result->auth_id) ? $result->userAuth->name : ''}}</strong>
        </div>
    </div>
@endif

<div class="form-group row mb-5 {{ $errors->has('prioridade') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="prioridade" class="control-label">{{ 'Prioridade' }}</label>
    </div>
    <div class="col-10">
        <select name="prioridade" class="form-control" id="prioridade" 
            @if (isset($result->auth_id) && $result->auth_id != auth('api')->user()->id) disabled @endif
            @if (isset($result->auth_id) && $result->respondendo_descricao != null) disabled @endif>
            <option value="">Selecione ...</option>
            <option value="1" {{ (isset($result->prioridade) && $result->prioridade == 1) ? 'selected' : ''}} {{ old('prioridade') == 1 ? "selected" : "" }}>Alta</option>
            <option value="2" {{ (isset($result->prioridade) && $result->prioridade == 2) ? 'selected' : ''}} {{ old('prioridade') == 2 ? "selected" : "" }}>Normal</option>
            <option value="3" {{ (isset($result->prioridade) && $result->prioridade == 3) ? 'selected' : ''}} {{ old('prioridade') == 3 ? "selected" : "" }}>Baixa</option>    
        </select>
        {!! $errors->first('prioridade', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('solicitacao_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="solicitacao_id" class="control-label">{{ 'Solicitação' }}</label>
    </div>
    <div class="col-10">
        <select name="solicitacao_id" class="form-control" id="solicitacao_id" 
            @if (isset($result->auth_id) && $result->auth_id != auth('api')->user()->id) disabled @endif
            @if (isset($result->auth_id) && $result->respondendo_descricao != null) disabled @endif>
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['tipoSolicitacao'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}" 
                    {{ (isset($result->solicitacao_id) && $result->solicitacao_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('solicitacao_id') == $optionValue->id ? "selected" : "" }} 
                >{{ $optionValue->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('solicitacao_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('numero_oficio') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="numero_oficio" class="control-label">{{ 'Número Oficio' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="numero_oficio" type="text" id="numero_oficio" value="{{ isset($result->numero_oficio) ? $result->numero_oficio : ''}}" 
            @if (isset($result->auth_id) && $result->auth_id != auth('api')->user()->id) disabled @endif
            @if (isset($result->auth_id) && $result->respondendo_descricao != null) disabled @endif>
        {!! $errors->first('numero_oficio', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="descricao" class="control-label">{{ 'Descrição' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="descricao" type="textarea" id="descricao" 
            @if (isset($result->auth_id) && $result->auth_id != auth('api')->user()->id) disabled @endif
            @if (isset($result->auth_id) && $result->respondendo_descricao != null) disabled @endif>{{ isset($result->descricao) ? $result->descricao : old('descricao')}}</textarea>
        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row {{ $errors->has('documento') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="documento" class="control-label">{{ 'Anexar documento' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="documento" type="file" id="documento" value="{{ isset($result->documento) ? $result->documento : ''}}" 
            @if (isset($result->auth_id) && $result->auth_id != auth('api')->user()->id) disabled @endif
            @if (isset($result->auth_id) && $result->respondendo_descricao != null) disabled @endif>
        {!! $errors->first('documento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('documento') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    @include('parts.imagem-pdf', ['value' => isset($result->documento) ? $result->documento : null])
</div>


@if ($formMode != 'create' && ($result->auth_id !=  auth('api')->user()->id || $result->respondendo_descricao != null))

    <div class="form-group row mb-5 {{ $errors->has('respondendo_descricao') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="respondendo_descricao" class="control-label">{{ 'Resposta a Solicitação' }}</label>
        </div>
        <div class="col-10">
            <textarea class="form-control" required rows="5" name="respondendo_descricao" type="textarea" id="respondendo_descricao" @if (isset($result->respondendo_auth_id) && $result->respondendo_auth_id != auth('api')->user()->id) disabled @endif>{{ isset($result->respondendo_descricao) ? $result->respondendo_descricao : old('respondendo_descricao')}}</textarea>
            {!! $errors->first('respondendo_descricao', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    {{-- <div class="form-group row mb-5 {{ $errors->has('respondendo_data') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="respondendo_data" class="control-label">{{ 'Data' }}</label>
        </div>
        <div class="col-10">
            <input class="form-control" name="respondendo_data" type="date" id="respondendo_data" value="{{ isset($result->respondendo_data) ? $result->respondendo_data : ''}}" @if (isset($result->respondendo_data)) disabled @endif>
            {!! $errors->first('respondendo_data', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row mb-5 {{ $errors->has('respondendo_horario') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="respondendo_horario" class="control-label">{{ 'Horário' }}</label>
        </div>
        <div class="col-10">
            <input class="form-control" name="respondendo_horario" type="time" id="respondendo_horario" value="{{ isset($result->respondendo_horario) ? $result->respondendo_horario : old('respondendo_horario')}}" @if (isset($result->respondendo_horario)) disabled @endif>
            {!! $errors->first('respondendo_horario', '<p class="help-block">:message</p>') !!}
        </div>
    </div> --}}

    <div class="form-group row {{ $errors->has('respondendo_documento') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="respondendo_documento" class="control-label">{{ 'Anexar Documento' }}</label>
        </div>
        <div class="col-10">
            <input class="form-control" name="respondendo_documento" type="file" id="respondendo_documento" value="{{ isset($result->respondendo_documento) ? $result->respondendo_documento : ''}}" @if (isset($result->respondendo_auth_id) && $result->respondendo_auth_id != auth('api')->user()->id) disabled @endif>
            {!! $errors->first('respondendo_documento', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group row mb-5 {{ $errors->has('respondendo_documento') ? 'has-error' : ''}}">
        <div class="col-2">
        </div>
        @include('parts.imagem-pdf', ['value' => isset($result->respondendo_documento) ? $result->respondendo_documento : null])
    </div>

    @if (isset($result->respondendo_auth_id))
        <div class="form-group row mb-5 {{ $errors->has('respondendo_auth_id') ? 'has-error' : ''}}">
            <div class="col-2">
                <label for="respondendo_auth_id" class="control-label">{{ 'Respondido por' }}</label>
            </div>
            <div class="col-10">
                <strong>{{ isset($result->respondendo_auth_id) ? $result->userAuthRespondido->name : ''}}</strong>
            </div>
        </div>
    @endif



    {{-- <div class="form-group row mb-5 {{ $errors->has('status') ? 'has-error' : ''}}">
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
    </div> --}}
@endif

@include('parts/select-setor')


<div class="form-group">
    <a href="{{ url()->previous() }}" title="Voltar" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
    
    @if (!isset($result))
        <input class="btn btn-primary" type="submit" value="Cadastar">
    @elseif (isset($result->respondendo_auth_id) && $result->auth_id == auth('api')->user()->id)
        {{-- <input class="btn btn-primary" type="submit" value="Finalizar"> --}}
    @else
        <input class="btn btn-primary" type="submit" value="Editar">
    @endif
</div>
