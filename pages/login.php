<?php
include('../config/database.php');
session_start();

$mesaj = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $parola = $_POST['parola'];

    $sql = "SELECT * FROM operatori WHERE Operator = ? AND Parola = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $parola]);

    if ($stmt->rowCount() === 1) {
        $_SESSION['user'] = $stmt->fetch();
        header("Location: ../index.php");
        exit;
    } else {
        $mesaj = "Utilizator sau parolă incorectă.";
    }
}
?>

<?php include('../includes/header.php'); ?>

<div class="container">
    <h2>Autentificare Operator</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Nume utilizator" required><br><br>
        <input type="password" name="parola" placeholder="Parola" required><br><br>
        <button type="submit">Autentificare</button>
    </form>
    <?php if ($mesaj): ?>
        <p style="color:red;"><?= $mesaj ?></p>
    <?php endif; ?>
</div>

<?php include('../includes/footer.php'); ?>
