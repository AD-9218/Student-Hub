let form = document.querySelector("form");

let usernameRegex = /^[A-Za-z0-9]{4,15}$/;
let passwordRegex = /^(?=.*[A-Z])(?=.*\W).{8,}$/;

if (form) {
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;

        if (!usernameRegex.test(username)) {
            alert("Username must be 4-15 letters or numbers only");
            return;
        }

        if (!passwordRegex.test(password)) {
            alert("Password must contain at least 8 characters, one capital letter and one special character");
            return;
        }

        if (username === "Student" && password === "Student@123") {
            let successMessage = document.getElementById("successMessage");

            successMessage.innerHTML = "✅ Login Successful!";
            successMessage.style.color = "green";

            setTimeout(function () {
                successMessage.innerHTML = "";
            }, 3000);

            window.location.href = "index.html";
        } else {
            alert("Wrong Username or Password");
        }
    });
}