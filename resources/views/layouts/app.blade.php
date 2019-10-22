<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Glyphicons -->
    <link href="{{ asset('css/webfonts/all.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @include('inc.navbar')
    <main class="container">
        @include('inc.messages')
        @yield('content')
    </main>
</div>
<!-- Scripts -->
<script type="text/javascript">
    <!--
    function toggle_visibility(id , target) {
        var form_target = document.getElementById(id);
        var button_target  = document.getElementById(target);
        //Configuration Information
        var info = document.getElementById("config_info");
        if(info !== null){
            info.style.display = "none";
        }

        var buttons = document.getElementsByClassName("a_picker");
        for(var x = 0;  x < buttons.length; x++){
            buttons[x].style.color = 'dimgray';
            buttons[x].style.fontWeight = 'normal';
        }

        var forms = document.getElementsByClassName("picker");
        for(var i = 0;  i < forms.length; i++){
            forms[i].style.display = 'none';
        }
        form_target.style.display = 'block';
        button_target.style.color = "black";
        button_target.style.fontWeight = "bold";

        //loadjscssfile("{{ asset('css/style_hover.css') }}", "css")
    }
    //teste. FUNCIONA MAS COMO A MINHA FUNÇAO EM CIMA FUNCIONA SEM DAR REFRESH A PAGINA, O HTML NAO LE O NOVO LINK!
    function loadjscssfile(filename, filetype){
        if (filetype=="js"){
            var fileref=document.createElement('script')
            fileref.setAttribute("type","text/javascript")
            fileref.setAttribute("src", filename)
        }
        else if (filetype=="css"){
            var fileref=document.createElement("link")
            fileref.setAttribute("rel", "stylesheet")
            fileref.setAttribute("type", "text/css")
            fileref.setAttribute("href", filename)
        }
        if (typeof fileref!="undefined")
            document.getElementsByTagName("head")[0].appendChild(fileref)
    }
    //-->
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>CKEDITOR.replace( 'game-ckeditor' );CKEDITOR.replace( 'rgame-ckeditor' );</script>
<script>
    CKEDITOR.replace( 'bio-ckeditor');
    CKEDITOR.replace( 'description-ckeditor' );
</script>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));;
        if("IntersectionObserver" in window && "IntersectionObserverEntry" in window && "intersectionRatio" in window.IntersectionObserverEntry.prototype){
            var lazyImageObserver = new IntersectionObserver(function(entries, observer){
                entries.forEach(function (entry) {
                    if(entry.isIntersecting){
                        var lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.srcset = lazyImage.dataset.srcset;
                        lazyImage.style = lazyImage.dataset.style;
                        lazyImage.classList.remove("lazy");
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });
            lazyImages.forEach(function (lazyImage) {
                lazyImageObserver.observe(lazyImage);
            });
        }
    })
</script>
</body>
</html>
