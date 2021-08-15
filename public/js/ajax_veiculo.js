var veiculoAppend = $('#controle_frota_id');
var veiculo_id = $(veiculoAppend).val();
var veiculoClassAppend = $('.controle_frota_class');

$(window).on('load', function(e) {
    if (veiculo_id !== '')
        loadControleFrotum(veiculo_id)
});

$(veiculoAppend).change(function (e) {
    loadControleFrotum(e.target.value)
});

async function loadControleFrotum(controle_frota_id = null){
    if (controle_frota_id == null)
        return true;

    $('#veiculo-remove-append').remove();

    const resp = await axios.get(`${BASE_URL}/controle-frota?with=tipo_veiculoHasOne,tipo_combustivel,marca,modelo,setor,responsavel&where=id,=,${controle_frota_id}&first=true`);

    let proprietario = resp.data.tipo_veiculo == 1 ? 'Veículo próprio' : resp.data.nome_proprietario;

    veiculoAppend.after(
        `
            <ul class="ml-3 list-unstyled" id="veiculo-remove-append">
                <li><strong>Proprietário</strong>: ${proprietario} </li>
                <li><strong>Marca</strong>: ${resp.data.marca.nome} </li>
                <li><strong>Modelo</strong>: ${resp.data.modelo.modelo}</li>
                <li><strong>Tipo de combustível</strong>: ${resp.data.tipo_combustivel.nome}</li>
                <li><strong>Cor</strong>: ${resp.data.cor}</li>
                <li><strong>Capacidade</strong>: ${resp.data.capacidade}</li>
                <li><strong>Ano</strong>: ${resp.data.ano_modelo}</li>
                <li><strong>Km inicial</strong>: ${parseFloat(resp.data.km_inicial)}</li>
                <li><strong>Placa</strong>: ${resp.data.placa}</li>
                <li><strong>Renavan</strong>: ${resp.data.renavan}</li>
                <li><strong>Responsavel</strong>: ${resp.data.responsavel.nome}</li>
                <li><strong>Setor</strong>: ${resp.data.setor.nome}</li>
            </ul>
        `
    );

    str = resp.data.km_atual !== null ? resp.data.km_atual : resp.data.km_inicial;
    str = str.substring(0, str.length-5);
    $('.km_atual').val(str);
}

async function loadControleFrotumClass(controle_frota_id = null){
    if (controle_frota_id == null)
        return true;

    $('.veiculo-remove-append').remove();

    const resp = await axios.get(`${BASE_URL}/controle-frota?with=tipo_veiculoHasOne,tipo_combustivel,marca,modelo&where=id,=,${controle_frota_id}&first=true`);

    let proprietario = resp.data.tipo_veiculo == 1 ? 'Veículo próprio' : resp.data.nome_proprietario;

    veiculoClassAppend.after(
        `
            <ul class="ml-3 list-unstyled veiculo-remove-append">
                <li><strong>Proprietário</strong>: ${proprietario} </li>
                <li><strong>Marca</strong>: ${resp.data.marca.nome} </li>
                <li><strong>Modelo</strong>: ${resp.data.modelo.modelo}</li>
                <li><strong>Veículo</strong>: ${resp.data.veiculo}</li>
                <li><strong>Tipo de veículo</strong>: ${resp.data.tipo_veiculo_has_one.nome}</li>
                <li><strong>Tipo de combustível</strong>: ${resp.data.tipo_combustivel.nome}</li>
                <li><strong>Cor</strong>: ${resp.data.cor}</li>
                <li><strong>Capacidade</strong>: ${resp.data.capacidade}</li>
                <li><strong>Ano</strong>: ${resp.data.ano_modelo}</li>
                <li><strong>Km inicial</strong>: ${parseFloat(resp.data.km_inicial)}</li>
                <li><strong>Placa</strong>: ${resp.data.placa}</li>
                <li><strong>Renavan</strong>: ${resp.data.renavan}</li>
            </ul>
        `
    );
}
