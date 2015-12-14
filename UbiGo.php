<?php

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

$wgExtensionCredits['other'][] = array(
    'path' => __FILE__,
    'name' => 'UbiGoExtensions',
    'author' => 'Tobias Haider', 
    'url' => 'http://www.ubigo.at', 
    'descriptionmsg' => 'ubigo-desc',
    'version'  => 0.1,
    'license-name' => "",   // Short name of the license, links LICENSE or COPYING file if existing - string, added in 1.23.0
);

$wgAutoloadClasses['UbiGoHooks'] = __DIR__ . '/UbiGo.hooks.php';

$wgHooks['ParserFirstCallInit'][] = 'UbiGoHooks::nearestSetup';

$wgMessagesDirs['UbiGo'] = __DIR__ . '/i18n';

$wgAutoloadClasses['ApiBVdistances'] 				= __DIR__ . '/api/ApiBVdistances.php';
$wgAPIModules['bvdistances'] = 'ApiBVdistances';

$wgAvailableRights[] = 'bvdistances';

# Users that can geocode. By default the same as those that can edit.
foreach ( $wgGroupPermissions as $group => $rights ) {
	if ( array_key_exists( 'edit' , $rights ) ) {
		$wgGroupPermissions[$group]['bvdistances'] = $wgGroupPermissions[$group]['edit'];
	}
}

$wgResourceModules['ext.nearest'] = array(
	// JavaScript and CSS styles. To combine multiple files, just list them as an array.
	'scripts' => array( 'js/ext.ubigo.nearest.js' ),
	'styles' => array( 'css/ext.ubigo.nearest.css' ),
 
	// You need to declare the base path of the file paths in 'scripts' and 'styles'
	'localBasePath' => __DIR__,
	// ... and the base from the browser as well. For extensions this is made easy,
	// you can use the 'remoteExtPath' property to declare it relative to where the wiki
	// has $wgExtensionAssetsPath configured:
	'remoteExtPath' => 'UbiGo'
);