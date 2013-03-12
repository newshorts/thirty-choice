<?php

// nobody

    if(isset($_POST['data'])) {
        $data = json_decode($_POST['data'], true);
        
        $str = '';
        
        $name = '';
        
        foreach($data['contact'] as $field) {
            $str .= "\n\r\t" . ucfirst($field['name']) . ": " . ucfirst($field['value']) . "\n\r";
            if($field['name'] == 'name') {
                $name = $field['value'];
            }
        }
        
        foreach($data['choices'] as $key => $value) {
            $str .= "\n\r\t#" . $key . ": " . ucfirst($value) . "\n\r";
        }
        
        $str .= "\n\r\tComments: ".$data['comments']."\n\r";
        
        $to = "mike_newell@gspsf.com";
        $subject = "VOTE: From GSP 30th";
        $txt = $str;
        $headers = "From: thevotingmachine@goodbysilverstein.com" . "\r\n" .
        "CC: patrick_wong@gspsf.com";

        $response = mail($to,$subject,$txt,$headers);
        
        $response = array('response' => false);
        
        if($response) {
            $response['response'] = true;
        }
        
        $filename = filter_var(str_replace(' ', '_', trim(strtolower($name))), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        
        $filename .= '_' . time();
        
        $file = 'flatfiles/'.$filename.'.txt';
        
        if(file_put_contents($file, $str)) {
            $response['response'] = true;
        } else {
            $response['response'] = false;
            $response['error'] = 'could not write to file';
        }
        
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($response);
        
    }
?>