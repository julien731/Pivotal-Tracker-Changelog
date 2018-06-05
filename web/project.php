<?php
include( 'templates/header.html' );
include( 'templates/jumbotron.html' ); 
?>

<div class="container">
	<!-- Example row of columns -->
	<div class="row">
		<div class="col-md-4">
			<h2>Project ID</h2>
			<form method="get" action="/">
				<div class="form-group">
					<label for="project_id">Project ID</label>
					<?php
					// Get the Pivotal_Changelog instance.
					$tracker = new Pivotal_Changelog( false, false );

					// Get all the user's projects.
					$projects = $tracker->get_projects();

					// Make sure we have a valid response.
					if ( true !== $projects['success'] ) :
						echo 'Aw. Something went wrong. Did you use an incorrect token?';
					else : ?>

						<select name="project_id" class="form-control" id="project_id">
							<?php
							foreach ( $projects['data'] as $project ) {
								printf( '<option value="%1$s">%2$s</option>', $project['id'], $project['name'] );
							}
							?>
						</select>
					
					<?php endif; ?>
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
