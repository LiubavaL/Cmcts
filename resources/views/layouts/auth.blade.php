<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="imagetoolbar" content="no">
    <meta name="msthemecompatible" content="no">
    <meta name="cleartype" content="on">
    <meta name="HandheldFriendly" content="True">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="google" value="notranslate">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="/manifest.json">
    <title></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="/css/app.min.css" rel="stylesheet">
</head>

<body class="page">
<div class="header-auth">
    <div class="header-auth__content">
        <a href="/" class="header-auth__home">Home</a>
    </div>
</div>
<main class="container-auth" role="main">
    <div class="container-auth__form">
        @yield('content')
    </div>
</main>
<!-- Scripts -->
<script src="/js/app.min.js"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-98862533-1', 'auto');
    ga('send', 'pageview');

</script>
</body>

</html>
