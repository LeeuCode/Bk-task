@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Students') }}</div>

                <div class="card-body">
                    <a class="btn btn-sm btn-info" href="{{ route('students') }}">{{ __('All students') }}</a>
                    <a class="btn btn-sm btn-success" href="{{ route('students.create') }}">{{ __('Create New') }}</a>
                    <a class="btn btn-sm btn-danger" href="{{ route('students.trached') }}">{{ __('students Deleted') }}</a>
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
                                        <a class="btn btn-sm btn-info text-white" href="{{ route('students.edit', ['id' => $student->id]) }}">{{ __('EDIT') }}</a>
                                        <form class="d-inline" action="{{ route('student.delete', ['id' => $student->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit">{{ __('DELETE') }}</button>
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