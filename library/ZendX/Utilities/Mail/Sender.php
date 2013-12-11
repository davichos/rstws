<?php

class ZendX_Utilities_Mail_Sender {

    /**
     * 
     * @param array $options array('host' => string,'param' => array('auth' => string,'ssl' => string,'port' => string,'username' => string,'password' => string));
     * @param array $emailsCC array(array('name'=>string,'email=>string),array('name'=>string,'email=>string),...),
     * @param string $subject
     * @param string $message
     * @param string $filecontent
     * @param string $filename
     * @return boolean
     */
    public function sendMail($options, $subject, $message, $emailsCC = array(), $emailsBcc = array(), $filecontent = null, $filename = null) {
        try {
            $host = $options['host'];
            $param = $options['param'];
            $tr = new Zend_Mail_Transport_Smtp($host, $param);
            Zend_Mail::setDefaultTransport($tr);
            $mail = new Zend_Mail();

            if ($filecontent !== null) {
                $attachment = $mail->createAttachment($filecontent);
                $attachment->filename = $filename;
            }

            $mail->setFrom('notificaciones@urreamespatrio.com', 'Urrea mes Patrio')
                    ->setSubject($subject)
                    ->setBodyHtml($message, 'UTF-8');
            foreach ($emailsCC as $email) {
                $mail->addTo($email['email'], $email['nombre']);
            }
            foreach ($emailsBcc as $email) {
                $mail->addBcc($email['email']);
            }
            $mail->send();
            $return = true;
        } catch (Exception $e) {

            //throw new Exception('error', $e->getMessage());
        }
        return $return;
    }

}