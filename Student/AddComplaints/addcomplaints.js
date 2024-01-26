const textarea = document.getElementById("description");
const charCount = document.getElementById("charCount");
const maxLength = 1000;

textarea.addEventListener("input", function () {
  const remainingChars = maxLength - textarea.value.length;
  charCount.textContent = `Characters remaining: ${remainingChars}`;

  // Truncate the content if it exceeds the maximum length
  if (textarea.value.length > maxLength) {
    textarea.value = textarea.value.substring(0, maxLength);
  }
});
function submitGreivance() {
  console.log("Hello");

  // Add logic here to handle profile update
  var category = document.getElementById("category").value;
  var title = document.getElementById("title").value;
  var description = document.getElementById("description").value;
  // Create a FormData object to send data to PHP
  var formData = new FormData();

  formData.append("category", category);
  formData.append("title", title);
  formData.append("description", description);

  // Create an XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Configure it to send a POST request to your PHP file
  xhr.open("POST", "addcomplaints.php", true);

  // Define the callback function to handle the response
  xhr.onreadystatechange = function () {
    // In your JavaScript callback
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        console.log(xhr.responseText);
        const response = JSON.parse(xhr.responseText);
        alert(response.message);
        if (response.message === "Succesfully added complaint") {
          // window.location.href = "/AddComplaints/addcomplaints.html";
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
  console.log("Okk");
}
