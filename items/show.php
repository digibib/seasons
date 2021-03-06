<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>

<h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>

<div id="primary">

    <?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
    <?php echo files_for_item(array('imageSize' => 'fullsize', 'imgAttributes' => array('title' => ''))); ?>
    <?php endif; ?>
    
    <?php echo all_element_texts('item'); ?>
    
    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>



</div><!-- end primary -->

<aside id="sidebar">

    <!-- The following returns all of the files associated with an item. -->
    <?php if ((get_theme_option('Item FileGallery') == 1) && metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <h2><?php echo __('Files'); ?></h2>
        <?php echo item_image_gallery(); ?>
    </div>
    <?php endif; ?>

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (metadata('item', 'Collection Name')): ?>
    <div id="collection" class="element">
        <h2><?php echo __('Collection'); ?></h2>
        <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
    </div>
    <?php endif; ?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2><?php echo __('Citation'); ?></h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>

    <div id="disclaimer" class="element">
      <h2>Bruk av bildet</h2>
      <div class="element-text">Bildet kan ikke brukes i andre sammenhenger uten skriftlig tillatelse fra <?php echo link_to_collection_for_item(); ?>.</div>
    </div>

    <!-- the edit button for logged in superusers and admins -->
    <?php if (is_allowed($item, 'edit')){
    echo __('<div style="background:#000"><a class="edit" href="/admin/items/edit/'.$item->id.'">Rediger denne posten</a></div>');
    } ?> 
    <!-- end edit button -->

</aside>

<?php echo foot(); ?>
