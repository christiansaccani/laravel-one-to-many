@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h1>Pagina di amministrazione</h1>
    <h2>Benvenuto {{$user -> name}}</h2>

    <a href="{{route('admin.posts.create')}}" class="btn btn-secondary">Aggiungi un post</a>
    <a href="{{route('admin.posts.index')}}" class="btn btn-primary my-2">Tutti i post</a>
</div>

@endsection