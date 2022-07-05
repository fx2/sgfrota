@extends('layouts.pdf.pdf-padrao')

@section('content-title')
{{$pdfTitle}}
@endsection

@section('content')
<table class="table borda">
    <thead>
      <tr>
        @foreach ($titles as $item)
            <th class="borda" scope="col">{{ $item }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach ($results as $key => $item)
        <tr>
          @foreach ($fields as $key => $val)
            @if ($val == 'status')
              <td class="borda" scope="row">{{ $item->$val == 1 ? 'Ativo' : 'Bloqueado'}}</td>
            @elseif ($val == 'data')
              <td class="borda" scope="row">{{ convertTimestamp($item->data, 'd/m/Y') }}</td>
            @else

              <td class="borda tdcenter-font13" width="100%" scope="row">
                @php
                // da pra melhorar esses if e fazer um loop, mas nao quero
                  if (!empty($val[0])){
                    $a = $val[0];
                    $valor = $item->$a;

                    if ($val[0] == 'status') {
                        $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                    }
                    elseif ($val[0] == 'hora') {
                        $valor = convertTimestamp($valor, 'H:i');
                    }
                    elseif ($val[0] == 'entrada_hora') {
                        $valor = convertTimestamp($valor, 'H:i');
                    }
                    elseif ($val[0] == 'hora_multa') {
                        $valor = convertTimestamp($valor, 'H:i');
                    }
                    elseif ($val[0] == 'respondendo_horario') {
                        $valor = $valor!= null ? convertTimestamp($valor, 'H:i') . ':00': '';
                    }
                    elseif ($val[0] == 'data') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[0] == 'saida_data') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[0] == 'saida_horario') {
                        $valor = convertTimestamp($valor, 'H:i');
                    }
                    elseif ($val[0] == 'entrada_data') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[0] == 'data_nascimento') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[0] == 'data_multa') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[0] == 'previsao_saida') {
                        $valor = convertTimestamp($valor, 'd/m/Y H:i');
                    }
                    elseif ($val[0] == 'previsao_volta') {
                        $valor = convertTimestamp($valor, 'd/m/Y H:i');
                    }
                    elseif ($val[0] == 'cnh_validade') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[0] == 'respondendo_data') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[0] == 'valor') {
                        $valor = decimalGambeta($valor);
                    }
                    elseif ($val[0] == 'valor_multa') {
                        $valor = decimalGambeta($valor);
                    }
                    elseif ($val[0] == 'km_atual') {
                        $valor = decimalSimples($valor);
                    }
                    elseif ($val[0] == 'tipo_veiculo') {
                        $valor = $valor == 1 ? 'Próprio' : 'Alugado';
                    }
                    elseif ($val[0] == 'pago') {
                        $valor = $valor == 1 ? 'Sim' : 'Não';
                    }
                    elseif ($val[0] == 'prioridade') {
                        if ($valor == 1)
                            $valor = 'Alta';
                        if ($valor == 2)
                            $valor = 'Normal';
                        if ($valor == 3)
                            $valor = 'Baixa';
                    }

                  }

                  if (!empty($val[1])){
                    $a = $val[0];
                    $b = $val[1];

                    if (!isset($item->$a->$b)) {
                        continue;
                    }
                    $valor = $item->$a->$b;

                    if ($val[1] == 'status') {
                        $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                    }
                    elseif ($val[1] == 'data') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[1] == 'data_nascimento') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[1] == 'cnh_validade') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                  }

                  if (!empty($val[2])){
                    $a = $val[0];
                    $b = $val[1];
                    $c = $val[2];

                    $valor = $item->$a->$b->$c;

                    if ($val[2] == 'status') {
                        $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                    }
                    elseif ($val[2] == 'data') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[2] == 'data_nascimento') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[2] == 'cnh_validade') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                  }

                  if (!empty($val[3])){
                    $a = $val[0];
                    $b = $val[1];
                    $c = $val[2];
                    $d = $val[3];

                    $valor = $item->$a->$b->$c->$d;

                    if ($val[3] == 'status') {
                        $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                    }
                    elseif ($val[3] == 'data') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[3] == 'data_nascimento') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[3] == 'cnh_validade') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                  }

                  if (!empty($val[4])){
                    $a = $val[0];
                    $b = $val[1];
                    $c = $val[2];
                    $d = $val[3];
                    $e = $val[4];

                    $valor = $item->$a->$b->$c->$d->$e;

                    if ($val[4] == 'status') {
                        $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                    }
                    elseif ($val[4] == 'data') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[4] == 'data_nascimento') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[4] == 'cnh_validade') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                  }

                  if (!empty($val[5])){
                    $a = $val[0];
                    $b = $val[1];
                    $c = $val[2];
                    $d = $val[3];
                    $e = $val[4];
                    $f = $val[5];

                    $valor = $item->$a->$b->$c->$d->$e->$f;

                    if ($val[5] == 'status') {
                        $valor = $valor == 1 ? 'Ativo' : 'Bloqueado';
                    }
                    elseif ($val[5] == 'data') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[5] == 'data_nascimento') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                    elseif ($val[5] == 'cnh_validade') {
                        $valor = convertTimestamp($valor, 'd/m/Y');
                    }
                  }
                @endphp

                {{$valor}}
              </td>
            @endif
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
