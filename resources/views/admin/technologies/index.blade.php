@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between">
                    <h4>Elenco tecnologie dei progetti</h4>
                    <div>
                        <a href="{{ route('admin.technologies.create') }}" class="btn btn-sm btn-primary">Aggiungi</a>
                    </div>
                </div>
            </div>
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="col-12">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <th>Nome</th>
                        <th>Slug</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse($technologies as $technology)
                                <td>{{ $technology->name }}</td>
                                <td>{{ $technology->slug }}</td>
                                <td>
                                    <a href="{{ route('admin.technologies.show', $technology->slug) }}" title="Visualizza tipo"
                                        class="btn btn-sm btn-square btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.technologies.edit', $technology->slug) }}" title="Modifica tipo"
                                        class="btn btn-sm btn-square btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form class="d-inline-block" action="{{ route('admin.technologies.destroy', $technology->slug) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm btn-square confirm-delete-button"
                                            message="Sei sicuro di voler cancellare questa tecnologia?">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                        </tr>
                        @empty
                            <div class="alert alert-warning">
                                Non esistono tecnologie, per crearne una nuovo clicca <a class="text-warning text-decoration-none"
                                    href="{{ route('admin.technologies.create') }}">qui</a>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.partials.modals')
@endsection
