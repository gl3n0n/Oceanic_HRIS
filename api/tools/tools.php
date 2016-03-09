<?php
class Tools
{
	public $postvars;
	public function Tools($postvars)
	{
		$this->postvars = $postvars;
	}

	public function PreparePost()
	{
		foreach ($this->postvars as $key=>$value)
		{
            if (!empty($value))
			    $this->postvars[$key] = addslashes(trim($value));
		}
		return $this->postvars;
	}
}

function IsLogin()
{
	return isset($_SESSION['user_id']) ? true : false;
}

function genRandomString()
{
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}

function get_field_values_from_post($fields, $post)
{
    $field_values = array();
    foreach ($fields as $key) {
        if (isset($_POST[$key]))
            $field_values[$key] = $_POST[$key];
    }

    return $field_values;
}

function response_to_json($response)
{
    $json = array(
        'code'=>$response[0],
        'response'=>$response[1]
        );

    return json_encode($json);
}
?>