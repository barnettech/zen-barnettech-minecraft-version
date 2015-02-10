<?php
/**
 * @file
 * Zen theme's implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $secondary_menu_heading: The title of the menu used by the secondary links.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['navigation']: Items for the navigation region, below the main menu (if any).
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['footer']: Items for the footer region.
 * - $page['bottom']: Items to appear at the bottom of the page below the footer.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess_page()
 * @see template_process()
 */
?>

<div id="page">

  <header id="header" role="banner">


    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"><img src="<?php print $logo; ?>" alt="<?php //print t('Home'); ?>" /></a>
    <?php endif; ?>

    <?php if ($site_name || $site_slogan): ?>
      <hgroup id="name-and-slogan">
        <?php if ($site_name): ?>
          <h1 id="site-name">
            <a href="<?php print $front_page; ?>" title="<?php //print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
          </h1>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <h2 id="site-slogan"><?php print $site_slogan; ?></h2>
        <?php endif; ?>
      </hgroup><!-- /#name-and-slogan -->
    <?php endif; ?>

    <?php if ($secondary_menu): ?>
      <nav id="secondary-menu" role="navigation">
        <?php print theme('links__system_secondary_menu', array(
          'links' => $secondary_menu,
          'attributes' => array(
            'class' => array('links', 'inline', 'clearfix'),
          ),
          'heading' => array(
            'text' => $secondary_menu_heading,
            'level' => 'h2',
            'class' => array('element-invisible'),
          ),
        )); ?>
      </nav>
    <?php endif; ?>

    <?php print render($page['header']); ?>

  </header>

  <div id="main">

    <div id="content" class="column" role="main">
      <?php print render($page['highlighted']); ?>
      <?php print $breadcrumb; ?>
      <a id="main-content"></a>
      <div id="container"></div>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div><!-- /#content -->

    <div id="navigation">

      <?php if ($main_menu): ?>
        <nav id="main-menu" role="navigation">
          <?php
          // This code snippet is hard to modify. We recommend turning off the
          // "Main menu" on your sub-theme's settings form, deleting this PHP
          // code block, and, instead, using the "Menu block" module.
          // @see http://drupal.org/project/menu_block
          print theme('links__system_main_menu', array(
            'links' => $main_menu,
            'attributes' => array(
              'class' => array('links', 'inline', 'clearfix'),
            ),
            'heading' => array(
              'text' => t('Main menu'),
              'level' => 'h2',
              'class' => array('element-invisible'),
            ),
          )); ?>
        </nav>
      <?php endif; ?>

      <?php print render($page['navigation']); ?>

    </div><!-- /#navigation -->

    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second): ?>
      <aside class="sidebars">
        <?php print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      </aside><!-- /.sidebars -->
    <?php endif; ?>

  </div><!-- /#main -->

  <?php print render($page['footer']); ?>

