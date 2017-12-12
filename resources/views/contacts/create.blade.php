<form id="creation-form" action="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create Contact</h4>
    </div>
    <div class="modal-body">

        <fieldset>
            {!! csrf_field() !!}
        </fieldset>

        <fieldset>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" class="form-control">
            </div>
        </fieldset>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>