let complaintsData = [];
//After database connection formed
function fetchComplaintsData() {
  fetch("fetch_complaints.php")
    .then((response) => response.json())
    .then((data) => {
      complaintsData = data;
      // Call a function to update the HTML with the fetched data
      displayComplaints();
    })
    .catch((error) => console.error("Error fetching data:", error));
}

// Call the function to fetch data when the page loads
window.addEventListener("load", fetchComplaintsData);

// Function to display complaints on the webpage
function displayComplaints() {
  const complaintsBody = document.getElementById("complaints-body");

  const modal = document.querySelector(".mod"); //for accessing the whole modal container
  const overlay = document.querySelector(".overlay"); //for accessing the overlay
  const btnCloseModal = document.querySelector(".close-modal"); //for closing the modal container
  const content = document.querySelector(".content");

  // Wrote the eventHandler functions outside for better readability.
  const openModal = (text) => {
    modal.classList.remove("hidden");
    overlay.classList.remove("hidden");
    content.textContent = text;
  };
  const closeModal = function () {
    modal.classList.add("hidden");
    overlay.classList.add("hidden");
    content.textContent = "";
  };
  // Still need to dynamically add the the descripiton of each object in the complaints array : DONE

  // LOOPING STATEMENTS ACCORDING TO NUMBER OF COMPLAINTS
  // for each complaint:
  complaintsData.forEach((complaint) => {
    const newRow = complaintsBody.insertRow(-1);

    // Insert cells with data
    const cell1 = newRow.insertCell(0);
    const cell2 = newRow.insertCell(1);
    const cell3 = newRow.insertCell(2);
    const cell4 = newRow.insertCell(3);
    const cell5 = newRow.insertCell(4);
    const cell6 = newRow.insertCell(5);
    const cell7 = newRow.insertCell(6);

    cell1.textContent = complaint.complaint_id;
    cell2.textContent = complaint.student_id;
    cell3.textContent = complaint.category;
    cell4.textContent = complaint.title;

    // Add "View Description" button
    const viewDescriptionBtn = document.createElement("button");
    viewDescriptionBtn.textContent = "View Description";
    viewDescriptionBtn.classList.add("view-description-btn");
    viewDescriptionBtn.addEventListener("click", function () {
      openModal(complaint.description);
    });
    btnCloseModal.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);
    cell5.appendChild(viewDescriptionBtn);

    // Add class for color coding based on progress

    cell7.textContent = complaint.date_submitted;

    // Add dropdown for status
    const statusDropdown = document.createElement("select");
    const options = ["Not Viewed", "In Progress", "Resolved", "Unresolved"];

    options.forEach((option) => {
      const optionElement = document.createElement("option");
      optionElement.value = option;
      optionElement.textContent = option;
      statusDropdown.appendChild(optionElement);
    });

    // Set the default selected value based on the complaint's status
    statusDropdown.value = complaint.status;

    // Add event listener to update status on change
    statusDropdown.addEventListener("change", function () {
      updateStatus(complaint.complaint_id, this.value);
    });

    // Append the dropdown to the cell
    cell6.appendChild(statusDropdown);
    cell6.classList.add(
      complaint.status === "Not Viewed" ? "not-viewed" : "in-progress"
    );
  });
}
function updateStatus(complaintId, newStatus) {
  // Send an AJAX request to update the status
  fetch("update_status.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      complaintId: complaintId,
      newStatus: newStatus,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      // Handle the response if needed
      console.log(data);
      // Refresh the complaints table after updating the status
      // fetchComplaintsData();
      location.reload();
    })
    .catch((error) => console.error("Error updating status:", error));
}