</div><!-- /#page -->
<script>

			if ( ! Detector.webgl ) {

				Detector.addGetWebGLMessage();
				document.getElementById( 'container' ).innerHTML = "";

			}

			var fogExp2 = true;

			var container, stats;

			var camera, controls, scene, renderer;

			var mesh, mat;

			var worldWidth = 200, worldDepth = 200,
			worldHalfWidth = worldWidth / 2, worldHalfDepth = worldDepth / 2,
			data = generateHeight( worldWidth, worldDepth );

			var clock = new THREE.Clock();

			init();
			animate();

			function init() {

				container = document.getElementById( 'container' );

				camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 1, 20000 );
				camera.position.y = getY( worldHalfWidth, worldHalfDepth ) * 100 + 100;

				controls = new THREE.FirstPersonControls( camera );

				controls.movementSpeed = 1000;
				controls.lookSpeed = 0.125;
				controls.lookVertical = true;
				controls.constrainVertical = true;
				controls.verticalMin = 1.1;
				controls.verticalMax = 2.2;

				scene = new THREE.Scene();
				scene.fog = new THREE.FogExp2( 0xffffff, 0.00015 );

				// sides
				
				var light = new THREE.Color( 0xffffff );
				var shadow = new THREE.Color( 0x505050 );

				var matrix = new THREE.Matrix4();

				var pxGeometry = new THREE.PlaneGeometry( 100, 100 );
				pxGeometry.faces[ 0 ].vertexColors = [ light, shadow, light ];
				pxGeometry.faces[ 1 ].vertexColors = [ shadow, shadow, light ];
				pxGeometry.faceVertexUvs[ 0 ][ 0 ][ 0 ].y = 0.5;
				pxGeometry.faceVertexUvs[ 0 ][ 0 ][ 2 ].y = 0.5;
				pxGeometry.faceVertexUvs[ 0 ][ 1 ][ 2 ].y = 0.5;
				pxGeometry.applyMatrix( matrix.makeRotationY( Math.PI / 2 ) );
				pxGeometry.applyMatrix( matrix.makeTranslation( 50, 0, 0 ) );

				var nxGeometry = new THREE.PlaneGeometry( 100, 100 );
				nxGeometry.faces[ 0 ].vertexColors = [ light, shadow, light ];
				nxGeometry.faces[ 1 ].vertexColors = [ shadow, shadow, light ];
				nxGeometry.faceVertexUvs[ 0 ][ 0 ][ 0 ].y = 0.5;
				nxGeometry.faceVertexUvs[ 0 ][ 0 ][ 2 ].y = 0.5;
				nxGeometry.faceVertexUvs[ 0 ][ 1 ][ 2 ].y = 0.5;
				nxGeometry.applyMatrix( matrix.makeRotationY( - Math.PI / 2 ) );
				nxGeometry.applyMatrix( matrix.makeTranslation( - 50, 0, 0 ) );

				var pyGeometry = new THREE.PlaneGeometry( 100, 100 );
				pyGeometry.faces[ 0 ].vertexColors = [ light, light, light ];
				pyGeometry.faces[ 1 ].vertexColors = [ light, light, light ];
				pyGeometry.faceVertexUvs[ 0 ][ 0 ][ 1 ].y = 0.5;
				pyGeometry.faceVertexUvs[ 0 ][ 1 ][ 0 ].y = 0.5;
				pyGeometry.faceVertexUvs[ 0 ][ 1 ][ 1 ].y = 0.5;
				pyGeometry.applyMatrix( matrix.makeRotationX( - Math.PI / 2 ) );
				pyGeometry.applyMatrix( matrix.makeTranslation( 0, 50, 0 ) );

				var py2Geometry = new THREE.PlaneGeometry( 100, 100 );
				py2Geometry.faces[ 0 ].vertexColors = [ light, light, light ];
				py2Geometry.faces[ 1 ].vertexColors = [ light, light, light ];
				py2Geometry.faceVertexUvs[ 0 ][ 0 ][ 1 ].y = 0.5;
				py2Geometry.faceVertexUvs[ 0 ][ 1 ][ 0 ].y = 0.5;
				py2Geometry.faceVertexUvs[ 0 ][ 1 ][ 1 ].y = 0.5;
				py2Geometry.applyMatrix( matrix.makeRotationX( - Math.PI / 2 ) );
				py2Geometry.applyMatrix( matrix.makeRotationY( Math.PI / 2 ) );
				py2Geometry.applyMatrix( matrix.makeTranslation( 0, 50, 0 ) );

				var pzGeometry = new THREE.PlaneGeometry( 100, 100 );
				pzGeometry.faces[ 0 ].vertexColors = [ light, shadow, light ];
				pzGeometry.faces[ 1 ].vertexColors = [ shadow, shadow, light ];
				pzGeometry.faceVertexUvs[ 0 ][ 0 ][ 0 ].y = 0.5;
				pzGeometry.faceVertexUvs[ 0 ][ 0 ][ 2 ].y = 0.5;
				pzGeometry.faceVertexUvs[ 0 ][ 1 ][ 2 ].y = 0.5;
				pzGeometry.applyMatrix( matrix.makeTranslation( 0, 0, 50 ) );

				var nzGeometry = new THREE.PlaneGeometry( 100, 100 );
				nzGeometry.faces[ 0 ].vertexColors = [ light, shadow, light ];
				nzGeometry.faces[ 1 ].vertexColors = [ shadow, shadow, light ];
				nzGeometry.faceVertexUvs[ 0 ][ 0 ][ 0 ].y = 0.5;
				nzGeometry.faceVertexUvs[ 0 ][ 0 ][ 2 ].y = 0.5;
				nzGeometry.faceVertexUvs[ 0 ][ 1 ][ 2 ].y = 0.5;
				nzGeometry.applyMatrix( matrix.makeRotationY( Math.PI ) );
				nzGeometry.applyMatrix( matrix.makeTranslation( 0, 0, - 50 ) );

				//

				var geometry = new THREE.Geometry();
				var dummy = new THREE.Mesh();

				for ( var z = 0; z < worldDepth; z ++ ) {

					for ( var x = 0; x < worldWidth; x ++ ) {

						var h = getY( x, z );

						matrix.makeTranslation(
							x * 100 - worldHalfWidth * 100,
							h * 100,
							z * 100 - worldHalfDepth * 100
						);

						var px = getY( x + 1, z );
						var nx = getY( x - 1, z );
						var pz = getY( x, z + 1 );
						var nz = getY( x, z - 1 );

						var pxpz = getY( x + 1, z + 1 );
						var nxpz = getY( x - 1, z + 1 );
						var pxnz = getY( x + 1, z - 1 );
						var nxnz = getY( x - 1, z - 1 );

						var a = nx > h || nz > h || nxnz > h ? 0 : 1;
						var b = nx > h || pz > h || nxpz > h ? 0 : 1;
						var c = px > h || pz > h || pxpz > h ? 0 : 1;
						var d = px > h || nz > h || pxnz > h ? 0 : 1;

						if ( a + c > b + d ) {

							var colors = py2Geometry.faces[ 0 ].vertexColors;
							colors[ 0 ] = b === 0 ? shadow : light;
							colors[ 1 ] = c === 0 ? shadow : light;
							colors[ 2 ] = a === 0 ? shadow : light;

							var colors = py2Geometry.faces[ 1 ].vertexColors;
							colors[ 0 ] = c === 0 ? shadow : light;
							colors[ 1 ] = d === 0 ? shadow : light;
							colors[ 2 ] = a === 0 ? shadow : light;
							
							geometry.merge( py2Geometry, matrix );

						} else {

							var colors = pyGeometry.faces[ 0 ].vertexColors;
							colors[ 0 ] = a === 0 ? shadow : light;
							colors[ 1 ] = b === 0 ? shadow : light;
							colors[ 2 ] = d === 0 ? shadow : light;

							var colors = pyGeometry.faces[ 1 ].vertexColors;
							colors[ 0 ] = b === 0 ? shadow : light;
							colors[ 1 ] = c === 0 ? shadow : light;
							colors[ 2 ] = d === 0 ? shadow : light;
							
							geometry.merge( pyGeometry, matrix );

						}

						if ( ( px != h && px != h + 1 ) || x == 0 ) {

							var colors = pxGeometry.faces[ 0 ].vertexColors;
							colors[ 0 ] = pxpz > px && x > 0 ? shadow : light;
							colors[ 2 ] = pxnz > px && x > 0 ? shadow : light;

							var colors = pxGeometry.faces[ 1 ].vertexColors;
							colors[ 2 ] = pxnz > px && x > 0 ? shadow : light;

							geometry.merge( pxGeometry, matrix );

						}

						if ( ( nx != h && nx != h + 1 ) || x == worldWidth - 1 ) {

							var colors = nxGeometry.faces[ 0 ].vertexColors;
							colors[ 0 ] = nxnz > nx && x < worldWidth - 1 ? shadow : light;
							colors[ 2 ] = nxpz > nx && x < worldWidth - 1 ? shadow : light;

							var colors = nxGeometry.faces[ 1 ].vertexColors;
							colors[ 2 ] = nxpz > nx && x < worldWidth - 1 ? shadow : light;

							geometry.merge( nxGeometry, matrix );

						}

						if ( ( pz != h && pz != h + 1 ) || z == worldDepth - 1 ) {

							var colors = pzGeometry.faces[ 0 ].vertexColors;
							colors[ 0 ] = nxpz > pz && z < worldDepth - 1 ? shadow : light;
							colors[ 2 ] = pxpz > pz && z < worldDepth - 1 ? shadow : light;

							var colors = pzGeometry.faces[ 1 ].vertexColors;
							colors[ 2 ] = pxpz > pz && z < worldDepth - 1 ? shadow : light;

							geometry.merge( pzGeometry, matrix );

						}

						if ( ( nz != h && nz != h + 1 ) || z == 0 ) {

							var colors = nzGeometry.faces[ 0 ].vertexColors;
							colors[ 0 ] = pxnz > nz && z > 0 ? shadow : light;
							colors[ 2 ] = nxnz > nz && z > 0 ? shadow : light;

							var colors = nzGeometry.faces[ 1 ].vertexColors;
							colors[ 2 ] = nxnz > nz && z > 0 ? shadow : light;

							geometry.merge( nzGeometry, matrix );

						}

					}

				}

				var texture = THREE.ImageUtils.loadTexture( '/sites/default/files/textures/minecraft/atlas.png' );
				texture.magFilter = THREE.NearestFilter;
				texture.minFilter = THREE.LinearMipMapLinearFilter;

				var mesh = new THREE.Mesh( geometry, new THREE.MeshLambertMaterial( { map: texture, ambient: 0xbbbbbb, vertexColors: THREE.VertexColors } ) );
				scene.add( mesh );

				var ambientLight = new THREE.AmbientLight( 0xcccccc );
				scene.add( ambientLight );

				var directionalLight = new THREE.DirectionalLight( 0xffffff, 2 );
				directionalLight.position.set( 1, 1, 0.5 ).normalize();
				scene.add( directionalLight );

				renderer = new THREE.WebGLRenderer();
				renderer.setClearColor( 0xffffff );
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );

				container.innerHTML = "";

				container.appendChild( renderer.domElement );

				stats = new Stats();
				stats.domElement.style.position = 'absolute';
				stats.domElement.style.top = '0px';
				container.appendChild( stats.domElement );

				//

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

				controls.handleResize();

			}

			function loadTexture( path, callback ) {

				var image = new Image();

				image.onload = function () { callback(); };
				image.src = path;

				return image;

			}

			function generateHeight( width, height ) {

				var data = [], perlin = new ImprovedNoise(),
				size = width * height, quality = 2, z = Math.random() * 100;

				for ( var j = 0; j < 4; j ++ ) {

					if ( j == 0 ) for ( var i = 0; i < size; i ++ ) data[ i ] = 0;

					for ( var i = 0; i < size; i ++ ) {

						var x = i % width, y = ( i / width ) | 0;
						data[ i ] += perlin.noise( x / quality, y / quality, z ) * quality;

					}

					quality *= 4

				}

				return data;

			}

			function getY( x, z ) {

				return ( data[ x + z * worldWidth ] * 0.2 ) | 0;

			}

			//

			function animate() {

				requestAnimationFrame( animate );

				render();
				stats.update();

			}

			function render() {

				controls.update( clock.getDelta() );
				renderer.render( scene, camera );

			}

		</script>



<?php print render($page['bottom']); ?>
