<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>HTTP secure streaming with FlowPlayer</title>
    <style>
		body{font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; color:#333; background-color:#f9f9f9; font-size:14px; line-height:1.4em;}
		ul li,li ul li{margin:10px 0;}
		#container{width:760px; margin:30px auto;}
		a:link, a:visited, a:active{color:#08C; text-decoration:none;}
		a:hover{color:#005580;}
		#dl{float:left;font-size:30px; margin-top:6px;}
		img{float:left; margin-right:10px;}
		.clear{clear:both;}
    </style>
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
					url: "theowlnamedorion.mp3", //Change this to any mp3 file in the secure folder
					autoPlay: false,
					urlResolvers: "secure",
					baseUrl: "secure"
					//More player options here: http://flowplayer.org/documentation/configuration/clips.html
				}
			});
		
		});
    </script>
</head>

<body>

    <div id="container">
    
        <h1>HTTP secure streaming with FlowPlayer</h1>
        
        <p><a href="https://github.com/rantastic/Secure-http-streaming-with-FlowPlayer"><img src="../img/github_white_black_cat_32.png" alt""/></a><a id="dl" href="https://github.com/rantastic/Secure-http-streaming-with-FlowPlayer">Download On Github</a></p>
        <br class="clear"/>
        
        <p>Prevent a streaming audio (or other media) file from being downloaded by user.</p>
    
        <h3>Basic rundown of process:</h3>
        
        <ul>
        
            <li>User clicks play</li>
        
            <li>The FlowPlayer calls the mp3 file from a link structured like this:
            
                <ul>
            
                    <li>http://yourdomain.com/secure/SECURITYHASH/TIMESTAMP/musicfile.mp3</li>
                    <li>The security hash is a md5 of Token/MusicfileTimestamp.</li>
                    <li>The token is a security keyphrase that can be compiled into FlowPlayer.</li>
                    <li>If none is compiled in, a default token provided by FlowPlayer is used</li>
                    
                </ul>
            
            </li>
            
            <li>The .htaccess grabs any request for the secure folder and turns the link into this
        
                <ul>
                
                    <li>http://yourdomain.com/secure/audio.php?h=SECURITYHASH&amp;t=TIMESTAMP&amp;v=musicfile.mp3</li>
                    
                </ul>
            
            </li>
                    
            <li>The audio.php file then checks that the hash is correct and that the<br/>
              current time is within 2 seconds of the timestamp (This makes it so the<br/>
              user can't just grab the link that was called from the network requests and<br/>
              use it later).  If everything checks out, the audio.php loads the file with<br/>
              the correct audio/mpeg headers, otherwise it redirects to the secure root which will<br/>
              show a forbidden error message.</li>
        
        </ul>
          
        <p>The only way a user could theoretically download the file is if the knew the token<br/>
        used (which is why its best to compile your own).  Figure out how the token is salted <br/>
        with the timestamp and file name, create a corresponding link with a timestamp in the<br/>
        future, click the player and load the link within 2 seconds of clicking.</p>
        
                
        <p><a id="player" style="display:block;width:300px;height:30px;"></a>
        <a href="http://www.danosongs.com" target="_blank">Music by DanoSongs.com</a></p>
            
        <p>Shoot me an <a href="mailto:billjohnston4@gmail.com">email</a> if you find any security holes</p>
        
        <p>*********Future development*********<br/>
        I would like to be able to add a multiple track playlist, but I ran into problems with<br/>
        the timestamp.  FlowPlayer seems to get the timestamp once,  and use it for any future<br/>
        calls.  This, of course, causes issues with the 2 second time limit on downloading the file.<br/>
        ************************************</p>
        
        <p>sources:<br/>
        http://flowplayer.blacktrash.org/secure-http.html<br/>
        http://flowplayer.org/documentation/</p>
        
    </div>
        
</body>
</html>