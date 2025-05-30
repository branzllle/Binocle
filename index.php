<?php
$data = json_decode(file_get_contents('admin/data/journals.json'), true);
?><!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Binocle Tracker</title>
<link rel="icon" type="image/png" href="https://i.ibb.co/bgCDX0M5/x.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
<style>
body {
  background-color: #f1f5f9;
  font-family: 'Poppins', sans-serif;
}
.header-bar {
  background-color: #1A2330;
  color: #fff;
  padding: 1rem;
  border-radius: 0.5rem;
  margin-bottom: 2rem;
  text-align: center;
  font-weight: 600;
  font-size: 1.8rem;
}
.card {
  background-color: #e7f1ff;
  border: 3px solid #1A2330;
  border-radius: 1rem;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.timeline {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  padding: 0.5rem 0;
  position: relative;
  margin-top: 1rem;
}
.timeline-step {
  flex: 1;
  text-align: center;
  position: relative;
  font-size: 0.85rem;
}
.timeline-step::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 12px;
  width: 12px;
  border-radius: 50%;
  background: #ccc;
  z-index: 2;
}
.timeline-step.completed::after { background: #198754; }
.timeline::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 4px;
  background: #dee2e6;
  z-index: 1;
}
.timeline-step span {
  position: relative;
  z-index: 3;
  display: block;
  margin-top:2rem;
}
.card-body h5 {
  font-size: 1.25rem;
  font-weight: 600;
}
.card-body small {
  color: #495057;
}
footer {
  background:#1A2330;
  color:#fff;
  text-align:center;
  padding:1rem 0;
  margin-top:3rem;
  font-family: 'Poppins', sans-serif;
  border-radius: 0.5rem;
}
footer a {
  color:#0d6efd;
  text-decoration:none;
  font-weight:600;
}
</style>
</head><body class="container py-4">
<div class="header-bar d-flex align-items-center justify-content-center gap-3">
  <img src="https://i.ibb.co/bgCDX0M5/x.png" alt="Logo" style="height: 55px;">
  <h1 class="mb-0">Binocle Tracker</h1>
</div>

<div class="row row-cols-1 row-cols-md-2 g-4">
<?php foreach ($data as $student): ?>
<div class="col"><div class="card h-100"><div class="card-body">
<div class="d-flex align-items-center mb-3">
<img src="<?= $student['image'] ?>" alt="Photo" width="60" height="60" class="rounded-circle me-3 border border-2">
<div>
<h5 class="mb-1"><?= $student['name'] ?></h5>
<small>Topic: <?= $student['journal'] ?></small>
</div></div>
<div class="timeline"><?php
$steps = ['Submitted', 'Edited', 'Sent', 'Pending', 'Published'];
foreach ($steps as $step):
$status_class = array_search($step, $steps) <= array_search($student['status'], $steps) ? 'completed' : '';
?><div class="timeline-step <?= $status_class ?>"><span><?= $step ?></span></div><?php endforeach; ?></div>
</div></div></div><?php endforeach; ?>
</div>

<footer>
  <div>© Misbah 2025-26</div>
  <div>
    Developed By 
    <a href="https://badaru.is-a.dev" target="_blank" rel="noopener noreferrer">Badarudheen</a>
  </div>
</footer>

</body></html>
