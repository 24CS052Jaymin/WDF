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
        alert("Password must be at least 8 characters.");
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


document.addEventListener('DOMContentLoaded', function () {
    var questions = document.querySelectorAll('.faq .question');
    questions.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var expanded = this.getAttribute('aria-expanded') === 'true';
            // collapse all
            questions.forEach(function (q) {
                q.setAttribute('aria-expanded', 'false');
                var ans = q.nextElementSibling;
                if (ans && ans.classList.contains('answer')) {
                    ans.hidden = true;
                    ans.style.maxHeight = null;
                }
            });
          
            if (!expanded) {
                this.setAttribute('aria-expanded', 'true');
                var answer = this.nextElementSibling;
                if (answer) {
                    answer.hidden = false;
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                }
            }
        });
    });
});

