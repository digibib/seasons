<?php foreach ($elementsForDisplay as $setName => $setElements): ?>
<div class="element-set">
    <?php if (html_escape(__($setName)) == "Dublin Core"): ?>
      <h2>Metadata</h2>
    <?php endif; ?>
    <?php foreach ($setElements as $elementName => $elementInfo): ?>
    <div id="<?php echo text_to_id(html_escape("$setName $elementName")); ?>" class="element">
        <h3><?php echo html_escape(__($elementName)); ?></h3>
        <?php if ($elementName == 'Date' & (count($elementInfo['texts']) > 1)):?>
            <div class="element-text">
                <?php echo search_link($elementInfo['element'][0]->id, $elementInfo['texts'][0]); ?>
                -
                <?php echo search_link($elementInfo['element'][0]->id, end($elementInfo['texts'])); ?>
            </div>
        <?php else: ?>
            <?php foreach ($elementInfo['texts'] as $text): ?>
                <?php if (in_array(strtolower($elementName), array("subject", "date", "avbildet person", "fotograf", "creator",  "gårdsnavn", "sted", "bydel"))): ?>
                    <div class="element-text"><?php echo search_link($elementInfo['element']->id, $text); ?></div>
                <?php else: ?>
                    <div class="element-text"><?php echo $text; ?></div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div><!-- end element -->
    <?php endforeach; ?>
</div><!-- end element-set -->
<?php endforeach;
