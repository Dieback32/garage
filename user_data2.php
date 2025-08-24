<?php
session_start();
require 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['email'] = $_POST['email'];

    // Insert into DB
    $sql = "INSERT INTO customer_details 
            (first_name, last_name, address, city, state, phone, email) 
            VALUES (:first_name, :last_name, :address, :city, :state, :phone, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':first_name' => $_SESSION['first_name'],
        ':last_name'  => $_SESSION['last_name'],
        ':address'    => $_SESSION['address'],
        ':city'       => $_SESSION['city'],
        ':state'      => $_SESSION['state'],
        ':phone'      => $_SESSION['phone'],
        ':email'      => $_SESSION['email']
    ]);

    // Save the inserted customer ID for linking payments later
    $_SESSION['customer_id'] = $pdo->lastInsertId();
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
    <title>Step 2</title>

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
        <h2 class="mb-3">Step 2: Payment</h2>

        <div class="stepper mb-3">
            <div class="step done"></div>
            <div class="step active"></div>
            <div class="step"></div>
        </div>

        <form method="post" action="user_data3.php" class="row gy-3 gx-3">

            <div class="col-12 col-md-6 col-lg-4">
                <?php
                $stmt = $pdo->query("SELECT id, type_name FROM payment_types ORDER BY id ASC ");
                $paymentTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <label class="form-label">Card Type</label>
                <select name="card_type" class="form-control" required>
                    <option value="" disabled selected>-- Select Card Type --</option>
                    <?php foreach ($paymentTypes as $type): ?>
                        <option value="<?= $type['id'] ?>"><?= htmlspecialchars($type['type_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Card Number</label>
                <input type="text" name="card_number" class="form-control" autocomplete="off" inputmode="numeric" required>
            </div>

            <div class="col-6 col-md-4">
                <label class="form-label">Expiration (MM/YY)</label>
                <input type="text" name="exp_date" class="form-control" placeholder="MM/YY" inputmode="numeric" required>
            </div>
            <div class="col-6 col-md-3">
                <label class="form-label">CVV2</label>
                <input type="text" name="cvv" class="form-control" inputmode="numeric" required>
            </div>

            <div class="d-flex justify-content-between pt-2">
                <a href="user_data1.php" class="btn btn-outline-dark">Back</a>
                <button type="submit" class="btn btn-brand">Next</button>
            </div>

            <p class="muted mt-2 mb-0">Your card will not be charged during this demo.</p>
        </form>
    </div>
</main>
</body>
</html>
