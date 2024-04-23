<!doctype HTML>
<html>
<head>
    <title>Shopping site: <?= $pageTitle ?></title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link
        href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>@import '/css/products.css'</style>
</head>
<body class="container ">
<nav>
    <ul>
        <li>
            <a href="/">
                List of Products
            </a>
        </li>
        <li>
            <a href="/?action=cart">
                Shopping Cart
            </a>
        </li>
    </ul>
</nav>

<h1><?= $pageTitle ?></h1>

<?php
