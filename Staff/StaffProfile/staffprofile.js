const phoneInput = document.getElementById("phone");
const warning = document.getElementById("warning");
let phone = phoneInput.value;

if (phone === "") {
  warning.classList.add("alert");
  warning.classList.remove("display-none");
} else {
  warning.classList.add("display-none");
  warning.classList.remove("alert");
}

// Add an event listener to the phone input for real-time validation
phoneInput.addEventListener("input", function () {
  phone = phoneInput.value;

  if (phone === "") {
    warning.classList.add("alert");
    warning.classList.remove("display-none");
  } else {
    warning.classList.add("display-none");
    warning.classList.remove("alert");
  }
});

function updateProfile() {
  // Add logic here to handle profile update
  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var phonee = document.getElementById("phone").value;
  // Create a FormData object to send data to PHP
  var formData = new FormData();

  formData.append("username", username);
  formData.append("email", email);
  formData.append("phone", phonee);

  // Create an XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Configure it to send a POST request to your PHP file
  xhr.open("POST", "saveprofile.php", true);

  // Define the callback function to handle the response
  xhr.onreadystatechange = function () {
    // In your JavaScript callback
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        const response = JSON.parse(xhr.responseText);
        alert(response.message);
        if (response.message === "Profile updated successfully") {
          // Redirect to hello.html or any other page
          location.reload();
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

  // Send the form data
  xhr.send(formData);

  console.log("Hello");
}
