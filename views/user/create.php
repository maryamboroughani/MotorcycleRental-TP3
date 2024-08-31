{{ include('layouts/header.php', {title:'Create User'})}}
<div class="container">
    <form method="post">
        <h2>New User</h2>
        
        <!-- First Name -->
        <label for="first_name">First Name
            <input type="text" id="first_name" name="first_name" value="{{ user.first_name }}">
        </label>
        {% if errors.first_name is defined %}
            <span class="error">{{ errors.first_name }}</span>
        {% endif %}
        
        <!-- Last Name -->
        <label for="last_name">Last Name
            <input type="text" id="last_name" name="last_name" value="{{ user.last_name }}">
        </label>
        {% if errors.last_name is defined %}
            <span class="error">{{ errors.last_name }}</span>
        {% endif %}
        
        <!-- Email -->
        <label for="email">Email
            <input type="email" id="email" name="email" value="{{ user.email }}">
        </label>
        {% if errors.email is defined %}
            <span class="error">{{ errors.email }}</span>
        {% endif %}
        
        <!-- Password -->
        <label for="password">Password
            <input type="password" id="password" name="password" value="{{ user.password }}">
        </label>
        {% if errors.password is defined %}
            <span class="error">{{ errors.password }}</span>
        {% endif %}
        <label>Privilege
            <select name="privilege_id">
                <option value="">Select Privilege</option>
                {% for privilege in privileges %}
                <option value="{{privilege.id}}" {% if privilege.id==user.privilege_id %} selected {% endif %}>{{privilege.privilege_name}}</option>
                {% endfor %}
            </select>
        </label>
        {% if errors.privilege_id is defined %}
        <span class="error">{{ errors.privilege_id }}</span>
        {% endif %}

        <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
    </form>

        
        <input type="submit" class="btn" value="Save">
    </form>
</div>
{{ include('layouts/footer.php')}}
