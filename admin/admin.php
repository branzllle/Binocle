<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit;
}

$data = json_decode(file_get_contents('data/journals.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $data[] = [
            'name' => $_POST['name'],
            'image' => $_POST['image'],
            'journal' => $_POST['journal'],
            'status' => 'Submitted'
        ];
    } elseif (isset($_POST['update'])) {
        $index = $_POST['index'];
        $data[$index]['name'] = $_POST['name'];
        $data[$index]['image'] = $_POST['image'];
        $data[$index]['journal'] = $_POST['journal'];
        $data[$index]['status'] = $_POST['status'];
    } elseif (isset($_POST['delete'])) {
        $index = $_POST['index'];
        array_splice($data, $index, 1);
    }

    file_put_contents('data/journals.json', json_encode($data, JSON_PRETTY_PRINT));
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
.bg-info {
  background-color: #1A2330 !important;
  color: white;
}
</style>

</head>
<body class="container py-4">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 px-3 rounded">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <div class="ms-auto">
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
</nav>

<div class="card mb-4 shadow-sm">
    <div class="card-header bg-success text-white">Add New Student</div>
    <div class="card-body">
        <form method="POST">
            <div class="row g-2">
                <div class="col-md-4"><input name="name" class="form-control" placeholder="Enter Name  of the Student" required></div>
                <div class="col-md-4"><input name="image" class="form-control" placeholder="Student's Image URL"></div>
                <div class="col-md-4"><input name="journal" class="form-control" placeholder="Enter The Topic" required></div>
                <div class="col-md-12 mt-2">
                    <button type="submit" name="add" class="btn btn-primary">Add Student</button>
                </div>
            </div>
        </form>
    </div>
</div>
  

<?php foreach ($data as $index => $entry): ?>
<div class="card mb-3">
    <div class="card-header bg-info bg- text-white"><?= htmlspecialchars($entry['name']) ?></div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="index" value="<?= $index ?>">
            <div class="row g-2">
                <div class="col-md-3"><input name="name" class="form-control" value="<?= htmlspecialchars($entry['name']) ?>"></div>
                <div class="col-md-3"><input name="image" class="form-control" value="<?= htmlspecialchars($entry['image']) ?>"></div>
                <div class="col-md-4"><input name="journal" class="form-control" value="<?= htmlspecialchars($entry['journal']) ?>"></div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option <?= $entry['status'] === 'Submitted' ? 'selected' : '' ?>>Submitted</option>
                        <option <?= $entry['status'] === 'Edited' ? 'selected' : '' ?>>Edited</option>
                        <option <?= $entry['status'] === 'Sent' ? 'selected' : '' ?>>Sent</option>
                        <option <?= $entry['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option <?= $entry['status'] === 'Published' ? 'selected' : '' ?>>Published</option>
                    </select>
                </div>
                <div class="col-md-12 mt-2 d-flex gap-2">
                    <button type="submit" name="update" class="btn btn-success">✔</button>
                    <button type="submit" name="delete" class="btn btn-danger">✖</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endforeach; ?>

</body>
</html>
