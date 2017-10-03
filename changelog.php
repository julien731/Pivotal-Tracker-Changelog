<?php
/**
 * @var $changelog Pivotal_Changelog
 */
global $changelog;

include( 'templates/header.html' );
$project = $changelog->get_project();  ?>

<div class="jumbotron">
	<div class="container">
		<h1>Changelog for <?php echo $project['data']['name']; ?></h1>
		<h2>Version <?php echo $changelog->get_version(); ?> released on <?php echo date( 'Y-m-d', strtotime( $changelog->get_release_date() ) ); ?></h2>
	</div>
</div>

<div class="container">
	<!-- Example row of columns -->
	<div class="row">
		<div class="col-md-12">
			<ul>
			<?php
			foreach ( $changelog->get_stories()['data'] as $story ) {
				printf( '<li><strong>%1$s:</strong> <a href="%3$s" target="_blank">%2$s</a></li>', strtoupper( $story['story_type'] ), $story['name'], $story['url'] );
			}
			?>
			</ul>
		</div>
	</div>
</div> <!-- /container -->
</body>
</html>
