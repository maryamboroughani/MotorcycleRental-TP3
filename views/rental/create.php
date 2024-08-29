{{ include('layouts/header.php', { title: 'New Rental' }) }}

<h1>New Rental</h1>

{% if errors is defined %}
    {% for error in errors %}
        <p class="error">{{ error }}</p>
    {% endfor %}
{% endif %}

<form action="{{ base }}/rental/create" method="post" enctype="multipart/form-data">
    <label>Motorcycle ID
        <input type="text" name="motorcycle_id" value="{{ rental.motorcycle_id | default('') }}" required>
    </label>
    <label>User ID
        <input type="text" name="user_id" value="{{ rental.user_id | default('') }}" required>
    </label>
    <label>Start Date
        <input type="date" name="start_date" value="{{ rental.start_date | default('') }}" required>
    </label>
    <label>End Date
        <input type="date" name="end_date" value="{{ rental.end_date | default('') }}" required>
    </label>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

    
    <button type="submit" class="btn">Create Rental</button>
</form>

{{ include('layouts/footer.php') }}
