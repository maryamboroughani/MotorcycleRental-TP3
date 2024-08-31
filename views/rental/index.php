{{ include('layouts/header.php', { title: 'Rentals' }) }}

<h1>Rentals</h1>

{% if rentals is not empty %}
<table>
    <thead>
        <tr>
            <th>Rental ID</th>
            <th>Motorcycle ID</th>
            <th>User ID</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        {% for rental in rentals %}
        <tr>
            <td>{{ rental.id }}</td>
            <td>{{ rental.motorcycle_id }}</td>
            <td>{{ rental.user_id }}</td>
            <td>{{ rental.start_date|date('d M Y') }}</td>
            <td>{{ rental.end_date|date('d M Y') }}</td>
            <td>
                <a href="{{ base }}/rental/show?id={{ rental.id }}">View</a>
                <a href="{{ base }}/rental/edit?id={{ rental.id }}">Edit</a>
                <form action="{{ base }}/rental/delete" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="{{ rental.id }}">
                    <button type="submit" class="btn red">Delete</button>
                </form>
            </td>
        </tr>
        {% endfor %}
    </tbody>
</table>

{% else %}
<p>No rentals found.</p>
{% endif %}
<a href="{{ base }}/rental/create" class="btn">New Rental</a>

{{ include('layouts/footer.php') }}
