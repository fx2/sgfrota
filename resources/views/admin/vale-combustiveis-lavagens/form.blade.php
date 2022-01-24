<div class="form-group row mb-5 {{ $errors->has('controle_frota_id') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="controle_frota_id" class="control-label">{{ 'Veículo' }}</label>
    </div>
    <div class="col-10">
        <select name="controle_frota_id" class="form-control" id="controle_frota_id"
{{--            @if ($formMode != 'create')--}}
{{--                disabled--}}
{{--            @endif--}}
        >
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


<div class="form-group row mb-5 {{ $errors->has('tipo_vale') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="tipo_vale" class="control-label">{{ 'Tipo de Vale' }}</label>
    </div>
    <div class="col-10">
        <div class="radio">
            <label><input name="tipo_vale" type="radio" value="Abastecimento" onclick="tipo_valeFn('Abastecimento')" @if (isset($result)) {{ ('Abastecimento' == $result->tipo_vale) ? 'checked' : '' }} @else {{ 'checked' }} @endif
{{--                @if ($formMode != 'create')--}}
{{--                    disabled--}}
{{--                @endif    --}}
            > Abastecimento</label>
            <label><input name="tipo_vale" type="radio" value="Lavagem" onclick="tipo_valeFn('Lavagem')" {{ (isset($result) && 'Lavagem' == $result->tipo_vale) ? 'checked' : '' }}
{{--                @if ($formMode != 'create')--}}
{{--                    disabled--}}
{{--                @endif  --}}
            > Lavagem</label>
        </div>
        {!! $errors->first('tipo_vale', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="hide_show_lavagem">
    <div class="form-group row mb-5 {{ $errors->has('quantidade_litros') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="quantidade_litros" class="control-label">{{ 'Quantidade Litros' }}</label>
        </div>
        <div class="col-10">
            <input class="form-control decimal" name="quantidade_litros" type="text" id="quantidade_litros" value="{{ isset($result->quantidade_litros) ? $result->quantidade_litros : ''}}"
{{--                @if (isset($result->quantidade_litros) && $result->quantidade_litros !== '')--}}
{{--                    readonly--}}
{{--                @endif--}}
            >
            {!! $errors->first('quantidade_litros', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group row mb-5 {{ $errors->has('tipo_combustivel_id') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="tipo_combustivel_id" class="control-label">{{ 'Tipo Combustivel' }}</label>
        </div>
        <div class="col-10">
            <select name="tipo_combustivel_id" class="form-control" id="tipo_combustivel_id"
{{--                @if ($formMode != 'create')--}}
{{--                    disabled--}}
{{--                @endif --}}
            >
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
</div>

<div class="form-group row mb-5 {{ $errors->has('data') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="data" class="control-label">{{ 'Data' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="data" type="date" id="data" value="{{ isset($result->data) ? $result->data : ''}}"
{{--            @if ($formMode != 'create')--}}
{{--                readonly--}}
{{--            @endif --}}
        >
        {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('hour') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="hour" class="control-label">{{ 'Hour' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="hour" type="time" id="hour" value="{{ isset($result->hour) ? $result->hour : old('hour')}}"
{{--            @if ($formMode != 'create')--}}
{{--                readonly--}}
{{--            @endif --}}
        >
        {!! $errors->first('hour', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('nome_responsavel') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="nome_responsavel" class="control-label">{{ 'Nome Responsavel' }}</label>
    </div>
    <div class="col-10">
        <input class="form-control" name="nome_responsavel" type="text" id="nome_responsavel" value="{{ isset($result->nome_responsavel) ? $result->nome_responsavel : ''}}"
{{--            @if ($formMode != 'create')--}}
{{--                readonly--}}
{{--            @endif --}}
        >
        {!! $errors->first('nome_responsavel', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group row mb-5 {{ $errors->has('observacao') ? 'has-error' : ''}}">
    <div class="col-2">
        <label for="observacao" class="control-label">{{ 'Observacao' }}</label>
    </div>
    <div class="col-10">
        <textarea class="form-control" rows="5" name="observacao" type="textarea" id="observacao"
{{--            @if ($formMode != 'create')--}}
{{--                readonly--}}
{{--            @endif --}}
        >{{ isset($result->observacao) ? $result->observacao : old('observacao')}}</textarea>
        {!! $errors->first('observacao', '<p class="help-block">:message</p>') !!}
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
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Editar' : 'Cadastar' }}">
</div>

@push('js')
    <script src="{{ asset('js/ajax_veiculoTemporario.js') }}"></script>
    <script>
        const hide_show_lavagem = $('#hide_show_lavagem');
        const quantidade_litros = $('#quantidade_litros');
        const tipo_combustivel_id = $('#tipo_combustivel_id');

        $(function () {
            tipo_valeFn("{{ $result->tipo_vale ?? 'Abastecimento' }}")
        });

        function tipo_valeFn(value){
            if (value == 'Abastecimento'){
                hide_show_lavagem.fadeIn();

                return true;
            }

            hide_show_lavagem.fadeOut();
            quantidade_litros.val(null);
            tipo_combustivel_id.empty().append( // TODO: arrumar isso kkkk
                `<option value="5"></option>
                <option value="1">Flex</option>
                <option value="2">Etanol</option>
                <option value="3">Gasolina</option>
                <option value="4">Diesel</option>`
            );
        }
    </script>
@endpush
