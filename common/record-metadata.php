<?php foreach ($elementsForDisplay as $setName => $setElements): ?>
<div class="element-set">
    <?php if (html_escape(__($setName)) == "Dublin Core"): ?>
      <h2>Metadata</h2>
    <?php endif; ?>
    <?php foreach ($setElements as $elementName => $elementInfo): ?>
    <div id="<?php echo text_to_id(html_escape("$setName $elementName")); ?>" class="element">
        <h3><?php echo html_escape(__($elementName)); ?></h3>
        <?php foreach ($elementInfo['texts'] as $text): ?>
            <?php if (in_array(strtolower($elementName), array("subject", "date", "avbildet person", "fotograf", "gårdsnavn", "sted", "bydel"))): ?>
                <div class="element-text"><a href='/omeka/items/browse?search=&advanced%5B0%5D%5Belement_id%5D=<?php echo $elementInfo['element']->id ;?>&advanced%5B0%5D%5Btype%5D=contains&advanced%5B0%5D%5Bterms%5D=<?php echo $text; ?>&range=&collection=&type=&user=&tags=&public=&featured=&submit_search=Søk'><?php echo $text; ?></a></div>
            <?php else: ?>
                <div class="element-text"><?php echo $text; ?></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div><!-- end element -->
    <?php endforeach; ?>
</div><!-- end element-set -->
<?php endforeach;
