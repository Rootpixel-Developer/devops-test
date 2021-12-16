@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit Product - Step 2') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/home/update/'.$product->id) }}">
                            @csrf
                            @method('put')
                            <input type="hidden" name="step" value="2">
                            @foreach($product->modules as $i => $module)
                                <input type="hidden" name="module_id[]" value="{{ $module->id }}">
                                <div class="row mb-3">

                                    <label for="name"
                                           class="col-2 col-form-label text-md-right">{{ __('Module Name') }}</label>

                                    <div class="col-md-3">
                                        <input id="name" type="text"
                                               class="form-control" name="module_name[]"
                                               value="{{ old('module_name.'.$i,$module->module_name) }}" required>
                                    </div>
                                    <label for="name"
                                           class="col-2 col-form-label text-md-right">{{ __('Module Link') }}</label>

                                    <div class="col-md-3">
                                        <input id="name" type="text"
                                               class="form-control" name="module_link[]"
                                               value="{{ old('module_link.'.$i,$module->module_link) }}" required>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
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
