<!DOCTYPE html>
<html lang="de" class="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopware Plentyconnector PSC7-Helper</title>
    <meta name="description" content="Dashboard">
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="{link file="backend/_resources/images/favicon.png"}">
    <link rel="apple-touch-icon" href="{link file="backend/_resources/images/apple-touch-icon.png"}">
    <link rel="stylesheet" href="{link file="backend/_resources/components/bootstrap/dist/css/bootstrap.min.css"}">
    <link rel="stylesheet" href="{link file="backend/_resources/components/font-awesome/css/fontawesome-all.min.css"}">
    <link rel="stylesheet" href="{link file="backend/_resources/components/range-slider/css/rangeslider.min.css"}">
    <link rel="stylesheet" href="{link file="backend/_resources/css/styles-main.css"}">
    <link rel="stylesheet" href="{link file="backend/_resources/css/styles-print.css"}">
    <link rel="stylesheet" href="{link file="backend/_resources/css/styles-responsive.css"}">
    <link rel="stylesheet" href="{link file="backend/_resources/css/dataTables.css"}">
</head>
<body role="document">
{include file="backend/_base/header.tpl"}
<hr class="hr-after-header">
<main class="main">
    <div class="container">
        {block name="content/main"}{/block}
    </div>
</main>
{include file="backend/_base/footer.tpl"}
<script src="{link file="backend/_resources/components/jquery/jquery.min.js"}"></script>
<script src="{link file="backend/_resources/components/bootstrap/dist/js/bootstrap.bundle.min.js"}"></script>
<script src="{link file="backend/_resources/components/range-slider/js/rangeslider.min.js"}"></script>
<script src="{link file="backend/_resources/js/dataTables.js"}"></script>
<script src="{link file="backend/_resources/js/helper.js"}"></script>
{block name="content/javascript"}{/block}
</body>
</html>