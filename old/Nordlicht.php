<?php
/**
 * Nordlicht Coporate Design
 *
 * @todo document
 * @addtogroup Skins
 */

if( !defined( 'MEDIAWIKI' ) )
	die( -1 );

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @addtogroup Skins
 */
class SkinNordlichtOld extends SkinTemplate {
	/** Using monobook. */
	function initPage( &$out ) {
		SkinTemplate::initPage( $out );
		$this->skinname  = 'nordlicht';
		$this->stylename = 'nordlicht';
		$this->template  = 'NordlichtTemplate';
	}
}

/**
 * @todo document
 * @addtogroup Skins
 */
class NordlichtTemplateOld extends QuickTemplate {
	/**
	 * Template filter callback for MonoBook skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
		global $wgUser;
		$skin = $wgUser->getSkin();

		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php $this->text('lang') ?>" lang="<?php $this->text('lang') ?>" dir="<?php $this->text('dir') ?>">
	<head>
		<meta http-equiv="Content-Type" content="<?php $this->text('mimetype') ?>; charset=<?php $this->text('charset') ?>" />
		<?php $this->html('headlinks') ?>
		<title><?php $this->text('pagetitle') ?></title>
    <link rel="stylesheet" type="text/css" media="screen, projection" href="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/main.css" />
    <link rel="stylesheet" type="text/css" <?php if(empty($this->data['printable']) ) { ?>media="print"<?php } ?> href="<?php $this->text('stylepath') ?>/common/commonPrint.css" />
    <style type="text/css">@media print { #head, #left, #right, #foot, .editsection { display: none; }}</style>
		<?php print Skin::makeGlobalVariablesScript( $this->data ); ?>
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath') ?>/common/wikibits.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"></script>
    <?php if($this->data['jsvarurl']) { ?><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl') ?>"></script><?php	} ?>
    <?php	if($this->data['pagecss']) { ?><style type="text/css"><?php $this->html('pagecss') ?></style><?php } ?>
		<?php if($this->data['usercss']) { ?><style type="text/css"><?php $this->html('usercss') ?></style><?php } ?>
    <?php if($this->data['userjs']) { ?><script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs') ?>"></script><?php	} ?>
    <?php if($this->data['userjsprev']) { ?><script type="<?php $this->text('jsmimetype') ?>"><?php $this->html('userjsprev') ?></script><?php } ?>
		<?php if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?><?php $this->html('headscripts') ?>
  </head>
	<body
		<?php if($this->data['body_ondblclick']) { ?>ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
		<?php if($this->data['body_onload']) { ?>onload="<?php $this->text('body_onload') ?>"<?php } ?>
		class="<?php $this->text('nsclass') ?>"
	>
  <a name="top" id="top"></a>
  <div id="content">
    <div id="head">
      <?php if ($this->data['loggedin']) { ?>
	    <h5><?php $this->msg('views') ?></h5>
	    <ul>
	      <?php foreach($this->data['content_actions'] as $key => $action) {
	        ?><li id="ca-<?php echo htmlspecialchars($key) ?>"
	        <?php if($action['class']) { ?>class="<?php echo htmlspecialchars($action['class']) ?>"<?php } ?>
	        ><a href="<?php echo htmlspecialchars($action['href']) ?>"><?php
	        echo htmlspecialchars($action['text']) ?></a></li><?php
	      } ?>
	    </ul>
      <?php } ?>
    </div>
    <div id="left" class="sidebar">
			<?php foreach ($this->data['sidebar'] as $bar => $cont) { ?>
				<h5><?php $out = wfMsg( $bar ); if (wfEmptyMsg($bar, $out)) echo $bar; else echo $out; ?></h5>
				<ul>
          <?php foreach($cont as $key => $val) { ?>
            <li id="<?php echo Sanitizer::escapeId($val['id']) ?>"><a href="<?php echo htmlspecialchars($val['href']) ?>"<?php echo $skin->tooltipAndAccesskey($val['id']) ?>><?php echo htmlspecialchars($val['text']) ?></a></li>
          <?php } ?>
				</ul>
			<?php } ?>
			<?php if($this->data['loggedin']) { ?>
	      <h5><?php $this->msg('toolbox') ?></h5>
			  <ul>
	        <?php if($this->data['notspecialpage']) { ?>
	        	<li><a href="<?php echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href']) ?>" <?php echo $skin->tooltipAndAccesskey('t-whatlinkshere') ?>><?php $this->msg('whatlinkshere') ?></a></li>
	          <?php if( $this->data['nav_urls']['recentchangeslinked'] ) { ?><li><a href="<?php	echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href']) ?>"<?php echo $skin->tooltipAndAccesskey('t-recentchangeslinked') ?>><?php $this->msg('recentchangeslinked') ?></a></li><?php } ?>
	        <?php	} ?>
	        <?php	if(isset($this->data['nav_urls']['trackbacklink'])) { ?><li><a href="<?php echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href'])	?>"<?php echo $skin->tooltipAndAccesskey('t-trackbacklink') ?>><?php $this->msg('trackbacklink') ?></a></li><?php } ?>
	        <?php	if($this->data['feeds']) { ?><li><?php foreach($this->data['feeds'] as $key => $feed) {	?><a href="<?php echo htmlspecialchars($feed['href']) ?>"<?php echo $skin->tooltipAndAccesskey('feed-'.$key) ?>><?php echo htmlspecialchars($feed['text'])?></a><?php } ?></li><?php } ?>
	        <?php	foreach( array('contributions', 'log', 'blockip', 'emailuser', 'upload', 'specialpages') as $special ) { ?>
	       	  <?php	if($this->data['nav_urls'][$special]) {	?><li><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href']) ?>"<?php echo $skin->tooltipAndAccesskey('t-'.$special) ?>><?php $this->msg($special) ?></a></li><?php } ?>
	    	  <?php	} ?>
	    	  <?php	if(!empty($this->data['nav_urls']['permalink']['href'])) { ?><li><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href'])	?>"<?php echo $skin->tooltipAndAccesskey('t-permalink') ?>><?php $this->msg('permalink') ?></a></li><?php	} elseif ($this->data['nav_urls']['permalink']['href'] === '') { ?><li><?php $this->msg('permalink') ?></li><?php	} ?>
	    	  <?php	wfRunHooks( 'NordlichtTemplateToolboxEnd', array( &$this ) ); ?>
			  </ul>
		  <?php } ?>
    </div>
    <div id="main">
  		<?php if($this->data['sitenotice']) { ?><?php $this->html('sitenotice') ?><?php } ?>
		  <h1 class="firstHeading"><?php $this->data['displaytitle']!=""?$this->html('title'):$this->text('title') ?></h1>
			<h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
			<div id="contentSub"><?php $this->html('subtitle') ?></div>
			<?php if($this->data['undelete']) { ?><div id="contentSub2"><?php     $this->html('undelete') ?></div><?php } ?>
			<?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
			<!-- start content -->
			<?php $this->html('bodytext') ?>
			<?php if($this->data['catlinks']) { ?><?php $this->html('catlinks') ?><?php } ?>
    </div>
    <div id="right" class="sidebar">
  	  <h5><label for="searchInput"><?php $this->msg('search') ?></label></h5>
		  <form action="<?php $this->text('searchaction') ?>" id="searchform">
		  	<input id="searchInput" name="search" type="text"<?php echo $skin->tooltipAndAccesskey('search');	if( isset( $this->data['search'] ) ) { ?> value="<?php $this->text('search') ?>"<?php } ?> />
				<input type='submit' name="go" class="searchButton" id="searchGoButton"	value="<?php $this->msg('searcharticle') ?>" />&nbsp;
				<input type='submit' name="fulltext" class="searchButton" id="mw-searchButton" value="<?php $this->msg('searchbutton') ?>" />
			</form>
  		<h5><?php $this->msg('personaltools') ?></h5>
			<ul>
        <?php	foreach($this->data['personal_urls'] as $key => $item) { ?>
				<li><a href="<?php echo htmlspecialchars($item['href']) ?>"<?php echo $skin->tooltipAndAccesskey('pt-'.$key) ?>><?php	echo htmlspecialchars($item['text']) ?></a></li><?php } ?>
		  </ul>
    </div>
    <div id="foot">
			<ul>
			  <?php	$footerlinks = array('lastmod', 'viewcount'); ?>
			  <?php	foreach( $footerlinks as $aLink ) {?>
			  	<?php	if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) { ?><li><?php $this->html($aLink) ?></li><?php } ?>
			  <?php } ?>
			</ul>
    </div>
  </div>
	<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>
  <?php $this->html('reporttime') ?>
  <?php if ( $this->data['debug'] ): ?>
  <!-- Debug output:
  <?php $this->text( 'debug' ); ?>
  -->
  <?php endif; ?>
  </body>
</html>
<?php
	wfRestoreWarnings();
	} // end of execute() method
} // end of class
?>
