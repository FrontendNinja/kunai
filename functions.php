<?php
/* You shouldn't add functions here, just includes. */

/* FEN Control Panel */
require_once( 'lib/fen-admin-page-framework.3.8.15/library/admin-page-framework/admin-page-framework.php' );
require_once( 'lib/fen-admin-page-framework.3.8.15/admin-page-fen-loader.php' );

/* FEN Filters, Actions and Registers */
require_once( 'includes/admin/add-theme-support.php' );
require_once( 'includes/admin/fen-admin-login.php' );
require_once( 'includes/fen-default-setup.php' );
require_once( 'includes/fen-register-menus.php' );
require_once( 'includes/fen-register-sidebars.php' );
require_once( 'includes/fen-scripts-n-style-enqueue.php' );
require_once( 'includes/fen-thumbnail-size.php' );

/* FEN Functions */
require_once( 'includes/fen-functions.php' );


/* FEN Templates */
require_once( 'includes/fen-template-functions.php' );
require_once( 'includes/fen-template-hooks.php' );

/* Add Here your Custom Functions */
require_once( 'includes/fen-custom-functions.php' );

