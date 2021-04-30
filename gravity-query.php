<?php
/*
Plugin Name: Gravity Query
Plugin URI: https://bellaworksweb.com
Description: Query Group Outings Forms by Date Range.
Author: Austin Crane
Version: 1.0
Author URI: https://bellaworksweb.com
*/
// loads the stylesheet
add_action('admin_enqueue_scripts', 'acgf_query_style');
function acgf_query_style() {
	wp_register_style( 'acgf-query-style',  plugin_dir_url( __FILE__ ) . 'query-style.css' );
    wp_enqueue_style( 'acgf-query-style' );
}

function acgf_query_js() {
    wp_enqueue_script('acgf_custom_script', plugin_dir_url(__FILE__) . 'js/helper.js');
}

add_action('admin_enqueue_scripts', 'acgf_query_js');

add_action('admin_menu', 'acgf_register_my_custom_submenu_page');
 
function acgf_register_my_custom_submenu_page() {
    add_submenu_page(
        'tools.php',
        'Gravity Form Query',
        'Gravity Form Query',
        'manage_options',
        'form-entry-query',
        'acgf_my_custom_submenu_page_callback' );
}
 



add_action( 'plugins_loaded', 'my_plugin_override' );
 // fire before wp_head
function my_plugin_override() {
	acf_form_head();
}


function acgf_my_custom_submenu_page_callback() {
    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h2>Gravity Forms Entries Query</h2>'; ?>
        <p>Choose Your Form</p>
		<?php
        $forms = GFAPI::get_forms(true, false);

        echo '<select id="formselector">';
        echo '<option>Select Your Form</option>';
        foreach( $forms as $form ) {
        	//echo $form['title'];
        	echo'<option value="'.$form['id'].'">'.$form['title'].'</option>';
        }
        echo '</select>';
        ?>
        <p>Choose a Date Range</p>
        <?php
        acf_form([
			'field_groups' => [44644],
			'post_id' => 'options',
			'submit_value' => 'Query Entries',
			//'html_before_fields' => $html
		]);


        

        //echo $html[0];

        $start_date = get_field( 'start_date', 'option');
		$end_date = get_field( 'end_date', 'option');

		// echo 'Entries before format '.$start_date.' and '.$end_date;
		// echo '<br>';

		$search_criteria = array();
		// $form_id = 2;
		$form_id = get_field('form_id', 'option');
		//$paging  = array( 'offset' => 0, 'page_size' => 2000 );
		$total_count = 0;
		// $start_date = date( 'Y-m-d', strtotime('-30 days') );
		// $end_date = date( 'Y-m-d' );

		// echo 'Entries  format '.$start_date.' and '.$end_date;
		// echo '<br>';

		$search_criteria['start_date'] = $start_date;
		$search_criteria['end_date'] = $end_date;
		 
		// $entries = GFAPI::get_entries($form_id, $search_criteria, null, $paging );
		// $num = count( $entries );

		//$result = GFAPI::count_entries( $form_ids, $search_criteria, null, $paging  );

		// $search_criteria = array();
		$sorting         = array();
		$total_count     = 0;
		// $entries         = GFAPI::get_entries( $form_id, $search_criteria, $sorting, $paging, $total_count );
		// $num = count( $entries );

		$result = GFAPI::count_entries( $form_id, $search_criteria );


		//change the dates for humans
		$humanStart = date("F j, Y", strtotime($start_date));
		$humanEnd = date("F j, Y", strtotime($end_date)); 
		?>
		<div class="queryresults">

			<?php 
			echo 'Entries between '.$humanStart.' and '.$humanEnd;
			echo '<br>';
			// pagi_posts_nav();
			// echo '<br>';
			echo 'Submissions between these dates: '.$result;

			// echo 'count_entries: '.$result;
			?>
		</div>
		<?php 

		echo '<pre>';
		print_r($entries);
		echo '</pre>';

    echo '</div>';
} ?>


