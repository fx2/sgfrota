<div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-1">
    <label for="tipo_manutencao_id">Manutenção/Despesas</label>
    <div class="form-group">
        <select name="tipo_manutencao_id" class="form-control inside_modal" id="tipo_manutencao_id" style="width: 100%;">
            <option value="">Selecione ...</option>
        </select>
    </div>
</div>

@push('js')
<script>

    loadAit();

    async function loadAit() {
        const resp = await axios.get(`${BASE_URL}/tipo-manutencao?select=id,nome&get=true`);
        resp.data.forEach(element => {
            $("#tipo_manutencao_id").append(`<option value="${element.id}">${element.nome}</option>`);
        })
    }
</script>
@endpush
