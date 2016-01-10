<?php
/** @var \AboutBrowser\Model\Visitor $visitor */
$visitor;
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tell Me About My Browser</title>
    <link rel="stylesheet" href="/css/foundation.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/vendor/modernizr.js"></script>
</head>
<body>
    <header>
        <div class="row">
            <div class="small-12 columns">
                <h1><a href="/" rel="nofollow">Tell Me About My Browser</a></h1>
                <p>Ever wonder what websites can tell about your browser?  Or maybe you need to troubleshoot a browser problem?  This will help!</p>
            </div>
        </div>
    </header>
    <div class="row">
        <div class="small-12 medium-8 columns">
            <table role="grid" id="visitor_data">
                <tr>
                    <td>Public IP Address</td>
                    <td><?= htmlentities($visitor->getIP()) ?></td>
                </tr>
                <?php
                $forwardedFor = $visitor->getIPForwardedFor();
                if ($forwardedFor) {
                    echo '<tr><td>Forwarded from IP</td>';
                    echo '<td>' . htmlentities($forwardedFor) . '</td></tr>';
                }
                ?>
                <tr>
                    <td>Operating System</td>
                    <td><?= htmlentities($visitor->getFullOperatingSystem()) ?></td>
                </tr>
                <tr>
                    <td>Platform</td>
                    <td><span id="js-platform"></span></td>
                </tr>
                <tr>
                    <td>Display</td>
                    <td><span id="js-display"></span></td>
                </tr>
                <tr>
                    <td>Browser</td>
                    <td><?= htmlentities($visitor->getFullBrowserVersion()) ?></td>
                </tr>
                <tr>
                    <td>Browser Window</td>
                    <td><span id="js-browser-window"></span></td>
                </tr>
                <tr>
                    <td>Language</td>
                    <td><span id="js-language"></span></td>
                </tr>
                <tr>
                    <td>Cookies</td>
                    <td><span id="js-cookies"></span></td>
                </tr>
                <tr>
                    <td>Do Not Track</td>
                    <td><span id="js-do-not-track"></span></td>
                </tr>
                <tr id="js-template">
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <?php
            if ($javascriptData = $visitor->getJavascriptData()) {
                print "<script>var javascriptData = '" . json_encode($javascriptData) . "';</script>";
            }
            ?>
            <p><small>Generated at <?= $visitor->getCreatedAt()->format('Y-m-d H:i:s e') ?></small></p>
        </div>
        <div class="small-12 medium-4 columns">
            <div class="panel callout radius no-offset">
                <h4>Share Your Browser Info</h4>
                <p>Simply copy &amp; paste the URL from the address bar.</p>
                <p>Or, use this link:</p>
                <input type="text" readonly value="<?= htmlentities($visitor->getViewUrl()) ?>" id="share_url">
                <p><a href="mailto:?subject=My%20Browser%20Information&body=<?= urlencode($visitor->getViewUrl()) ?>">Click here to email the link.</a></p>
            </div>
            <p class="text-center"><small>Please note: links expire in 3 days.</small></p>
        </div>
    </div>
    <footer>
        <p>Another useful tool from the <a href="http://201creative.com">Website Programming Company</a>, 201 Creative.</p>
    </footer>
    <script src="/js/vendor/jquery.min.js"></script>
    <script src="/js/app.js"></script>
    <script>
        if (window.location.hostname.search('browser.com') !== -1) {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-60057163-3', 'auto');
            ga('send', 'pageview');
        }
    </script>
    <script type="text/javascript">
        reformal_wdg_domain    = "tellmeaboutmybrowser";
        reformal_wdg_mode    = 0;
        reformal_wdg_title   = "Tell Me About My Browser";
        reformal_wdg_ltitle  = "Leave feedback";
        reformal_wdg_lfont   = "";
        reformal_wdg_lsize   = "";
        reformal_wdg_color   = "#FFA000";
        reformal_wdg_bcolor  = "#516683";
        reformal_wdg_tcolor  = "#FFFFFF";
        reformal_wdg_align   = "right";
        reformal_wdg_waction = 0;
        reformal_wdg_vcolor  = "#9FCE54";
        reformal_wdg_cmline  = "#E0E0E0";
        reformal_wdg_glcolor  = "#105895";
        reformal_wdg_tbcolor  = "#FFFFFF";
        reformal_wdg_bimage = "8489db229aa0a66ab6b80ebbe0bb26cd.png";
    </script>
    <script type="text/javascript" language="JavaScript" src="http://idea.informer.com/tab6.js?domain=tellmeaboutmybrowser"></script><noscript><a href="http://tellmeaboutmybrowser.idea.informer.com">Tell Me About My Browser feedback </a> <a href="http://idea.informer.com"><img src="http://widget.idea.informer.com/tmpl/images/widget_logo.jpg" /></a></noscript>
</body>
</html>