<?php
	echo $head_start;
	echo $body_start;	
	$site = SITE;
?>

<div class='container-wide-white'>
	<div id='home-header1' class='container-center'>
		<div class='div-row'>
			<div  class='div-col div-700'>
				<a href='<?php echo $site;?>'><img src="<?php echo $site;?>/_images/site/favicon.png"></a>
				<a href='<?php echo $site;?>'>Questions</a>
				<a href='<?php echo $site;?>'>Stories</a>
				<a href='<?php echo $site;?>'>Groups</a>
			</div>
			
			<div class='div-col div-300'>
				<div class='div-row'>
					<div class='div-cell' style='border-spacing:5px;'>
						<input type='text' class='search-input rounded-input' name='search' placeholder='Search Storyville' />
					</div>
					<div class='div-cell'>
						<a href='#' class='btn-green'>Go</a>
					</div>
					<div class='div-cell'>
						<a href='#' class='btn-default'>Login</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id='home-content'>
		<div id='home-content-main'>
			<div class='container-center'>
				<div class='div-cell div-700'>
					<div class='jumbotron-title'>
						<h1>Your bootstrap questions<br />  answered simply</h1>
						<h3>And answered in the nick of time</h3>
					</div>
				</div>
				<div class='div-cell div-300'>
					<form method="post" action="" >
						<input type='text' name='username' id='username' class='form-control form-control-lg' placeholder='Username (min. 5 characters)' />
						<input type='text' name='email' id='email' class='form-control form-control-lg' placeholder='Email (stays private)' />
						<input type='text' name='password' id='password' class='form-control form-control-lg' placeholder='Password (min. 6 characters)' />
						<p class='form-control-note'>Use at least one number</p>
						<a href='#' class="btn-green-submit">Signup For Storyville</a>
						<p class='form-control-disclaimer'>
							By clicking "Sign up for Storyville", you agree to our terms of service and privacy policy. We'll occasionally send you account related emails.
						</p>
					</form>
				</div>
			</div>
		</div>
	<div>
	
</div>