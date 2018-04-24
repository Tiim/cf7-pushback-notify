<?php
namespace Cf7PushoverNotify;
if ( ! defined( 'ABSPATH' ) ) exit;

require_once('vendor/Pushover.php');
require_once('Util.php');

class PushoverHandler {

    public function __construct($plugin) {
        $this->prefix = $plugin->prefix;
    }

    public function submit($contactform, $result) {
        // if status is not 'mail_sent', 'mail_failed' or 'spam' return
        if (! in_array( $result['status'], array('mail_sent', 'mail_failed', 'spam') )) {
            return;
        }

        $submission = \WPCF7_Submission::get_instance();

        $data = array();
        $data = $this->filterData($submission->get_posted_data());
        $data['title'] = $contactform->title();
        $this->send($data);
    }

    public function filterData($data) {
        $new = array();
        foreach ($data as $key => $value) {
            if (substr($key, 0, 6) !== '_wpcf7') {
                $new[$key] = $value;
            }
        }
        return $new;
    }

    public function send($data) {
        $title = get_option( $this->prefix . 'msg-title', null );
        $message = get_option( $this->prefix . 'message', null );
        
        $title = Util::formatStr($title, $data);
        $message = Util::formatStr($message, $data);

        $api_token = get_option( $this->prefix . 'api-token', null );
        $user_token = get_option( $this->prefix . 'user-token', null );

        if (!$api_token || !$user_token) {
            return;
        }

        $push = new Pushover();
        $push->setToken($api_token);
        $push->setUser($user_token);
        $push->setTitle($title);
        $push->setMessage($message);
        $push->setPriority(-1);
        $push->send();
    }
}
?>