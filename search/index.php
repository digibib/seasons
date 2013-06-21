<?php
$pageTitle = __('Search Omeka ') . __('(%s total)', $total_results);
echo head(array('title' => $pageTitle, 'bodyclass' => 'search'));
$searchRecordTypes = get_search_record_types();
?>
<?php if ($total_results): ?>
    <div class="items" style="padding-left:1em">
        <?php $query = (isset($_GET['query']) ? $_GET['query'] : null); ?>
        <h3>Søk på "<?php echo $query;?>" ga <?php echo $total_results; ?> treff</h3>
        <?php echo pagination_links(); ?>
    </div>

<div class="items">
    <?php foreach (loop('search_texts') as $searchText): ?>
        <?php $record = get_record_by_id($searchText['record_type'], $searchText['record_id']); ?>
        <?php if(get_class($record) =='Item'):
              set_current_record('Item',$record);
              $item = get_current_record('Item');          
             ?>

             <div class="picture">
                 <p><strong><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></strong></p>
                 <div class="picture-img">
                     <?php $description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>100)) ?>
                     <?php echo link_to_item(item_image('square_thumbnail', array('title' => $description))); ?>
                 </div>
             </div>
        <?php endif;?>
    <?php endforeach; ?>
</div>
<?php echo pagination_links(); ?>
<?php else: ?>
<div id="no-results">
    <p><?php echo __('Your query returned no results.');?></p>
</div>
<?php endif; ?>
<?php echo foot(); ?>