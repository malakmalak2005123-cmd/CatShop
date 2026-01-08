<?php
include "configue.php"; 

// Lazy migration: Add status column if not exists
try {
    $pdo->query("SELECT status FROM adopted LIMIT 1");
} catch (Exception $e) {
    try {
        $pdo->query("ALTER TABLE adopted ADD COLUMN status VARCHAR(50) DEFAULT 'En attente'");
    } catch (Exception $e2) {
        // Column might exist or error, ignore
    }
}

$sql = "
SELECT
    adopted.id AS adoption_id,
    adopted.fullname AS client_name,
    adopted.cin,
    adopted.email AS client_email,
    adopted.phone AS client_phone,
    adopted.address AS client_address,
    adopted.status AS order_status,
    produits.id AS cat_id,
    produits.name AS cat_name,
    produits.age AS cat_age,
    produits.sexe AS cat_sexe,
    produits.image AS cat_image,
    produits.description_courte AS cat_description,
    produits.caracteristiques AS cat_caracteristiques,
    produits.prix AS cat_prix,
    produits.Type AS cat_type,
    produits.user_id AS owner_id
FROM adopted
JOIN produits ON adopted.cat_id = produits.id
ORDER BY adopted.created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin – Orders</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
        /* Specific adjustments for the orders table */
        table {
            font-size: 0.9em;
        }
        th, td {
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }
        .cat-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .cat-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #b2dfdb;
        }
        .status-badge {
            background-color: #e0f2f1;
            color: #00695c;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            font-weight: 600;
        }
        .client-info strong {
            display: block;
            color: #2c3e50;
        }
        .client-info span {
            color: #7f8c8d;
            font-size: 0.9em;
        }
        .btn-confirm {
            display: inline-block;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8em;
            box-shadow: 0 4px 6px rgba(52, 152, 219, 0.2);
            transition: all 0.3s ease;
            margin-bottom: 5px;
        }
        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(52, 152, 219, 0.3);
        }

        .btn-deliver {
            display: inline-block;
            background: linear-gradient(135deg, #2c3e50 0%, #000000 100%);
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8em;
            box-shadow: 0 4px 6px rgba(44, 62, 80, 0.2);
            transition: all 0.3s ease;
        }
        .btn-deliver:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(44, 62, 80, 0.3);
            background: #000;
        }

/* Actions Column Specifics */
td:last-child {
    white-space: nowrap;
    width: 1%; /* Shrink to fit content */
}

.actions-row {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 8px; /* Slightly reduced gap */
}

/* Compact Buttons for Table */
.btn-confirm, .btn-cancel, .btn-deliver {
    padding: 6px 10px; /* Reduced padding */
    font-size: 0.75em; /* Smaller font */
    white-space: nowrap;
    margin-bottom: 0 !important; /* Force no bottom margin */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 32px; /* Fixed height for consistency */
}

.status-text {
    font-weight: bold;
    display: block;
    margin-bottom: 0;
}
        .status-confirme { color: #27ae60; }
        .status-attente { color: #f39c12; }
    </style>
</head>
<body>



<div class="container" style="margin-top: 100px;"> <!-- Margin for fixed navbar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1>📦 Adoption Orders</h1>
        <a href="admin.php" class="btn-add" style="background: #78909c; margin-bottom: 0;">← Return to Dashboard</a>
    </div>

    <?php
    // Group orders by CIN
    $groupedOrders = [];
    foreach($orders as $o) {
        $cin = $o['cin'];
        if(!$cin) continue; 
        if(!isset($groupedOrders[$cin])) {
            $groupedOrders[$cin] = [
                'client_name' => $o['client_name'],
                'client_email' => $o['client_email'],
                'client_phone' => $o['client_phone'],
                'client_address' => $o['client_address'],
                'cin' => $o['cin'],
                'items' => []
            ];
        }
        $groupedOrders[$cin]['items'][] = $o;
    }
    ?>

    <?php if (count($groupedOrders) > 0): ?>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th style="width: 20%;">Client</th>
                        <th style="width: 20%;">Contact</th>
                        <th style="width: 60%;">Adoption Requests</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($groupedOrders as $cin => $client): ?>
                    <tr>
                        <td style="vertical-align: top;">
                            <div class="client-info">
                                <strong><?= htmlspecialchars($client['client_name']) ?></strong>
                                <span>CIN: <?= htmlspecialchars($client['cin']) ?></span>
                            </div>
                        </td>
                        <td style="vertical-align: top;">
                            <div class="client-info">
                                <strong><?= htmlspecialchars($client['client_email']) ?></strong>
                                <span><?= htmlspecialchars($client['client_phone']) ?></span>
                                <br><small><?= htmlspecialchars($client['client_address']) ?></small>
                            </div>
                        </td>
                        <td style="padding: 0;">
                            <!-- Nested Table for Products -->
                            <table style="width: 100%; border: none; margin: 0; background: transparent;">
                                <?php foreach($client['items'] as $item): ?>
                                <tr style="background: transparent; border-bottom: 1px solid #eee;">
                                    <td style="width: 30%; border: none; padding: 8px;">
                                        <div class="cat-info">
                                            <img src="image/<?= htmlspecialchars($item['cat_image']) ?>" alt="Cat" style="width: 40px; height: 40px;">
                                            <div>
                                                <strong><?= htmlspecialchars($item['cat_name']) ?></strong>
                                                <br><small><?= htmlspecialchars($item['cat_type']) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 20%; border: none; padding: 8px;">
                                        <small>
                                            <strong>Age:</strong> <?= htmlspecialchars($item['cat_age']) ?><br>
                                            <strong>Sex:</strong> <?= htmlspecialchars($item['cat_sexe']) ?>
                                        </small>
                                    </td>
                                    <td style="width: 20%; border: none; padding: 8px;">
                                       <?php 
                                            $status = $item['order_status'] ?? 'En attente'; 
                                            $statusClass = ($status == 'Confirme') ? 'status-confirme' : 'status-attente';
                                            $displayStatus = ($status == 'Confirme') ? 'Confirmed' : 'Pending';
                                            if($status == 'En attente') $displayStatus = 'Pending';
                                       ?>
                                       <span class="status-text <?= $statusClass ?>" style="font-size: 0.85em;"><?= htmlspecialchars($displayStatus) ?></span>
                                    </td>
                                    <td style="width: 30%; border: none; padding: 8px;">
                                        <div class="actions-row">
                                            <?php if($status != 'Confirme'): ?>
                                                <a href="confirmer.php?id=<?= $item['adoption_id'] ?>" class="btn-confirm">
                                                    ✔ Use
                                                </a>
                                            <?php else: ?>
                                                <a href="annuler.php?id=<?= $item['adoption_id'] ?>" class="btn-cancel" onclick="return confirm('Cancel reservation?');">
                                                    ↺ Cancel
                                                </a>
                                            <?php endif; ?>

                                            <a href="livrer.php?id=<?= $item['cat_id'] ?>" class="btn-deliver" onclick="return confirm('Mark as Delivered? \nThis will PERMANENTLY DELETE the product.');">
                                                🚚 Delivered
                                            </a>
                                            
                                            <a href="delete_order.php?id=<?= $item['adoption_id'] ?>" class="btn-delete" onclick="return confirm('Delete this request?');" style="background: #e74c3c; color: white; padding: 6px 10px; border-radius: 6px; text-decoration: none; font-size: 0.75em; display: inline-flex; align-items: center; white-space: nowrap;">
                                                🗑 Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 50px; color: #78909c;">
            <p>No adoption requests at the moment.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
