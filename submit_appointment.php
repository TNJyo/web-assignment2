<?php
session_start(); // Start the session

// Database connection variables
$host = 'localhost';
$dbname = 'healthcare';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $gender = htmlspecialchars($_POST['gender']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $doctor = htmlspecialchars($_POST['doctor']);
    $message = htmlspecialchars($_POST['message']);
    $follow_up = isset($_POST['follow_up']) ? 'Yes' : 'No';
    $symptoms = isset($_POST['symptoms']) ? implode(', ', $_POST['symptoms']) : 'None';

    $sql = "INSERT INTO appointments (name, email, phone, gender, appointment_date, appointment_time, doctor, symptoms, message, follow_up)
            VALUES (:name, :email, :phone, :gender, :appointment_date, :appointment_time, :doctor, :symptoms, :message, :follow_up)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':gender' => $gender,
        ':appointment_date' => $date,
        ':appointment_time' => $time,
        ':doctor' => $doctor,
        ':symptoms' => $symptoms,
        ':message' => $message,
        ':follow_up' => $follow_up
    ])) {
        // Store form data in the session
        $_SESSION['appointment'] = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'gender' => $gender,
            'date' => $date,
            'time' => $time,
            'doctor' => $doctor,
            'symptoms' => $symptoms,
            'message' => $message,
            'follow_up' => $follow_up
        ];

        // Redirect to success.php
        header("Location: success.php");
        exit;
    } else {
        echo "An error occurred while submitting your appointment. Please try again.";
    }
}
?>
