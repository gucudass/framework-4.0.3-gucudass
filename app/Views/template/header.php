<?php
$aMenu = [
    '테스트1' => [
        'uri' => '/admin/test1',
        'key' => [
            'admin_test1'
        ],
        'icon' => 'info'
    ],
    '테스트2' => [
        'uri' => '/admin/test2',
        'key' => [
            'admin_test2'
        ],
        'icon' => 'info'
    ]
];

$aPath = explode('/', $_SERVER['PATH_INFO']);
array_shift($aPath);
$sUriKey = implode('_', $aPath);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/css/default.css">
    <title><?= \App\Libraries\Sc::TITLE; ?></title>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-info mb-3">
    <a class="navbar-brand" href="#">EQ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <? foreach ($aMenu as $sMenuName => $aRow) : ?>
                <li class="nav-item <? if (in_array($sUriKey, $aRow['key'])) {
                    echo 'active';
                } ?>">
                    <a class="nav-link" href="<?= $aRow['uri']; ?>"><?= $sMenuName; ?></a>
                </li>
            <? endforeach; ?>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="/sign/out">로그아웃</a>
            </li>
        </ul>
    </div>
</nav>
