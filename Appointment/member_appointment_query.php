<?php
session_start();
require_once 'dbconn.php';

if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $appoId = $_POST['appo_id'];
    $name = $_POST['name'];
    $petName = $_POST['pet_name'];
    $breed = $_POST['breed'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $message = $_POST['message'];

    // Perform the update operation here
    $query = "UPDATE appointments SET name = :name, pet_name = :petName, breed = :breed, phone = :phone, email = :email, appointment_date = :appointmentDate, appointment_time = :appointmentTime, message = :message WHERE appo_id = :appoId";
    $statement = $appointmentsConnection->prepare($query);
    $statement->bindValue(":name", $name);
    $statement->bindValue(":petName", $petName);
    $statement->bindValue(":breed", $breed);
    $statement->bindValue(":phone", $phone);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":appointmentDate", $appointmentDate);
    $statement->bindValue(":appointmentTime", $appointmentTime);
    $statement->bindValue(":message", $message);
    $statement->bindValue(":appoId", $appoId);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        header("Location: member_appointment.php");
        exit();
    } else {
        echo "<script>alert('Failed to Update Appointment');</script>";
    }
} elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $appoId = $_POST['appo_id'];

    // Perform the delete operation here
    $query = "DELETE FROM appointments WHERE appo_id = :appoId";
    $statement = $appointmentsConnection->prepare($query);
    $statement->bindValue(":appoId", $appoId);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        header("Location: member_appointment.php");
        exit();
    } else {
        echo "<script>alert('Failed to Delete Appointment');</script>";
    }
} elseif (isset($_POST['action']) && $_POST['action'] === 'insert') {
    $name = $_POST['name'];
    $petName = $_POST['pet_name'];
    $breed = $_POST['breed'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $message = $_POST['message'];

    // Perform the insert operation here
    $query = "INSERT INTO appointments (mem_id, name, pet_name, breed, phone, email, appointment_date, appointment_time, message) VALUES (:memId, :name, :petName, :breed, :phone, :email, :appointmentDate, :appointmentTime, :message)";
    $statement = $appointmentsConnection->prepare($query);
    $statement->bindValue(":memId", $_SESSION['mem_id']);
    $statement->bindValue(":name", $name);
    $statement->bindValue(":petName", $petName);
    $statement->bindValue(":breed", $breed);
    $statement->bindValue(":phone", $phone);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":appointmentDate", $appointmentDate);
    $statement->bindValue(":appointmentTime", $appointmentTime);
    $statement->bindValue(":message", $message);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        header("Location: member_appointment.php");
        exit();
    } else {
        echo "<script>alert('Failed to Insert Appointment');</script>";
    }
}
?>

