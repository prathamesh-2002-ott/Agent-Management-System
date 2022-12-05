<!DOCTYPE html>
<html>
<body>

<p>Click the button to write some text in the new window and the source (parent) window.</p>

<button onclick="myFunction()">Try it</button>

<script>
function myFunction() {
  var myWindow = window.open("","MyWindow", "width=200,height=100");
  myWindow.document.write("<p>This is 'myWindow'</p>");
  myWindow.opener.document.write("<p>This is the source window!</p>");
}

function openWin() {
  myWindow = window.open("", "myWindow", "width=200,height=100");   // Opens a new window
}

function closeWin() {
  myWindow.close();   // Closes the new window
}


var newwindow;
function createPop(url, name)
{    
   newwindow=window.open(url,name,'width=560,height=340,toolbar=0,menubar=0,location=0');  
   if (window.focus) {newwindow.focus()}
}

var popupWindow=null;

function popup()
{
    popupWindow = window.open('child_page.html','name','width=200,height=200');
}

function parent_disable() {
if(popupWindow && !popupWindow.closed)
popupWindow.focus();
}
</script>

</body>
</html>
<!-- <body onFocus="parent_disable();" onclick="parent_disable();"> -->

<!-- for modwl popup window -->




<?php /*

function OpenModalPopUP()
{
window.showModalDialog(‘page.aspx’);
window.location.reload();
}

<!DOCTYPE html>
<html>
<body>

<p>Click the button to show the dialog.</p>

<button onclick="myFunction()">Show dialog</button>

<p><b>Note:</b> Use the "Esc" button to close the modal.</p>
<p><b>Note:</b> The dialog element is only supported in Chrome 37+, Safari 6+ and Opera 24+.</p>

<dialog id="myDialog">This is a dialog window</dialog>

<script>
function myFunction() { 
  document.getElementById("myDialog").showModal(); 
} 
</script>

</body>
</html>

openDialog("http://example.tld/zzz.xul", "dlg", "", "pizza", 6.98);

var win = openDialog("http://example.tld/zzz.xul", "dlg", "", "pizza", 6.98);



<style>
html, body {
    height:100%
}


#overlay { 
    position:absolute;
    z-index:10;
    width:100%;
    height:100%;
    top:0;
    left:0;
    background-color:#f00;
    filter:alpha(opacity=10);
    -moz-opacity:0.1;
    opacity:0.1;
    cursor:pointer;

} 

.dialog {
    position:absolute;
    border:2px solid #3366CC;
    width:250px;
    height:120px;
    background-color:#ffffff;
    z-index:12;
}

</style>
<script type="text/javascript">
$(document).ready(function() { init() })

function init() {
    $('#overlay').click(function() { closeDialog(); })
}

function openDialog(element) {
    //this is the general dialog handler.
    //pass the element name and this will copy
    //the contents of the element to the dialog box

    $('#overlay').css('height', $(document.body).height() + 'px')
    $('#overlay').show()
    $('#dialog').html($(element).html())
    centerMe('#dialog')
    $('#dialog').show();
}

function closeDialog() {
    $('#overlay').hide();
    $('#dialog').hide().html('');
}

function centerMe(element) {
    //pass element name to be centered on screen
    var pWidth = $(window).width();
    var pTop = $(window).scrollTop()
    var eWidth = $(element).width()
    var height = $(element).height()
    $(element).css('top', '130px')
    //$(element).css('top',pTop+100+'px')
    $(element).css('left', parseInt((pWidth / 2) - (eWidth / 2)) + 'px')
}


</script>


<a href="javascript:;//close me" onclick="openDialog($('#content'))">show dialog A</a>

<a href="javascript:;//close me" onclick="openDialog($('#contentB'))">show dialog B</a>

<div id="dialog" class="dialog" style="display:none"></div>
<div id="overlay" style="display:none"></div>
<div id="content" style="display:none">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nisl felis, placerat in sollicitudin quis, hendrerit vitae diam. Nunc ornare iaculis urna. 
</div>

<div id="contentB" style="display:none">
    Moooo mooo moo moo moo!!! 
</div>


.windowModal {
    position: fixed;
    font-family: Arial, Helvetica, sans-serif;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0,0,0,0.8);
    z-index: 99999;
    opacity:0;
    -webkit-transition: opacity 400ms ease-in;
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;
    pointer-events: none;
}
.windowModal:target {
    opacity:1;
    pointer-events: auto;
}

.windowModal > div {
    width: 400px;
    position: relative;
    margin: 10% auto;
    padding: 5px 20px 13px 20px;
    border-radius: 10px;
    background: #fff;
    background: -moz-linear-gradient(#fff, #999);
    background: -webkit-linear-gradient(#fff, #999);
    background: -o-linear-gradient(#fff, #999);
}
.close {
    background: #606061;
    color: #FFFFFF;
    line-height: 25px;
    position: absolute;
    right: -12px;
    text-align: center;
    top: -10px;
    width: 24px;
    text-decoration: none;
    font-weight: bold;
    -webkit-border-radius: 12px;
    -moz-border-radius: 12px;
    border-radius: 12px;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    box-shadow: 1px 1px 3px #000;
}

.close:hover { background: #00d9ff; }

<a href="#divModal">Open Modal Window</a>

<div id="divModal" class="windowModal">
    <div>
        <a href="#close" title="Close" class="close">X</a>
        <h2>Modal Dialog</h2>
        <p>This example shows a modal window without using javascript only using html5 and css3, I try it it¡</p>
        <p>Using javascript, with new versions of html5 and css3 is not necessary can do whatever we want without using js libraries.</p>
    </div>
</div>






<!-- begin snippet: js hide: false console: true babel: null -->

<!-- language: lang-css -->

    .windowModal {
        position: fixed;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.8);
        z-index: 99999;
        opacity:0;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        pointer-events: none;
    }
    .windowModal:target {
        opacity:1;
        pointer-events: auto;
    }

    .windowModal > div {
        width: 400px;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
        background: -moz-linear-gradient(#fff, #999);
        background: -webkit-linear-gradient(#fff, #999);
        background: -o-linear-gradient(#fff, #999);
    }
    .close {
        background: #606061;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        right: -12px;
        text-align: center;
        top: -10px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        border-radius: 12px;
        -moz-box-shadow: 1px 1px 3px #000;
        -webkit-box-shadow: 1px 1px 3px #000;
        box-shadow: 1px 1px 3px #000;
    }

    .close:hover { background: #00d9ff; }

<!-- language: lang-html -->

    <a href="#divModal">Open Modal Window</a>

    <div id="divModal" class="windowModal">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h2>Modal Dialog</h2>
            <p>This example shows a modal window without using javascript only using html5 and css3, I try it it¡</p>
            <p>Using javascript, with new versions of html5 and css3 is not necessary can do whatever we want without using js libraries.</p>
        </div>
    </div>

<!-- end snippet -->



*/?>