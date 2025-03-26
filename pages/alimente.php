<?php
require_once '../includes/header.php';
require_once '../includes/db.php';

// Adăugare aliment nou
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['adauga'])) {
    $denumire = $_POST['denumire'];
    $calorii = $_POST['calorii'];
    $vegan = $_POST['vegan'];
    
    execute("INSERT INTO Alimente (Denumire, Calorii, Vegan) VALUES (?, ?, ?)", [$denumire, $calorii, $vegan]);
    header("Location: alimente.php");
    exit;
}

// Ștergere aliment
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    execute("DELETE FROM Alimente WHERE idAliment = ?", [$id]);
    header("Location: alimente.php");
    exit;
}

$alimente = select("SELECT * FROM Alimente");
?>

<h2>Lista alimentelor</h2>
<table border="1" cellpadding="5">
    <tr><th>Denumire</th><th>Calorii/100g</th><th>Vegan</th><th>Acțiuni</th></tr>
    <?php foreach ($alimente as $a): ?>
        <tr>
            <td><?= htmlspecialchars($a['Denumire']) ?></td>
            <td><?= $a['Calorii'] ?></td>
            <td><?= $a['Vegan'] === 'D' ? 'Da' : 'Nu' ?></td>
            <td><a href="?delete=<?= $a['idAliment'] ?>" onclick="return confirm('Ești sigur?')">🗑️</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Adaugă aliment nou</h3>
<form method="post">
    <input type="text" name="denumire" placeholder="Denumire" required>
    <input type="number" name="calorii" placeholder="Calorii" required>
    <select name="vegan">
        <option value="D">Da</option>
        <option value="N">Nu</option>
    </select>
    <button type="submit" name="adauga">Adaugă</button>
</form>

<?php require_once '../includes/footer.php'; ?>
