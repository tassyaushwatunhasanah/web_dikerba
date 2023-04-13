@extends('adminlte::page')

@section('title', 'WebDikerba')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

                    <h3>Kalender Kegiatan Pelatihan</h3>

                    <div id='calendar' style="width: 700px"></div>

                </div>
            </div>
        </div>
    </div>
@stop
@push ('js')
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            // editable: true,
            // selectable: true,
            // header:{
            //     left: 'prev,next today',
            //     center:'title',
            //     right:'month,agendaWeek,agendaDay'
            // },
            eventColor: 'red',
            nextDayThreshold: '00:00',
            events : [
                @foreach($iht as $iht)
                {
                        title : '{{ $iht->jenis_kegiatan}}',
                        description : '{{$iht->nama_pelatihan}}',
                        start : '{{ $iht->tgl_mulai }}',
                        end : '{{$iht->tgl_selesai}}'+'T23:59:59',
                        @if($iht->jenis_kegiatan=="Pelatihan")
                            color:'green',
                        @elseif($iht->jenis_kegiatan=="IHT")
                            color:'purple',
                        @elseif($iht->jenis_kegiatan=="Seminar")
                            color:'blue',
                        @endif
                        url : '/iht/{{$iht -> id}}'
                },
                @endforeach
            ],
            eventRender: function(event, element) {
            element.find('.fc-title').append("<br/>" + event.description);
            }
        });
    });
</script>

@endpush
