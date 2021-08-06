<div class="form-group row mb-5 {{ $errors->has('email') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="name" class="control-label">{{ 'Nome' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ isset($result->name) ? $result->name : ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('email') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="email" class="control-label">{{ 'Email' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="email" type="text" id="email" value="{{ isset($result->email) ? $result->email : ''}}" >
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group row mb-5 {{ $errors->has('password') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="password" class="control-label">{{ 'Senha    ' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="password" type="password" id="password">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group row mb-5 {{ $errors->has('foto_perfil') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="foto_perfil" class="control-label">{{ 'Foto de Perfil' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="foto_perfil" type="file" id="foto_perfil" value="{{ isset($result->foto_perfil) ? $result->foto_perfil : old('foto_perfil')}}" >
        {!! $errors->first('foto_perfil', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('foto_perfil') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    <div class="col-10">
        <label for="foto_perfil" class="control-label">{{ 'Foto Atual' }}</label>
        <img class="img-fluid" src="{{ isset($result->foto_perfil) ? removePublicPath(asset($result->foto_perfil)) : '' }}" alt="{{ isset($result->foto_perfil) ? $result->foto_perfil : '' }}" >
    </div>
</div>

<div class="form-group">
    <a href="{{ url()->previous() }}" title="Voltar" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
</div>
