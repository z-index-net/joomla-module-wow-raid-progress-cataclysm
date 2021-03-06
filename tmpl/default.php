<?php

/**
 * @author     Branko Wilhelm <branko.wilhelm@gmail.com>
 * @link       http://www.z-index.net
 * @copyright  (c) 2013 - 2015 Branko Wilhelm
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @var        array $raids
 * @var        stdClass $module
 * @var        Joomla\Registry\Registry $params
 */

defined('_JEXEC') or die;

if (version_compare(JVERSION, 3, '>=')) {
    JHtml::_('jquery.framework');
}

JFactory::getDocument()->addStyleSheet('media/' . $module->module . '/css/default.css');
JFactory::getDocument()->addScript('media/' . $module->module . '/js/default.js');
?>
<?php if ($params->get('ajax')) : ?>
    <div class="mod_wow_raid_progress_cata ajax"></div>
<?php else: ?>
    <div class="mod_wow_raid_progress_cata">
        <?php foreach ($raids as $zoneId => $zone) : ?>
            <ul class="z<?php echo $zoneId; ?>">
                <li class="header">
                    <span class="p" style="width:<?php echo $zone['stats']['percent']; ?>%;"></span>
                    <?php echo JText::_('MOD_WOW_RAID_PROGRESS_CATA_ZONE_' . $zoneId); ?>
                    <span class="k" title="<?php echo $zone['stats']['percent']; ?>%"><?php echo JText::sprintf('MOD_WOW_RAID_PROGRESS_CATA_MODE_' . strtoupper($zone['stats']['mode']), $zone['stats']['kills'], $zone['stats']['bosses']); ?></span>
                </li>
                <li class="npcs<?php echo ($zone['collapsed'] == true) ? ' open' : ''; ?>">
                    <ul>
                        <?php foreach ($zone['npcs'] as $npc => $data) : ?>
                            <li class="npc">
                                <?php echo JHtml::_('link', $data['link'], JText::_('MOD_WOW_RAID_PROGRESS_CATA_NPC_' . $npc), array('target' => '_blank')); ?>
                                <span class="<?php echo ($data['heroic'] === true) ? ' heroic' : (($data['normal'] === true) ? ' normal' : ''); ?>"> </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>
<?php endif; ?>