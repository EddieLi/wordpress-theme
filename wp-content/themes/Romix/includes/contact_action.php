<?php
require( HT_INCLUDES_PATH . '/get_options.php' );
if(isset($_POST['sendContact'])){


		// ENTER YOUR EMAIL HERE
		 $to_email = get_option('ht_email_address');

        $hasError = 'false';
        if(trim($_POST['fullname']) == '') {
            $hasError = "true";
            echo '<div class="error">'.__('Please enter your name.','highthemes').'</div>';
			exit;
            
        } else {
            $name = trim($_POST['fullname']);
        }
        
        if(trim($_POST['email']) == '')  {
            $hasError = "true";
            echo '<div class="error">'.__('Please enter your valid email address.','highthemes').'</div>';
			exit;			
			
            
        } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
            $hasError = "true";
            echo '<div class="error">'.__('Please enter your valid email address.','highthemes').'</div>';
			exit;			
            
        } else {
            $email = trim($_POST['email']);
        }
            
        if(trim($_POST['form_message']) == '') {
            $hasError = "true";
            echo '<div class="error">'.__('Please enter your message.','highthemes').'</div>';
			exit;			
            
        } else {
            
                $comment = stripslashes(trim($_POST['form_message']));
            
        }
        if(isset($_POST['url'])) $website = stripslashes(trim($_POST['url']));
        
        
        if($hasError!="true") {

            $e_date    = date( 'Y/m/d - h:i A', time() );
            $e_subject = ''.__('New Message By','highthemes'	).' ' . $name . ' '.__('on','highthemes').' ' . $e_date . '';
            $e_body    = $name . __(" has contacted you",'highthemes') ."\r\n\n";
            $e_body .= __("Comment: ",'highthemes') . $comment ." \r\n\n";
            $e_body .= __("Email: ",'highthemes') .  $email . " \r\n\n";
            $e_body .= __("website: ",'highthemes') . $website ." \r\n\n";
            $msg = $e_body;

         mail( $to_email, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n" );
            
       	 echo "";            
         echo '<div class="info-box-wrapper">
				<div class="info-box-green-header">
				<div class="info-content-box">'.__("Message Sent Successfully!",'highthemes').' </div>
				</div>
				<div class="info-box-green-body">
				<div class="info-content-box">';
         echo __("Thank you ",'highthemes') . "<strong>$name</strong>, " . __("your message has been submitted to us.",'highthemes') ."";
         echo '</div>
				</div>
				</div>';
			exit;
		}
        }
?>