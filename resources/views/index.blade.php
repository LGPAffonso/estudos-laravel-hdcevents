{{-- herda o que está no loyout --}}
@extends('layouts.main')
{{-- define o title --}}
@section('title', 'Eventos')
{{-- define o conteudo --}}
@section('content')
<!-- <div class="col-12">

    <p>teste</p>

    <img src="\img\latrel.gif" alt="">


</div> -->


<div id="search-container" class="col-md-12">
    <h1>Busque evento</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="procurar....">
        <input type="submit" value="Enviar">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
    <h2>Buscando por: {{$search}}</h2>
    @else
    <h2>Proximos eventos</h2>
    <p>Veja os eventos dos proximos dias</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            @if($event->imagem!=null || $event->imagem!='')
            <img src="\img\events/{{$event->imagem}}" alt="{{$event->titulo}}">
            @else
            <img src="\img\latrel.gif" alt="{{$event->titulo}}">
            @endif
            <div class="card-body">
                <p class="card-date">{{ date('d/m/Y', strtotime($event->data))}}</p>
                <h5 class="card-title">{{$event->titulo}}</h5>
                <p class="card-participants">{{ count($event->users) }} participantes</p>
                <a href="/events/{{$event->id}}" class="btn btn-primary">Ver detalhes</a>
            </div>
        </div>
        @endforeach
        @if(count($events)==0 && $search)
        <p>Não foi possivel encontrar eventos com {{$search}}! <a href="/">Ver Todos!</a></p>
        @elseif(count($events)==0)
        <p>Ainda não há eventos disponíveis</p>
        @endif

    </div>
</div>

<!-- @foreach($events as $event)

<p>{{$event->titulo}}</p>
<p>{{$event->descricao}}</p>

@endforeach -->

@endsection