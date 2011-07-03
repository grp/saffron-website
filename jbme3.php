<?php
error_reporting(E_ALL);
//ob_start('ob_gzhandler');
header('Content-Type: text/html; charset=utf-8');
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if(preg_match('!^Mozilla/5\.0 \((\w+).*OS ([0-9_]+) like Mac OS X.*Mobile/([^ ]+)!', $user_agent, $matches)) {
    list($_, $device, $version, $build) = $matches;
    $version = str_replace('_', '.' ,$version);
    $small_device = $device != 'iPad';
    $pdf = "./${device}_${version}_$build.pdf";
    $supported = file_exists($pdf);
    $device = 'mobile';
} else {
    $device = 'computer';
    $small_device = false;

    $supported = false;
}

$dangerous = $small_device && substr($version, 0, 3) == '4.2' ? ($device == 'iPhone' ? 'iPhone 3G' : 'iPod touch (2nd generation)') : '';

$device = 'iPhone'; $version = '4.3.1'; $small_device = $supported = true; $dangerous = '';

$_2x = ($small_device && substr($version, 0, 3) != '4.2') ? '@2x' : '';

function data_encode($fn, $ct) {
    return 'data:'.$ct.';base64,'.urlencode(base64_encode(file_get_contents($fn)));
    //return $fn;
}

$b = $small_device ? '' : '<br>';
$donatestuff = <<<ENDE
<div id="sbigdiv">
<div id="sdiv2">
<b>Donate!</b><br>
I greatly appreciate donations; they help me pay for college at <a href="http://brown.edu">Brown</a>.
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="sform">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="CTALSP2HYEFKN">
<input type="image" src="btn_donate_LG.gif" width="92" height="26" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
</form>
</div>
<div id="sdiv3">
<b>Hire me?</b><br>
I'm looking for a job or {$b}internship where I can help make something really cool.  If you liked this site, why not <a href="mailto:comexk@gmail.com">send an email</a>?
</div>
</div>
ENDE;

?>
<html>
<head>
<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>JailbreakMe 3.0</title>

<!-- hey there, source code reader, who probably wants to ask if you can use this design on your homepage. -->
<!-- while I don't have an issue with it, the code is SO horrible and awful that it's much, much easier to -->
<!-- just make your own version of the design, which is completely cool with us: most of the design's from -->
<!-- apple's websites and apps anyway. -->

<style type="text/css">

body {
    margin: 0;
    padding: 0;

    font-family: Helvetica NeueUI, Helvetica Neue, Helvetica, Arial, Verdana, sans-serif;
    color: black;
}

* {
    -webkit-user-select: none !important;
    -webkit-text-size-adjust: none;
}

ul {
    padding-left: 10px;
}

li {
    padding-bottom: 15px;
}

.body {
    color: black;
}

.body1 {
    padding: 1px 10px;
}

.body a {
    text-decoration: none;
}

#hax {
    position: fixed;
    opacity: 0.001;
    top: 0; left: 0;
    width: 20px; height: 40px;
}

.container {
    overflow: hidden;
}

.button-container {
    z-index: 10;
    display: table-cell;
    vertical-align: middle;
}

.button-wrapper {
    padding-left: 6px;
    padding-right: 6px;
    width: 50px;
}

.button {
    color: white;
    font-weight: bold;
    text-shadow: rgba(0, 0, 0, 0.60) 0 -1px 0;
    font-size: 13px;
    line-height: 16px; 
    
    -webkit-box-shadow: 0 -1px 0px #79797b, 0 1px 0px #ffffff;
    border-top: 1px solid #505050;
    
    padding-top: 1px;
    height: 20px;
    -webkit-border-radius: 3px;
    
    width: 48px;
    text-align: center;
    
    overflow: hidden;
    position: relative;
<?php if($small_device) { ?>
    -webkit-transform-origin: right 50%;
<?php } else { ?>
    margin-top: 7px;
<?php } ?>
<?php if(!$supported) { ?>
    opacity: 0.7;
<?php } ?>
}

.button-shadow {
    position: absolute;
    left: -25%;
    top: -25%;
    width: 150%;
    height: 150%;
}

#bb-shadow {
    position: absolute;
}

<?php if($supported) { ?>
.button:active .button-shadow {
    background-color: rgba(0, 0, 0, 0.33);
}
<?php } ?>

.button-disabled .button-shadow {
    background-color: transparent !important;
}

