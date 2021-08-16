@if(Auth::user()->type === 'master' OR Auth::user()->type === 'admin')
    <div class="form-group row mb-5 {{ $errors->has('setor_id') ? 'has-error' : ''}}">
        <div class="col-2">
            <label for="setor_id" class="control-label">{{ 'Setor' }}</label>
        </div>
        <div class="col-10">
            <select name="setor_id" class="form-control" id="setor_id" required>
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
@endif
