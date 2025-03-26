<?php
session_start();
if (!isset($_SESSION['admin_loggedin']) || !$_SESSION['admin_loggedin']) {
    header("Location: admin_login.php");
    exit;
}

include '../loginsystem/connt_db.php';

// Handle actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM published WHERE id = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
    } 
    elseif (isset($_POST['toggle_visibility'])) {
        $stmt = $conn->prepare("UPDATE published SET visible = NOT visible WHERE id = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
    }
    elseif (isset($_FILES['journal_pdf'])) {
        // File upload handling
        $name = $_POST['name'];
        $date = $_POST['date'];
        $pdf_path = '../uploads/pdf/' . basename($_FILES['journal_pdf']['name']);
        $image_path = '../uploads/images/' . basename($_FILES['cover_image']['name']);
        
        if (move_uploaded_file($_FILES['journal_pdf']['tmp_name'], $pdf_path) &&
            move_uploaded_file($_FILES['cover_image']['tmp_name'], $image_path)) {
            
            $stmt = $conn->prepare("INSERT INTO published (name, date, image, path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $date, $image_path, $pdf_path);
            $stmt->execute();
        }
    }
}

// Get all publications
$result = $conn->query("SELECT * FROM published ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="d-flex">
                <a href="admin_logout.php" class="btn btn-light">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <!-- Upload Form -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Upload New Journal</h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Journal Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">PDF File</label>
                            <input type="file" name="journal_pdf" class="form-control" accept="application/pdf" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cover Image</label>
                            <input type="file" name="cover_image" class="form-control" accept="image/*" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Upload Journal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Journal List -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Manage Journals</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= $row['date'] ?></td>
                                <td>
                                    <span class="badge bg-<?= $row['visible'] ? 'success' : 'danger' ?>">
                                        <?= $row['visible'] ? 'Visible' : 'Hidden' ?>
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="toggle_visibility" 
                                            class="btn btn-sm btn-<?= $row['visible'] ? 'warning' : 'success' ?>">
                                            <?= $row['visible'] ? 'Hide' : 'Show' ?>
                                        </button>
                                    </form>
                                    <form method="POST" class="d-inline" 
                                        onsubmit="return confirm('Are you sure?')">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="delete" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>