.button-text {
    position: absolute;
    margin-top: 2px;
    text-align: center;
}

.button-blue .button {
    border-right: 1px solid #435c8d;
    border-left: 1px solid #435c8d;
    border-bottom: 1px solid #34528e;

<?php if($small_device) { ?>
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(1, #566684),
        color-stop(0.95, #60749b),
        color-stop(0, #32559c)
    );
<?php } else { ?>
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(1, #74767a),
        color-stop(0.95, #8d8f96),
        color-stop(0, #75777f)
    );
<?php } ?>
}

.button-green .button {
    border-right: 1px solid #528e37;
    border-left: 1px solid #528e37;
    border-bottom: 1px solid #449222;
    
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(1, #648b53),
        color-stop(0.95, #74a361),
        color-stop(0, #51ab29)
    );

    width: 68px;
    margin-left: -10px;
}

.button-animated .button {
    -webkit-transition-property: -webkit-transform, background-image, border-color;
    -webkit-transition-timing-function: ease-in-out;
    -webkit-transition-duration: 0.2s;
    -webkit-transform: scaleX(1);
    
}

.button-squashed .button {
    -webkit-transform: scaleX(0.7059);
}

.button-stretched .button {

    -webkit-transform: scaleX(1.417);
}


.cell {
    border-top: 1px solid #e5e5e5;
    border-bottom: 1px solid #e5e5e5;
    background-color: #d5d5d5;
    
    padding: 0;
    margin: 0;
    /*position: relative;*/

    height: 44px;
    width: 100%;
    display: block;
    
    text-decoration: none;

    background-repeat: no-repeat;
    background-image: url(<?php echo data_encode('chevron.svg', 'image/svg+xml'); ?>);
    background-size: 25px 13px;
    background-position: center right;
    
    /* disable gray selected overlay thingy */
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    
    /* disable tap-and-hold menu */
    -webkit-touch-callout: none;
}

/* i love (read: hate) css */
.cell + .cell {
    margin-top: -1px;
}

.cell:active {
    border-top: 1px solid #0099FF;
    border-bottom: 1px solid #0066F2;

    background-repeat: no-repeat, repeat-x;
    background-image: url(<?php echo data_encode('chevron_white.svg', 'image/svg+xml'); ?>), -webkit-gradient(
        linear,
        left top,
        left bottom,
        color-stop(0, #0099FF),
        color-stop(1, #0066F2)
    );
    background-size: 25px 13px, 100% 44px;
    background-position: center right, top left;
}

.cell:active + .cell {
    /* so, there's this weird thing that our cells are put margin-top -1px */
    /* so that they look good when multiple of them are in a row, however  */
    /* that makes the selected cells look one pixel off when they are above*/
    /* a deselected cell. so, set the color to the bottom color of the cell*/
    /* above, which is hidden. if that makes any sense (probably does not) */
    border-top: 1px solid #0066F2;
}

.cell span {
    display: block;
    position: absolute;
    
    line-height: 44px;

    font-weight: bold;
    font-size: 15px;
    padding-left: 17px;
    color: black;
}

.cell:active span {
    color: white;
}


.navbar-label {
    width: 100%;
    position: absolute;
    text-align: center;
    line-height: 44px;
    font-size: 22px;
    font-weight: bold;
}

#back-taptarget {
    top: 6px;
    left: 8px;
    height: 32px;
    width: 52px;
    position: absolute;
    z-index: 9999999;
    
    /* disable gray selected overlay thingy */
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    
    /* disable tap-and-hold menu */
    -webkit-touch-callout: none;
}

#back-container {
    height: 32px;
    margin-top: <?php if ($small_device) { ?> 6px <?php } else { ?> 7px <?php } ?>;
    <?php if ($small_device) { echo "margin-left: -2px"; } ?>;
    position: absolute;
}

<?php
function back_image($mini, $mode) {
    global $small_device, $_2x;
    $fn = data_encode("UINavigationBar" . ($mini ? "Mini" : "") . ($small_device ? "Default" : "Silver") . "Back" . $_2x . ".png", 'image/png');
    $lines = ($_2x ? '30 10 30 28' : '15 5 15 14');
    if ($mini) $lines = ($_2x ? '24 8 24 20' : '12 4 12 10');
    echo "url($fn) $lines stretch";
}
?>

#back-button {
    line-height: 0px;
    margin: 0;
    padding: 0;
    height: 0px;
    color: white;

    border-width: 15px 5px 15px 14px;
    -webkit-border-image: <?php back_image(false, 0); ?>;
}

#back-shadow {
    position: absolute;
<?php if($_2x) { ?>
    width: 104px;
    height: 60px;
    -webkit-transform: scale(0.5);
    -webkit-transform-origin: top left;
<?php } else { ?>
    width: 52px;
    height: 30px;
<?php } ?>
    left: -14px;
    top: -15px;
    -webkit-mask-box-image: <?php back_image(false, 1); ?>;
    
    z-index: -1;
}


#back-text {
    font-family: "Helvetica NeueUI", Helvetica Neue, Helvetica, Arial, Verdana, sans-serif;
    text-shadow: #4e4e4e 0 -1px 0;
    font-weight: bold;
    font-size: 13px;
    
    padding-right: 3px;
    margin-top: -1px;
}

#back-taptarget:active + #back-container #back-shadow {
    background-color: rgba(0, 0, 0, 0.33);
}

.navbar-label, #back-button, .navigation-view-2-container, .navigation-view-1 {
    -webkit-transition-property: -webkit-transform, opacity;
    -webkit-transition-timing-function: ease-in-out; /* iOS uses exactly this */
    -webkit-transition-duration: 0.35s;
}

.freeze, .freeze .container, .freeze .navigation-view-1, .freeze .navigation-view-2-container, .freeze .navbar-label, .freeze #back-button {
    -webkit-transition-duration: 0s !important;
}

       #first-label { -webkit-transform: translateX(0); opacity: 1; }
