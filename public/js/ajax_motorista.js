var motoristaAppend = $('#motorista_id');
var motorista_id = $(motoristaAppend).val();

$(window).on('load', function(e) {
    if (motorista_id !== '')
    loadMotorista(motorista_id)
});

$(motoristaAppend).change(function (e) { 
    loadMotorista(e.target.value)
});

async function loadMotorista(motorista_id = null){
    if (motorista_id == null)
        return true;

    $('#motorista-remove-append').remove();

    const resp = await axios.get(`${BASE_URL}/motorista?with=fornecedor,tipoCnh&where=id,=,${motorista_id}&first=true`);

    motoristaAppend.after(
        `
            <ul class="ml-3 list-unstyled" id="motorista-remove-append">
                <li><strong>Proprietário</strong>: ${resp.data.nome} </li>
                <li><strong>Fornecedor</strong>: ${resp.data.fornecedor.razao_social} </li>
                <li><strong>Tipo CNH</strong>: ${resp.data.tipo_cnh.nome}</li>
                <li><strong>CNH</strong>: ${resp.data.cnh}</li>
                <li><strong>Validade da CNH</strong>: ${moment(resp.data.cnh_validade).format('DD/MM/YYYY')}</li>
                <li><strong>RG</strong>: ${resp.data.rg}</li>
                <li><strong>CPF</strong>: ${resp.data.cpf}</li>
            </ul>
        `
    );
}