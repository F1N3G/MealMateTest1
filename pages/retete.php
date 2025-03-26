<?php
require_once '../includes/header.php';
require_once '../includes/db.php';

// Salvare rețetă nouă
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['adauga_reteta'])) {
    $denumire = $_POST['denumire'];
    $observatii = $_POST['observatii'];
    execute("INSERT INTO ReteteH (Denumire, Observatii) VALUES (?, ?)", [$denumire, $observatii]);
    header("Location: retete.php");
    exit;
}

// Ștergere rețetă
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    execute("DELETE FROM ReteteH WHERE idReteta = ?", [$id]);
    execute("DELETE FROM ReteteL WHERE idReteta = ?", [$id]); // ștergem și componentele
    header("Location: retete.php");
    exit;
}

$retete = select("SELECT * FROM ReteteH");
?>

<h2>Rețete</h2>
<table border="1" cellpadding="5">
    <tr><th>Denumire</th><th>Observații</th><th>Acțiuni</th></tr>
    <?php foreach ($retete as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['Denumire']) ?></td>
            <td><?= htmlspecialchars($r['Observatii']) ?></td>
            <td><a href="?delete=<?= $r['idReteta'] ?>" onclick="return confirm('Ștergi rețeta?')">🗑️</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Adaugă rețetă</h3>
<form method="post">
    <input type="text" name="denumire" placeholder="Nume rețetă" required>
    <input type="text" name="observatii" placeholder="Observații" required>
    <button type="submit" name="adauga_reteta">Salvează</button>
</form>

<?php require_once '../includes/footer.php'; ?>
