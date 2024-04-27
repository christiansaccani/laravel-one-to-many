@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h1>Pagina di amministrazione</h1>
    <h2>Benvenuto {{$user -> name}}</h2>

    <a href="{{route('admin.posts.create')}}" class="btn btn-primary">Aggiungi un post</a>
</div>

@endsection