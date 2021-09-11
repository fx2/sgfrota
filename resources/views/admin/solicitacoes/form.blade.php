<div class="form-group row mb-5 {{ $errors->has('sequencia') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="sequencia" class="control-label">{{ 'Sequencia' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="sequencia" type="text" id="sequencia" value="{{ isset($result->sequencia) ? $result->sequencia : ''}}" >
        {!! $errors->first('sequencia', '<p class="help-block">:message</p>') !!}
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
<div class="form-group row mb-5 {{ $errors->has('horario') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="horario" class="control-label">{{ 'Horario' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="horario" type="time" id="horario" value="{{ isset($result->horario) ? $result->horario : old('horario')}}" >
        {!! $errors->first('horario', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('prioridade') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="prioridade" class="control-label">{{ 'Prioridade' }}</label>
    </div>
    <div class="col-10">
        <select name="prioridade" class="form-control" id="prioridade" >
            <option value="">Selecione ...</option>
            <option value="1" {{ (isset($result->prioridade) && $result->prioridade == 1) ? 'selected' : ''}} {{ old('prioridade') == 1 ? "selected" : "" }}>Alta</option>
            <option value="2" {{ (isset($result->prioridade) && $result->prioridade == 2) ? 'selected' : ''}} {{ old('prioridade') == 2 ? "selected" : "" }}>Normal</option>
            <option value="3" {{ (isset($result->prioridade) && $result->prioridade == 3) ? 'selected' : ''}} {{ old('prioridade') == 3 ? "selected" : "" }}>Baixa</option>    
        </select>
        {!! $errors->first('prioridade', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('solicitacao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="solicitacao" class="control-label">{{ 'Solicitacao' }}</label>
    </div>
    <div class="col-10">
        <select name="solicitacao" class="form-control" id="solicitacao" >
    <option value="">Selecione ...</option>
    {{-- @foreach ($selectModelFields[] as $optionKey => $optionValue)
        <option value="{{ $optionValue->id }}" 
            {{ (isset($result->solicitacao) && $result->solicitacao == $optionValue->id) ? 'selected' : ''}}
            {{ old('solicitacao') == $optionValue->id ? "selected" : "" }} 
        >{{ $optionValue }}</option>
    @endforeach --}}
</select>
        {!! $errors->first('solicitacao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('numero_oficio') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="numero_oficio" class="control-label">{{ 'Numero Oficio' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="numero_oficio" type="text" id="numero_oficio" value="{{ isset($result->numero_oficio) ? $result->numero_oficio : ''}}" >
        {!! $errors->first('numero_oficio', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('descricao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="descricao" class="control-label">{{ 'Descricao' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="descricao" type="textarea" id="descricao" >{{ isset($result->descricao) ? $result->descricao : old('descricao')}}</textarea>
        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('documento') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="documento" class="control-label">{{ 'Documento' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="documento" type="text" id="documento" value="{{ isset($result->documento) ? $result->documento : ''}}" >
        {!! $errors->first('documento', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('respondendo_descricao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="respondendo_descricao" class="control-label">{{ 'Respondendo Descricao' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="respondendo_descricao" type="textarea" id="respondendo_descricao" >{{ isset($result->respondendo_descricao) ? $result->respondendo_descricao : old('respondendo_descricao')}}</textarea>
        {!! $errors->first('respondendo_descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{-- <div class="form-group row mb-5 {{ $errors->has('respondendo_user_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="respondendo_user_id" class="control-label">{{ 'Respondendo User Id' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="respondendo_user_id" type="number" id="respondendo_user_id" value="{{ isset($result->respondendo_user_id) ? $result->respondendo_user_id : ''}}" >
        {!! $errors->first('respondendo_user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}
<div class="form-group row mb-5 {{ $errors->has('respondendo_data') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="respondendo_data" class="control-label">{{ 'Respondendo Data' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="respondendo_data" type="date" id="respondendo_data" value="{{ isset($result->respondendo_data) ? $result->respondendo_data : ''}}" >
        {!! $errors->first('respondendo_data', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('respondendo_horario') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="respondendo_horario" class="control-label">{{ 'Respondendo Horario' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="respondendo_horario" type="time" id="respondendo_horario" value="{{ isset($result->respondendo_horario) ? $result->respondendo_horario : old('respondendo_horario')}}" >
        {!! $errors->first('respondendo_horario', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('respondendo_documento') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="respondendo_documento" class="control-label">{{ 'Respondendo Documento' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="respondendo_documento" type="text" id="respondendo_documento" value="{{ isset($result->respondendo_documento) ? $result->respondendo_documento : ''}}" >
        {!! $errors->first('respondendo_documento', '<p class="help-block">:message</p>') !!}
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
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
</div>