.page2 #first-label { -webkit-transform: translateX(-100%); opacity: 0; }
       #second-label { -webkit-transform: translateX(60%); opacity: 0; }
.page2 #second-label { -webkit-transform: translateX(0); opacity: 1; }
       #back-button { -webkit-transform: translateX(50%); opacity: 0; }
.page2 #back-button { -webkit-transform: translateX(9px); opacity: 1; }


.navigation-view-container {
    position: relative;
}

.navigation-view-2-container {
    -webkit-transform: translateX(100%);
    position: absolute;
    width: 100%;
    top: 0; left: 0;
}

.page2 .navigation-view-2-container {
    -webkit-transform: translateX(0);
    position: relative;
}
    

.navigation-view {
    display: none;
    padding: 5px;
}

.navigation-view-1 {
    -webkit-transform: translateX(0);
    display: block;
    position: relative;
}

.page2 .navigation-view-1 {
    -webkit-transform: translateX(-100%);
    position: absolute;
    top: 44px; left: 0;
}

.container.moreinfo .navigation-view-moreinfo { display: block; }
.container.success .navigation-view-success { display: block; }
.container.failure .navigation-view-failure { display: block; }
.container.legal .navigation-view-legal { display: block; }


<?php if(!$small_device) { ?>

body {
    background-color: #c8cacc;
    background-repeat: no-repeat;
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        from(#656565),
        to(#959595)
    );
}

.container {
    margin-left: 10%;
    margin-right: 10%;
    position: static;
    margin-top: 25%;
    <?php if ($device == 'computer') echo "-webkit-transform: translateY(0);" ?>
    -webkit-transition-property: -webkit-transform;
    -webkit-transition-duration: 0.3s;
    -webkit-transition-timing-function: ease-in-out;
    background-color: #e1e1e1;
    -webkit-box-shadow: 0 0 50px black;
    -webkit-border-radius: 15px;
}

<?php if($device != 'computer') { ?>
.container.legal, .container.moreinfo {
    margin-top: 30px;
}
<?php } ?>

body.apage2 .container {
    -webkit-transform: translateY(-100px);
}

.container-rounded {
    position:relative; 
    overflow: hidden;
}

.container2 {
    display: table;
}

.container3 {
    display: table-row;
}

.header {
    /*float: left;*/
    position: relative;
    width: 40%;
    display: table-cell;

    padding-top: 24px;
    padding-bottom: 24px;
    vertical-align: top;
}

.notheader {
    /*float: right;*/
    width: 59%;
    border-left: solid 1px black;
    display: table-cell;
    vertical-align: top;

    overflow: hidden;
    -webkit-border-bottom-right-radius: 15px;
}


.body-header {
    font-weight: bold;
    font-size: 17px;
}

.body p {
    margin-top: 10px;
    margin-bottom: 10px;
}

.icon {
    display: none;
}

.bigicon {
    margin-bottom: 50px;
    width: 190px;
    height: 190px;
    -webkit-background-size: 100%;
    margin-left: auto;
    margin-right: auto;
    background-image: url(holybejesus.png);

    -webkit-box-reflect: below 4px -webkit-gradient(linear, left top, left bottom, from(transparent), color-stop(0.8, transparent), to(rgba(1, 1, 1, 0.5)));
}

.headertext {
    width: 100%;
}

.cell {
    border-top: solid 1px #b5b5b5;
    border-bottom: solid 1px #b5b5b5;
    background-color: #d5d5d5;
}

.title {
    width: 100%;
    text-align: center;
    font-size: 30px;
    margin-bottom: 0;
    padding-bottom: 2px;
}

.subtitle {
    font-size: 17px;
    width: 100%;
    margin: 0;
    padding-bottom: 1px;
    text-align: center;
    color: #888888;
}

.navbar {
    background-color: #7f94b0;
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(0%, #a8abbb),
        color-stop(100%, #ffffff)
    );

    -webkit-border-top-left-radius: 15px;
    -webkit-border-top-right-radius: 15px;

    height: 43px;
    margin: 0;
    padding: 0;

    border-bottom: solid 1px #797D92;

    text-align: center;
}

.navbar-label {
    color: #808080;
    text-shadow: white 0 1px 0;
}

.button-wrapper {
    position: static;
    margin-top: 5px;
    margin-left: auto;
    margin-right: auto;
}

@media only screen and (orientation: portrait) {
    .container {
    }

}

@media only screen and (orientation: landscape) {
    .container {
        margin-top: 8%;
        margin-bottom: 8%;
        margin-left: 15%;
        margin-right: 15%;
    }
}

.question-answer {
    margin: -5px;
}

.question-answer:nth-child(odd) {
    background-color: #dadada;
}

<?php if (!$small_device) { ?>

.question-answer:last-child {
    -webkit-border-bottom-right-radius: 15px;
    -webkit-border-bottom-left-radius: 15px;
}

<?php } ?>

#sdiv1 {
    padding-top: 63px;
    float: right;
    width: 240px;
}

#simg {
    padding-top: 10px;
}

#sdiv2 {
    float: left;
    width: 302px;
    padding: 0 50px;
}

