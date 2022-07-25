@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a class="btn btn-sm btn-info" href="{{ route('schools') }}">{{ __('All Schools') }}</a>
                    <a class="btn btn-sm btn-success" href="{{ route('schools.create') }}">{{ __('Create New') }}</a>
                    <a class="btn btn-sm btn-danger" href="{{ route('schools.trached') }}">{{ __('Schools Deleted') }}</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schools as $school)    
                                <tr>
                                    <th scope="row">{{ $school->id }}</th>
                                    <td>{{ $school->name }}</td>
                                    <td>
                                        <form class="d-inline" action="{{ route('schools.restore', ['id' => $school->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm" >{{ __('Restore') }}</button>
                                        </form>
                                        <form class="d-inline" action="{{ route('schools.forceDelete', ['id' => $school->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" >
                                                {{ __('Delete Forever') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection