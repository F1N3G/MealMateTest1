<?php
require_once '../includes/header.php';
require_once '../includes/db.php';

// 🔐 Protecție acces
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Adăugare plan alimentar
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['adauga_plan'])) {
    $idPersoana = $_POST['idPersoana'];
    $idReteta = $_POST['idReteta'];
    $data = $_POST['data'];
    $tipMasa = $_POST['tipMasa'];
    $observatii = $_POST['observatii'];

    execute("INSERT INTO PlanAlimentar (idPersoana, idReteta, Data, TipMasa, Observatii) VALUES (?, ?, ?, ?, ?)", 
        [$idPersoana, $idReteta, $data, $tipMasa, $observatii]);

    header("Location: plan_alimentar.php");
    exit;
}

// Date pentru dropdown-uri
$persoane = select("SELECT idPersoana, NumePrenume FROM Persoane");
$retete = select("SELECT idReteta, Denumire FROM ReteteH");

// Planuri existente
$planuri = select("SELECT PA.*, P.NumePrenume, R.Denumire AS NumeReteta
                   FROM PlanAlimentar PA
                   JOIN Persoane P ON PA.idPersoana = P.idPersoana
                   JOIN ReteteH R ON PA.idReteta = R.idReteta
                   ORDER BY PA.Data DESC");
?>

<div class="container">
    <h2>Planificare masă</h2>

    <form method="post">
        <label>Persoană:</label><br>
        <select name="idPersoana" required>
            <?php foreach ($persoane as $p): ?>
                <option value="<?= $p['idPersoana'] ?>"><?= htmlspecialchars($p['NumePrenume']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Dată:</label><br>
        <input type="date" name="data" required><br><br>

        <label>Tip masă:</label><br>
        <select name="tipMasa" required>
            <option value="M">Mic dejun</option>
            <option value="P">Prânz</option>
            <option value="C">Cină</option>
        </select><br><br>

        <label>Rețetă:</label><br>
        <select name="idReteta" required>
            <?php foreach ($retete as $r): ?>
                <option value="<?= $r['idReteta'] ?>"><?= htmlspecialchars($r['Denumire']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Observații:</label><br>
        <input type="text" name="observatii"><br><br>

        <button type="submit" name="adauga_plan">Salvează planul</button>
    </form>

    <hr>

    <h3>Planuri alimentare existente</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Persoană</th>
            <th>Dată</th>
            <th>Masă</th>
            <th>Rețetă</th>
            <th>Observații</th>
        </tr>
        <?php foreach ($planuri as $plan): ?>
            <tr>
                <td><?= htmlspecialchars($plan['NumePrenume']) ?></td>
                <td><?= $plan['Data'] ?></td>
                <td><?= $plan['TipMasa'] === 'M' ? 'Mic dejun' : ($plan['TipMasa'] === 'P' ? 'Prânz' : 'Cină') ?></td>
                <td><?= htmlspecialchars($plan['NumeReteta']) ?></td>
                <td><?= htmlspecialchars($plan['Observatii']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
