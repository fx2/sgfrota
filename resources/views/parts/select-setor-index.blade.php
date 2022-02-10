@if(Auth::user()->type === 'master' OR Auth::user()->type === 'admin')
    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-1">
                <label for="setor_id" class="control-label">{{ 'Setor' }}</label>
        <div class="form-group row mb-5 {{ $errors->has('setor_id') ? 'has-error' : ''}}">
                <select name="setor_id" class="form-control inside_modal" id="setor_id" style="width: 100%;">
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
