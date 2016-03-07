<?= $this->assign('title', 'OSM Integration'); ?>
<div class="actions columns large-2 medium-3">
    
    <?= $this->start('Sidebar');
    echo $this->element('Sidebar/user');
    $this->end(); ?>
    
    <?= $this->fetch('Sidebar') ?>
    
</div>
<div class="osm home large-10 medium-9 columns">
    <h4>Current Status</h4>
    <table class="goat" cellpadding="0" cellspacing="0">
    	<tr>
    		<th style="background: <?= $linked ? '#009A44' : '#BA0C2F' ; ?>; color: #fff; a:link { color: #fff;} a:visited {color: #fff;} a:hover {color: #fff;} a:active {color: #fff;}"><?= $linked ? __('Account Set') : $this->Html->link( __('Please Set Account'), ['controller' => 'Osm', 'action' => 'link', 'prefix' => false ]); ?></th>
    		<th style="background: <?= $sectionSet ? '#009A44' : '#BA0C2F' ; ?>; color: #fff; a:link { color: #fff;} a:visited {color: #fff;} a:hover {color: #fff;} a:active {color: #fff;}"><?= $sectionSet ? __('Section Set') : $this->Html->link( __('Please Set Section'), ['controller' => 'Osm', 'action' => 'section', 'prefix' => false ]); ?></th>
    		<th style="background: <?= $termCurrent ? '#009A44' : '#BA0C2F' ; ?>; color: #fff; a:link { color: #fff;} a:visited {color: #fff;} a:hover {color: #fff;} a:active {color: #fff;}"><?= $termCurrent ? __('Term Set') : $this->Html->link( __('Please Update Term'), ['controller' => 'Osm', 'action' => 'term', 'prefix' => false ]); ?></th>
    	</tr>
    </table>
</div>