<?php if($device == 'computer') { ?>
#sdiv2 {
    width: 240px;
}
#sdiv3 {
    height: 130px;
}

#sbigdiv {
    background-color: #ded;
    margin-top: 5px;
    padding-top: 10px;
}
<?php } ?>

#sform {
    padding: 10px 30px;
}

<?php } else { // small_device ?>

.button-container {
    position: absolute;
    right: 25px;
    top: 20px;
}

body {
    background-color: #c8cacc;
    -webkit-background-size: 101% 100px;
    background-repeat: no-repeat;
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        from(#c8cacc),
        to(#8c8d8e)
    );

    padding-bottom: 15px;
}

.header {
    height: 60px;
    padding-left: 10px;
    margin-bottom: 16px;
    position: relative;
}

.title {
    color: black;
    font-size: 18px;
    text-shadow: #bebebe 0 1px 0;
    padding-top: 2px;
    margin-bottom: 0px;
}

.subtitle {
    color: #353535;
    font-size: 11px;
    margin-top: 0;
    margin-bottom: 2px;
    text-shadow: #bebebe 0 1px 0;
}

.bigicon {
    display: none;
}

.icon {
    width: 59px;
    height: 60px;
    float: left;
    margin-right: 10px;
    border: 0;
    padding: 0;
    
    -webkit-box-reflect: below -2px -webkit-gradient(linear, left top, left bottom, from(transparent), color-stop(0.75, transparent), to(rgba(1, 1, 1, 0.75)));
}

.navbar {
    background-color: #7f94b0;
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(0%, #6d83a1),
        color-stop(50%, #7f94b0),
        color-stop(50%, #889bb3),
        color-stop(100%, #b5c0ce)
    );

    height: 42px;
    margin: 0;
    padding: 0;

    border-top: 2px solid #d4d4d4;
    border-bottom: 1px solid #2d3033;

    text-align: center;
}

.navbar-label {
    color: white;
    margin-top: -2px;
    text-shadow: #4e4e4e 0 -1px 0;
}    

.body {
    line-height: 1.3em;
    padding: 0;
}

.button-holder {
    position: absolute;
}

.button-wrapper {
    position: relative;
}

.button-green .button-text {
    right: 50%;
}

@media only screen and (orientation: portrait) {
    .button-holder {
        top: 12px;
        left: 260px;
    }
    .container {
        width: 322px;
    }
}

@media only screen and (orientation: landscape) { 
    .container {
        width: 482px;
    }
    .button-holder {
        top: 12px;
        left: 420px;
    }

    .navbar {
        height: 32px;
    }

    .navbar-label {
        font-size: 18px;
        line-height: 34px;
    }
    #back-button {
        margin-top: -3px;
        margin-left: -1px;
    }

    #back-taptarget {
        top: 6px;
        left: 8px;
        height: 24px;
        width: 52px;
    }

    #back-container {
        height: 24px;
        margin-top: <?php if ($small_device) { ?> 7px <?php } else { ?> 7px <?php } ?>;
        <?php if ($small_device) { echo "margin-left: -2px"; } ?>;
        position: absolute;
    }

    #back-button {
        -webkit-border-image: <?php back_image(true, 0); ?>;
    }

    #back-shadow {
        -webkit-mask-box-image: <?php back_image(true, 1); ?>;
    }

    #back-text {
        font-size: 12px;
   
        padding-left: 2px;
        padding-right: 3px;
        margin-top: -1px;
    }
}

