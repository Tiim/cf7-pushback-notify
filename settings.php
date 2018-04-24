<?php
namespace Cf7PushoverNotify;

require_once('Util.php');

class Settings {
    public $section;
    public $page;
    public $group;

    public function __construct() {
        $this->section = Util::$prefix . 'settings-section';
        $this->page =  Util::$prefix . 'settings';
        $this->group = Util::$prefix . 'settings';
    }
}


function init_settings() {
    $s = new Settings();
    
    add_settings_section(
        $s->section,                            // Section id
        'Contact Form 7 Pushover Settings',     // Page title
        Plugin::$ns . '\settings_section_cb',   // Render callback
        $s->page                                // Parent page
    );

    add_setting($s, 'pushover-api-token', 'Pushover Api Token', 'Enter your Pushover api token here');
    add_setting($s, 'pushover-user-token', 'Pushover User Token', 'Enter your Pushover user token here');
}

function add_setting($s, $id, $name, $desc) {
    $id = Util::$prefix . $id;
    add_settings_field( 
        $id,                                    // Field id
        $name,                                  // Label
        Plugin::$ns . '\input_cb',              // Render callback
        $s->page,                               // Parent page
        $s->section,                            // Parent section
        array(                                  // Render callback args
            $id, 
            $desc,
        )
    );

    register_setting(
        Util::$prefix . 'settings',
        $id
    );
}

function init_menu() {
    add_submenu_page(
        'wpcf7',                                // Parent Page
        'Pushover Settings',                    // Page Title
        'Pushover Settings',                    // Menu Title
        'manage_options',                       // Permission
        Util::$prefix . 'settings',             // Menu Id
        Plugin::$ns . '\settings_cb'            // Render callback
    );
}

function input_cb($args) {
    $id = $args[0];
    $label = $args[1];

    $html = '<input type="text" id="'.$id.'" name="'.$id.'" value="'.get_option($id).'"/>'; 
    $html .= '<p class="description" for="'.$id.'">'.$label.'</p>'; 
     
    echo $html;
}

function settings_section_cb() {
    echo '<p>Settings</p>';
}

function settings_cb() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting group "$prefix . 'settings'"
            settings_fields(Util::$prefix . 'settings');
            // output setting sections and their fields
            // (sections are registered for page "$prefix . 'settings'", each field is registered to a specific section)
            do_settings_sections(Util::$prefix . 'settings' );
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

?>