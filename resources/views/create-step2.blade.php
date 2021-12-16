@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Create Product - Step 2') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/home') }}">
                            @csrf
                            <input type="hidden" name="step" value="2">
                            @for($i =0; $i < 3; $i++)
                                <div class="row mb-3">

                                    <label for="name"
                                           class="col-2 col-form-label text-md-right">{{ __('Module Name') }}</label>

                                    <div class="col-md-3">
                                        <input id="name" type="text"
                                               class="form-control" name="module_name[]"
                                               value="{{ old('module_name.'.$i) }}" required>
                                    </div>
                                    <label for="name"
                                           class="col-2 col-form-label text-md-right">{{ __('Module Link') }}</label>

                                    <div class="col-md-3">
                                        <input id="name" type="text"
                                               class="form-control" name="module_link[]"
                                               value="{{ old('module_link.'.$i) }}" required>
                                    </div>
                                </div>
                                <hr>
                            @endfor
                            <div class="row mb-0">
                                <div class="col-12 float-end">
                                    <button type="submit" class="btn btn-primary float-end">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
