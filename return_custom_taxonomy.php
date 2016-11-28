<?php
/*
* Return custom taxonomy associated with custom post type
*/

function return_custom_post_category($post_id, $tax_name)
{
    $arr = get_the_terms($post_id, $tax_name);
    $cats =array();
    foreach ($arr as $term) {
        array_push($cats, $term->name);
    }
    $categories = implode(',', $cats);
    return $categories;
}