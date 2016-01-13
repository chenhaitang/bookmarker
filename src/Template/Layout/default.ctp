<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$CDN = '';
if (!preg_match('/^(demo|dev)\./', $this->request->host())) {
    $CDN = 'http://light.tridentcdn.com';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $this->fetch('title') ?></title>
<?php
    echo $this->Html->meta('icon');
    echo $this->Html->meta('format-detection', 'telephone=no');
    echo $this->fetch('meta');

    if (isset($canonical)) {
        echo sprintf('<link rel="canonical" href="%s" />', $canonical);
    }

    echo $this->Html->css($CDN . '/css/style.min.css');

    echo '<!--[if lt IE 9]>';
    echo $this->Html->script($CDN . '/js/html5shiv.min.js');
    echo $this->Html->script($CDN . '/js/respond.min.js');
    echo '<![endif]-->';

    echo $this->fetch('css');
    echo $this->fetch('script'); 
?>
<script>
function hasClass(a,e){return a.className&&new RegExp("(^|\\s)"+e+"(\\s|$)").test(a.className)}document.addEventListener("click",function(a){for(var e,s=0,t=a.target;t;t=t.parentNode){if(hasClass(t,"dropdown")){r=t.childNodes;for(var l=0;l<r.length;l++){var n=r[l];if(hasClass(n,"dropdown-menu")){var o=n.offsetWidth>0||n.offsetHeight>0;o||(n.style.display="block",t.className+=" open",e=t)}}}s++}for(var r=document.getElementsByClassName("dropdown"),l=0;l<r.length;l++){var t=r[l];initerator=t.childNodes;for(var c=0;c<initerator.length;c++){var n=initerator[c];if(hasClass(n,"dropdown-menu")){var o=n.offsetWidth>0||n.offsetHeight>0;o&&e!=t&&(n.style.display="none",t.className=t.className.replace(" open",""))}}}});
</script>
</head>
<body>
<header class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button id="navToggleBtn" type="button" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><?= __('Color Lookup') ?></a>
        </div>
        <nav id="nav" class="navbar-collapse collapse" role="navigation">
            <div class="navbar-right">
                  <ul class="nav navbar-nav">
                    <li><?= $this->Html->link(__('Palettes'), ['controller' => 'Palettes', 'action' => 'index']) ?></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= __('Colors') ?><span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                          <li><?= $this->Html->link(__('Web Safe Colors'), ['controller' => 'Sets', 'action' => 'websafe']) ?></li>
                          <li><?= $this->Html->link(__('Color Names'), ['controller' => 'Sets', 'action' => 'names']) ?></li>
                          <li><?= $this->Html->link(__('Popular Colors'), ['controller' => 'Sets', 'action' => 'popular']) ?></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= __('Tools') ?><span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                          <li><?= $this->Html->link(__('Color Code Converter'), ['controller' => 'Tools', 'action' => 'converter']) ?></li>
                          <li><?= $this->Html->link(__('Color Chart'), ['controller' => 'Tools', 'action' => 'chart']) ?></li>
                          <li><?= $this->Html->link(__('Color Picker'), ['controller' => 'Tools', 'action' => 'picker']) ?></li>
                          <li><?= $this->Html->link(__('Colors From Image'), ['controller' => 'Tools', 'action' => 'image']) ?></li>
                      </ul>
                    </li>
                  </ul>
            </div>
<?php if ($this->request->here() !== '/'): ?>
            <form class="navbar-form navbar-left" role="search" action="<?= $this->Url->build(["controller" => "Colors", "action" => "search"]) ?>">
                <div class="input-group">
                    <input type="text" name="q" maxlength="30" size="30" autocomplete="off" class="form-control" placeholder="#0000FF">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-success"><?= __('Go') ?></button>
                    </span>
                </div>
            </form>
<?php endif; ?>
        </nav>
    </div>
</header>
<div class="main container">
    <?= $this->fetch('content') ?>
</div>
<footer>
    <div class="container">
        <ul>
            <li><a href="/contact"><?= __('Contact') ?></a></li>
            <li><a href="/privacy"><?= __('Privacy') ?></a></li>
            <li><a href="/terms"><?= __('Terms') ?></a></li>
        </ul>
        <p class="text-center">Copyright &copy; <?= date('Y') ?> <a href="/"><?= __('Color Lookup') ?></a></p>
    </div>
</footer>
<script>
var btn=document.getElementById("navToggleBtn"),nav=document.getElementById("nav");btn.onclick=function(){nav.className="navbar-collapse collapse"===nav.className?"navbar-collapse collapse in":"navbar-collapse collapse"};
</script>
</body>
</html>
