<?php
#
# See docs/Configuration.md for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings
#

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

## Load private configurations and settings.
## See `LocalSettings_*.php.sample` files.
require_once "LocalSettings_database.php";
require_once "LocalSettings_private.php";

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

# Error log
#$wgDebugLogFile = "/var/log/mediawiki/debug-{$wgDBname}.log";

# Disable running jobs on page requests.
# See: /etc/systemd/system/mw-jobqueue.service
# See: /usr/local/bin/mwjobrunner
$wgJobRunRate = 0;

$wgSitename = "SHIFT Friends";
$wgMetaNamespace = "SHIFT_Friends";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "/w";
$wgArticlePath = "/wiki/$1";
$wgUsePathInfo = true;

## The protocol and server name to use in fully-qualified URLs
$wgServer = "https://shift-friends.community";

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL paths to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogos = [
	'1x' =>   "$wgResourceBasePath/resources/assets/logo_shift_friends.svg",
	'icon' => "$wgResourceBasePath/resources/assets/logo_shift_friends.svg",
];

## UPO means: this is also a user preference option

$wgEnableEmail = false;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "bouncy@";
$wgPasswordSender = "bouncy@";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;

## Shared memory settings
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = true;

# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = false;

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "en";

# Time zone
$wgLocaltimezone = "UTC";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publicly accessible from the web.
#$wgCacheDirectory = "$IP/cache";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by-sa/4.0/";
$wgRightsText = "Creative Commons Attribution-ShareAlike";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/cc-by-sa.png";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['*']['read'] = true;

## Default skin: you can change the default skin. Use the internal symbolic
## names, e.g. 'vector' or 'monobook':
$wgDefaultSkin = "vector";
$wgDefaultMobileSkin = 'minerva';

# Enabled skins.
wfLoadSkin( 'MinervaNeue' );
wfLoadSkin( 'MonoBook' );
wfLoadSkin( 'Timeless' );
wfLoadSkin( 'Vector' );


# Enabled extensions. Most of the extensions are enabled by adding
# wfLoadExtension( 'ExtensionName' );
# to LocalSettings.php. Check specific extension documentation for more details.

# Editor
wfLoadExtension( 'CodeEditor' );
wfLoadExtension( 'CodeMirror' );
$wgDefaultUserOptions['usecodemirror'] = 1;
wfLoadExtension( 'VisualEditor' );
$wgVisualEditorEnableBetaFeature = true;
$wgDefaultUserOptions['visualeditor-autodisable'] = true;
wfLoadExtension( 'WikiEditor' );

# Mobile
wfLoadExtension( 'MobileFrontend' );

# Parser
wfLoadExtension( 'Cite' );
wfLoadExtension( 'InputBox' );
wfLoadExtension( 'ParserFunctions' );
$wgPFEnableStringFunctions = true;
wfLoadExtension( 'Scribunto' );
$wgScribuntoDefaultEngine = 'luastandalone';
#$wgScribuntoEngineConf['luastandalone']['errorFile'] = "/tmp/lua_error.log";
wfLoadExtension( 'SyntaxHighlight_GeSHi' );
wfLoadExtension( 'TemplateData' );
wfLoadExtension( 'TemplateStyles' );

# Spam
wfLoadExtension( 'AbuseFilter' );
wfLoadExtension( 'AntiSpoof' );

##
wfLoadExtensions([ 'ConfirmEdit', 'ConfirmEdit/QuestyCaptcha' ]);
$wgCaptchaQuestions = [
	'What is my name?' => 'Yes',
];
##

wfLoadExtension( 'SmiteSpam' );
wfLoadExtension( 'SpamBlacklist' );
wfLoadExtension( 'TorBlock' );

# _Others
wfLoadExtension( 'Cargo' );
wfLoadExtension( 'Gadgets' );
wfLoadExtension( 'SecureLinkFixer' );
wfLoadExtension( 'TextExtracts' );

# Add more configuration options below.

wfLoadExtension( 'JsonConfig' );
$wgJsonConfigEnableLuaSupport = true;
$wgJsonConfigModels['Tabular.JsonConfig'] = 'JsonConfig\JCTabularContent';
$wgJsonConfigs['Tabular.JsonConfig'] = [
        'namespace' => 486,
        'nsName' => 'Data',
        // page name must end in ".tab", and contain at least one symbol
        'pattern' => '/.\.tab$/',
        'license' => 'CC0-1.0',
        'isLocal' => false,
];

$wgJsonConfigModels['Map.JsonConfig'] = 'JsonConfig\JCMapDataContent';
$wgJsonConfigs['Map.JsonConfig'] = [
        'namespace' => 486,
        'nsName' => 'Data',
        // page name must end in ".map", and contain at least one symbol
        'pattern' => '/.\.map$/',
        'license' => 'CC0-1.0',
        'isLocal' => false,
];
$wgJsonConfigInterwikiPrefix = "commons";

$wgJsonConfigs['Tabular.JsonConfig']['remote'] = [
        'url' => 'https://commons.wikimedia.org/w/api.php'
];
$wgJsonConfigs['Map.JsonConfig']['remote'] = [
        'url' => 'https://commons.wikimedia.org/w/api.php'
];