.question-answer:nth-child(odd) {
    background-color: #ddd;
}


#sdiv1 {
    margin-top: 14px;
}

#sdiv2 {
    margin-bottom: -12px;
}

#simg {
    width: 300px;
    height: 150px;
}

#sform {
    padding: 10px 20px;
}

<?php } // small_device ?>

@media only screen and (orientation: landscape) {
    margin-top: -13px;
}

.bodypad {
    padding: 15px !important;
}

.question-answer {
    padding: 10px 20px !important;
}

.question {
    font-weight: bold;
    margin-bottom: 5px;
    margin-top: 10px;
}

.answer {
    margin-top: 5px;
    margin-bottom: 10px;
}

<?php if (!$small_device) { ?>
.body {
    font-size: 16px;
    line-height: 19px;
}

<?php } ?>
</style>
</head>
<body>
<iframe id="hax" src="about:blank"></iframe>

<!-- preload images -->
<img style="display: none; -webkit-border-image: <?php back_image(true, false); ?>" />
<img style="display: none; -webkit-border-image: <?php back_image(false, false); ?>" />
<img style="display: none; -webkit-border-image: <?php back_image(true, true); ?>" />
<img style="display: none; -webkit-border-image: <?php back_image(false, true); ?>" />

<div class="container">
<div class="container-rounded">
<div class="navbar-container">

<div class="navbar">

<div id="back-taptarget"></div>
<div id="back-container">
<div id="back-button">
<div id="back-text">Back</div>
<div id="back-shadow"></div>
</div>
</div>

<div class="navbar-label" id="first-label">JailbreakMe</div>
<div class="navbar-label" id="second-label">More Information</div>
</div>
</div>

<div class="navigation-view-container">
<div class="navigation-view-2-container">

<div class="navigation-view navigation-view-moreinfo body">
<?php if($device == 'computer') { ?>
    <div class="question-answer">
    <?php echo $donatestuff; ?>
    </div>
<?php } ?>

    <div class="question-answer">
    <p class="question">What's a jailbreak?</p>
    <p class="answer">Jailbreaking your device means installing a small program that removes restrictions in the default software. A jailbroken device can run apps and extensions (themes and tweaks) not approved by Apple. Jailbreaking does not slow down your device or use extra battery, and you can still use all your existing apps and buy new ones from the App Store. Jailbreaking simply enables you to do more with your device, nothing is taken away.</p>
    </div>

    <div class="question-answer">
    <p class="question">Is JailbreakMe reversible?
    <p class="answer">Yes! If you ever decide that you want to undo your jailbreak, connect your device to your computer, sync to make a full backup, press Restore in iTunes to wipe the device, and load your backup when prompted. All your App Store apps and the information in them will be preserved as usual.</p>
    </div>
    <div class="question-answer">
    <p class="question">Can jailbreaking "brick" my device?</p>
    <p class="answer">JailbreakMe provides a safe jailbreak that <em>cannot</em> put your device into an unusable state on its own. You will have full access to your jailbroken device, which gives you the power to modify it in ways that can put it in a state where you have to connect your device to iTunes and "restore" from a recently-synced backup. However, it should not be possible to render your device as permanently non-interactive as a brick, no matter what you choose to install.</p>
    </div>
    
    <div class="question-answer">
    <p class="question">Is this legal in the United States?</p>
    <p class="answer">The Library of Congress approved a DMCA exemption in 2010 for jailbreaking cell phones, including the iPhone.</p>
    </div>

    
    <div class="question-answer">
    <p class="question">Can jailbreaking make my device less secure?</p>
    <div class="answer">By itself, jailbreaking does not make you vulnerable.
    <p>However, a common mistake for jailbreakers is to install OpenSSH but forget to change the passwords for root and mobile; this lets anyone log into your device over the Internet.  If you install OpenSSH, remember to change the password!</p>
    </div>
    </div>

    <div class="question-answer">
    <p class="question">How can I get help with jailbreaking?</p>
    <p class="answer">If you need technical help with jailbreaking, you can try websites like <a href="http://jailbreakqa.com/">Jailbreak QA</a> and <a href="http://reddit.com/r/jailbreak">/r/jailbreak</a>.</p>
    </div>
    
    <div class="question-answer">
    <p class="question">Isn't there a risk hackers will make the exploit from this site into an iPhone virus?</p>
    <div class="answer">
