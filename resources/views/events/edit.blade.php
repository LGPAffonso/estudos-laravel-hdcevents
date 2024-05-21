@extends('layouts.main')

@section('titulo', 'Editar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{$event->titulo}}</h1>

    <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="imagem">Imagem do evento:</label>
            <input type="file" class="form-control-file" id="imagem" name="imagem" >
            <img src="/img/events/{{$event->imagem}}" alt="{{$event->titulo}}" class="img-preview">
        </div>
        <div class="form-group">
            <label for="titulo">Evento:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nome do evento" value="{{$event->titulo}}">
        </div>
        <div class="form-group">
            <label for="data">Data do Evento:</label>
            <input type="date" class="form-control" id="data" name="data" placeholder="Data do evento" value="{{$event->data->format('Y-m-d')}}">
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Local do evento" value="{{$event->cidade}}">
        </div>
        <div class="form-group">
            <label for="privado">O evento é privado?</label>
            <select name="privado" id="privado" class="form-control">
                <option value="0" {{$event->private==0? "selected='selected'":""}}>Não</option>
                <option value="1" {{$event->private==1? "selected='selected'":""}}>Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control" placeholder="O que vai acontecer no evento?" >{{$event->descricao}}</textarea>
        </div>
        <div class="form_group">
            <label for="">Adicione itens de infraestrutura:</label>
            <div class="form-group">
                <input type="checkbox" name="itens[]" value="Cadeiras">Cadeiras
                <input type="checkbox" name="itens[]" value="Palco">Palco
                <input type="checkbox" name="itens[]" value="Open Bar">Open Bar
                <input type="checkbox" name="itens[]" value="Open Food">Open Food
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Editar Evento">
    </form>
</div>
@endsection