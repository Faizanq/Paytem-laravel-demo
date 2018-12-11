<?php

namespace App\Helper;

class CustomFunctions {

  //To return nullyfy the values
  public static function nullyfy($object){

    $result = [];
    
    foreach ($object->getAttributes() as $attribute => $value) {

    		if($object[$attribute] == null)
    			$result[$attribute] = '';

        else $result[$attribute] = (string)$value;
    }
    return $object;

  }//nullyfy ends here

  public static function languagesLevel(){
  	return [
  	'Beginner','Intermidiate','Advance','Native'
  	];
  }

   public static function availabilityType(){
    return [
    'Immediate Start',
    'Not Immediate',
    'Not Available'
    ];
  }

   public static function employmentType(){
    return [
    1=>'Full Time',
    2=>'Part Time',
    3=>'Temporary',
    4=>'Freelance',
    5=>'Contract'
    ];
  }

  public static function salaryType(){
    return [
    1=>'Hourly',
    2=>'Monthly',
    3=>'Yearly'];
  }



    public static function pushNotification($ids,$data){


    // API access key from Google API's Console
    define( 'API_ACCESS_KEY', 'AIzaSyB2htiEIpOJmGeEuG3V9iL3SwVzqP8V2pU' );
    $registrationIds = $ids;
    // prep the bundle

    $fields = array
    (
      'registration_ids'  => $ids,
      'data'      => $data
    );
     
    $headers = array
    (
      'Authorization: key=' . API_ACCESS_KEY,
      'Content-Type: application/json'
    );
     
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    curl_close( $ch );
    return  $result;
    }

}