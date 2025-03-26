<?php
require_once '../includes/header.php';
require_once '../includes/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Salvare persoană nouă
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adauga_persoana'])) {
    $nume = $_POST['nume'];
    $varsta = $_POST['varsta'];
    $sex = $_POST['sex'];
    $inaltime = $_POST['inaltime'];
    $greutate = $_POST['greutate'];
    $observatii = $_POST['observatii'];

    execute("INSERT INTO Persoane (NumePrenume, Varsta, Sex, Inaltime, Greutate, Observatii) VALUES (?, ?, ?, ?, ?, ?)", 
        [$nume, $varsta, $sex, $inaltime, $greutate, $observatii]);

    header("Location: persoane.php");
    exit;
}

// Ștergere persoană
if (isset($_GET['delete'])) {
    execute("DELETE FROM Persoane WHERE idPersoana = ?", [$_GET['delete']]);
    header("Location: persoane.php");
    exit;
}

$persoane = select("SELECT * FROM Persoane");
?>

<div class="container">
    <h2>Persoane</h2>

    <form method="post">
        <input type="text" name="nume" placeholder="Nume Prenume" required><br><br>
        <input type="number" name="varsta" placeholder="Vârstă" required><br><br>
        <select name="sex" required>
            <option value="F">Femeie</option>
            <option value="M">Bărbat</option>
        </select><br><br>
        <input type="number" name="inaltime" placeholder="Înălțime (cm)" required><br><br>
        <input type="number" name="greutate" placeholder="Greutate (kg)" required><br><br>
        <input type="text" name="observatii" placeholder="Observații"><br><br>
        <button type="submit" name="adauga_persoana">Adaugă persoană</button>
    </form>

    <hr>

    <h3>Lista persoanelor</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Nume</th><th>Vârstă</th><th>Sex</th><th>Înălțime</th><th>Greutate</th><th>Observații</th><th>Acțiuni</th>
        </tr>
        <?php foreach ($persoane as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['NumePrenume']) ?></td>
            <td><?= $p['Varsta'] ?></td>
            <td><?= $p['Sex'] === 'F' ? 'Femeie' : 'Bărbat' ?></td>
            <td><?= $p['Inaltime'] ?> cm</td>
            <td><?= $p['Greutate'] ?> kg</td>
            <td><?= htmlspecialchars($p['Observatii']) ?></td>
            <td><a href="?delete=<?= $p['idPersoana'] ?>" onclick="return confirm('Ștergi această persoană?')">🗑️</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
