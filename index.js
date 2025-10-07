function validform() {
    const username = document.querySelector('input[type="text"]').value.trim();
    const password = document.querySelector('input[type="password"]').value;
    var numberCharacter = /[123456789]/;
    var specialCharacter = /[!@#$%^&*()><?:;<>]/;
    
    if (username.length < 3) {
        alert("Username must be at least 3 characters long.");
        return false;
    }

    if (password.length < 8) {
        alert("Password must be at least 6 characters long.");
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
    return true;
}