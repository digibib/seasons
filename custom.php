<?php
function find_random_item($params = array())
{
    $db = get_db();
    $table = $db->getTable('Item');

    $select = new Omeka_Db_Select;
    $select->from(array('items'=>$db->Item), array('items.*'));
    $select->from(array(), 'RAND() as rand');
    $select->order('rand DESC');

    if ($params['withImage']) {
        $select->joinLeft(array('f'=>"$db->File"), 'f.item_id = items.id', array());
        $select->where('f.has_derivative_image = 1');
    }

    $table->applySearchFilters($select, $params);

    $select->limit(1);

    $item = $table->fetchObject($select);

    return $item;
}
function display_random_items_from_collection($featuredCollection, $nums)
{
    $html = '';
    if ($featuredCollection) {

        for ($i=0; $i<$nums; $i++) {
        $item = find_random_item(array('withImage' => true, 'collection' => $featuredCollection));
        if ($item) {

        if (metadata($item, 'has thumbnail')) {
            set_current_record('item', $item);
            $title = metadata('item', array('Dublin Core','Title'));
            $html .= '<div class="picture">' . link_to_item(item_image('square_thumbnail', array('alt' => $title))) .'</div>';
        }
         }
     }

    } else {
        $html .= '<p>Samlingen finnes ikke</p>';
    }
    return $html;
}
function search_link($id, $term) {
    $html = '<a href="/omeka/items/browse?search=&advanced%5B0%5D%5Belement_id%5D=';
    $html .= $id .'&advanced%5B0%5D%5Btype%5D=contains&advanced%5B0%5D%5Bterms%5D=';
    $html .= $term . '&range=&collection=&type=&user=&tags=&public=&featured=&submit_search=Søk">';
    $html .= $term . '</a>';
    return $html;

}
?>