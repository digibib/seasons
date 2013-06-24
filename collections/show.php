<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
if ($collectionTitle == '') {
    $collectionTitle = __('[Untitled]');
}
$coll=get_current_record('Collections',false)->id;
$total_results=metadata('Collection', 'total_items');
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>

<h1><?php echo $collectionTitle; ?></h1>

<div>
   <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'))); ?>
    <p><?php echo link_to_items_browse('Bla i alle ('.$total_results.') bildene in ' . metadata('Collection',array('Dublin Core','Title')), array('collection' => $coll)); ?></p>

</div>

<div style="padding-left:1em">
    <h2>Bilder fra samlingen</h2>
    <?php if (metadata('collection', 'total_items') > 0): ?>
        <?php foreach (loop('items') as $item): ?>
        <?php $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>
        <div class="picture">
            <!-- p><strong><?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></strong></p> -->

            <?php if (metadata('item', 'has thumbnail')): ?>
            <div class="picture-img">
                <?php echo link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle))); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p><?php echo __("There are currently no items within this collection."); ?></p>
    <?php endif; ?>
</div><!-- end collection-items -->

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
