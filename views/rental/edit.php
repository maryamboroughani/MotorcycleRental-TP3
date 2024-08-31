{{ include('layouts/header.php', { title: 'Edit Rental' }) }}

<h1>Edit Rental</h1>

{% if errors is defined %}
    {% for error in errors %}
        <p class="error">{{ error }}</p>
    {% endfor %}
{% endif %}

<form action="{{ base }}/rental/edit?id={{ rental.id }}" method="post" >
    <input type="hidden" name="id" value="{{ rental.id }}">
    
    <label>Motorcycle ID
        <input type="text" name="motorcycle_id" value="{{ rental.motorcycle_id }}" required>
    </label>
    <label>User ID
        <input type="text" name="user_id" value="{{ rental.user_id }}" required>
    </label>
    <label>Start Date
        <input type="date" name="start_date" value="{{ rental.start_date }}" required>
    </label>
    <label>End Date
        <input type="date" name="end_date" value="{{ rental.end_date }}" required>
    </label>
   
    <button type="submit" class="btn">Update Rental</button>
</form>

{{ include('layouts/footer.php') }}
