<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Step 1</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

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
        <h2 class="mb-3">Step 1: Customer Details</h2>

        <!-- progress -->
        <div class="stepper mb-3">
            <div class="step active"></div>
            <div class="step"></div>
            <div class="step"></div>
        </div>

        <form method="post" action="user_data2.php" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">State</label>
                <input type="text" name="state" maxlength="2" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="d-flex justify-content-end gap-2 pt-2">
                <button type="submit" class="btn btn-brand">Next</button>
            </div>
            <p class="muted mt-2 mb-0">Secure & Private — we won’t share your info.</p>
        </form>
    </div>
</main>
</body>
</html>
