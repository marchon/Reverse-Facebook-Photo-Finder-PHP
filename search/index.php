<?php
# AF$#TQge3q4g4
# http://gumroad.com/l/pstkqs
# http://www.w3schools.com/PHP/php_ajax_database.asp

# Image File Naming Schemes
# 33928_152487554786401_100000754713948_237838_7543147_n.jpg
# UNKNOWN_UNKNOWN_$profileID_UNKNOWN_UNKNOWN_n.jpg
#
# 173272_100001840133300_6350707_n.jpg
# UNKNOWN_$profileID_UNKNOWN_n.jpg
#
# n40700018_31257967_7692.jpg 
# n$profileID_UNKNOWN_UNKNOWN.jpg

# URL regex
$pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|].jpg/i";

if ( $_GET["fname"] != null ) {
  if ( preg_match($pattern, $_GET["fname"]) ) {
    # is a URL
    # explode "/"
    # count
    #last key in array is image
    $fname = $_GET["fname"];
    $urlPart = explode("/", $fname);
    $imageKey = count($urlPart)-1;
    $kaboom = explode("_", $urlPart[$imageKey]);
    $countKaboom = count($kaboom);
    if ( $countKaboom == 6 ) {
      $numID = $kaboom[2];
      }
    elseif ( $countKaboom == 4 ) {
      $numID = $kaboom[1];
      }
    elseif ( $countKaboom == 3 ) {
      $n = array("n", "N");
      $numID = str_replace($n, "", $kaboom[0]);
    } else {

    }
  } else {
    # not an url
    #
    $fname = htmlspecialchars($_GET["fname"], ENT_QUOTES);
    $profileID = explode("_", $fname);
    $whichFormat = count($profileID);
    if ( $whichFormat == 6 ) {
      $numID = $profileID[2];
      }
    elseif ( $whichFormat == 4 ) {
      $numID = $profileID[1];
      }
    elseif ( $whichFormat == 3 ) {
      $n = array("n", "N");
      $numID = str_replace($n, "", $profileID[0]);
    } else {

    }
  }
  $profileLink = "http://www.facebook.com/profile.php?id=".$numID;
  $profileImage = "http://graph.facebook.com/".$numID."/picture?type=large";
  $graphAPI = file_get_contents("http://graph.facebook.com/".$numID);
  $graphJSON = json_decode($graphAPI, true);
  $name = $graphJSON[name];
  $link = $graphJSON[link];
  $gender = $graphJSON[gender];

echo '<b>RESULTS</b><br /><a href= "'.$link.'"><img src="'.$profileImage.'" /><br />'.$name.'</a> '.$gender;
}

#######

if ( $_POST["fname"] != null ) {
  if ( preg_match($pattern, $_POST["fname"]) ) {
    # is a URL
    # explode "/"
    # count
    #last key in array is image
    $fname = $_POST["fname"];
    $urlPart = explode("/", $fname);
    $imageKey = count($urlPart)-1;
    $kaboom = explode("_", $urlPart[$imageKey]);
    $countKaboom = count($kaboom);
    if ( $countKaboom == 6 ) {
      $numID = $kaboom[2];
      }
    elseif ( $countKaboom == 4 ) {
      $numID = $kaboom[1];
      }
    elseif ( $countKaboom == 3 ) {
      $n = array("n", "N");
      $numID = str_replace($n, "", $kaboom[0]);
    } else {

    }
  } else {
    # not an url
    #
    $fname = htmlspecialchars($_POST["fname"], ENT_QUOTES);
    $profileID = explode("_", $fname);
    $whichFormat = count($profileID);
    if ( $whichFormat == 6 ) {
      $numID = $profileID[2];
      }
    elseif ( $whichFormat == 4 ) {
      $numID = $profileID[1];
      }
    elseif ( $whichFormat == 3 ) {
      $n = array("n", "N");
      $numID = str_replace($n, "", $profileID[0]);
    } else {

    }
  }
  $profileLink = "http://www.facebook.com/profile.php?id=".$numID;
  $profileImage = "http://graph.facebook.com/".$numID."/picture?type=large";
  $graphAPI = file_get_contents("http://graph.facebook.com/".$numID);
  $graphJSON = json_decode($graphAPI, true);
  $name = $graphJSON[name];
  $link = $graphJSON[link];
  $gender = $graphJSON[gender][0];
?>
<!doctype html>
<html lang="en">
	<head>
  <title>Brag College - FaceBook Reverse Image Lookup</title>
	<meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="/facebook/reverse/search.css" media="all">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
//<![CDATA[
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
   }
  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
   }
  else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
    xmlhttp.onreadystatechange=function()
   {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","/facebook/reverse/search/?fname="+str,true);
  xmlhttp.send();
  }
  //]]>
  </script>
  <style>
  .button {
    background-color: #5A74A9;
    border-radius: 7px 7px 7px 7px;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 12px;
    font-weight: bold;
    padding: 6px;
}

.buttonborder {
    border: 1px solid #1A3073;
}
  </style>
</head>
<body>
  <div id="container">

    <div id="head">
      <div id="tag"><h1>FaceBook Reverse Image Lookup</h1>
  </div>
    </div>
    <div id="body">		
      <div id="updates">  
        <form action="/facebook/reverse/search/" method="post">
          <label class="header" for="q">Reverse Facebook Photo: </label>
          <input id="q" name="fname" type="text"/>
          <input id="search" class="button buttonborder" type="button" value="Search" onclick="showUser(fname.value)">
        </form>

        
        <div id="results"></div>
          <center><div class="c1" id="txtHint">
    <? echo '<b>RESULTS</b><br /><a href= "'.$link.'"><img src="'.$profileImage.'" /><br />'.$name.'</a> ('.$gender.')'; ?>
  </div></center>
        <div class="waitloading"><img src='images/spinner.gif'></div>
        <div id="finished">No more results. Try another search!</div>
        </div>
      </div>
    </div>
	</body>
</html>
<?
}
?>
