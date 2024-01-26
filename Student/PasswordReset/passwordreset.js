document.querySelector(".btn-reset").addEventListener("click", function () {
  var newPassword = document.getElementById("newPassword").value;
  var confirmNewPassword = document.getElementById("confirmNewPassword").value;
  var oldPassword = document.getElementById("oldPassword").value;
  console.log(newPassword, confirmNewPassword);

  // Check if the passwords match
  if (newPassword !== confirmNewPassword) {
    alert("New passwords do not match. Please enter matching passwords.");
  } else {
    var formData = new FormData();
    formData.append("oldpassword", oldPassword);
    formData.append("newpassword", newPassword);
    var xhr = new XMLHttpRequest();

    // Configure it to send a POST request to your PHP file
    xhr.open("POST", "passwordreset.php", true);

    // callback function to handle the response
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          console.log(xhr.responseText);
          const response = JSON.parse(xhr.responseText); //parse the json encoded response from the php file
          alert(response.message);
          if (response.message === "Password was reset successfully!") {
            // alert("Password was reset successfully!");
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
    xhr.send(formData); // sends data to the php file
  }
});
