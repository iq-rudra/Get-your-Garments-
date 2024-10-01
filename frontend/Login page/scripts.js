// Validate login form
function validateLogin() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    if (!email || !password) {
        document.getElementById("loginMessage").innerHTML = "<span style='color: red;'>Please enter both email and password.</span>";
        return false;
    }

    document.getElementById("loginMessage").innerHTML = "<span style='color: green;'>Login successful!</span>";
    return false; // Prevent actual form submission for demo purposes
}
