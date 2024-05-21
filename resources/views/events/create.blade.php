@extends('layouts.main')

@section('titulo', 'Criar Evento')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Criar evento</h1>

    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="imagem">Imagem do evento:</label>
            <input type="file" class="form-control-file" id="imagem" name="imagem" >
        </div>
        <div class="form-group">
            <label for="titulo">Evento:</label>
            <input required type="text" class="form-control" id="titulo" name="titulo" placeholder="Nome do evento">
        </div>
        <div class="form-group">
            <label for="data">Data do Evento:</label>
            <input required type="date" class="form-control" id="data" name="data" placeholder="Data do evento">
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input required type="text" class="form-control" id="cidade" name="cidade" placeholder="Local do evento">
        </div>
        <div class="form-group">
            <label for="privado">O evento é privado?</label>
            <select name="privado" id="privado" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control" placeholder="O que vai acontecer no evento?"></textarea>
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
        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>

@endsection