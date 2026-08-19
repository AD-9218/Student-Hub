let form = document.querySelector("form");

if (form) {

    form.addEventListener("submit", function (event) {

        event.preventDefault();

        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;

        if (username === "Anandi" && password === "1234") {

            alert("Login Successful");
            window.location.href = "index.html";

        } else {

            alert("Wrong Username or Password");

        }

    });

}

let today = new Date();

document.querySelectorAll("tr").forEach(function (row) {

    let dueCell = row.querySelector(".due-date");
    let status = row.querySelector(".status");
    let file = row.querySelector(".file");

    if (dueCell && status && file) {

        let due = new Date(dueCell.innerText);
        file.addEventListener("change", function () {

            if (today <= due ) {
                if(this.files.length > 0){
                    status.value = "Submitted";
                    row.style.backgroundColor = "#d4edda";
                }
            }
        });


        if (today > due && status.value === "Pending") {

            row.style.backgroundColor = "#f8d7da";

            alert(
                "Assignment Due!\n\n" +
                "Subject : " + row.cells[1].innerText +
                "\nTitle : " + row.cells[2].innerText
            );

        }

    }

});
const table = document.querySelector("table");
const rows = table.querySelectorAll("tr");

const attendance = {
    "CSUC201-Lab": [18, 20],
    "CSUC201-Lecture": [22, 25],
    "CEUE203-Lab": [16, 18],
    "CEUE203-Lecture": [20, 22],
    "ITUE203-Lab": [17, 20],
    "ITUE203-Lecture": [21, 24],
    "CEUC102-Lab": [15, 18],
    "CEUC102-Lecture": [19, 22],
    "CEUC101-Lab": [18, 20],
    "CEUC101-Lecture": [23, 25],
    "MEUD203-Lab": [14, 16],
    "MEUD203-Lecture": [20, 23]
};

for (let i = 1; i < rows.length; i++) {

    let course = rows[i].cells[0].innerText.trim();
    let type = rows[i].cells[1].innerText.trim();

    let key = course + "-" + type;

    if (attendance[key]) {

        let present = attendance[key][0];
        let total = attendance[key][1];

        let percentage = (present / total * 100).toFixed(1);

        rows[i].cells[2].innerText = present + " / " + total;
        rows[i].cells[3].innerText = percentage + "%";

        if (percentage >= 75) {
            rows[i].cells[3].style.color = "green";
        } else {
            rows[i].cells[3].style.color = "red";
        }
    }
}

const date = document.querySelector("input[type='date']");

date.addEventListener("change", function () {
    alert("Attendance date selected: " + this.value);
});

for (let i = 1; i < rows.length; i++) {

    rows[i].addEventListener("click", function () {

        let course = this.cells[0].innerText;
        let type = this.cells[1].innerText;
        let percentage = this.cells[3].innerText;

        alert(
            "Course: " + course +
            "\nClass Type: " + type +
            "\nAttendance: " + percentage
        );
    });
}

console.log("Attendance JavaScript is working");

let form = document.querySelector("form");

if (form) {
    form.addEventListener("submit", function(event) {
        event.preventDefault();

        let name = document.getElementById("name");
        let roll = document.getElementById("roll");
        let email = document.getElementById("email");

        if (name && roll && email) {

            if (name.value === "" || roll.value === "" || email.value === "") {
                alert("Please fill all required fields.");
            } 
            else {
                alert("Feedback submitted successfully!");
                form.reset();
            }
        }
    });
}

document.getElementById("contactForm").addEventListener("submit", function(event) {

    event.preventDefault();

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let mobile = document.getElementById("mobile").value.trim();
    let subject = document.getElementById("subject").value.trim();
    let message = document.getElementById("message").value.trim();

    let formMessage = document.getElementById("formMessage");

    if (name === "" || email === "" || mobile === "" || subject === "" || message === "") {

        alert("Please fill all details");
        formMessage.style.color = "red";

    } else {

        formMessage.innerHTML = "✅ Message sent successfully!";
        formMessage.style.color = "green";

        document.getElementById("contactForm").reset();
    }
});

let registerForm = document.getElementById("registerForm");

if (registerForm) {

    registerForm.addEventListener("submit", function(event) {

        event.preventDefault();

        let name = document.getElementById("name").value.trim();
        let roll = document.getElementById("roll").value.trim();
        let email = document.getElementById("email").value.trim();
        let phone = document.getElementById("phone").value.trim();
        let semester = document.getElementById("semester").value.trim();
        let eventName = document.getElementById("event").value;
        let reason = document.getElementById("reason").value.trim();

        if (
            name === "" ||
            roll === "" ||
            email === "" ||
            phone === "" ||
            semester === "" ||
            eventName === "" ||
            reason === ""
        ) {

            alert("⚠️ Please fill all details");

        } else {

            alert("✅ Registration Successful!");

            registerForm.reset();
        }

    });

}

let feedbackForm = document.getElementById("feedbackForm");

if (feedbackForm) {

    feedbackForm.addEventListener("submit", function(event) {

        event.preventDefault();

        let name = document.getElementById("name").value.trim();
        let roll = document.getElementById("roll").value.trim();
        let email = document.getElementById("email").value.trim();

        let feedbackType = document.getElementById("feedbackType").value;

        let rating = document.querySelector(
            'input[name="rating"]:checked'
        );

        let suggestions = document.getElementById("suggestions").value.trim();
        let comments = document.getElementById("comments").value.trim();


        if (
            name === "" ||
            roll === "" ||
            email === "" ||
            feedbackType === "" ||
            !rating ||
            suggestions === "" ||
            comments === ""
        ) {

            alert("⚠️ Please fill all details");

        } else {

            alert("✅ Feedback submitted successfully!");

            feedbackForm.reset();
        }

    });

}

let resetButton = settingsForm.querySelector('input[type="reset"]');

if (resetButton) {

    resetButton.addEventListener("click", function () {

        alert("Form has been reset!");

    });

}