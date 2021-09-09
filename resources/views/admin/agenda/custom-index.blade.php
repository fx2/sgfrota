@extends('layouts.admin.index')

<link rel="stylesheet" href="{{ asset('adminlte/plugins/fullcalendar/main.min.css') }}">

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb back-transparente">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('agenda') }}">Agenda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Agenda</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <div class="">Agenda</div>
{{--            <div class="">--}}
{{--              <form method="GET" action="{{ url('/agenda') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">--}}
{{--                <input type="hidden" class="form-control" name="export_pdf" placeholder="Buscar...">--}}
{{--                <button class="ml-3 btn btn-secondary export-pdf" type="submit">--}}
{{--                    <i class="fas fa-file-pdf"></i>--}}
{{--                </button>--}}
{{--              </form>--}}
{{--            </div>--}}
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-1 d-none">
              <div class="sticky-top mb-3">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Draggable Events</h4>
                  </div>
                  <div class="card-body">
                    <!-- the events -->
                    <div id="external-events">
                      <div class="external-event bg-success">Manhã</div>
                      <div class="external-event bg-warning">Tarde</div>
                      <div class="external-event bg-info">Integral</div>
                      <div class="checkbox d-none">
                        <label for="drop-remove">
                          <input type="checkbox" id="drop-remove">
                          remove after drop
                        </label>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Create Event</h3>
                  </div>
                  <div class="card-body">
                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                      <ul class="fc-color-picker" id="color-chooser">
                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                      </ul>
                    </div>
                    <!-- /btn-group -->
                    <div class="input-group">
                      <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                      <div class="input-group-append">
                        <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                      </div>
                      <!-- /btn-group -->
                    </div>
                    <!-- /input-group -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-10 offset-md-1">
              <div class="card card-primary">
                <div class="card-body p-0">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
        </div>
    </div>

    <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agendamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div class="p-2 bd-highlight">Título:</div>
                                <div class="p-2 bd-highlight" id="title"></div>
                                <div class="p-2 bd-highlight"></div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div class="p-2 bd-highlight">Descrição</div>
                                <div class="p-2 bd-highlight" id="descricaoshow"></div>
                                <div class="p-2 bd-highlight"></div>
                            </div>
                        </li>


                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div class="p-2 bd-highlight">Horário:</div>
                                <div class="p-2 bd-highlight" id="horarioshow"></div>
                                <div class="p-2 bd-highlight"></div>
                            </div>
                        </li>
                    </ul>
                </div>

                <input type="hidden" name="fkas_id" id="fkas_id">

                @can('checksetor', AGENDA_DELETAR)
                 <button type="submit" id="id_delete" data-id="" data-route="/agenda" class="btnDeletarAgendamento btn btn-danger btn-sm">Cancelar Agendamento</button>
                @else
                    <button type="submit" id="id_delete" data-id="" data-route="/agenda" class="d-none btn btn-danger btn-sm">Cancelar Agendamento</button>
                @endcan
            </div>
        </div>
    </div>

    <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/agenda') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" name="titulo" class="form-control" id="titulo" required>
                            </div>
                        </div>

                        <div class="form-group row mb-5 {{ $errors->has('descricao') ? 'has-error' : ''}}">
                            <div class="col-2">
                                <label for="descricao" class="control-label">{{ 'Descrição' }}</label>
                            </div>
                            <div class="col-10">
                                <textarea class="form-control" rows="5" name="descricao" type="textarea" id="descricao" >{{ isset($result->descricao) ? $result->descricao : old('descricao')}}</textarea>
                                {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Horário</label>
                          <div class="col-sm-10">
                              <input type="time" name="horario" class="form-control" id="horario" required>
                          </div>
                        </div>

                        <input type="hidden" name="data">


                        @include('parts/select-setor')

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Cadastar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="{{ asset('adminlte/plugins/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/fullcalendar/locales/pt-br.js') }}"></script>
<script src="{{ asset('js/ajax_veiculo.js') }}"></script>
<script>

    $(function () {
      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function () {

          // create an Event Object (https://fullcalendar.io/docs/event-object)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          }

          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject)

          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex        : 1070,
            revert        : true, // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
          })

        })
      }

      ini_events($('#external-events div.external-event'))

      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()

      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendar.Draggable;

      var containerEl = document.getElementById('external-events');
      var checkbox = document.getElementById('drop-remove');
      var calendarEl = document.getElementById('calendar');

      // initialize the external events
      // -----------------------------------------------------------------

      new Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
          return {
            title: eventEl.innerText,
            backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
            borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
            textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
          };
        }
      });

      var calendar = new Calendar(calendarEl, {
        showNonCurrentDates: true, //false = somente o mes
        locale: 'pt-br',
        headerToolbar: {
          left  : 'prev,next today',
          center: 'title',
          right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        // events: `${BASE_URL}/api/agenda?select=id AS fkas_id, auth_id, CONCAT(' - ', periodo,' - ', DATE_FORMAT(previsao_volta, '%H:%i')) as title, DATE_FORMAT(previsao_saida, '%H:%i') AS saida, DATE_FORMAT(previsao_volta, '%H:%i') AS volta, previsao_saida AS start,previsao_volta AS end,local,telefone,controle_frota_id&where=status,=,1&whereYear=created_at,2021&get=true`,

        events: [
          <?php foreach($agendamentos as $agendamento): ?>
            {
              fkas_id           : '{{ $agendamento->fkas_id }}',
              auth_id           : '{{ $agendamento->auth_id }}',
              titulo            : '{{ $agendamento->titulo }}',
              title             : '{{ $agendamento->titulo }}',
              descricao         : '{{ $agendamento->descricao }}',
              data              : '{{ $agendamento->data }}',
              horario           : '{{ $agendamento->horario }}',
              start             : new Date('{{ $agendamento->start }} {{ $agendamento->horario }}'),
              end               : new Date('{{ $agendamento->end }} {{ $agendamento->horario }}'),
              backgroundColor   : '{{ $agendamento->color }}',
              borderColor       : '{{ $agendamento->color }}'
            },
          <?php endforeach; ?>
        ],

        editable  : true,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        },
        selectable: true,
        select: function (info){
            $('[name="data"]').val(info.endStr)
            $('[name="data"]').val(info.startStr);

          if (info.startStr !=  moment(info.endStr).subtract(1, "days").format('YYYY-MM-DD')) {
            calendar.unselect()
          } else {
              @can('checksetor', AGENDA_ADICIONAR)
                $('#cadastrar').modal('show');
              @endcan
          }

        },

        eventClick: function (info) {
            info.jsEvent.preventDefault(); // don't let the browser navigate

            const eluser = document.querySelector('#id_delete');

            eluser.dataset.id = info.event._def.extendedProps.fkas_id

            if (info.event._def.extendedProps.auth_id == user.id || user.type == "master") {
              $('#id_delete').show();
            } else {
              $('#id_delete').hide();
            }

            $('#visualizar #fkas_id').val(info.event._def.extendedProps.fkas_id);
            $('#visualizar #title').text(info.event._def.extendedProps.titulo);
            $('#visualizar #descricaoshow').text(info.event._def.extendedProps.descricao);
            $('#visualizar #horarioshow').text(info.event._def.extendedProps.horario);
            $('#visualizar #start').text(info.event._def.extendedProps.data);
            $('#visualizar #end').text(info.event._def.extendedProps.data);
            $('#visualizar').modal('show');
        },
        // selectOverlap: function(info) {
        //   $('[name=periodo]').find('option').remove();

        //   if (info.title.indexOf('tarde'))

        //   $('[name="previsao_volta"]').val(info.endStr)
        //   $('[name="previsao_saida"]').val(info.startStr);


        //   // buscaAgendamentos(info._instance.range);
        //   // $('#cadastrar').modal('show');
        // }


      });


      calendar.render();
      // $('#calendar').fullCalendar()

        //   {
        //     title          : 'All Day Event',
        //     start          : new Date(y, m, 1),
        //     backgroundColor: '#f56954', //red
        //     borderColor    : '#f56954', //red
        //     allDay         : true
        //   },
        //   {
        //     title          : 'Long Event',
        //     start          : new Date(y, m, d - 5),
        //     end            : new Date(y, m, d - 2),
        //     backgroundColor: '#f39c12', //yellow
        //     borderColor    : '#f39c12' //yellow
        //   },
        //   {
        //     title          : 'Meeting',
        //     start          : new Date(y, m, d, 10, 30),
        //     allDay         : false,
        //     backgroundColor: '#0073b7', //Blue
        //     borderColor    : '#0073b7' //Blue
        //   },
        //   {
        //     title          : 'Lunch',
        //     start          : new Date(y, m, d, 12, 0),
        //     end            : new Date(y, m, d, 14, 0),
        //     allDay         : false,
        //     backgroundColor: '#00c0ef', //Info (aqua)
        //     borderColor    : '#00c0ef' //Info (aqua)
        //   },
        //   {
        //     title          : 'Birthday Party',
        //     start          : new Date(y, m, d + 1, 19, 0),
        //     end            : new Date(y, m, d + 1, 22, 30),
        //     allDay         : false,
        //     backgroundColor: '#00a65a', //Success (green)
        //     borderColor    : '#00a65a' //Success (green)
        //   },
        //   {
        //     title          : 'Click for Google',
        //     start          : new Date(y, m, 28),
        //     end            : new Date(y, m, 29),
        //     url            : 'https://www.google.com/',
        //     backgroundColor: '#3c8dbc', //Primary (light-blue)
        //     borderColor    : '#3c8dbc' //Primary (light-blue)
        //   }
        // ],
    })

    $(".btnDeletarAgendamento").click(function () {
      _this = this;

      swal.fire({
          title: 'Atenção?',
          text: "Deseja remover este agendamento?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim!',
          cancelButtonText: 'Não',
      }).then(function (result) {
          if (result.value) {
              $.ajax({
                  url: BASE_URL + $(_this).attr('data-route') + '/' + $('#fkas_id').val(),
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

                          // $(_this).closest('tr').remove();
                          location.reload()
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


    async function buscaAgendamentos(range){
      const agendamento = await axios.post(`${BASE_URL}/agenda/custom/store`, {range})
    }
  </script>
@endpush
