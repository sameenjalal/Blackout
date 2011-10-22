<?php include_once('header.php'); ?>
<?
	include_once('db_helpers.php');
	//include_once('foursquare_tools.php');
?>
<? if(!get_access_token()): ?>
				<div id="login">
						<form action="login_FS.php" method="get">
							<input type="Submit" name="" value="" id="foursquare_login"/>
						</form>
					<br>
					<br>
					
					<p> It sucks when you can't remember what you did last night, doesn't it?</p>
					<p> That's where we come in. </p>
					<br>
					<p> When you know you're going to blackout tonight, you can just start-up our app on your smartphone. It'll create a summary of your activities that night, and email it to you in the morning when you're sober.</p>
					</div>
				
				<br>
				<br>
				
				<p>With our app, you can:

				<ul> 
					<li>Record your adventures</li>
					<li>Track your phone if you lost it</li>
					<li>Add way points (pictures, text, video, voice)</li>	
					<li>See the locations at which you recieved text messages and calls</li>
				</ul>

				<p>Never miss out on things from a blackout again.</p> <br />
	<? else: ?>
<? 
$ads = get_adventures(get_user_id(get_access_token()));
//debug_r($ads);
?>
Your Adventures: 
<ul>
<?
foreach($ads as $ele)
{
	echo('<li>');
	echo('<a href="/blackout/view_adventure.php?id='.$ele['id'].'"> '.$ele['name']. '</a>');
	echo('</li>');
}
?>
</ul>

<? endif; ?>


				<center>
					<a href="http://www.foursquare.com">FourSquare</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="http://usacs.rutgers.edu">Rutgers USACS</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="http://ruslug.rutgers.edu">RUSLUG</a><br />
					Email: ru_cs@<span style="display:none">null</span>googlegroups.com
				</center>
					</div>

				<div id="box3">
				</div> <!-- box 3 -->
		</div> <!-- center ends -->

	</body>
	
	<footer>
		<div id=fin>
		<p class="final">Copyright©2011 Vaibhav Verma, Sameen Jalal, Joe Galaro & Bilal Quadri</p>
		</div>
	
	</footer>
</html>



