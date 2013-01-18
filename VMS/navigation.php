<div id="page-wrap">
<div id="logo">
	<img src="images/TVWC_text_logo.png"/>
	<div id="logo2">
		<img src="images/videowing.png"/>
				
	</div>
	<div id="welcome">Welcome, <?php echo $_SESSION["firstname"];?></div>
	
</div>

<ul class="dropdown">
    <li><a href="home.php">Home</a></li>
    <li><a href="#">Channels</a>
	    <ul class="sub_menu">
		    <li><a href="newChannel.php">Add a Channel</a></li>
		    <li>
		        <a href="channels.php">Manage Channels <img src="images/subnav_indicator.png" width="13" height="13" border="0"/></a>
		        <ul class="subnav">
		        	<li><a href="channels.php">ALL</a></li>
		        <?php
		        
		        $chList = $dbService->getAllChannels();
		        foreach ($chList as $thisChan) {
		        	if ($thisChan->getParentID() == 0) {?>
		            <li><a href="channelView.php?channelID=<?php echo $thisChan->getID();?>"><?php echo $thisChan->getName();?>
		        <?php
		        	
						$subChannel = $dbService->getSubChannelsForChannel($thisChan->getID());
						if (sizeof($subChannel) > 0) {
					?>
						<img src="images/subnav_indicator.png" width="13" height="13" border="0"/></a>
						<ul class="subnav">
					<?php
						
							foreach ($subChannel as $subChan) {
					?>
						
								<li><a href="channelView.php?channelID=<?php echo $subChan->getID();?>"><?php echo $subChan->getName();?></a></li>
						
				<?php
							}
				?>
						</ul>
				<?php
						} else {
				?>
						</a>
				<?php
						}
				?>
					</li>
				<?php
		        	}
		        }
		        ?>
		            
		        </ul>
		    </li>  
		    
		</ul>
    </li>    
    <li><a href="#">Videos</a>
    	<ul class="sub_menu">
		    <li><a href="videoDetail.php?newVideo=true">Add a Video</a></li>		
		    <li><a href="videos.php">Manage Videos</a></li>
		</ul>
	</li>
    <li><a href="#">Articles</a>
    	<ul class="sub_menu">
		    <li><a href="articleDetail.php?newArticle=true">Add an Article</a></li>
			<li><a href="articles.php">Manage Articles</a></li>
		</ul>
	</li>
	<?php if ($userType <= 1) {
	?>
    <li><a href="users.php">Users</a>
    	<ul class="sub_menu">
		    <li><a href="changePassword.php">Change Password</a></li>
			<li><a href="users.php">Manage Users</a></li>
		</ul>	
    </li>
   	<?php }
   	?>
<div id="logout"><a href="logout.php">Logout</a></div>   
</ul>



</div>