<?php
        // page3.php
        session_start();

        if (!isset($_SESSION['username'])) {
            header('Location: ../../loginstaffstudent.html');
            exit();
        }
        $db = new SQLite3('../../GRSystemDB');
        $id = $_SESSION['id'];
        $username = $_SESSION['username']; // User ID stored in the session
        
        // For displaying user's username, email , phone
        $stmt = $db->prepare('SELECT username, email, phone FROM staff WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_TEXT);
        
        $result = $stmt->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 

  <title>Staff Profile</title>

  <link rel="stylesheet" href="../../css/bootstrap.min.css" />
  <link href="../../css/simple-sidebar.css" rel="stylesheet">
  <link href="staffprofile.css" rel = "stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark border-right hello" id="sidebar-wrapper">
      <div class="sidebar-heading"><b>GRSystem</b></div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-dark custom-text-white">Dashboard</a>
        <a href="#" class="list-group-item list-group-item-action bg-dark active">Profile</a>
        <a href="../ViewAllComplaints/ViewAllComplaints.html" class="list-group-item list-group-item-action bg-dark custom-text-white">View All Complaints</a>
        <a href="../AllResolvedGrievances/AllResolvedGrievances.html" class="list-group-item list-group-item-action bg-dark custom-text-white">All Resolved Greivances</a>
        <a href="../AllUnresolvedGrievances/AllUnresolvedGrievances.html" class="list-group-item list-group-item-action bg-dark custom-text-white">All Unresolved Greivances</a>
        <a href="../PasswordReset/PasswordReset.html" class="list-group-item list-group-item-action bg-dark custom-text-white">Password Reset</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
     <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Dashboard</button>

        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Profile</a>
            </li>
            <li class="nav-item">
              <a href="../../Logout.php" class="nav-link">Logout</a>
            </li>
          </ul>
        </div>
      </nav>
      <p class="welcome">Hello, <?php echo $user['username'] ?>!</p>

      <div class="container">
        <form id="profileForm">
            <h2>Your Profile</h2>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="phone">Phone:</label>
            <input type="phone" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
            <h6 id = "warning" class=""> Please enter your Phone Number</h6>


            <button class = "update-btn" type="button" onclick="updateProfile()">Update Profile</button>
        </form>
    </div>
  </div>
  <script src = "staffprofile.js"></script>

</body>

</html>


