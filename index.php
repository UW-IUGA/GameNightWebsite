<?php
#tu0100241pc1 to tu0100241pc75 PW: 67995618
error_reporting(E_ALL); 
ini_set( 'display_errors','1');

$STEAM_BASE_ID = "TU0100024PC";
$IP = $_SERVER['REMOTE_ADDR'];
$STEAM_DATA = "steam.json";
$PASSWORD = "5621978112";
$QUARTER = "Autumn 2013";


if(isset($_GET['reset']) && $_GET['reset'] == "iugaofficer"){
	$file = fopen($STEAM_DATA,'w+');
	fwrite($file, "[]");
	fclose($file);
	$reset = true;
}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
    	<title>IUGA Game Night</title>
    	<meta charset="UTF-8">
    	<!-- Bootstrap --><link href="bootstrap.min.css" rel="stylesheet">
    	<link href="style.css" rel="stylesheet">
  	</head>
	<body>
		<div class="container">
		
				<div id="head" class="oneup">
					<audio src="1up.mp3" preload="auto"></audio>
					<img src="head.png">
				</div>
			<div class="centered">
				<div id="countdown">
				<h1>IUGA Game Night: <?= $QUARTER?></h1>
				<h5>Using IP: <?=$IP ?></h5>
			  		<div class="message">
			  			<?php
			  			if(isset($reset) && $reset){
			  				echo '<h2 class="alert alert-danger">Data Reset</h2>';
			  			}
					if(isset($_GET['newid'])){
						//Check for stored IP
						//Output new ID if it doesn't exist or old id if it does
						$json_data = file_get_contents($STEAM_DATA);
						$json = json_decode($json_data, true);
						$uid = getSteamID($json, $IP);

						if(!$uid){
							//Create a new ID
							$uid = array_push($json, $IP);
							$file = fopen($STEAM_DATA,'w+');
							fwrite($file, json_encode($json));
							fclose($file);
						}
						$steamid = $STEAM_BASE_ID . $uid;
						?>
						<p>
							<strong>Steam ID:</strong> <?= $steamid ?><br>
							<strong>Steam Pass:</strong> <?= $PASSWORD ?>
						</p>
						<!-- -login %u %p -->
						<a class="well" href='http://store.steampowered.com/about/?snr=1_4_4__11'>Download Steam!</a>

						<h4>Play some steam games!</h4>
							<ul>
								<li>Team Fortress 2</li>
								<li>Counterstrike: Global Offensive</li>
								<ul>
                                    <li>From the CSGO main menu go to OPTIONS, GAME SETTINGS and select ENABLE DEVELOPER CONSOLE</li>
                                    <li>open console with ~ and type connect iuga.info</li>
                                </ul>
								<li>Dota 2</li>
							</ul>
						<h4> IUGA Official Servers</h4>
							<strong>Access the IUGA server and play together@ url = iuga.info </strong>
							<ul>
								<li>Minecraft (Must either boot into OSX mode, or go down in to IPLC)</li>
								<li>Counterstrike: Global Offensive</li>
								<li>And more!</li>
							</ul>
						<p>To play, simply download the game in Steam after entering your 
						tournament license and the game should load up</p>


<!-- For when Distribution Scripts start working again:

						<h4>These computers have the following games already installed:</h4>
						<ul>
							<li>Team Fortress 2</li>
							<li>Counterstrike: Global Offensive</li>
							<li>Dota 2</li>
						</ul>
						<p>To load, simply download the game in Steam after entering your 
						tournament license and the game should load up.</p> -->
						<?php
					}else{
						?>
					<p>Welcome! Let's play some games!</p>
                    <p>Download <a href="http://store.steampowered.com/">steam</a> and login!</p>
		  				<!-- Inserts links to social pages here -->
		  				<a class="well" href="?newid">Get Steam ID</a>
		  				<a class="well" href="http://ischool.uw.edu/academics/informatics" target="_blank">Learn about Informatics</a>
					<?php } ?>
	  				</div> 		
			  	</div>
			</div>
	    	<div id="games">
	    		<img src="games.png">
	    	</div>
		   <div class="navbar navbar-fixed-bottom">
			<div class="navbar-inner container">
			<a class="brand" href="/">IUGA</a>
			<ul class="nav pull-right">
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Feedback</a>
					<ul class="dropdown-menu">
						<li><a href="https://www.facebook.com/events/436747423108702/" target="_blank">Facebook Event</a></li>
						<li><a href="https://www.facebook.com/groups/info.uw/" target="_blank">IUGA Group</a></li>
						<li class="divider"></li>
						
						<li class="disabled"><a href="#"><strong>Evan Cohen</strong></a></li>
						<li><a href="mailto:evanc3@uw.edu">evanc3@uw.edu</a></li>
						<li><a href="tel:15108624733">1 (510) 862-4733</a></li>

						<li class="divider"></li>

						<li class="disabled"><a href="#"><strong>Ashish Chandwani</strong></a></li>
						<li><a href="mailto:evanc3@uw.edu">ashishsc@uw.edu</a></li>
						<li><a href="tel:4252103873">1 (425) 210-3873</a></li>
					</ul>
				</li>
			</ul>
			</div>
		</div> 
	    </div><!-- /.container -->

	    <script src="jquery-1.8.1.min.js"></script>
    	<script src="bootstrap.min.js"></script>
    <script type="text/javascript">
		$(function(){
		    var oneup     = $('.oneup');
	        var oneupaudio = oneup.find('audio')[0];
		    oneup.hover(function(){
		       oneupaudio.play();
		    }, function(){
		       oneupaudio.stop();
		    });
		});
    </script>
  </body>
</html>

<?php

// Return the steam ID associated with the given IP,
// false if none exists.
function getSteamID($json, $ipAddress){
	$idIndex = array_search($ipAddress, $json);

	for ($i=0; $i < count($json); $i++) { 
		if($json[$i] == $ipAddress){
			return $i + 1;
		}
	}
	return false;
}
?>
