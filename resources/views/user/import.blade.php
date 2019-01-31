@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Import users') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('users/import') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="import_file">Import csv</label>
                                <input type="file" class="form-control-file" id="import_file" name="import_file">
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Import users') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (isset($lava))
                    <div style="margin-top: 100px;" id="pop-div"></div>
                    {!! $lava->render('GeoChart', 'Popularity', 'pop-div') !!}
                        @endif

                    @if (Session::has('exception'))
                        <div class="alert alert-danger">{{ Session::get('exception') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
