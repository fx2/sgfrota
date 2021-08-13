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
            <td class="borda tdcenter-font13" scope="row">
                {{convertTimestamp($item->entrada_data, 'd/m/Y')}}
            </td>
            <td class="borda tdcenter-font13" scope="row">
                {{convertTimestamp($item->entrada_hora, 'H:i')}}
            </td>
            <td class="borda tdcenter-font13" scope="row">
                {{$item->km_final}}
            </td>
            <td class="borda tdcenter-font13" scope="row">
                {{$item->motorista->nome}}
            </td>
            <td class="borda tdcenter-font13" scope="row">
                {{$item->controle_frota->placa}}
            </td>
            <td class="borda tdcenter-font13" scope="row">
                {{$item->setor->nome}}
            </td>
            <td class="borda tdcenter-font13" scope="row">
                {{$item->nome_responsavel}}
            </td>
            <td class="borda tdcenter-font13"  scope="row">
                {{$item->relatorio_trajeto_motorista}}
            </td>
            <td class="borda tdcenter-font13"  scope="row">
                {{ convertTimestamp($item->veiculo_saida->saida_data, 'd/m/Y') }}
            </td>
            <td class="borda tdcenter-font13"  scope="row">
                {{ convertTimestamp($item->veiculo_saida->saida_hora, 'H:i')}}
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
