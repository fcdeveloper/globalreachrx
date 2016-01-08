
<?php
	/**
	 * Retrieves the max id from table.
	 */
	function get_last_id($id, $table)
	{
		$i = 0;
		$rNum = mt_rand(1,9);
		do {
		    $rNum .= mt_rand(0, 9);
		} while(++$i < 10);

	    $query = mysql_query("SELECT {$id} FROM {$table}");
	    if(mysql_num_rows() > 0){
		    get_last_id($id, $table);
		}else{
			return $rNum;
		}
	}
	
	/* Check is email is valid */
	function is_valid_email($email){
		return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
	}
	/* Sanitize String */
	function cleanStr($str=""){
	
		if($str != ""){
			$str = str_replace(" ", "", $str);
			$str = str_replace("-", "", $str);
			$str = str_replace("\\'", "", $str);
			$str = str_replace("\\", "", $str);
			$str = str_replace("'", "", $str);
			$str = str_replace("(", "", $str);
			$str = str_replace(")", "", $str);
			$str = str_replace("[", "", $str);
			$str = str_replace("]", "", $str);
			$str = str_replace("{", "", $str);
			$str = str_replace("}", "", $str);
		}
		return $str;
	}
	/* Format Phone Number */
	function formatPhoneNumber($str=""){
		if($str != ""){
			$str = cleanStr($str);
			$area_code = "(".substr($str,0,3).") ";
			$number1 = substr($str, 3, 3)."-";
			$number2 = substr($str, 6);
		}
		return $area_code.$number1.$number2;
	}
	/* send email with or not attachment */
	function mail_attachment($mailto, $from_mail, $from_name, $replyto = null, $subject, $message, $filename = null, $path = null) {
		$replyto = ($replyto == null ? $from_mail : $replyto);
		if($filename != null && $path != null){
		    $file = $path.$filename;
		    $file_size = filesize($file);
		    $handle = fopen($file, "r");
		    $content = fread($handle, $file_size);
		    fclose($handle);
		    $content = chunk_split(base64_encode($content));
		}
	    $uid = md5(uniqid(time()));
	    $header = "From: ".$from_name." <".$from_mail.">\r\n";
	    $header .= "Reply-To: ".$replyto."\r\n";
	    $header .= "MIME-Version: 1.0\r\n";
	    if($filename != null && $path != null){
		    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		    $header .= "This is a multi-part message in MIME format.\r\n";
		    $header .= "--".$uid."\r\n";
		    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
		    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		    $header .= $message."\r\n\r\n";
		    $header .= "--".$uid."\r\n";
		    $header .= "Content-Type: image/png; name=\"".$filename."\"\r\n"; //octet-stream
		    // use different content types here
		    $header .= "Content-Transfer-Encoding: base64\r\n";
		    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
		    $header .= $content."\r\n\r\n";
	    }
	    $header .= "--".$uid."--";
	    if (mail($mailto, $subject, "", $header)) {
	        echo "mail send ... OK"; // or use booleans here
	    } else {
	        echo "mail send ... ERROR!";
	    }

		/*
			$my_file = "somefile.zip";
			$my_path = "/your_path/to_the_attachment/";
			$my_name = "Olaf Lederer";
			$my_mail = "my@mail.com";
			$my_replyto = "my_reply_to@mail.net";
			$my_subject = "This is a mail with attachment.";
			$my_message = "Hallo,\r\ndo you like this script? I hope it will help.\r\n\r\ngr. Olaf";
			mail_attachment($my_file, $my_path, "recipient@mail.org", $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
		*/
	}

?>