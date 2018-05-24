<?php
    class PageController extends Controller{
        public function home() {
           $this->set('seo_title', 'eBanking');
        }
        
        public function aboutUs() {
           $this->set('seo_title', 'About us');
        }
        
        public function contactUs() {
           $this->set('seo_title', 'Contact us');
           $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);  
           
            if ($post['submit']) {
                $from = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
                $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
                $to = "alielsadai@gmail.com";
                
                //IN CASE OF ANY OF the LINES IS LARGER THAN 70 CHARACTERS, the text will be wrapped;
                wordwrap($message, 70, "\r\n");
                $success = mail($to, $subject, $message, $from);

                if (!$success) {
                    $this->set('error_message', 'E-mail filed to send, try again!');
                } else {
                    $this->set('success_message', 'E-mail hs been sent successfully, Thank you!');
                }
            }
        }
    }
