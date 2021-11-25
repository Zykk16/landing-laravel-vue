<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <title>Otclick-ADV Платформа эффективного онлайн-маркетинга</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!--[if lt IE 11]>
    <div style='border: 1px solid #F7941D; background: #FEEFDA; text-align: center; clear: both; height: 75px; position: relative;'>
    <div style='position: absolute; right: 3px; top: 3px; font-family: courier new; font-weight: bold;'>
        <a href='#' onclick='javascript:this.parentNode.parentNode.style.display="none"; return false;'>
            <img src='/ie_check/img//ie6nomore-cornerx.jpg' style='border: none;' alt='Close this notice' />
        </a>
    </div>
    <div style='width: 640px; margin: 0 auto; text-align: left; padding: 0; overflow: hidden; color: black;'>
        <div style='width: 75px; float: left;'>
            <img src='/ie_check/img//ie6nomore-warning.jpg' alt='Warning!' />
        </div>
        <div style='width: 275px; float: left; font-family: Arial, sans-serif;'>
            <div style='font-size: 14px; font-weight: bold; margin-top: 12px;'>Вы используете устаревший браузер</div>
            <div style='font-size: 12px; margin-top: 6px; line-height: 12px;'>Для полноценной работы, пожалуйста, воспользуйтесь любым современным браузером.</div>
        </div>
        <div style='width: 75px; float: left;'>
            <a href='http://www.firefox.com' target='_blank'><img src='/ie_check/img//ie6nomore-firefox.jpg' style='border: none;' alt='Get Firefox 3.5' /></a>
        </div>
        <div style='width: 75px; float: left;'>
            <a href='http://www.browserforthebetter.com/download.html' target='_blank'><img src='/ie_check/img//ie6nomore-ie8.jpg' style='border: none;' alt='Get Internet Explorer 8' /></a>
        </div>
        <div style='width: 73px; float: left;'>
            <a href='http://www.apple.com/safari/download/' target='_blank'>
                <img src='/ie_check/img//ie6nomore-safari.jpg' style='border: none;' alt='Get Safari 4' />
            </a>
        </div>
        <div style='float: left;'>
            <a href='http://www.google.com/chrome' target='_blank'>
                <img src='/ie_check/img//ie6nomore-chrome.jpg' style='border: none;' alt='Get Google Chrome' />
            </a>
        </div>
    </div>
    </div>
    <![endif]-->
</head>
<body>
<noscript>
    Ваш браузер не поддерживается, обновите до последней версии
</noscript>
@yield('content')
</body>
</html>
