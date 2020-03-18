<?php
/**
 * SkinTemplate class for the Timeless skin
 *
 * @ingroup Skins
 */
class SkinNordlicht extends SkinTemplate {
	/** @var string */
	public $skinname = 'nordlicht';

	/** @var string */
	public $stylename = 'Nordlicht';

	/** @var string */
	public $template = 'NordlichtTemplate';

	/**
	 * @param OutputPage $out
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		$out->addMeta( 'viewport',
			'width=device-width, initial-scale=1.0, ' .
			'user-scalable=yes, minimum-scale=0.25, maximum-scale=5.0'
		);

		$out->addModuleStyles( [
			'mediawiki.skinning.content.externallinks',
			'skins.nordlicht',
		] );
		$out->addModules( [
			'skins.nordlicht.js'
		] );

		// Basic IE support without flexbox
		//$out->addStyle( $this->stylename . '/resources/IE9fixes.css', 'screen', 'IE' );
	}

	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param OutputPage $out
	 */
	public function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
	}
}
