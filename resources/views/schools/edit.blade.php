@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('school.update', ['id' => $school->id]) }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-success text-white">{{ __('Edit School') }}</div>

                        <div class="card-body">
                            <input class="form-control" name="name" value="{{ $school->name }}" type="text" placeholder="{{ __('Enter School Name Here....') }}">
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-success">{{ __('Update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
