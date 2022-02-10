<div class="col-12 col-sm-6	col-md-6 col-lg-6 col-xl-6 mb-1">
    <label for="numero_ait">Número AIT</label>
    <div class="form-group">
        <select name="numero_ait" class="form-control inside_modal" id="numero_ait"  style="width: 100%;">
            <option value="">Selecione ...</option>
        </select>
    </div>
</div>

@push('js')
<script>

    loadAit();

    async function loadAit() {
        const resp = await axios.get(`${BASE_URL}/lancamento-multas?select=numero_ait&get=true`);
        resp.data.forEach(element => {
            $("#numero_ait").append(`<option value="${element.numero_ait}">${element.numero_ait}</option>`);
        })
    }
</script>
@endpush
