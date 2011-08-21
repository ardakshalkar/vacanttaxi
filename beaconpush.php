<?php

class BeaconPush {

    protected static $api_version = "1.0.0";
    protected static $api_key = "55d93b9d";
    protected static $secret_key = "d44827809f447541ecbad0193d76803b9ebce604";

    protected static $channels = array();

    /**
     * Send the request
     */
    protected static function _request($method, $command, $arg=NULL, array $data=array(), $curl_timeout=30)
    {
        $request_url = 'http://api.beaconpush.com/'.BeaconPush::$api_version.'/'.BeaconPush::$api_key;
        $request_url = $request_url.'/'.strtolower($command).($arg ? '/'.$arg : '');

        $headers = array(
            'X-Beacon-Secret-Key: '. BeaconPush::$secret_key,
        );

        $ch = curl_init($request_url);

        $opts = array(
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CONNECTTIMEOUT => ($curl_timeout/2 < 3 ? 3 : floor($curl_timeout/2)),
            CURLOPT_TIMEOUT => $curl_timeout,
        );

        curl_setopt_array($ch, $opts);

        if($method == 'POST')
        {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        elseif($method == 'GET')
            curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
        elseif($method == 'DELETE')
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        else
            throw new Exception('Illegal method defined. Allowed methods are POST, GET and DELETE.');


        if(($response = curl_exec($ch)) === FALSE)
            throw new Exception('cURL failed: '.curl_error($ch));

        curl_close($ch);
		//echo $response;
        return json_decode($response, TRUE);
    }


    public static function embed(array $options = array())
    {
        $r = "<script type=\"text/javascript\" src=\"http://cdn.beaconpush.com/clients/client-1.js\"></script>\n";

        $beacon_options = "";

        if($options)
        {
            $beacon_options .= ",{";

            if(array_key_exists('log', $options))
            {
                $comma = (array_key_exists('user', $options) ? "," : "");
                $log = ($options['log'] ? ($options['log'] !== "false" ? "true" : "false") : "false");
                $beacon_options .= "log:".$log.$comma;
            }

            if(array_key_exists('user', $options))
                $beacon_options .= "user:'".$options['user']."'";


            $beacon_options .= "}";
        }

        $r .= "<script type=\"text/javascript\">";
        $r .= "Beacon.connect(\"".BeaconPush::$api_key."\",[\"".implode('","', BeaconPush::$channels)."\"]".$beacon_options.");";
		$r .= "Beacon.listen(function( message) {
		var msg = message.name;
		console.log(message.data);
		
		if(msg == 'client_msg'){
			addTweet(\"#show_msgC\",message.data);
		}
		else if (msg =='driver_msg'){
			addTweet(\"#show_msgT\",message.data);
		}
		else if (msg == 'chat'){
			$(\"#messages\").prepend('<li id='+message.data.from+'><label class=\"name\">'+message.data.name+'</label></br><a class=\"reply\">Ответить</a></br>'+message.data.text+'</li>');
		}
		});";
        $r .= "</script>";

        return $r;
    }


    public static function add_channel($channel)
    {
        BeaconPush::$channels[] = $channel;
    }

    public static function add_channels(array $channels)
    {
        BeaconPush::$channels = array_merge(BeaconPush::$channels, $channels);
    }



    public static function send_to_channel($channel, $event, array $data = array())
    {
        return BeaconPush::_request('POST', 'channels', $channel, array('name' => $event, 'data' => $data));
    }

    public static function send_to_channels(array $channels, $event, array $data = array())
    {
        $r = array();
        foreach($channels as $channel)
            $r[$channel] = BeaconPush::send_to_channel($channel, $event, $data);

        return $r;
    }

    public static function send_to_user($user, $event, array $data = array())
    {
        return BeaconPush::_request('POST', 'users', $user, array('name' => $event, 'data' => $data));
    }

    public static function send_to_users(array $users, $event, array $data = array())
    {
        $r = array();
        foreach($users as $user)
            $r[$user] = BeaconPush::send_to_user($user, $event, $data);

        return $r;
    }

    public static function is_user_online($user)
    {
        $response = BeaconPush::_request('GET', 'users', $user);
        return isset($response['online']);
    }

    public static function get_users_in_channel($channel)
    {
        $response = BeaconPush::_request('GET', 'channels', $channel);
        return $response['users'];
    }

    public static function get_users_in_channels(array $channels)
    {
        $users = array();
        foreach($channels as $channel)
            $users = array_merge($users, BeaconPush::get_users_in_channel($channel));

        return $users;
    }

    public static function count_users_online()
    {
        $response = BeaconPush::_request('GET', 'users');
        return $response['online'];
    }

    public static function force_user_logout($user)
    {
        return BeaconPush::_request('DELETE', 'users', $user);
    }

}
