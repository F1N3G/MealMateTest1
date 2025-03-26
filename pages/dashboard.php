<?php
require_once '../includes/header.php';
require_once '../includes/db.php';

// Protecție acces
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Preluare statistici cu fallback la 0 dacă nu există rezultate
function getTotal($sql) {
    $result = select($sql);
    return $result ? (int)$result[0]['total'] : 0;
}

$nrAlimente = getTotal("SELECT COUNT(*) as total FROM Alimente");
$nrRetete   = getTotal("SELECT COUNT(*) as total FROM ReteteH");
$nrPersoane = getTotal("SELECT COUNT(*) as total FROM Persoane");
$nrPlanuri  = getTotal("SELECT COUNT(*) as total FROM PlanAlimentar");
?>

<div class="container">
    <h2>Dashboard</h2>
    <p>Bine ai venit, <strong><?= htmlspecialchars($_SESSION['user']['NumePrenume']) ?></strong>!</p>

    <div class="card">
        <p><strong><?= $nrAlimente ?></strong> alimente înregistrate</p>
        <p><strong><?= $nrRetete ?></strong> rețete disponibile</p>
        <p><strong><?= $nrPersoane ?></strong> persoane în sistem</p>
        <p><strong><?= $nrPlanuri ?></strong> planuri alimentare create</p>
    </div>

    <hr>
    <h3>Linkuri rapide</h3>
    <ul>
        <li><a href="alimente.php">📦 Gestionează alimente</a></li>
        <li><a href="retete.php">📖 Gestionează rețete</a></li>
        <li><a href="plan_alimentar.php">🗓️ Planificare mese</a></li>
        <li><a href="cumparaturi.php">🛒 Listă de cumpărături</a></li>
    </ul>
</div>

<?php require_once '../includes/footer.php'; ?>
