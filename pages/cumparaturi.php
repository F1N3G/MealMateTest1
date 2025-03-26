<?php
require_once '../includes/header.php';
require_once '../includes/db.php';

// 🔐 Protecție acces
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Obținem persoanele pentru dropdown
$persoane = select("SELECT idPersoana, NumePrenume FROM Persoane");

$lista = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idPersoana = $_POST['idPersoana'];
    $dataStart = $_POST['dataStart'];
    $dataEnd = $_POST['dataEnd'];

    // Interogare JOIN pentru a aduce alimentele + cantitățile
    $sql = "
        SELECT A.Denumire, SUM(RL.Cantitate) AS TotalCantitate
        FROM PlanAlimentar PA
        JOIN ReteteL RL ON PA.idReteta = RL.idReteta
        JOIN Alimente A ON RL.idAliment = A.idAliment
        WHERE PA.idPersoana = ? AND PA.Data BETWEEN ? AND ?
        GROUP BY A.Denumire
        ORDER BY A.Denumire
    ";

    $lista = select($sql, [$idPersoana, $dataStart, $dataEnd]);
}
?>

<div class="container">
    <h2>Listă de cumpărături</h2>

    <form method="post">
        <label>Persoană:</label><br>
        <select name="idPersoana" required>
            <?php foreach ($persoane as $p): ?>
                <option value="<?= $p['idPersoana'] ?>"><?= htmlspecialchars($p['NumePrenume']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>De la data:</label><br>
        <input type="date" name="dataStart" required><br><br>

        <label>Până la data:</label><br>
        <input type="date" name="dataEnd" required><br><br>

        <button type="submit">Generează lista</button>
    </form>

    <?php if (!empty($lista)): ?>
        <h3>Rezultate:</h3>
        <table border="1" cellpadding="5">
            <tr><th>Aliment</th><th>Cantitate totală (g)</th></tr>
            <?php foreach ($lista as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['Denumire']) ?></td>
                    <td><?= $item['TotalCantitate'] ?> g</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>
