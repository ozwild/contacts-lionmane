<form id="creation-form" action="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create Contact</h4>
    </div>
    <div class="modal-body">

        <div class="row">
            <div class="col-xs-12 clearfix">
                <fieldset>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" class="form-control">
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
                <button type="button" id="insert-new-attribute" class="btn btn-default rounded pull-right"><i class="material-icons block">add</i></button>
            </div>
        </div>
        <div id="attributes-container">

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>