<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="">



</head>

<body style="margin: 0px; padding: 0px; background-color: #f3f3f3;">
    <div style="display: block; max-width: 728px; width: 60%; margin: 0px auto;">

        <img src="{{ url('/static/images/logotipo - copia.png') }}" style="width: 40%; display: block; ">
        <div style="background-color: #fff; border-radius: 4px; padding: 24px;">

            @yield('content')
            <hr style="border-radius: 50%">
            <div class="social" >
                <p><strong>Encuéntranos en nuestras redes sociales.</strong></p>
                @if(config('cms.social_facebook') != "")
                <a href="{{ config('cms.social_facebook') }}" target="_blank"
                    style="display: inline-block; margin-right: 6px;">
                    <img src="{{ url('/static/images/social/facebook.png') }}" style="width: 25px; border-radius: 10%">
                </a>
                @endif
                @if(config('cms.soacial_instagram') != "")
                <a href="{{ config('cms.soacial_instagram') }}" target="_blank"
                    style="display: inline-block; margin-right: 6px;">
                    <img src="{{ url('/static/images/social/instagram.png') }}" style="width: 25px; border-radius: 10%">
                </a>
                @endif
                @if(config('cms.social_twitter') != "")
                <a href="{{ config('cms.social_twitter') }}" target="_blank"
                    style="display: inline-block; margin-right: 6px;">
                    <img src="{{ url('/static/images/social/twitter.png') }}" style="width: 25px; border-radius: 10%">
                </a>
                @endif
                @if(config('cms.social_youtube') != "")
                <a href="{{ config('cms.social_youtube') }}" target="_blank"
                    style="display: inline-block; margin-right: 6px;">
                    <img src="{{ url('/static/images/social/youtube.png') }}" style="width: 25px; border-radius: 10%">
                </a>
                @endif
                @if(config('cms.social_whatsapp') != "")
                <a href="{{ config('cms.social_whatsapp') }}" target="_blank"
                    style="display: inline-block; margin-right: 6px;">
                    <img src="{{ url('/static/images/social/whatsapp.png') }}" style="width: 25px; border-radius: 10%">
                </a>
                @endif
                @if(config('cms.social_tiktok') != "")
                <a href="{{ config('cms.social_tiktok') }}" target="_blank"
                    style="display: inline-block; margin-right: 6px;">
                    <img src="{{ url('/static/images/social/tik-tok.png') }}" style="width: 25px; border-radius: 10%">
                </a>
                @endif
            </div>

            {{--
            <hr>
            <p>Nuestras redes sociales</p>
            <p>Nuestras redes sociales</p> --}}
        </div>

    </div>
</body>

</html>
