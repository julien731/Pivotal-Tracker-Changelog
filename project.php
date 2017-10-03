<?php include( 'templates/header.html' ); ?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
	<div class="container">
		<h1>Changelogs for Pivotal</h1>
		<p>Do you like copy-pasting? No? Me neither. Let's get those changelogs generated automatically! This method for generating changelogs for Pivotal Tracker projects is based on the workflow used at
			<a href="https://nimbl3.com" target="_blank">Nimbl3</a>.</p>
	</div>
</div>

<div class="container">
	<!-- Example row of columns -->
	<div class="row">
		<div class="col-md-4">
			<h2>Project ID</h2>
			<form method="get" action="/">
				<div class="form-group">
					<label for="project_id">Project ID</label>
					<input type="text" name="project_id" class="form-control" id="project_id" placeholder="Pivotal Tracker project ID">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div>
				<div class="form-group">
					<label for="version">Version</label>
					<input type="text" name="version" class="form-control" id="version" placeholder="Release version">
				</div>
				<button type="submit" class="btn btn-primary">Get Changelog</button>
			</form>
		</div>
		<div class="col-md-4">
			<h2>Selecting a Version</h2>
			<p>Selecting the version that you want to generate the changelog for is dead-simple.</p>
			<p>The pattern that we use for tagging a version to a user story in pivotal is <code>@x.x.x</code> (following semantic visioning).</p>
			<p>For instance, to generate the changelog for version 1.0.0, simply input <code>1.0.0</code> in the "Version" field :)</p>
		</div>
		<div class="col-md-4">
			<h2>Authentication</h2>
			<p>In order to authenticate with Pivotal Tracker, you need to paste your API key in a file called <code>.token</code> at the root of the project.</p>
			<p>Make sure not to share this file!</p>
		</div>
	</div>
</div> <!-- /container -->
</body>
</html>
