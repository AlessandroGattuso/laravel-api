@extends('layouts.admin')
@section('content')
   <div class="container">
    <div class="row">
      <div class="col-12 my-5">
        <div class="d-flex justify-content-between">
          <h4>Elenco progetti</h4>
          <div>
            <a href="{{route('admin.projects.create')}}" class="btn btn-sm btn-primary">Aggiungi</a>
          </div>
        </div>
      </div>
      @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
      @endif
      <div class="col-12">
          <table class="table table-striped">
            <thead class="table-dark">
              <th>Titolo</th>
              <th>Slug</th>
              <th></th>
            </thead>
            <tbody>
              @forelse($projects as $project)
                <tr>
                  <td>{{$project->title}}</td>
                  <td>{{$project->slug}}</td>
                  <td>
                    <a href="{{route('admin.projects.show', $project->slug)}}" title="Visualizza project" class="btn btn-sm btn-square btn-primary">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{route('admin.projects.edit', $project->slug)}}" title="Modifica project" class="btn btn-sm btn-square btn-warning">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form class="d-inline-block" action="{{ route('admin.projects.destroy', $project->slug)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm btn-square confirm-delete-button" message="Sei sicuro di voler cancellare questo progetto?">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <div class="alert alert-warning">
                    Non hai progetti, aggiungi un nuovo progetto da <a class="text-warning text-decoration-none" href="{{route('admin.projects.create')}}">qui</a>
                </div>
              @endforelse
            </tbody>
          </table>
      </div>
    </div>
   </div>
   @include('admin.partials.modals')
@endsection