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