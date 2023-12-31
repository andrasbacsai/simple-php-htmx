<?php
session_start();
$users = [
    'id' => 1,
    'user' => 'admin',
    'password' => '123',
];
if ($_SERVER['REQUEST_URI'] == '/') {
    include('login.php');
    exit;
}
if ($_SERVER['REQUEST_URI'] == '/about') {
    if (!isset($_SESSION['user'])) {
        $_SESSION['error'] = 'You must be logged in to view this page';
        header('Refresh: 0; url=/');
        exit;
    }
    include('about.php');
    exit;
}
if ($_SERVER['REQUEST_URI'] == '/api/user') {
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($_SESSION['user']);
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        session_destroy();
        header('HX-Refresh: true');
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        header('Content-Type: application/json; charset=utf-8');
        $user = $_POST['user'];
        $password = $_POST['password'];
        if (!isset($user) || !isset($password)) {
            $_SESSION['error'] = 'Invalid username or password';
            header('HX-Refresh: true');
            exit;
        }
        if ($user == $users['user'] && $password == $users['password']) {
            $_SESSION['user'] = $users;
            header('HX-Redirect: /about');
            exit;

        } else {
            $_SESSION['error'] = 'Invalid username or password';
            header('HX-Refresh: true');
            exit;
        }
    }
 }
?>