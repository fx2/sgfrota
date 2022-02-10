<div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-1">
                                            <label for="exampleFormControlInput1">Veículo</label>
                                        <div class="form-group">
                                            <select name="controle_frota_id" class="form-control inside_modal" id="controle_frota_id"  style="width: 100%;">
                                                <option value="">Selecione ...</option>
                                                @foreach ($selectModelFields['ControleFrotum'] as $optionKey => $optionValue)
                                                    <option value="{{ $optionValue->id }}"
                                                        {{ (isset($result->controle_frota_id) && $result->controle_frota_id == $optionValue->id) ? 'selected' : ''}}
                                                    >{{ $optionValue->veiculo }} - {{ $optionValue->placa }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
