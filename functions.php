
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
	/* detect if is surfing in mobile device */
	function isMobile() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
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
	/* Fill design elements in card */
	function fill_card($card, $site){

		$html = $card; //get card content
		
		//$html = str_replace('<div class="card-wrap">', '<img src="form/images/icon-scissor.png" style="left: 45px; opacity: 0.6; position: absolute; margin-top: 40px;"><div class="card-wrap">', $html);
		switch($site){
			case 'globalreachhealth':
			{
				$html = str_replace("{title}", "Global Reach Health", $html);
				$html = str_replace("{logo}", "<img src='http://www.globalreachhealth.com/wp-content/uploads/2016/01/GlobalReachHealth__RGB.png' width='370' alt=''/>", $html);
				$html = str_replace("{subtitle}", "health discount card", $html);
				$html = str_replace("{pharmacy_help}", "Pharmacy: (888) <span>723</span>-6004&nbsp;&nbsp;&nbsp;&nbsp;Medical Services: (305) <span>431</span>-5350", $html);
				$html = str_replace("{slogan}", "Save up to 75% on 50,000 drugs and medical services worldwide.", $html);
				$html = str_replace("{card_present}", "Present this card to your local pharmacy and/or clinical to save on your prescriptions and medical services.", $html);
				break;
			}
			case 'globalreachrx':
			{
				$html = str_replace("{title}", "Global Reach RX", $html);
				$html = str_replace("{logo}", "<img src='form/images/logo.png' alt=''/>", $html);
				$html = str_replace("{subtitle}", "pharmacy discount card", $html);
				$html = str_replace("{pharmacy_help}", "Pharmacy Help (888) <span>723</span>-6004", $html);
				$html = str_replace("{slogan}", "Save up to 75% on 50,000 drugs at over 50,000 pharmacies", $html);
				$html = str_replace("{card_present}", "Present this card to your local pharmacy to save on your prescriptions.", $html);
				$html = str_replace("{hide_on_belizerx}", '
				<tr>
				    <td style="width: 3%; font-size: 13px;"><img src="form/images/list-icon.png"></td>
				    <td style="font-size: 13px;">Currently valid for use in U.S.A only.</td>
			    </tr>', $html);
				break;
			}
			case 'belizerx':
			{
				$html = str_replace("{title}", "Belize RX", $html);
				$html = str_replace("{logo}", "<img src='http://www.belizerx.com/wp-content/uploads/2016/01/logo.png' alt=''/>", $html);
				$html = str_replace("{subtitle}", "pharmacy discount card", $html);
				$html = str_replace("{pharmacy_help}", "Pharmacy Help (888) <span>723</span>-6004", $html);
				$html = str_replace("{slogan}", "Save up to 75% on 50,000 drugs at over 50,000 pharmacies", $html);
				$html = str_replace("{card_present}", "Present this card to your local pharmacy to save on your prescriptions.", $html);
				$html = str_replace("{hide_on_belizerx}", '', $html);
				break;
			}
		}
		$html = str_replace("{card_id}", "550002", $html); //card_id
		$html = str_replace("{card_bin}", "016912", $html); //card_bin
		$html = str_replace("{card_group}", "550004", $html); //card_group
		$html = str_replace("{card_pcn}", "9743", $html); //card_id

		return $html;
		
	}

?>
