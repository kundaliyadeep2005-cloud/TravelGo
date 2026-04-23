<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelgo Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body { background-color: #f4f6f9; overflow-x: hidden; }
        .sidebar { min-height: calc(100vh - 60px); background-color: #343a40; transition: all 0.3s; }
        .sidebar .nav-link { color: #c2c7d0; padding: 12px 20px; font-weight: 500; font-size: 1.05rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background-color: rgba(255,255,255,.1); border-radius: 6px; }
        .sidebar .nav-link i { width: 30px; text-align: center; margin-right: 10px; font-size: 1.1rem; }
        .main-content { flex: 1; padding: 25px; width: 100%; transition: all 0.3s; overflow-y: auto; height: calc(100vh - 60px); }
        .navbar-brand { font-weight: 700; letter-spacing: 1px; font-size: 1.4rem; }
        .card-stat { transition: transform 0.2s; border: none; border-radius: 12px; }
        .card-stat:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
        .icon-bg { position: absolute; right: 20px; bottom: -10px; font-size: 6rem; opacity: 0.15; transform: rotate(-15deg); }
    </style>
</head>
<body class="d-flex flex-column vh-100 overflow-hidden">
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow flex-shrink-0" style="height: 60px;">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-white" href="dashboard.php"><i class="fas fa-plane-departure text-warning me-2"></i>TravelGo Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="settings.php"><i class="fas fa-user-circle fs-5 me-1"></i> Admin</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="btn btn-danger btn-sm rounded-pill px-4 fw-bold shadow-sm" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Wrapper for Sidebar and Main Content -->
    <div class="d-flex flex-grow-1 overflow-hidden">
