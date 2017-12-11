@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Contacts</div>

                <div class="panel-body">
                    <a href="" class="btn btn-success">Add Contact</a>

                    <div id="index-container"></div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('modals')
<!--  -->
@endpush

@push('scripts')
<script>
let $indexContainer = $('#index-container');

let p = $.get('{{ route('index') }}');

console.log(p);

p.done(function(r){

$indexContainer.html(r);

});

p.error(function(r){

    console.log(r);

});
</script>
@endpush