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

    const resp = await axios.get(`${BASE_URL}/motorista?with=fornecedor,tipoCnh,setor&where=id,=,${motorista_id}&first=true`);

    validade = cnhAvisarAntesXdias(resp.data);

    motoristaAppend.after(
        `
            <ul class="ml-3 list-unstyled" id="motorista-remove-append">
                <li><strong>Tipo CNH</strong>: ${resp.data.tipo_cnh.nome}</li>
                <li><strong>CNH</strong>: ${resp.data.cnh}</li>
            </ul>
        `
    );

    // <li><strong>Setor</strong>: ${resp.data.setor.nome}</li>
    // <li ${validade ? 'style="color: red;"' : ''}><strong>Validade da CNH</strong>: ${moment(resp.data.cnh_validade).format('DD/MM/YYYY')}</li>
    //             <li><strong>RG</strong>: ${resp.data.rg}</li>
    //             <li><strong>CPF</strong>: ${resp.data.cpf}</li>
}


function cnhAvisarAntesXdias(dateInfo){
    let dateSub = moment(dateInfo.cnh_validade).subtract(dateInfo.avisar_antes_qtddias, "days").format("YYYY-MM-DD")
    let compareDate = moment(moment().format("YYYY-MM-DD"), "YYYY-MM-DD");
    let startDate   = moment(dateSub, "YYYY-MM-DD");
    let endDate     = moment(dateInfo.cnh_validade, "YYYY-MM-DD");


    // console.log('cnh validade', moment(dateInfo.cnh_validade).format("YYYY-MM-DD"));
    // console.log('qtd dias', dateInfo.avisar_antes_qtddias);
    // console.log('avisar antes', moment(dateInfo.cnh_validade).subtract(dateInfo.avisar_antes_qtddias, "days").format("YYYY-MM-DD"));
    // console.log('hoje', moment().format("YYYY-MM-DD"))
    // console.log('compare', compareDate.isBetween(startDate, endDate));
    // console.log('igualcomeco', moment(compareDate).isSame(startDate));
    // console.log('igualfinal', moment(compareDate).isSame(endDate));
    //
    // console.log('---------------------------------')

    compare = compareDate.isBetween(startDate, endDate);
    igualcomeco = moment(compareDate).isSame(startDate);
    igualfinal = moment(compareDate).isSame(endDate);
    compareAfter = moment(compareDate).isAfter(endDate);

    if (compare)
        return true;

    if (igualcomeco)
        return true;

    if (igualfinal)
        return true;

    if (compareAfter)
        return true;

    return false;

}
