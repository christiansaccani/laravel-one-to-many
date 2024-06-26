@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h1>Aggiungi un post</h1>

    <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="mb-2" for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Titolo" aria-describedby="titleHelper" value="{{old('title')}}">
            @error('title')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <small id="titleHelper" class="text-muted">Titolo del post, massimo 255 caratteri</small>
        </div>

        <div class="mb-4">
            <label class="mb-2" for="content">Contenuto</label>
            <textarea class="form-control  @error('content') is-invalid @enderror" name="content" id="content" rows="4">{{old('content')}}</textarea>
            @error('content')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="mb-2" for="cover_image">Immagine di copertina</label>
            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image">
            @error('cover_image')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="mb-2" for="type_id">Type</label>

            <select class="form-select" name="type_id" id="type_id">
                
                <option value=""></option>
                @foreach ($types as $type)
                <option value="{{$type->id}}" {{ $type->id == old('type_id') ? 'selected' : '' }}>{{ $type->title }}</option>
                @endforeach

            </select>
        </div>

        <button class="btn btn-primary">Aggiungi</button>
    </form>

    <a href="{{route('admin.posts.index')}}" class="btn btn-primary mt-2">Torna a Tutti i Post</a>
</div>

@endsection