document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    // Reset error messages
    document.getElementById("username-error").style.display = "none";
    document.getElementById("password-error").style.display = "none";

    // Get values
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value;

    // Simple validation
    let isValid = true;

    if (username === "") {
        document.getElementById("username-error").textContent =
            "Username tidak boleh kosong";
        document.getElementById("username-error").style.display = "block";
        isValid = false;
    } else if (username.length < 3) {
        document.getElementById("username-error").textContent =
            "Username minimal 3 karakter";
        document.getElementById("username-error").style.display = "block";
        isValid = false;
    }

    if (password === "") {
        document.getElementById("password-error").textContent =
            "Password tidak boleh kosong";
        document.getElementById("password-error").style.display = "block";
        isValid = false;
    } else if (password.length < 6) {
        document.getElementById("password-error").textContent =
            "Password minimal 6 karakter";
        document.getElementById("password-error").style.display = "block";
        isValid = false;
    }

    // If valid, proceed with login (simulated)
    if (isValid) {
        alert("Login berhasil! Akan dialihkan ke dashboard...");
        // In a real application:
        // 1. Kirim data ke server
        // 2. Redirect: window.location.href = 'dashboard.html';
    }
});

// Add focus/blur effects
const inputs = document.querySelectorAll("input");
inputs.forEach((input) => {
    input.addEventListener("focus", function () {
        this.parentNode.querySelector("label").style.color = "#1E3A8A";
    });

    input.addEventListener("blur", function () {
        this.parentNode.querySelector("label").style.color = "#555";
    });
});
