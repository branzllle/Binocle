<?php
session_start();
$USERNAME = 'Branzlelllllllle';
$PASSWORD = 'Branzlllllllle';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['username'] === $USERNAME && $_POST['password'] === $PASSWORD) {
    $_SESSION['logged_in'] = true;
    header('Location: admin.php');
    exit;
  } else {
    $error = "Invalid login credentials.";
  }
}
?><!DOCTYPE html>
<html><head><title>Teacher Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="container py-4"><h1 class="mb-4">Teacher Login</h1>
<?php if (isset($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
<form method="POST">
<input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
<button class="btn btn-primary">Login</button>
</form></body></html>
