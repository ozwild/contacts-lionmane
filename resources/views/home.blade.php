@extends('layouts.app')

@section('modal')
    @include('layouts.pieces.modal')
@endsection

@section('loader')
    @include('layouts.pieces.loader')
@endsection

@section('abort')
    @include('layouts.pieces.abort')
@endsection

@section('content')

    @yield('abort')

    @yield('loader')

    <main style="display:none;">
        <div class="container">
            <div class="row">
                <div class="clearfix">
                    <a href="#" class="btn btn-success pull-right add-contact">Add New</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">

                        <div class="panel-body">

                            <div id="index-container"></div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        @yield('modal')

    </main>
@endsection

@push('scripts')
    <script>
        app.routes = {
            list: '{{ route('index') }}',
            create: '{{ route('create') }}',
            store: '{{ route('store') }}',
        };

        $.when(app.initialize()).then(function () {
            app.ready();
        }, function () {
            app.abort();
        });
    </script>
@endpush