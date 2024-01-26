function validateForm(event) {
  event.preventDefault();

  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirmPassword").value;

  if (password !== confirmPassword) {
    alert("Passwords do not match");
  } else {
    alert("Registration successful!");
    var id = document.getElementById("id").value;
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var registrationType = document.getElementById("registrationType").value;
    // Create a FormData object to send data to PHP
    var formData = new FormData();
    formData.append("id", id);
    formData.append("username", username);
    formData.append("email", email);
    formData.append("password", password);
    formData.append("registrationType", registrationType);

    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure it to send a POST request to your PHP file
    xhr.open("POST", "registration.php", true);

    // Define the callback function to handle the response
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Redirect to hello.html after successful submission
        window.location.href = "../loginstaffstudent.html";
      }
    };

    // Send the form data
    xhr.send(formData);

    // Add code here to send data to the server or perform other actions
  }
}
