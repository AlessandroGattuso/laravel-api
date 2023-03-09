@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row pb-5">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between">
                    <h3>Dettaglio tipo: {{ $type->name }}</h3>
                    <div>
                        <a href="{{ route('admin.types.index') }}" class="btn btn-primary btn-sm">Go back</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <p><strong>Slug: </strong> {{ $type->slug }}</p>
            </div>
            <div class="col-12">
                <h3>Tutti i progetti di questo tipo</h3>
                <div class="row gy-2">
                    @forelse($type->projects as $project)
                        <div class="card">
                            <div class="card-header card-title">{{$project->title}}</div>
                            <div class="card-body">
                                <p>{{ $project->title }}</p>
                                <p>{{ $project->slug}}</p>
                                <a href="{{route('admin.projects.show', $project->slug)}}">Vedi dettagli</a>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning">
                            Non esistono progetti con questo tipo, per crearne uno nuovo clicca <a class="text-warning text-decoration-none"
                                href="{{ route('admin.types.create') }}">qui</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
