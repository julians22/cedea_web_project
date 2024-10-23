<!DOCTYPE html>
<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @meta_tags

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Lobster&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @production
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-57ZD2ZE0ME"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-57ZD2ZE0ME');
        </script>
    @endproduction

    @production
        <!-- Google Tag Manager -->

        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start':

                        new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],

                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =

                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);

            })
            (window, document, 'script', 'dataLayer', 'GTM-TJJ7HQWD');
        </script>

        <!-- End Google Tag Manager -->
    @endproduction

    @stack('plugin-scripts')
</head>

<body class="font-poppins antialiased">

    @production
        <!-- Google Tag Manager (noscript) -->

        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TJJ7HQWD" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>

        <!-- End Google Tag Manager (noscript) -->
    @endproduction


    <x-header />
    {{ $slot }}
    <x-footer />

    @stack('after-scripts')

    @livewireScriptConfig

</body>

</html>
