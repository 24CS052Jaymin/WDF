function validateForm() {
    var username = document.getElementById("Username").value.trim();
    var email = document.getElementById("Email").value.trim();
    var password = document.getElementById("Password").value;
    var confirm = document.getElementById("Confirm-Password").value;
    var numberCharacter = /[123456789]/;
    var specialCharacter = /[!@#$%^&*()><?:;<>]/;
    
    if (username === "" || email === "" || password === "" || confirm === "") {
        alert("All fields are required!");
        return false;
    }

    if (!email.includes("@") || !email.includes(".")) {
        alert("Enter a valid email.");
        return false;
    }

    if (password.length < 8) {
        alert("Password must be at least 6 characters.");
        return false;
    }
      if (!numberCharacter.test(password)) {
        alert("Password must contain at least 1 number digit!");
        return false;
    }
    if (!specialCharacter.test(password)) {
        alert("Password must contain at least a special character!");
        return false;
    }

    if (confirm !== password) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}