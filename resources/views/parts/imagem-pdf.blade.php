<div class="col-10">
    <label for="documento" class="control-label">{{ '' }}</label>
    @if (verifyImagePDF($value, '.pdf'))
        <a href="{{ removePublicPath(asset($value)) }}" target="_blank">Visualizar documento PDF</a>
    @else
        <a href="{{ removePublicPath(asset($value)) }}" target="_blank">
            <img class="img-fluid" id="{{ $id ?? ''}}" src="{{ isset($value) ? removePublicPath(asset($value)) : '' }}" alt="{{ isset($value) ? $value : '' }}" >
        </a>
    @endif
</div>