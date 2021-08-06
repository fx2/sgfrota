<div class="form-group row mb-5 {{ $errors->has('titulo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="titulo" class="control-label">{{ 'Titulo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="titulo" type="text" id="titulo" value="{{ isset($result->titulo) ? $result->titulo : ''}}" >
        {!! $errors->first('titulo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('quem_pertence') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="quem_pertence" class="control-label">{{ 'Quem Pertence' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="quem_pertence" type="text" id="quem_pertence" value="{{ isset($result->quem_pertence) ? $result->quem_pertence : ''}}" >
        {!! $errors->first('quem_pertence', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('chave_ordem') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="chave_ordem" class="control-label">{{ 'Chave Ordem' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="chave_ordem" type="text" id="chave_ordem" value="{{ isset($result->chave_ordem) ? $result->chave_ordem : ''}}" >
        {!! $errors->first('chave_ordem', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('ordem_exibicao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="ordem_exibicao" class="control-label">{{ 'Ordem Exibicao' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="ordem_exibicao" type="text" id="ordem_exibicao" value="{{ isset($result->ordem_exibicao) ? $result->ordem_exibicao : ''}}" >
        {!! $errors->first('ordem_exibicao', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('avo') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="avo" class="control-label">{{ 'Avo' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="avo" type="text" id="avo" value="{{ isset($result->avo) ? $result->avo : ''}}" >
        {!! $errors->first('avo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('permissao_direta') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="permissao_direta" class="control-label">{{ 'Permissao Direta' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
    <label><input name="permissao_direta" type="radio" value="1" @if (isset($result)) {{ (1 == $result->permissao_direta) ? 'checked' : '' }} @else {{ 'checked' }} @endif> Ativo</label>
    <label><input name="permissao_direta" type="radio" value="0" {{ (isset($result) && 0 == $result->permissao_direta) ? 'checked' : '' }}> Bloqueado</label>
</div>
        {!! $errors->first('permissao_direta', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('pai') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="pai" class="control-label">{{ 'Pai' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="pai" type="number" id="pai" value="{{ isset($result->pai) ? $result->pai : ''}}" >
        {!! $errors->first('pai', '<p class="help-block">:message</p>') !!}
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
