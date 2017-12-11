<h3>Last Added</h3>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Phone</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts->sortBy('created_at') as $contact)
        <tr>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->phone }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<h3>All Contacts</h3>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Phone</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts->sortBy('name') as $contact)
        <tr>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->phone }}</td>
        </tr>
    @endforeach
    </tbody>
</table>