<<<<<<< HEAD
document.querySelector("form").addEventListener("submit", function(event)
{
    event.preventDefault();

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if(username == "Anandi" && password == "1234")
    {
        alert("Login Successful");
        window.location.href = "index.html";
    }
    else
    {
        alert("Wrong Username or Password");
    }

document.querySelector("form").addEventListener("submit", function(event)
{
    event.preventDefault();

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if(username == "Anandi" && password == "1234")
    {
        alert("Login Successful");
        window.location.href = "index.html";
    }
    else
    {
        alert("Wrong Username or Password");
    }
>>>>>>> 0b25317 (UPdate files)
});