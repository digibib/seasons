<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<div class="items" style="padding-left:1em">
<?php echo pagination_links(); ?>

<?php if ($total_results > 0): ?>

<?php
$sortLinks[__('År')] = 'Dublin Core,Date';
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Date Added')] = 'added';
?>

<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>
</div>

<?php endif; ?>
<div class="items">
    <?php foreach (loop('items') as $item): ?>
    <div class="picture">
        <p><strong><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></strong></p>
        <div class="picture-img">
            <?php $description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>100)) ?>
            <?php echo link_to_item(item_image('square_thumbnail', array('title' => $description))); ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<div class="items" style="padding-left:1em">
   <?php echo pagination_links(); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
