@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Students Trached') }}</div>

                <div class="card-body">
                    <a class="btn btn-sm btn-info" href="{{ route('students') }}">{{ __('All Students') }}</a>
                    <a class="btn btn-sm btn-success" href="{{ route('students.create') }}">{{ __('Create New') }}</a>
                    <a class="btn btn-sm btn-danger" href="{{ route('students.trached') }}">{{ __('Students Deleted') }}</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)    
                                <tr>
                                    <th scope="row">{{ $student->id }}</th>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        <form class="d-inline" action="{{ route('students.restore', ['id' => $student->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm" >{{ __('Restore') }}</button>
                                        </form>
                                        <form class="d-inline" action="{{ route('students.forceDelete', ['id' => $student->id]) }}" method="POST">
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