<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Future Gadget Lab Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Font - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? '../styles.css' : 'styles.css'; ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? '../index.php' : 'index.php'; ?>">
                <img src="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? '../assets/logo.png' : 'assets/logo.png'; ?>" alt="Future Gadget Lab" height="30" class="me-2">Future Gadget Lab
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? 'lab_members.php' : 'view/lab_members.php'; ?>">
                            <i class="bi bi-people me-1"></i> Lab Members
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? 'gadgets.php' : 'view/gadgets.php'; ?>">
                            <i class="bi bi-tools me-1"></i> Gadgets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo (strpos($_SERVER['REQUEST_URI'], 'view') !== false) ? 'experiments.php' : 'view/experiments.php'; ?>">
                            <i class="bi bi-clipboard-data me-1"></i> Experiments
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
