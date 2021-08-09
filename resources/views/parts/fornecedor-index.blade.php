
                                    <div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Fornecedor</label>
                                            <select name="fornecedor_id" class="form-control" id="fornecedor_id" onchange="loadFornecedor(this.value)">
                                                <option value="">Selecione ...</option>
                                                @foreach ($selectModelFields['Fornecedor'] as $optionKey => $optionValue)
                                                    <option value="{{ $optionValue->id }}"
                                                        {{ (isset($result->fornecedor_id) && $result->fornecedor_id == $optionValue->id) ? 'selected' : ''}}
                                                        {{ old('fornecedor_id') == $optionValue->id ? "selected" : "" }}
                                                    >{{ $optionValue->razao_social }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
