@extends('layouts.admin')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12 my-5">
      <h4>Modifica tecnologia</h4>
    </div>
    <div class="col-12">
        <form action="{{route('admin.technologies.update', $technology->slug)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group my-3">
              <div class="control-label">
                Nome
              </div>
              <input technology="text" class="form-control" placeholder="nome" name="name" id="name" value="{{old('$technology->name') ?? $technology->name}}">
              @error('name')
                <div class="text-danger">{{$message}}</div>
              @enderror
            <div class="my-5">
              <button technology="submit" class="btn btn-primary">Modifica</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection