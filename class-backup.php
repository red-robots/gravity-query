

<?php 
class Smashing_Fields_Plugin {

    public function __construct() {
        // Hook into the admin menu
        add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
        add_action( 'admin_init', array( $this, 'add_acf_variables' ) );

        // add_filter( 'acf/settings/path', array( $this, 'update_acf_settings_path' ) );
        // add_filter( 'acf/settings/dir', array( $this, 'update_acf_settings_dir' ) );

        //include_once( plugin_dir_path( __FILE__ ) . 'vendor/advanced-custom-fields/acf.php' );

        $this->setup_options();
    }

    // public function update_acf_settings_path( $path ) {
    //     $path = plugin_dir_path( __FILE__ ) . 'vendor/advanced-custom-fields/';
    //     return $path;
    // }

    // public function update_acf_settings_dir( $dir ) {
    //     $dir = plugin_dir_url( __FILE__ ) . 'vendor/advanced-custom-fields/';
    //     return $dir;
    // }

    public function create_plugin_settings_page() {
    	// Add the menu item and page
    	$page_title = 'Gravity Query';
    	$menu_title = 'Awesome Plugin';
    	$capability = 'manage_options';
    	$slug = 'smashing_fields';
    	$callback = array( $this, 'plugin_settings_page_content' );
    	$icon = 'dashicons-admin-plugins';
    	$position = 100;

    	add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback );
    }

    public function plugin_settings_page_content() {
        do_action('acf/input/admin_head');
        do_action('acf/input/admin_enqueue_scripts');

        $options = array(
        	'id' => 'gravity-query',
        	'post_id' => 'options',
        	'new_post' => false,
        	// 'field_groups' => false,
        	// 'field_groups' => array( 'acf_awesome-options' ),
        	'post_id'       => 44644,
        	'return' => admin_url('admin.php?page=smashing_fields'),
        	'submit_value' => 'Update',
        );
        acf_form( $options );
         
    }

    public function add_acf_variables() {
        acf_form_head();
    }

    public function setup_options() { ?>
    	<div class="wrap">
    		<h1>Gravity Query</h1>
    	</div>
    	<?php
    	
		// if( function_exists('acf_add_local_field_group') ):

		// acf_add_local_field_group(array(
		// 	'key' => 'group_608aa7f5c4c98',
		// 	'title' => 'Gravity Query',
		// 	'fields' => array(
		// 		array(
		// 			'key' => 'field_608aa80163dc0',
		// 			'label' => 'Start Date',
		// 			'name' => 'start_date',
		// 			'type' => 'date_picker',
		// 			'instructions' => '',
		// 			'required' => 0,
		// 			'conditional_logic' => 0,
		// 			'wrapper' => array(
		// 				'width' => '',
		// 				'class' => '',
		// 				'id' => '',
		// 			),
		// 			'display_format' => 'F j, Y',
		// 			'return_format' => 'Y-m-d',
		// 			'first_day' => 1,
		// 		),
		// 		array(
		// 			'key' => 'field_608aa81263dc1',
		// 			'label' => 'End Date',
		// 			'name' => 'end_date',
		// 			'type' => 'date_picker',
		// 			'instructions' => '',
		// 			'required' => 0,
		// 			'conditional_logic' => 0,
		// 			'wrapper' => array(
		// 				'width' => '',
		// 				'class' => '',
		// 				'id' => '',
		// 			),
		// 			'display_format' => 'F j, Y',
		// 			'return_format' => 'Y-m-d',
		// 			'first_day' => 1,
		// 		),
		// 	),
		// 	'location' => array(
		// 		array(
		// 			array(
		// 				'param' => 'page',
		// 				'operator' => '==',
		// 				'value' => '44642',
		// 			),
		// 		),
		// 	),
		// 	'menu_order' => 0,
		// 	'position' => 'normal',
		// 	'style' => 'default',
		// 	'label_placement' => 'top',
		// 	'instruction_placement' => 'label',
		// 	'hide_on_screen' => '',
		// 	'active' => true,
		// 	'description' => '',
		// ));

		// endif;
	}

}
new Smashing_Fields_Plugin();

















