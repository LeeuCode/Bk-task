@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('student.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-success text-white">{{ __('Create New Student') }}</div>

                        <div class="card-body">
                            <div class="col-md-12 mb-3">
                                <input class="form-control" name="name" type="text" placeholder="{{ __('Enter Student Name Here....') }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <select class="form-control" name="school_id" required>
                                    <option value="">{{ __('Select School') }}</option>
                                    @foreach ($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-success">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
