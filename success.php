<?php
session_start();

// Check if session data exists; if not, redirect to the form page
if (!isset($_SESSION['appointment'])) {
    header("Location: index.html");
    exit;
}

// Retrieve appointment data from the session
$appointment = $_SESSION['appointment'];

// Clear the session data after retrieving it
unset($_SESSION['appointment']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Appointment Confirmation</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($appointment['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($appointment['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($appointment['phone']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($appointment['gender']); ?></p>
        <p><strong>Appointment Date:</strong> <?php echo htmlspecialchars($appointment['date']); ?></p>
        <p><strong>Appointment Time:</strong> <?php echo htmlspecialchars($appointment['time']); ?></p>
        <p><strong>Doctor:</strong> <?php echo htmlspecialchars($appointment['doctor']); ?></p>
        <p><strong>Symptoms:</strong> <?php echo htmlspecialchars($appointment['symptoms']); ?></p>
        <p><strong>Message:</strong> <?php echo htmlspecialchars($appointment['message']); ?></p>
        <p><strong>Follow-up Appointment:</strong> <?php echo htmlspecialchars($appointment['follow_up']); ?></p>
        <a href="index.html"><button>Book Another Appointment</button></a>
    </div>
</body>
</html>
