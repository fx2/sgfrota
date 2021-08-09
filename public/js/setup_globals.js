$(document).ready(function() {
    $('select').addClass('select2');

    $('.select2').select2({
        // multiple:false
        width: '100%',
        placeholder: "Selecione...",
        selectOnClose: true
    })

    // $("select").each(function (index, element) {
    //     const val = $(this).data('value');
    //     if(val !== '') {
    //         $(this).val(val);
    //     }
    // });

    $('.data').mask('99/99/9999');
    $('.ano').mask('9999');
    $('.celular').mask('(99) 9999-99999');
    $('.cep').mask('99999-999');
    $('.cnpj').mask('99.999.999/9999-99');
    $('.rg').mask('99.999.999-9');
    $('.cpf').mask('999.999.999-99');
    $('.telefone').mask('(99) 9999-9999');
    $('.celular').mask('(99) 99999-9999');
    $('.cnh').mask('99999999999');
    $('.decimal').on("keyup",function(){
       $('.decimal').mask("###.###.###.###", {reverse: true, maxlength: false});
    });

    $('.money').mask('000.000.000.000.000,00', {reverse: true});

    if ($('.hide-thead').length) {
        $('.thead-hide').hide()
    }

    $('.export-pdf').click(function (e) {
        $('[name="export_pdf"]').val(true);
    });

    $('.without-pdf').click(function (e) {
        $('[name="export_pdf"]').val(false);
    });
});
