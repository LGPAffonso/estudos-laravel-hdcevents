@extends('layouts.main')

@section('title', $event->title)

@section('content')


<div class="col-md-10 offset-md-1">
      <p>Evento {{$event->id}}</p>
    <div class="row">
      <div id="image-container" class="col-md-6">
      @if($event->imagem!=null || $event->imagem!='')
            <img src="\img\events/{{$event->imagem}}" alt="{{$event->titulo}}">
            @else
            <img src="\img\latrel.gif" alt="{{$event->titulo}}">
            @endif
        <!-- <img src="/img/events/{{ $event->imagem }}" class="img-fluid" alt="{{ $event->titulo }}"> -->
      </div>
      <div id="info-container" class="col-md-6">
        <h1>{{ $event->titulo }}</h1>
        <p class="event-city"><ion-icon name="location-outline"></ion-icon> {{ $event->cidade }}</p>
        <p class="events-participants"><ion-icon name="people-outline"></ion-icon> {{ count($event->users) }} Participantes</p>
        <p class="event-owner"><ion-icon name="star-outline"></ion-icon> {{$eventOwner['name']}}</p>
        @if(!$hasJoined)
        <form action="/events/join/{{ $event->id }}" method="POST">
          @csrf
          <a href="/events/join/{{ $event->id }}" 
            class="btn btn-primary" 
            id="event-submit"
            onclick="event.preventDefault();
            this.closest('form').submit();">
            Confirmar Presença
          </a>
        </form>
        @else
        <p>Você já está participando</p>
        @endif
        <!-- <a href="#" class="btn btn-primary" id="event-submit">Confirmar Presença</a> -->
        <h3>o evento conta com:</h3>
        <ul id="items-list">
          @if($event->itens)
          @foreach($event->itens as $item)
          <li><ion-icon name='play-outline'></ion-icon>{{$item}}</li>
          @endforeach
          @endif
        </ul>
      </div>
      <div class="col-md-12" id="description-container">
        <h3>Sobre o evento:</h3>
        <p class="event-description">{{ $event->descricao }}</p>
      </div>
    </div>
  </div>

@endsection