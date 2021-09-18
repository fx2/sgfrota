loadSolicitacoesAlerta()

async function loadSolicitacoesAlerta() {
    if (user.type == 'master' || user.type == 'admin'){
        const resp = await axios.get(`${BASE_URL}/solicitacoes?where=etapa,=,1&first=true`);
        if (resp.data){
            $('#solicitacoesSino').append('<span style="font-size: 1em; color: Tomato;"><i class="fas fa-exclamation"></i></span>')
        }
    }
}