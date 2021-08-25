<div class="form-group row mb-5 {{ $errors->has('log_name') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="log_name" class="control-label">{{ 'Log Name' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="log_name" type="text" id="log_name" value="{{ isset($result->log_name) ? $result->log_name : ''}}" >
        {!! $errors->first('log_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('description') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="description" class="control-label">{{ 'Description' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($result->description) ? $result->description : old('description')}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('subject_type') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="subject_type" class="control-label">{{ 'Subject Type' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="subject_type" type="text" id="subject_type" value="{{ isset($result->subject_type) ? $result->subject_type : ''}}" >
        {!! $errors->first('subject_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('event') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="event" class="control-label">{{ 'Event' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="event" type="text" id="event" value="{{ isset($result->event) ? $result->event : ''}}" >
        {!! $errors->first('event', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('subject_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="subject_id" class="control-label">{{ 'Subject Id' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="subject_id" type="number" id="subject_id" value="{{ isset($result->subject_id) ? $result->subject_id : ''}}" >
        {!! $errors->first('subject_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('causer_type') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="causer_type" class="control-label">{{ 'Causer Type' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="causer_type" type="text" id="causer_type" value="{{ isset($result->causer_type) ? $result->causer_type : ''}}" >
        {!! $errors->first('causer_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('causer_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="causer_id" class="control-label">{{ 'Causer Id' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="causer_id" type="number" id="causer_id" value="{{ isset($result->causer_id) ? $result->causer_id : ''}}" >
        {!! $errors->first('causer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('properties') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="properties" class="control-label">{{ 'Properties' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="properties" type="textarea" id="properties" >{{ isset($result->properties) ? $result->properties : old('properties')}}</textarea>
        {!! $errors->first('properties', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('batch_uuid') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="batch_uuid" class="control-label">{{ 'Batch Uuid' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="batch_uuid" type="text" id="batch_uuid" value="{{ isset($result->batch_uuid) ? $result->batch_uuid : ''}}" >
        {!! $errors->first('batch_uuid', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('setor_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="setor_id" class="control-label">{{ 'Setor Id' }}</label>
    </div>
    <div class="col-10">
        <select name="setor_id" class="form-control" id="setor_id" >
    <option value="">Selecione ...</option>
    @foreach ($selectModelFields[] as $optionKey => $optionValue)
        <option value="{{ $optionValue->id }}"
            {{ (isset($result->setor_id) && $result->setor_id == $optionValue->id) ? 'selected' : ''}}
            {{ old('setor_id') == $optionValue->id ? "selected" : "" }}
        >{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('setor_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('setor') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="setor" class="control-label">{{ 'Setor' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="setor" type="text" id="setor" value="{{ isset($result->setor) ? $result->setor : ''}}" >
        {!! $errors->first('setor', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('nome') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome" class="control-label">{{ 'Nome' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ isset($result->nome) ? $result->nome : ''}}" >
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
</div>
