<?php
/**
 * Code4pro Intellectual Property
 *
 * @category     Notification Model
 * @copyright    Copyright © 1999-2017 CODE4PRO Team (http://code4.pro/)
 * @author       CODE4PRO Team (http://code4.pro/)
 */

class Notification
{
    const CODE4PRO_FCM_SEND_URL   = 'https://fcm.googleapis.com/fcm/send';
    const CODE4PRO_FCM_SERVER_KEY = 'YOUR_SECRET_KEY';

    /**
     * Send notification to devices via fcm.googleapis.com
     * https://firebase.google.com/docs/cloud-messaging/concept-options
     *
     * @param $title (main title of message)
     * @param $body  (main content of message)
     * @param $pushUid (unique code from Google service)
     */
    public function send($title, $body, $pushUid)
    {
        $server_key = self::CODE4PRO_FCM_SERVER_KEY;

        $headers = array(
            'Content-Type:application/json',
            "Authorization:key=$server_key"
        );

        $fields = array(
            'to' => $pushUid,
            'notification' => array(
                'title' => $title,
                'body'  => $body,
                'icon'  => 'myicon',
                'sound' => 'mySound'
            )
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::CODE4PRO_FCM_SEND_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_exec($ch);
        curl_close($ch);
    }
}