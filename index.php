<?php
session_start();

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {
    case '/':
    case '/home':
        include 'pages/home.php';
        break;
    case '/about':
        include 'pages/about.php';
        break;
    case '/contact':
        include 'pages/contact.php';
        break;
    case '/login':
        include 'pages/login.php';
        break;
    case '/logout':
        include 'pages/logout.php';
        break;
    case '/add-event':
        include 'pages/add-event.php';
        break;
    case '/add-image':
        include 'pages/add-image.php';
        break;
    case '/add-product':
        include 'pages/add-product.php';
        break;
    case '/all-events':
        include 'pages/all-events.php';
        break;
    case '/all-events':
        include 'pages/all-events.php';
        break;
    case '/all-images':
        include 'pages/all-images.php';
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}

?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Dusun Tegalsari</title>
</head>