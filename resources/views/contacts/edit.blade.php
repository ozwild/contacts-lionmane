<form id="edition-form" action="{{ route('update',$contact->id) }}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Contact</h4>
    </div>
    <div class="modal-body">


        <fieldset>
            {!! method_field('patch') !!}
        </fieldset>

        <div class="row">
            <div class="col-xs-12 clearfix">
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{ $contact->name }}">
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

    <div class="modal-header">
        <h4 class="modal-title">More</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-xs-12 clearfix">
                <button type="button" id="insert-new-attribute" class="btn btn-default rounded pull-right"><i
                            class="material-icons block">add</i></button>
            </div>
        </div>
        <div id="attributes-container">
            @foreach($attributes as $attribute)
                @include('attributes.edit',compact('attribute','types'))
            @endforeach
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>