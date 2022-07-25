@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('school.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-success text-white">{{ __('Create New School') }}</div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <input class="form-control" name="name" type="text" placeholder="{{ __('Enter School Name Here....') }}" required>
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
