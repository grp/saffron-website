
<html>
<head>
<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>JailbreakMe 3.0</title>
<style type="text/css">

body {
    margin: 0;
    padding: 0;

    font-family: Helvetica NeueUI, Helvetica Neue, Helvetica, Arial, Verdana, sans-serif;
    color: black;

    -webkit-user-select: none;
    -webkit-text-size-adjust: none;
}

.body {
    margin-left: 10px;
    margin-right: 10px;
    font-size: 15px;
    color: black;
}

.body a {
    text-decoration: none;
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
    
    -webkit-border-radius: 4px;
    -webkit-box-shadow: 0 -1px 0px #79797b, 0 1px 0px #ffffff;
    border-top: 1px solid #505050;
    
    padding-top: 1px;
    height: 20px;
    -webkit-border-radius: 4px;
    
    width: 48px;
    text-align: center;
    
    overflow: hidden;
}

.button-shadow {
    margin-left: -100%;
    margin-top: -100%;
    width: 300%;
    height: 300%;
}

#bb-shadow {
    position: absolute;
}

.button:active .button-shadow, #bb-button:active .button-shadow {
    background-color: rgba(0, 0, 0, 0.33);
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

    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(1, #566684),
        color-stop(0.95, #60749b),
        color-stop(0, #32559c)
    );
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
    margin-bottom: -1px;
    position: relative;

    height: 44px;
    width: 100%;
    display: block;
    
    text-decoration: none;

    background-repeat: no-repeat;
    background-image: url(chevron.png);
    background-size: 25px 13px;
    background-position: center right;
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

#bb-button {
<?php if($small_device) { ?>
    background-image: -webkit-gradient(
        linear,
        left top,
        left bottom,
        color-stop(0, #8ea4c1),
        color-stop(0.5, #5877a2),
        color-stop(0.5, #476999),
        color-stop(1, #4a6c9b)
    );
<?php } else { ?>
    background-image: -webkit-gradient(
        linear,
        left top,
        left bottom,
        color-stop(0, #b2b6bc),
        color-stop(1, #6b737e)
    );
<?php } ?>
}

#bb-top, #bb-bottom, #bb-highlight {
    padding-right: 10px !important;
    margin-left: -1px;
}

#bb-top {
    margin-top: -1px;
<?php if($small_device) { ?>
    background-image: -webkit-gradient(
        linear,
        left top,
        left bottom,
        color-stop(0, #30363e),
        color-stop(0.5, #415878),
        color-stop(0.5, #354e71),
        color-stop(1, #375073)
    );
<?php } else { ?>
    background-image: -webkit-gradient(
        linear,
        left top,
        left bottom,
        color-stop(0, #4e4f51),
        color-stop(1, #565b64)
    );
<?php } ?>
}

#bb-bottom, #bb-highlight {
    margin-top: 1px;
<?php if($small_device) { ?>
    background-color: #375073;
<?php } else { ?>
    background-color: #565b64;
<?php } ?>
}

#bb-highlight {
    margin-top: 2px;
<?php if($small_device) { ?>
    background-color: #9cacc0;
<?php } else { ?>
    background-color: #caccd4;
<?php } ?>
}

.navbar-label {
    width: 100%;
}

#back-button {
    left: 0;
    padding-top: 8px;
    font-family: Helvetica NeueUI, Helvetica Neue, Helvetica, Arial, Verdana, sans-serif;
    text-shadow: #4e4e4e 0 -1px 0;
    font-size: 13px;
    line-height: 16px; 
    color: white;
}

#back-button > div {
    position: absolute;
    padding: 6px 8px 6px 11px;
    -webkit-mask-box-image: url(arrow2.svg) 0 0 0 10 repeat repeat;
    -webkit-mask-origin: border;
    border-radius: 4px;
}

.navbar-label, #back-button, .navigation-view {
    -webkit-transition-property: -webkit-transform, opacity;
    -webkit-transition-timing-function: ease-in-out; /* iOS uses exactly this */
    -webkit-transition-duration: 0.35s;
}

       #first-label { -webkit-transform: translateX(0); opacity: 1; }
.page2 #first-label { -webkit-transform: translateX(-100%); opacity: 0; }
       #second-label { -webkit-transform: translateX(60%); opacity: 0; }
.page2 #second-label { -webkit-transform: translateX(0); opacity: 1; }
       #back-button { -webkit-transform: translateX(50%); opacity: 0; }
.page2 #back-button { -webkit-transform: translateX(9px); opacity: 1; }


.navigation-view {
    position: absolute;
    -webkit-transform: translateX(100%);
    display: none;
}

.page2 .navigation-view {
    -webkit-transform: translateX(0);
}

.navigation-view-1 {
    -webkit-transform: translateX(0);
    display: block;
}

.page2 .navigation-view-1 {
    -webkit-transform: translateX(-100%);
}

.navbar-container.page2a #navigation-view-2a { display: block; }
.navbar-container.page2b #navigation-view-2b { display: block; }
.navbar-container.page2c #navigation-view-2c { display: block; }
.navbar-container.page2d #navigation-view-2d { display: block; }


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
    margin-top: 25%;
    margin-bottom: 25%;
    position: relative;
    overflow: hidden;

    background-color: #e1e1e1;

    -webkit-border-radius: 15px;
    -webkit-box-shadow: 0 0 50px black;
    height: 463px;
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

    padding-top: 30px;
    vertical-align: top;
}

.notheader {
    /*float: right;*/
    width: 59%;
    border-left: solid 1px black;
    display: table-cell;
    vertical-align: top;
}

.cell:last-child {
    -webkit-border-bottom-right-radius: 15px;
}

.body {
    padding-left: 5px;
    padding-right: 5px;
    margin-bottom: 10px;
    margin-top: 10px;
    font-size: 16px;
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
    position: absolute;
    line-height: 44px;
    font-size: 22px;
    font-weight: bold;

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
    line-height: 44px;
    font-size: 22px;
    font-weight: bold;
    
    color: white;
    text-shadow: #4e4e4e 0 -1px 0;
}    

.body {
    line-height: 1.3em;
}

.button-holder {
    position: absolute;
}

.button-wrapper {
    position: relative;
}

.button {
    -webkit-transform-origin: right 50%;
}

.button-green .button-text {
    right: 50%;
}

.container {
    width: 322px;
}

@media only screen and (orientation: portrait) {
    .button-holder {
        top: 12px;
        left: 260px;
    }
}

@media only screen and (orientation: landscape) { 
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
}

<?php } // small_device ?>

</style>
</head>
<body>

<div class="container">

<div class="navbar-container">
<div class="navbar">
<div class="navbar-label" id="first-label">JailbreakMe 3</div>
<div class="navbar-label" id="second-label">More Info</div>
<div id="back-button">
<div id="bb-highlight">General</div>
<div id="bb-bottom">General</div>
<div id="bb-top">General</div>
<div id="bb-button" role="button">
<div class="button-shadow" id="bb-shadow"></div>
General
</div>
</div>
</div>

<div class="navigation-view navigation-view-1">
<div class="container2">
<div class="container3">

<div class="header">
<img class="icon" src="icon@2x.png" width="59" height="59" />
<div class="bigicon"></div>
<div class="headertext">
<h1 class="title">Cydia</h1>
<h3 class="subtitle">Jay Freeman (saurik)</h3>
<h3 class="subtitle">Jailbreak by comex.</h3>
<!--<div class="button button-blue" style="width: 40px;">FREE</div>-->
</div>
<div class="button-holder">
<div style="-webkit-transform: scale(1); z-index: 2;" class="button-wrapper">
<div class="button-container button-blue" id="button-container">
<div class="button" role="button">FREE<div class="button-shadow"></div></div>
</div>
</div>
</div>
</div>

<div class="notheader">

<div class="body">
<p>JailbreakMe is the easiest way to free your device. Experience iOS as it could be, fully customizable, themeable, and with every tweak you could possibly imagine.</p>
<p>Safe and completely reversible (just restore in iTunes), jailbreaking gives you control of your own device. It only takes a minute or two, and as always, it's completely free.</p>
</div>

<a href="faq.html" class="cell">
<span>More Information</span>
</a>
<a href="mailto:?Subject=Jailbreak%20your%20iDevice%21&Body=Jailbreak%20your%20iPhone%2C%20iPod%20touch%2C%20or%20iPad%20directly%20from%20the%20device%20itself%21%20JailbreakMe%20is%20the%20simplest%20way%20to%20free%20your%20device.%20Experience%20iOS%20as%20it%20could%20be%2C%20fully%20customizable%2C%20themeable%2C%20and%20with%20every%20tweak%20you%20could%20possibly%20imagine.%0A%0ACheck%20it%20out%20by%20visiting%20http%3A//jailbreakme.com/%20on%20your%20iOS%20device." class="cell">
<span>Tell a Friend</span>
</a>

<!--div class="body">
<p>(Note to media organizations: JailbreakMe uses just one of many paths into iOS. Malicious people will always find a way in, through this path or another. Jailbreaking itself does not affect the security of your device (yes it does).)</p>
</div-->

<div class="body">
<p>This jailbreak was brought to you by <a href="http://twitter.com/comex">comex</a>, with the help of many others, including: <a href="http://chpwn.com/">Grant Paul (chpwn)</a>, [insert-names-here], and <a href="http://saurik.com/">Jay Freeman (saurik)</a>. <a href="legal.html">Legal Information.</a></p>
</div>

<!--todo fix :select-->

<a href="legal" class="cell">
<span>Legal Information</span>
</a>

</div>
</div>
</div>
</div>

</div>

<script type="text/javascript">


var old_orientation = window.orientation;
window.onload = window.onorientationchange = function(e) {
    if (old_orientation != window.orientation)
        window.scrollTo(0, 1);
    old_orientation = window.orientation;
}

/*var is_touchy = (function() {
    var d = document.createElement('div');
    d.setAttribute('ongesturestart', 'return;');
    return (typeof d.ongesturestart == "function")
})();*/


window.onload = function() {
    setTimeout(function() { window.scrollTo(0, 1); }, 10);
    setInterval(window.onorientationchange, 100);
}
    
var bbs = document.getElementById('bb-shadow');

bbs.onmouseup = bbs.ontouchend = function() {
    buttonState = 0;
    buttonText.data = 'FREE';
    container.className = 'button-container button-blue';
    nbc.className = 'navbar-container';
}

var nbc = document.getElementsByClassName('navbar-container')[0];

var container = document.getElementsByClassName('button-container')[0];
var buttonShadow = document.getElementsByClassName('button-shadow')[0];
var buttonText = buttonShadow.firstChild;

var buttonState = 0;

container.ontouchend = container.onmouseup = function() {
    switch(buttonState) {
    case 0:
        buttonState = 1;
        buttonText.data = '';
        container.className = 'button-container button-green button-squashed';
        setTimeout(function() {
            container.className = 'button-container button-green button-animated';
            setTimeout(function() {
                buttonState = 2;
                buttonText.data = 'INSTALL';
            }, 270);
        }, 0);
        break;
    case 2:
        container.className = 'button-container button-pale';
        buttonState = 3;
        alert('really go');
        break;
    }
}

document.ontouchstart = document.onmousedown = function(evt) {
    if(buttonState != 2) return false;
    for(var target = evt.target; target; target = target.parentNode) {
        if(target == container) return false;
    }

    // we clicked outside
    buttonState = -1;

    container.className = 'button-container button-blue button-stretched';
    buttonText.data = '';
    setTimeout(function() {
        container.className = 'button-container button-blue button-animated';
        setTimeout(function() {
            buttonText.data = 'FREE';
            buttonState = 0;
        }, 270);
    }, 0);
    return false;
}

</script>
</body>
</html>