When I released JailbreakMe 2.0 last year, some media reports focused on the security implications of releasing an exploit for unpatched vulnerabilities.  I am not sure myself what to think of this, but here are some facts:

<p>▻ I did not create the vulnerabilities, only discover them.  Releasing an exploit demonstrates the flaw, making it easier for others to use it for malice, but they have long been present and exploitable.  Although releasing a jailbreak is certainly not the usual way to report a vulnerability, it still has the effect of making iOS more secure in the long run.</p>
<p>▻ There's always a first time, but I think there's a good chance the security impact of these vulnerabilities will remain theoretical.  Despite JailbreakMe 2.0 being open sourced after an updated version of iOS was released, which would have made it relatively easy to modify the code into an attack, I didn't hear about any such modification except a proof of concept that showed up much later.  The only iPhone virus ever to attack the general public was a trivial one that affected jailbreakers who installed OpenSSH (not installed by default) but left it at the default password.</p>
<p>▻ Along with the jailbreak, I am releasing a patch for the main vulnerability which anyone especially security conscious can install to render themselves immune; due to the nature of iOS, this patch can only be installed on a jailbroken device.   Until Apple releases an update, jailbreaking will ironically be the best way to remain secure.</p>
<p>▻ Jailbreak apps and tweaks improve the mobile experience of millions of users, including many who were encourged to try it by the ease of use of web-based jailbreaks.  I'm not just doing this to be flashy: there is considerable benefit to writing this kind of tool rather than one that requires a connected computer.</p>
    </div>
    </div>
</div>

<?php if($device != 'computer') { ?>
<div class="navigation-view navigation-view-success bodypad">
You should have seen Cydia install.
If the jailbreak didn't work correctly, please <a href="mailto:comexk@gmail.com?subject=<?php echo urlencode('failz: ' . $user_agent); ?>">email me</a>.<br>
<div id="sdiv1">
<b>Now don't upgrade!</b><br>
If you do, you won't be able to jailbreak until a new tool is released.
</div>
<img src="nuke.png" id="simg" width="400" height="200">
<?php echo $donatestuff; ?>

</div>

<div class="navigation-view navigation-view-failure bodypad">
Looks like the hack didn't work.  <?php echo $dangerous ? "If you're using an <b>$dangerous</b>, that would make sense, because it's not supported.  (Quick test: hold down the home button for a few seconds; if you don't get Voice Control, it's not supported.)<p>Otherwise, if" : "If"; ?>
you're already jailbroken, do you have <b>PDF Patcher 2</b> installed?
<p>
If none of these apply, <a href="mailto:comexk@gmail.com">email me.</a>
</div>
<?php } // computer ?>

<div class="navigation-view navigation-view-legal body bodypad">
Various parts of saffron use code from the following:<br>
<br>
<a href="http://tukaani.org/xz/">XZ Utils</a><br>
<br>
<a href="http://www.zlib.net/">zlib</a><br>
<br>
<a href="http://www.openbsd.org/">OpenBSD</a>:<br>

