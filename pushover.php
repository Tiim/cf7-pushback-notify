<?php
namespace Cf7PushoverNotify;



function onCf7Submit($contactform, $result) {
    // if status is not 'mail_sent', 'mail_failed' or 'spam' return
    if (! in_array( $result['status'], array('mail_sent', 'mail_failed', 'spam') )) {
        return;
    }

    $submission = \WPCF7_Submission::get_instance();

    $data = array();
    $data['title'] = $contactform->title();
    $postedData = $submission->get_posted_data();
    foreach ($postedData as $key => $value) {
        $str = substr( $key, 0, 5 );
        if ('your-' === $str) {
            $nkey = substr($key, 5);
            $data['posted_data'][$nkey] = $value;
        }
    }
}

?>