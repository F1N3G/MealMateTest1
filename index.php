<?php
// index.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('config/database.php');
require_once('includes/header.php');

// logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<div class="container">
    <?php if (isset($_SESSION['user'])): ?>
        <h1>Bine ai revenit, <?= htmlspecialchars($_SESSION['user']['NumePrenume']) ?>!</h1>
        <p>Poți accesa <a href="pages/dashboard.php">Dashboard-ul</a> pentru a gestiona aplicația.</p>
    <?php else: ?>
        <h1>Bine ai venit în MealMate!</h1>
        <p>Aplicație de planificare a dietei. Autentifică-te pentru a începe.</p>
        <a href="pages/login.php"><button>Autentificare</button></a>
    <?php endif; ?>
</div>

<?php require_once('includes/footer.php'); ?>
