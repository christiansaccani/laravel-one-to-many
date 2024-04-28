@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h1>Modifica il post</h1>

    <form action="{{route('admin.posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Titolo" aria-describedby="titleHelper" value="{{old('title') ?? $post->title}}">
            @error('title')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <small id="titleHelper" class="text-muted">Titolo del post, massimo 255 caratteri</small>
        </div>

        <div class="mb-2">
            <label for="content">Contenuto</label>
            <textarea class="form-control  @error('content') is-invalid @enderror" name="content" id="content" rows="4">{{old('content') ?? $post->content}}</textarea>
            @error('content')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-4">
            {{-- <img src="{{asset('storage/' . $post->cover_image)}}" alt="Copertina immagine"> --}}
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
                <option value="{{$type->id}}" {{ $type->id == old('type_id', $post->type ? $post->type->id : '') ? 'selected' : '' }}>
                    {{ $type->title }}
                </option>
                @endforeach

            </select>
        </div>

        <button class="btn btn-success">Modifica</button>
    
    </form>

    
    <div class="mt-2"><a href="{{route('admin.posts.index')}}" class="btn btn-primary">Torna a Tutti i Post</a></div>


    <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
        Elimina
    </button>
      
    <!-- Button trigger modal -->
    
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
    
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Elimina il post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
            <div class="modal-body">
                Sei sicuro di voler eliminare il post?
            </div>
    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-danger">Elimina</button>
                </form>
            </div>
    
        </div>
        </div>
    </div>

</div>

@endsection