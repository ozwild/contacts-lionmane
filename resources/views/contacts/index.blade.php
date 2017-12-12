@if($contacts->count() > 0)
    <h2>Your Contacts</h2>
    <hr>
    <h4>Latest</h4>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($latestContacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="show-button" data-ref="{{ route('show', $contact->id) }}">Show</a></li>
                            <li><a href="#" class="edit-button" data-ref="{{ route('edit', $contact->id) }}">Edit</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" class="delete-button" data-ref="{{ route('delete', $contact->id) }}" class="text-danger">Delete</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h4>All Contacts</h4>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-ref="{{ route('show', $contact->id) }}">View</a></li>
                            <li><a href="#" data-ref="{{ route('edit', $contact->id) }}">Edit</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" data-ref="{{ route('delete', $contact->id) }}" class="text-danger">Delete</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>You have no contacts yet. Start by <a href="#" class="add-contact">adding some</a></p>
@endif
