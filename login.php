<?php
// pages/login.php
require_once('../config/database.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mesaj = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $parola = trim($_POST['parola']);

    $sql = "SELECT * FROM operatori WHERE Operator = ? AND Parola = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $parola]);

    if ($stmt->rowCount() === 1) {
        $_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Location: ../index.php");
        exit;
    } else {
        $mesaj = "Utilizator sau parolă incorectă.";
    }
}

require_once('../includes/header.php');
?>

<div class="container">
    <h2>Autentificare Operator</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Nume utilizator" required><br><br>
        <input type="password" name="parola" placeholder="Parola" required><br><br>
        <button type="submit">Autentificare</button>
    </form>
    <?php if (!empty($mesaj)): ?>
        <p style="color:red;"><?= htmlspecialchars($mesaj) ?></p>
    <?php endif; ?>
</div>

<?php require_once('../includes/footer.php'); ?>
