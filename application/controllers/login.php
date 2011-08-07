<?php 
require("application/libraries/twitteroauth.php");
require("application/libraries/Loginza/LoginzaAPI.class.php");
require("application/libraries/Loginza/LoginzaUserProfile.class.php");
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front_model');
		$this->load->library('form_validation');
		$this->load->library('calendar');
		$this->load->helper('language');
		$this->lang->load("menu");
		//$this->defineCityName();
		//$this->session_start();
	}
	
	function loginza(){		
		$LoginzaAPI = new LoginzaAPI();
		$profile = &$LoginzaAPI->getAuthInfo($_POST['token']);
		if (!empty($profile->error_type)) {
			echo $profile->error_type.": ".$profile->error_message;
		} elseif (empty($profile)) {
			echo 'Temporary error.';
		} else {
			$loginzaProfile = new LoginzaUserProfile($profile);
			//print_r($profile);
			//$this->load->model('user_model');
			$this->load->model('tank_auth/users');
			$email = "";
			if (isset($profile->email)){
				$email = $profile->email;
			}
			else if ($profile->provider == 'http://twitter.com/'){
				$email = "tw".$profile->uid."@twitter.com";
			}
			else if ($profile->provider == 'http://vkontakte.ru/'){
				$email = "vk".$profile->uid."@vkontakte.ru";
			}
			else if ($profile->provider =='http://www.myopenid.com/server'){
				$email = $profile->identity;
			}
			echo $this->users->is_email_available($email);
			$user = $this->users->get_user_by_email($email);
			echo "-->";
			print_r($user);
			if (!isset($user)){	
				$data['email']	= $email;
				$data['banned']	= '0';
				$data['last_ip']= $this->input->ip_address();
				$data['displayname'] = $loginzaProfile->genDisplayName();
				$data['provider']	= $profile->provider;
				$data['identity']	= $loginzaProfile->genUserSite();
				$ret = $this->users->create_user($data,true);
				$user_profile = array();
				if (isset($profile->dob)) $user_profile['dob']=$profile->dob;
				if (isset($profile->photo)) $user_profile['photo']=$profile->photo;
				$this->db->where('user_id',$ret['user_id']);
				$this->db->update('user_profiles',$user_profile);
				if ($ret["user_id"] != NULL)
					$this->session->set_userdata(array(
								'user_id'	=> $ret["user_id"],
								'username'	=> $data['displayname'],
								'status'	=> '1',
						));
			}
			else{
				$this->session->set_userdata(array('user_id'=>$user->id,'username'=>$user->displayname,'status'=>'1'));
				//echo "logged";
			}
		}
		redirect('front/index');
	}
	# General Page
	function facebook()
	{
		$app_id = "155858844487024";
		$app_secret = "2b71848c4687c906b85cc27df8c64396";
		$my_url = base_url()."index.php/login/facebook/";
		session_start();
		$code = $this->input->get("code");
		//echo $_REQUEST['state']."---".$_SESSION['state'];
		if (empty($code)){
			$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
			$dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" 
			. $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
			. $_SESSION['state'];
			echo("<script> top.location.href='" . $dialog_url . "'</script>");
		}
		if($_REQUEST['state'] == $_SESSION['state']) {
			$code = $_REQUEST["code"];
			$token_url = "https://graph.facebook.com/oauth/access_token?"
			. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
			. "&client_secret=" . $app_secret . "&code=" . $code;

			$response = file_get_contents($token_url);
			$params = null;
			parse_str($response, $params);

			$graph_url = "https://graph.facebook.com/me?access_token=" 
			. $params['access_token'];

			$user = json_decode(file_get_contents($graph_url));
			print_r($user);
			echo("Hello " . $user->name." ".$user->id);
			
			$this->session->set_userdata('user_id',$user->id);
			$this->session->set_userdata('username',$user->name);
			redirect('main/index');
		}
		else {
			echo("The state does not match. You may be a victim of CSRF.");
		}
		
	}
	function twitter(){
		$consumer_key = 'gemUToViJQcZhM8yHwsdg';
		$consumer_secret = 'Ca15cJVfUvT2yHSjKKCazIXg1QEersrgXjgPd6UCs';
		session_start();
		$twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret);  
		$request_token = $twitteroauth->getRequestToken('http://localhost.com/twitter_oauth.php');
		$_SESSION['oauth_token'] = $request_token['oauth_token'];  
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];  
		if($twitteroauth->http_code==200){
			$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']); 
			header('Location: '. $url); 
		} else { 
			die('Something wrong happened.');  
		}  
	}
	function google(){
		$code = $_GET["code"];
		$postdata = http_build_query(
			array(
			'code' => $code,
			'client_id' => '968251785357.apps.googleusercontent.com',
			'client_secret'=>'6aTVk4Kkoe0QD3pyKkWk_6Yg',
			'redirect_uri'=>'https://localhost/VacanTaxi/index.php/login/google',
			'grant_type'=>'authorization_code'
			)
		);
		//echo $postdata;
		$opts = array('http' =>
			array(
			'method'  => 'POST',
			'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
			'content' => $postdata
			)
		);
		$context  = stream_context_create($opts);
		$result = file_get_contents('https://accounts.google.com/o/oauth2/token', false, $context);
		echo "<br/>".$result." ";
		$obj =json_decode($result); 
		$access_token = $obj->access_token;
		$opts = array('http' =>
			array(
			'method'  => 'GET',
			'header' => "Authorization: OAuth $access_token\r\nContent-Type: application/json\r\n",
			)
		);
		//print_r($opts);
		$context = stream_context_create($opts);
		//$result = file_get_contents('https://www.googleapis.com/userinfo/email?alt=json',false,$context);
		//$result = file_get_contents('https://www.googleapis.com/userinfo/email?alt=json&oauth_token='.$access_token);
		$result = file_get_contents('https://www.google.com/m8/feeds/contacts/default/full?alt=json&oauth_token='.$access_token);
		echo "<br/><br/>".$result;
	}
	function vkontakte(){
		echo "Vkontakte";
	}
}
?>
