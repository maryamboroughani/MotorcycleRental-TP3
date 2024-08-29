{{ include('layouts/header.php', {title:'Login'})}}
    <div class="container">
        <form  method="post">
            <h2>Login</h2>
            {% if errors.message is defined %}
                <span class="error">{{ errors.message }}</span>
            {% endif %}
            <label>Username
                <input type="email" name="email" value="{{ user.email}}">
            </label>
            {% if errors.email is defined %}
                <span class="error">{{ errors.email }}</span>
            {% endif %}
            <label>Password
                <input type="password" name="password" value="{{ user.password}}">
            </label>
            {% if errors.password is defined %}
                <span class="error">{{ errors.password }}</span>
            {% endif %}
            <input type="submit" class="btn" value="Login">
        </form>
    </div>
{{ include('layouts/footer.php')}}