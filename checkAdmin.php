<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['is_admin'])) {
    echo json_encode(['is_admin' => $_SESSION['is_admin']]);
} else {
    echo json_encode(['is_admin' => 0]);
}
