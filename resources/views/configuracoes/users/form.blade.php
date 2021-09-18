<div class="form-group row mb-5 {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="name" class="control-label">{{ 'Name' }}</label>
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
{{--<div class="form-group row mb-5 {{ $errors->has('phone') ? 'has-error' : ''}}">--}}
{{--    <div class="col-2">--}}
{{--        <label for="phone" class="control-label">{{ 'Telefone' }}</label>--}}
{{--    </div>--}}
{{--    <div class="col-10">--}}
{{--        <input class="form-control celular" name="phone" type="text" id="phone" value="{{ isset($result->phone) ? $result->phone : ''}}" >--}}
{{--        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}--}}
{{--    </div>--}}
{{--</div>--}}
<div class="form-group row mb-5 {{ $errors->has('password') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="password" class="control-label">{{ 'Password' }}</label>
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
        <input class="form-control" name="foto_perfil" type="file" id="foto_perfil" value="{{ isset($result->foto_perfil) ? removePublicPath($result->foto_perfil) : old('foto_perfil')}}" >
        {!! $errors->first('foto_perfil', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if(Request::path() != 'users/create')
    <div class="form-group row mb-5 {{ $errors->has('foto_perfil') ? 'has-error' : ''}}">
        <div class="col-2">
        </div>
            <div class="col-10">
                <label for="foto_perfil" class="control-label">{{ 'Foto Atual' }}:</label>
                <img class="img-fluid" src="{{ isset($result->foto_perfil) ? removePublicPath(asset($result->foto_perfil)) : '' }}" alt="{{ isset($result->foto_perfil) ? $result->foto_perfil : '' }}" >
            </div>
    </div>
@endif

<div class="form-group row mb-5 {{ $errors->has('perfil_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="perfil_id" class="control-label">{{ 'Perfil' }}</label>
    </div>
    <div class="col-10">
        <select name="perfil_id" class="form-control" id="perfil_id" >
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['Perfil'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->perfil_id) && $result->perfil_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('perfil_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('perfil_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('setor_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="setor_id" class="control-label">{{ 'Setor' }}</label>
    </div>
    <div class="col-10">
        <select name="setor_id" class="form-control" id="setor_id" >
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['Setor'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->setor_id) && $result->setor_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('setor_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->nome }}</option>
            @endforeach
        </select>
        {!! $errors->first('setor_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if (auth('api')->user()->type == 'master')
    <div class="form-group row mb-5 {{ $errors->has('type') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="type" class="control-label">{{ 'Tipo' }}</label>
        </div>
        <div class="col-10">
            <select name="type" class="form-control" id="type" >
                <option value="">Selecione ...</option>
                @foreach (json_decode('{"admin": "admin", "colaborador": "colaborador"}', true) as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($result->type) && $result->type == $optionKey) ? 'selected' : ''}}>{{ $optionKey }}</option>
                @endforeach
            </select>
            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
</div>
