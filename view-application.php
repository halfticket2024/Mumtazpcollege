<?php
// CSV file path
$file = "applications.csv";

// Check if file exists
if (!file_exists($file)) {
  echo "<h3>No applications found yet.</h3>";
  exit();
}

// Read file
$data = array_map("str_getcsv", file($file));
$headers = array_shift($data); // First row as headers
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Applications Viewer</title>
  <style>
    body {
      font-family: "Times New Roman", serif;
      padding: 30px;
      background: #f5f5f5;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      background: white;
      box-shadow: 0 0 5px rgba(0,0,0,0.2);
    }

    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      font-size: 14px;
    }

    th {
      background: maroon;
      color: white;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: maroon;
    }
  </style>
</head>
<body>

<h2>📄 Admission Applications - Mumtaz P.G. College</h2>

<table>
  <thead>
    <tr>
      <?php foreach ($headers as $head): ?>
        <th><?php echo htmlspecialchars($head); ?></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <?php foreach ($row as $col): ?>
          <td><?php echo htmlspecialchars($col); ?></td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</body>
</html>