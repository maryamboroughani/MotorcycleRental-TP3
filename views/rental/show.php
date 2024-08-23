{{ include('layouts/header.php', { title: 'Rental Details' }) }}

<div class="container">
    <h1>Rental Details</h1>
    <p><strong>Rental ID:</strong> {{ rental.id }}</p>
    <p><strong>Motorcycle ID:</strong> {{ rental.motorcycle_id }}</p>
    <p><strong>User ID:</strong> {{ rental.user_id }}</p>
    <p><strong>Start Date:</strong> {{ rental.start_date|date('d M Y') }}</p>
    <p><strong>End Date:</strong> {{ rental.end_date|date('d M Y') }}</p>
    <a href="{{ base }}/rental/edit?id={{ rental.id }}" class="btn">Edit Rental</a>
    <form action="{{ base }}/rental/delete" method="post" style="display:inline;">
        <input type="hidden" name="id" value="{{ rental.id }}">
        <button type="submit" class="btn red">Delete Rental</button>
    </form>
</div>

{{ include('layouts/footer.php') }}
