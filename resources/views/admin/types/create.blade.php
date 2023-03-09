@extends('layouts.admin')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12 my-5">
      <h4>Crea tipo</h4>
    </div>
    <div class="col-12 my-3">
        <form action="{{route('admin.types.store')}}" method="POST">
            @csrf
            <div class="form-group">
              <div class="control-label my-2">
                Nome
              </div>
              <input type="text" class="form-control" placeholder="nome" name="name" id="name">
              @error('name')
                <div class="text-danger">{{$message}}</div>
              @enderror
            <div class=" my-5">
              <button type="submit" class="btn btn-primary">Crea</button>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection