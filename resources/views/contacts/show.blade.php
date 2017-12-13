<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Basic Information</h4>
</div>

<div class="modal-body">

    <div class="row">
        <div class="col-xs-12 clearfix">
            <fieldset>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $contact->name }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                   value="{{ $contact->phone }}">
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

</div>
@if($attributes->count() > 0)

    <div class="modal-header">
        <h4 class="modal-title">More details</h4>
    </div>

    <div class="modal-body">

        <div id="attributes-container" class="clearfix">
            @foreach($attributes as $attribute)
                @include('attributes.show',compact('attribute','types'))
            @endforeach
        </div>
    </div>

@endif
