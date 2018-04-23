<?php
namespace Cf7PushoverNotify;

require_once('util.php')

class Hooks {

    public function onCf7Submit($form) {
        var_dump($form);
        die();
    }

    public function settingsPage() {
        add_options_page(
			'Contact Form 7 Pushover',
			'Cf7-Pushover',
			'manage_options',
			'cf7-pushover-notify-settings',
            array($this, 'settings')
        );
        
        add_settings_section(
            'cf7-pushover-notify-section', 
            'Contact Form 7 Pushover Settings',
            array(&$this, 'settingsSection'),
            'cf7-pushover-notify-settings'
        );

        add_settings_field(
            prefixStr('pushback-app-token'),
            'Pushback App Token',
            array(&$this, 'renderInput'),
            'cf7-pushover-notify-settings',
            'cf7-pushover-notify-section',
            array(
                'pushback-app-token', 'Enter your Pushback App Token here.'
            )
        );
    }

    public function renderInput($args) {
        $id = $args[0];
        $desc = $args[1];
        
        $option = prefixStr($id);

        $html = '<input type="text" id="'. $id .'" name="'. $id .'" value="' . get_option($option) . '"/>';
        $html .= '<label for="'.$id.'">'.$desc.'</label>';

        echo $html;
    }

    public function settings() {
        
    }

    public settingsSection() {
        echo '<p>Enter your Pushover data</p>';

    }

}

?>