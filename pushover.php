<?php
namespace Cf7PushoverNotify;

require_once('vendor/Pushover.php');
require_once('Util.php');

function cf7_submit($contactform, $result) {
    // if status is not 'mail_sent', 'mail_failed' or 'spam' return
    if (! in_array( $result['status'], array('mail_sent', 'mail_failed', 'spam') )) {
        return;
    }

    $submission = \WPCF7_Submission::get_instance();

    $data = array();
    $data = filterData($submission->get_posted_data());
    $data['title'] = $contactform->title();
    send($data);
}

function filterData($data) {
    $new = array();
    foreach ($data as $key => $value) {
        if (substr($key, 0, 6) !== '_wpcf7') {
            $new[$key] = $value;
        }
    }
    return $new;
}

function send($data) {
    $title = 'New Submission \'{{title}}\' from {{your-name}}';
    $message = "Subject: {{your-subject}}\n{{your-message}}";
    
    $title = Util::formatStr($title, $data);
    $message = Util::formatStr($message, $data);

    $api_token = get_option( Util::$prefix . 'pushover-api-token', null );
    $user_token = get_option( Util::$prefix . 'pushover-user-token', null );

    if (!$api_token || !$user_token) {
        return;
    }

    $push = new Pushover();
    $push->setToken('---');
    $push->setUser('---');
    $push->setTitle($title);
    $push->setMessage($message);
    $push->setPriority(-1);
    $push->send();
}

?>