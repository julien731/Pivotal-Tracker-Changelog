<?php
include( 'templates/header.html' );
include( 'templates/jumbotron.html' ); 
?>

<div class="container">
	<!-- Example row of columns -->
	<div class="row">
		<div class="col-md-4">
			<h2>Tracker Token</h2>
			<form method="get" action="/">
				<div class="form-group">
					<label for="version">Token</label>
					<input type="text" name="user_token" class="form-control" id="user_token" placeholder="User token">
				</div>
				<button type="submit" class="btn btn-primary">Save Token</button>
			</form>
		</div>
		<div class="col-md-4">
			<h2>What About My Token?</h2>
			<p>We need your token to get the projects and changes from your Pivotal Tracker account.</p>
			<p>After you've set your token, we will save it in a cookie to avoid asking you to enter it every time.</p>
		</div>
		<div class="col-md-4">
			<h2>Where Do I Find It?</h2>
			<p>Easy peasy. You can find your token on your Tracker profile page. <a href="https://www.pivotaltracker.com/profile" target="_blank">Just click here.</a></p>
		</div>
	</div>
</div> <!-- /container -->
</body>
</html>
