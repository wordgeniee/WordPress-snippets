<?php
/*
* Display categories as checkboxes
*
*/

//Following will render hierarchical categories as checkboxes 
wp_list_categories(array(
               'taxonomy'=>$category_name,
                'walker'   => new CustomCategoryWalkerClass(),
                'echo' => false,
                          
            )); 

//Class definition : CustomCategoryWalkerClass
//You can also change the display from list item to other html elements by overriding start_lvl and end_lvl functions

class CustomCategoryWalkerClass extends Walker_Category
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= "\n<ul>\n";
    }
     
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= "</ul>\n";
    }

    public function start_el(&$output, $term, $depth = 0, $args = array(), $id = 0)
    {

        extract($args);

        ob_start(); ?>   

      <li>
        <input type="checkbox" id="category-<?php print $term->term_id; ?>" name="cat[]" value="<?php print $term->term_id; ?>" />
        <label for="category-<?php print $term->term_id; ?>">
            <?php print esc_attr($term->name); ?>
        </label>       

        <?php // closing LI is added inside end_el

        $output .= ob_get_clean();
    }
    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>\n";
    }
}