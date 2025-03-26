<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>MealMate</title>
    <link rel="stylesheet" href="/MealMateTest1/assets/style.css">
</head>
<body>
    <header>
        <h2>MealMate</h2>
        <nav>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/MealMateTest1/pages/dashboard.php">Dashboard</a>
                <a href="/MealMateTest1/pages/alimente.php">Alimente</a>
                <a href="/MealMateTest1/pages/retete.php">Rețete</a>
                <a href="/MealMateTest1/pages/plan_alimentar.php">Plan alimentar</a>
                <a href="/MealMateTest1/pages/cumparaturi.php">Cumpărături</a>
                <a href="/MealMateTest1/index.php?logout=1">Logout</a>
            <?php else: ?>
                <a href="/MealMateTest1/index.php">Acasă</a>
                <a href="/MealMateTest1/pages/login.php">Login</a>
            <?php endif; ?>
        </nav>
    </header>
