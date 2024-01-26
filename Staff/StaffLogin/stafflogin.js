function login() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  var formData = new FormData();

  formData.append("username", username);
  formData.append("password", password);

  // Create an XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Configure it to send a POST request to your PHP file
  xhr.open("POST", "stafflogin.php", true);

  // Define the callback function to handle the response
  xhr.onreadystatechange = function () {
    // In your JavaScript callback
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        const response = JSON.parse(xhr.responseText);
        if (response.message === "Invalid Credentials!") {
          // Reload current page
          alert(response.message);
          location.reload();
        } else if (response.message === "Succesfully logged in!") {
          window.location = "../StaffProfile/StaffProfile.php";
        }
      } else {
        alert(
          "Problem occurred! Status: " +
            xhr.status +
            ", Response: " +
            xhr.responseText
        );
      }
    }
  };

  // Send the form data to the php file
  xhr.send(formData);
}
var loginbtn = document.getElementById("login");
loginbtn.addEventListener("click", login);
