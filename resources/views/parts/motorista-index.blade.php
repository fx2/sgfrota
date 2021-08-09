<div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Motorista</label>
<select name="motorista_id" class="form-control" id="motorista_id">
            <option value="">Selecione ...</option>
            @foreach ($selectModelFields['Motoristum'] as $optionKey => $optionValue)
                <option value="{{ $optionValue->id }}"
                    {{ (isset($result->motorista_id) && $result->motorista_id == $optionValue->id) ? 'selected' : ''}}
                    {{ old('motorista_id') == $optionValue->id ? "selected" : "" }}
                >{{ $optionValue->nome }}</option>
            @endforeach
        </select>
                                        </div>
</div>