Copyright (c) 1991, 1993, 1994 The Regents of the University of California.  All rights reserved.<br>
<br>
Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
<ol>
<li>Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.</li>
<li>Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.</li>
<li>Neither the name of the University nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.</li>
</ol>
THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL THE REGENTS OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.<br>
<br>
<a href="http://www.feep.net/libtar/">libtar:</a><br>
Copyright (c) 1998-2003  University of Illinois Board of Trustees<br>
Copyright (c) 1998-2003  Mark D. Roth<br>
All rights reserved.<br>
<br>
Developed by: Campus Information Technologies and Educational Services, University of Illinois at Urbana-Champaign<br>
<br>
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the ``Software''), to deal with the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:<br>
<br>
<ul>
<li>Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimers.</li>
<li>Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimers in the documentation and/or other materials provided with the distribution.</li>
<li>Neither the names of Campus Information Technologies and Educational Services, University of Illinois at Urbana-Champaign, nor the names of its contributors may be used to endorse or promote products derived from this Software without specific prior written permission.</li>
</ul>
<br>
THE SOFTWARE IS PROVIDED ``AS IS'', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.  IN NO EVENT SHALL THE CONTRIBUTORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS WITH THE SOFTWARE.
<br>
<br>
<br>
Thanks!
</div>


</div>
</div>


<div class="navigation-view-1">
<div class="container2">
<div class="container3">

<div class="header">
<img class="icon" src="icon@2x.png" width="59" height="59" />
<div class="bigicon"></div>
<div class="headertext">
<h1 class="title">Cydia</h1>
<h3 class="subtitle">Jay Freeman (saurik)</h3>
<h3 class="subtitle">Jailbreak by comex.</h3>
</div>

<?php if ($device != "computer") { ?>
<div class="button-holder">
<div style="z-index: 2;" class="button-wrapper">
<div class="button-container button-blue" id="button-container">
<div class="button" role="button">FREE<div class="button-shadow"></div></div>
</div>
</div>
</div>
<?php } else { ?>
<p style="color: red; font-weight: bold; text-align: center; margin-left: 30px; margin-right: 30px;">Come back on your iOS device to use JailbreakMe.</p>
<?php } ?>

</div>

<div class="notheader">

<div class="body1">
<?php if($dangerous) { ?>
<script>
if(window.devicePixelRatio > 1) document.write('<div style="color: red; font-weight: bold">Not supported on <?php echo $dangerous; ?>.</div>');
</script>
<?php } ?>
<p><i>Finally.</i> JailbreakMe is the easiest way to free your device. Experience iOS as it could be, fully customizable, themeable, and with every tweak you could possibly imagine.</p>
<p>Safe and completely reversible (just restore in iTunes), jailbreaking gives you control over the device you own. It only takes a minute or two, and as always, it's completely free.</p>
</div>

<a href="#moreinfo" class="cell" ontouchstart="" onclick="return goto('moreinfo');">
<span>More Information</span>
</a>
<a href="mailto:?Subject=Jailbreak%20your%20iOS%20device%21&Body=Jailbreak%20your%20iPhone%2C%20iPod%20touch%2C%20or%20iPad%20directly%20from%20the%20device%20itself%21%20JailbreakMe%20is%20the%20simplest%20way%20to%20free%20your%20device.%20Experience%20iOS%20as%20it%20could%20be%2C%20fully%20customizable%2C%20themeable%2C%20and%20with%20every%20tweak%20you%20could%20possibly%20imagine.%0A%0ACheck%20it%20out%20by%20visiting%20http%3A//jailbreakme.com/%20on%20your%20iOS%20device." class="cell" ontouchstart="">
<span>Tell a Friend</span>
</a>

<div class="body1">
<p>This jailbreak was brought to you by <a href="http://twitter.com/comex">comex</a>, with the help of <a href="http://chpwn.com/">Grant Paul (chpwn)</a>, <a href="http://saurik.com/">Jay Freeman (saurik)</a>, and many others. Please don't use this for piracy.</p>
</div>

<a href="#media" class="cell" ontouchstart="" onclick="return goto('legal')">
<span>Legal</span>
</a>

</div>
</div>
</div>
</div>
</div>

</div>
</div>

<script type="text/javascript">
var buttonState = 0;
var pdf = null;
var container = document.getElementsByClassName('container')[0];
var currentPage;
var small_device = <?php echo $small_device ? 'true' : 'false'; ?>;

