<div class="modal-body">
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