<form method="POST" action="/process">
    <h2>Register</h2>
    <label for="register-username">Username:</label>
    <input type="text" id="register-username" name="register-username" required>
    <br>
    <label for="register-email">Email:</label>
    <input type="email" id="register-email" name="register-email" required>
    <br>
    <label for="register-password">Password:</label>
    <input type="password" id="register-password" name="register-password" required>
    <br>
    <input type="submit" value="Register" name="register-submit">
</form>

<button class="toggle-button" onclick="toggleForms()">Switch to Login</button>

<style>
  input{
    width: 300px;
    padding: 8px;
    margin: 8px 0;
    box-sizing: border-box;
  }
</style>

