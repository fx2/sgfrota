$(".btnUpdate").click(function () {
    _this = this;
    swal.fire({
        title: 'Atenção?',
        text: "Deseja remover este item da lista?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não',
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + $(_this).attr('data-route') + '/' + $(_this).attr('data-id'),
                type: 'POST',
                data: { '_method': 'DELETE' },
                dataType: 'JSON',
                success: function (result) {
                    if (result == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Removido(a) com sucesso',
                            showConfirmButton: false,
                            timer: 1000
                          })

                        $(_this).closest('tr').remove();
                    }
                    else {
                        swal.fire({
                            title: "Erro ao remover",
                            icon: "error"
                        });
                    }
                },
                error: function (result) {
                    swal.fire({
                        title: "Erro remover",
                        text: result.responseJSON,
                        icon: "error"
                    });
                }
            });
        }
    });
});


$(".btnDeletar").click(function () {
    _this = this;
    swal.fire({
        title: 'Atenção?',
        text: "Deseja remover este item da lista?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim!',
        cancelButtonText: 'Não',
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + $(_this).attr('data-route') + '/' + $(_this).attr('data-id'),
                type: 'POST',
                data: { '_method': 'DELETE' },
                dataType: 'JSON',
                success: function (result) {
                    if (result == 1) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Removido(a) com sucesso',
                            showConfirmButton: false,
                            timer: 1000
                          })

                        $(_this).closest('tr').remove();
                    }
                    else {
                        swal.fire({
                            title: "Erro ao remover",
                            icon: "error"
                        });
                    }
                },
                error: function (result) {
                    swal.fire({
                        title: "Erro remover",
                        text: result.responseJSON.message,
                        icon: "error"
                    });
                }
            });
        }
    });
});
