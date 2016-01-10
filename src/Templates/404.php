<!doctype html>
<html class="no-js page-404" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Tell Me About My Browser</title>
    <link rel="stylesheet" href="/css/foundation.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/vendor/modernizr.js"></script>
</head>
<body>
    <h1 class="text-center">404 - Not Found</h1>
    <p class="text-center">Aw man!  Either this was a typo or the link has expired.</p>
    <p class="text-center"><a href="/">Try loading the home page.</a></p>
    <footer>
        <p>Another useful tool from the <a href="http://201creative.com">Website Programming Company</a>, 201 Creative.</p>
    </footer>
    <script>
        if (window.location.hostname.search('browser.com') !== -1) {
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-60057163-3', 'auto');
            ga('send', 'pageview');
        }
    </script>
</body>
</html>