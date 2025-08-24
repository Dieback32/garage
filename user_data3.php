<?php
session_start();
require 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['card_type'] = $_POST['card_type'];
    $_SESSION['card_number'] = $_POST['card_number'];
    $_SESSION['exp_date'] = $_POST['exp_date'];
    $_SESSION['cvv'] = $_POST['cvv'];

    if (!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id'])) {
        die("Error: Customer ID not set. Please complete step 1 first.");
    }

    // Insert into payment_details
    $sql = "INSERT INTO payment_details (card_type, card_number, card_exp_date, cvv, customer_id) 
        VALUES (:card_type, :card_number, :card_exp_date, :cvv, :customer_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':card_type'     => $_SESSION['card_type'],
        ':card_number'   => $_SESSION['card_number'],
        ':card_exp_date' => $_SESSION['exp_date'],
        ':cvv'           => $_SESSION['cvv'],
        ':customer_id'   => $_SESSION['customer_id']
    ]);

    $_SESSION['payment_id'] = $pdo->lastInsertId();



}

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Step 3</title>
</head>
<body>
<header class="header-bar">
    <nav class="navbar navbar-expand-lg container">
        <a class="navbar-brand" href="#">PHP TEST</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="subbar"></div>
</header>
    <main class="container my-4">
        <div class="checkout-card">
            <h2 class="mb-3">Step 3: Review</h2>

            <div class="stepper mb-3">
                <div class="step done"></div>
                <div class="step done"></div>
                <div class="step active"></div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <h5 class="label-uc mb-2">Customer</h5>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Name:</strong> <?= htmlspecialchars($_SESSION['first_name'].' '.$_SESSION['last_name']) ?></li>
                        <li><strong>Address:</strong> <?= htmlspecialchars($_SESSION['address'].', '.$_SESSION['city'].', '.$_SESSION['state']) ?></li>
                        <li><strong>Phone:</strong> <?= htmlspecialchars($_SESSION['phone']) ?></li>
                        <li><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h5 class="label-uc mb-2">Payment</h5>
                    <?php
                    if (isset($_SESSION['card_type'])) {
                        $stmt = $pdo->prepare("SELECT type_name FROM payment_types WHERE id = :id");
                        $stmt->execute(['id' => $_SESSION['card_type']]);
                        $cardType = $stmt->fetchColumn(); // fetch only the type_name
                    } else {
                        $cardType = "Unknown";
                    }
                    ?>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Type:</strong> <?= htmlspecialchars($cardType) ?></li>
                        <li><strong>Card #:</strong> <?= htmlspecialchars($_SESSION['card_number']) ?></li>
                        <li><strong>Expires:</strong> <?= htmlspecialchars($_SESSION['exp_date']) ?></li>
                        <li><strong>CVV2:</strong> <?= htmlspecialchars($_SESSION['cvv']) ?></li>
                    </ul>
                </div>
            </div>

            <div class="d-flex justify-content-between pt-3">
                <a href="user_data2.php.php" class="btn btn-outline-dark">Back</a>
                <button class="btn btn-brand">Confirm</button>
            </div>
        </div>
    </main>
</body>
</html>
