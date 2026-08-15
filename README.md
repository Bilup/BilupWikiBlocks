A simple MediaWiki extension for rendering Bilup Blocks used on Bilup 2.0. Supports MediaWiki 1.35+.

Transforms `<scratchblocks>` tags inside wiki articles into `<pre class="blocks">` in the HTML, which are then rendered to scratch blocks using CSS and JS included in the page. Inline blocks are rendered with `<sb>` tags, and become `<code class="blocks">` tags.

Use `version` attribute to set the version. Valid values are `2`, `3`, and `hc-3` (for High Contrast colors).

- Maintained by apple502j.
- Contributed to by Kenny2github
- Original by tjvr and ErnieParke

# Installation

This repository no longer uses Git submodules. You do **not** need to include the `--recursive` option.
```bash
$ cd extensions
$ git clone http://github.com/Bilup/BilupWikiBlocks
```
After cloning, add the line
```php
wfLoadExtension( "BilupWikiBlocks" );
```
to your LocalSettings.php file. If you need to use languages besides English, add the following line (Simplified Chinese and Traditional Chinese used as an example):
```php
$wgBilupBlocksLangs = ['zh_CN', 'zh_TW'];
```
Note that the TW is preceded by an underscore rather than a hyphen.

This variable is accessible through JavaScript via `mw.config.get("wgBilupBlocksLang")`.

Use `$wgBilupBlocksBlockVersion` to specify the default version. Valid values are `2`, `3`, and `hc-3` (for High Contrast colors).
