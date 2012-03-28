<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="flowplayer/flowplayer-3.2.8.min.js"></script>
    <script>
		$(document).ready(function() {
		
			$f("player", "flowplayer/flowplayer-3.2.8.swf", {
				plugins: {
					secure: {
						url: "flowplayer/flowplayer.securestreaming-3.2.8.swf",
						timestampUrl: "timestamp.php"
					},
					controls: {
						fullscreen: false,
						height: 30,
						autoHide: false,
					}
				},
				
				clip: {
					url: "theowlnamedorion.mp3",
					autoPlay: false,
					urlResolvers: "secure",
					baseUrl: "secure"
				}
			});
		
		});
    </script>
</head>

<body>

    <a id="player" style="display:block;width:300px;height:30px;"></a>
    
    <a href="http://www.danosongs.com">Music by DanoSongs.com</a>
    
</body>
</html>