function scrollo() {

    <?php if($device == 'computer') { ?>
    var wt = '';
    if(currentPage == 'moreinfo' || currentPage == 'legal') {
        var mt = window.getComputedStyle(container, null).marginTop;
        wt = 'translateY(' + (-parseInt(mt.substring(0, mt.length - 2)) + 30) + 'px)';
    }
    container.style.WebkitTransform = wt;
    <?php } else {?>
    window.scrollTo(0, 1);
    <?php } ?>
}
function goto(where) {
    var initial = typeof currentPage == 'undefined' ? ' freeze' : '';
    var old = currentPage;
    if(old == where) return;
    resetButton();
    window.location.hash = '#' + (currentPage = where);

    if (where) {
        if(container.className.indexOf('page2') == -1) container.className = 'container ' + where + initial;
        document.getElementById('second-label').innerHTML = {'moreinfo': small_device ? 'More Info' : 'More Information', 'legal': small_device ? 'Legal Info' : 'Legal Information', 'share': 'Share', 'success': (small_device ? '&nbsp;&nbsp;&nbsp;' : '') + 'Thanks for Playing!', 'failure': 'Oops...'}[where];
        setTimeout(function() {
            container.className = 'container page2 ' + where + initial;
        }, 0);
    } else {
        container.className = 'container ' + old + initial;
    }
    setTimeout(scrollo, initial ? 0 : 450);

    return false;
}

var currentTime = new Date().getTime();
var old_orientation = window.orientation;
(window.onorientationchange = function(e) {
    var newTime = new Date().getTime();
    if(buttonState == 3 && newTime - currentTime > 200) {
        // discontinuity
        document.getElementById('hax').src = '';
        goto('success');
    }
    currentTime = newTime;
    if (old_orientation != window.orientation)
        scrollo();
    old_orientation = window.orientation;
    if(window.location.hash != currentPage) {
        goto(window.location.hash.substring(1));
    }
})();

setInterval(window.onorientationchange, 50);

<?php if($device != 'computer') { ?>
// try a few times, it usually needs some time to get ready
// before this starts working. not sure why, but it does.
window.onload = function() {
    setTimeout(function() { window.scrollTo(0, 1); }, 10);
    setTimeout(function() { window.scrollTo(0, 1); }, 50);
    setTimeout(function() { window.scrollTo(0, 1); }, 150);
    setTimeout(function() { window.scrollTo(0, 1); }, 250);
};
<?php } // device ?>
    
var bbs = document.getElementById('back-taptarget');
bbs.onmouseup = bbs.ontouchend = function() {
    goto('');
}

var buttonContainer = document.getElementById('button-container');
var buttonShadow = document.getElementsByClassName('button-shadow')[0];
var buttonText = buttonShadow.parentNode.firstChild;

<?php
if ($supported) {
?>

buttonContainer.ontouchend = buttonContainer.onmouseup = function() {
    switch (buttonState) {
    case 0:
        buttonState = 1;
        buttonText.data = '';
        buttonContainer.className = 'button-container button-green button-squashed';
        setTimeout(function() {
            buttonContainer.className = 'button-container button-green button-animated';
            setTimeout(function() {
                buttonState = 2;
                buttonText.data = 'INSTALL';
            }, 270);
        }, 0);
        break;
    case 2:
        if (!pdf) return false;
        buttonState = 3;
        document.getElementById('hax').src = pdf;
        buttonContainer.className = 'button-container button-green button-disabled';
        setTimeout(function() {
            if(buttonState == 3) {
                goto('failed');
            }
        }, 300);
        break;
    }
}

function resetButton() {
    if(!buttonContainer) return;
    buttonState = -1;
    buttonContainer.className = 'button-container button-blue button-stretched';
    buttonText.data = '';
    setTimeout(function() {
        buttonContainer.className = 'button-container button-blue button-animated';
        setTimeout(function() {
            buttonText.data = 'FREE';
            buttonState = 0;
        }, 270);
    }, 0);
}

document.ontouchstart = document.onmousedown = function(evt) {
    var result = false;
    for (var target = evt.target; target; target = target.parentNode) {
        if (target.tagName == 'A') result = true;
        if (target == buttonContainer) return false;
    }
    if (buttonState != 2) return true;

    // we clicked outside
    resetButton();

    return false;
}

<?php } else { /* supported */ ?>
/*document.ontouchstart = document.onmousedown = function(evt) {
    return false;
}*/
function resetButton() {}

<?php } /* supported */ ?>
</script>
<?php if($supported) {
$url = data_encode($pdf, 'application/pdf');
echo "<script>pdf = '$url'</script>\n";
}
?>
</body>
</html>

