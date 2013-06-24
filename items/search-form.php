<?php
if (!empty($formActionUri)):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = url(array('controller'=>'items',
                                          'action'=>'browse'));
endif;
$formAttributes['method'] = 'GET';
?>

<form <?php echo tag_attributes($formAttributes); ?>>
    <div id="search-keywords" class="field">
        <?php echo $this->formLabel('keyword-search', __('Search for Keywords')); ?>
        <div class="inputs">
        <?php
            echo $this->formText(
                'search',
                @$_REQUEST['search'],
                array('id' => 'keyword-search', 'size' => '40')
            );
        ?>
        </div>
    </div>
    <div id="search-narrow-by-fields" class="field">
        <div class="label"><?php echo __('Narrow by Specific Fields'); ?></div>
        <div class="inputs">
        <?php
        // If the form has been submitted, retain the number of search
        // fields used and rebuild the form
        if (!empty($_GET['advanced'])) {
            $search = $_GET['advanced'];
        } else {
            $search = array(array('field'=>'','type'=>'','value'=>''));
        }

        //Here is where we actually build the search form
        foreach ($search as $i => $rows): ?>
            <div class="search-entry">
                <?php
                //The POST looks like =>
                // advanced[0] =>
                //[field] = 'description'
                //[type] = 'contains'
                //[terms] = 'foobar'
                //etc
                echo $this->formSelect(
                    "advanced[$i][element_id]",
                    @$rows['element_id'],
                    array(),
                    get_table_options('Element', null, array(
                        'record_types' => array('Item', 'All'),
                        'sort' => 'alphaBySet')
                    )
                );
                echo $this->formSelect(
                    "advanced[$i][type]",
                    @$rows['type'],
                    array(),
                    label_table_options(array(
                        'contains' => __('contains'),
                        'does not contain' => __('does not contain'),
                        'is exactly' => __('is exactly'),
                        'is empty' => __('is empty'),
                        'is not empty' => __('is not empty'))
                    )
                );
                echo $this->formText(
                    "advanced[$i][terms]",
                    @$rows['terms'],
                    array('size' => '20')
                );
                ?>
                <button type="button" class="remove_search" disabled="disabled" style="display: none;">-</button>
            </div>
        <?php endforeach; ?>
        </div>
        <button type="button" class="add_search"><?php echo __('Add a Field'); ?></button>
    </div>


    <div class="field">
        <?php echo $this->formLabel('collection-search', __('Search By Collection')); ?>
        <div class="inputs">
        <?php
            echo $this->formSelect(
                'collection',
                @$_REQUEST['collection'],
                array('id' => 'collection-search'),
                get_table_options('Collection')
            );
        ?>
        </div>
    </div>

    <?php fire_plugin_hook('public_items_search', array('view' => $this)); ?>
    <div>
        <input type="submit" class="submit" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" />
    </div>
</form>

<?php echo js_tag('items-search'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var blackListGroups = [
        "tada",
        "Contribution Form"
    ];
    var blackListElements = [
        "Andre kommentarer",
        "BCC",
        "Bibliography",
        "BildeID",
        "Biographical Text",
        "Birth Date",
        "Birthplace",
        "Bit Rate/Frequency",
        "CC",
        "Death Date",
        "Director",
        "Komprimering",
        "Email Body",
        "Event Type",
        "Fra",
        "Interviewee",
        "Interviewer",
        "Lesson Plan Text",
        "Local URL",
        "Location",
        "Materials",
        "Number of Attachments",
        "Objectives",
        "Occupation",
        "Original Format",
        "Participants",
        "Physical Dimensions",
        "Relasjon",
        "Språk",
        "Standards",
        "Subject Heading",
        "Subject Line",
        "Time Summary",
        "Transcription",
        "Type",
        "URL",
        "Varighet",
        "Vannmerke"
    ];
    jQuery.each(blackListGroups, function (index, value) {
        jQuery("#advanced-0-element_id optgroup[label='" + value + "']").remove();
    });
    jQuery.each(blackListElements, function (index, value) {
        jQuery("#advanced-0-element_id option[label='" + value + "']").remove();
    });

        Omeka.Search.activateSearchButtons();
    });
</script>