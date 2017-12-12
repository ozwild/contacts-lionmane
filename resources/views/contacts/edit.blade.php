<form id="edition-form" action="{{ route('update',$contact->id) }}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Contact</h4>
    </div>
    <div class="modal-body">

        <fieldset>
            {!! csrf_field() !!}
            {!! method_field('patch') !!}
        </fieldset>

        <fieldset>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $contact->name }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" class="form-control" value="{{ $contact->phone }}">
            </div>
        </fieldset>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>