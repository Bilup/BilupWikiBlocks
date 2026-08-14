<?php

use MediaWiki\Hook\ParserFirstCallInitHook;
use MediaWiki\ResourceLoader\Hook\ResourceLoaderGetConfigVarsHook;

define('BB_MODULE_KEY', 'ext.BilupBlocks');

class BilupBlockHook implements ParserFirstCallInitHook, ResourceLoaderGetConfigVarsHook {
	// Ouput HTML for <scratchblocks> tag

	public function onParserFirstCallInit($parser) {
		// Register <scratchblocks> and <sb> tag
		$parser->setHook('scratchblocks', array("BilupBlockHook", 'bb4RenderTag'));
		$parser->setHook('sb', array("BilupBlockHook", 'bb4RenderInlineTag'));
		//throw new Exception(var_dump($parser));
		return true;
	}

	public function onResourceLoaderGetConfigVars(array &$vars, $skin, Config $config): void {
		$vars['wgBilupBlocksLangs'] = $config->get('BilupBlocksLangs');
		$vars['wgBilupBlocksBlockVersion'] = $config->get('BilupBlocksBlockVersion');
	}

	public static function bb4Setup(Parser $parser) {
		$out = $parser->getOutput();
		if (!in_array(BB_MODULE_KEY, $out->getModules())) {
			$out->addModules([ BB_MODULE_KEY ]);
		}
	}

	public static function bb4RenderTagGeneric($input, array $args, $parser, $tag) {
		self::bb4Setup($parser);
		if ( class_exists( 'MediaWiki\\Html\\Html' ) ) {
			// MW 1.40+
			$htmlClass = \MediaWiki\Html\Html::class;
		} else {
			$htmlClass = \Html::class;
		}
		return $htmlClass::element($tag, [
			'class' => 'blocks' . (isset($args['version']) ? '-' . $args['version'] : '')
		], $input);
	}

	// Output HTML for <scratchblocks> tag
	public static function bb4RenderTag($input, array $args, Parser $parser, PPFrame $frame) {
		return self::bb4RenderTagGeneric($input, $args, $parser, 'pre');
	}

	// Output HTML for inline <sb> tag
	public static function bb4RenderInlineTag($input, array $args, Parser $parser, PPFrame $frame) {
		return self::bb4RenderTagGeneric($input, $args, $parser, 'code');
	}
}
