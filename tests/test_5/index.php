<?php
//=============================================================================
// Author   : M@nKind - Geert Weggemans 
// Date     : 12-11-2015
// Project  : Multi
// Goal     : Populate multiple elements with html with AJAX/JSON Call
//=============================================================================
class myMultiController
{
    protected $_isajax;
//=============================================================================
    public function __construct()
    {
            $this->_isajax = $this->_getVar("action") == "ajaxcall";
    }
//=============================================================================
    public function handleRequest()
    {
            if ($this->_isajax)
            {
                    $this->_handleAjaxRequest();
            }
            else
            {
                    $this->_handlePageRequest();
            }    
    }
//=============================================================================
    protected function _getVar($name, $default="NOPPES")
    {
            return isset($_GET[$name])? $_GET[$name] : $default;
    }
//=============================================================================
    protected function _echoJSONElementArray()
    {
            $code = file_get_contents('http://loripsum.net/api');
            $dateTime = new DateTime("now");
            $y = $dateTime->format("Y");
            $data = array();
            $data[] = array('target'=>"div#top",     "content" => "<h1>Multi Element Test</h1>");    
            $data[] = array('target'=>"div#mid",     "content" => "<code>".$code."</code>");    
            $data[] = array('target'=>"div#bot",     "content" => "<h2>&copy; ".$y." Geert</h2>");    
            header("Content-type: application/json");
            echo json_encode($data);
    }
//=============================================================================
    protected function _handleAjaxRequest()
    {
            $func = $this->_getVar('func');
            switch ($func)
            {
                case "populate":
                    $this->_echoJSONElementArray();
                    break;
                default:
                    echo "<h1>OOPS : no action defined for [".$func."]</h1>";
                    break;
            }
    }
//=============================================================================
    protected function _handlePageRequest()
    {    
            echo <<<EOD
<html>
<head>
<title>JQuery Multiple Element Response</title>
<meta name="author" content="M@NKIND - Geert Weggemans" />
<style>
div.fullscreen { border : 1px solid black;  margin : 10px; padding : 10px; font-size:12px; }
div#top {background-color : #b0b0b0;  min-height : 50px;}
div#mid {background-color : #e0e0e0;  min-height : 100px;}
div#bot {background-color : #a0a0a0;  min-height : 50px;}
</style>
</head>
<body>
<div class="fullscreen" id="top">Top DIV</div>
<div class="fullscreen" id="mid"><button id="populate">Ajax populate</button></div>
<div class="fullscreen" id="bot">Bottom DIV</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="main.js"></script>
</body>
</html>
EOD;
    }
} 
//=============================================================================
// MAIN APP :
//=============================================================================
$mycontroller = new myMultiController();
$mycontroller->handleRequest();
?>