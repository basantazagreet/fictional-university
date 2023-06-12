<?php 

class GetPets {
  function __construct() {

    //Args build garera loop through to add in query
    global $wpdb;
    $tablename = $wpdb->prefix . 'pets';

    $this->args = $this->getArgs();
    $this->placeholders = $this->createPlaceholders();

    $query = "SELECT * FROM $tablename ";
    $countQuery = "SELECT COUNT(*) FROM $tablename ";
    $query .= $this->createWhereText();
    $countQuery .= $this->createWhereText();
    $query .= " LIMIT 100";

    $this->count = $wpdb->get_var($wpdb->prepare($countQuery, $this->placeholders));
    $this->pets = $wpdb->get_results($wpdb->prepare($query, $this->placeholders));
  }

  function getArgs() {
    $temp = array(
      //Discard other dummy content use these only
      'favcolor' => sanitize_text_field($_GET['favcolor']),
      'species' => sanitize_text_field($_GET['species']),
      'minyear' => sanitize_text_field($_GET['minyear']),
      'maxyear' => sanitize_text_field($_GET['maxyear']),
      'minweight' => sanitize_text_field($_GET['minweight']),
      'maxweight' => sanitize_text_field($_GET['maxweight']),
      'favhobby' => sanitize_text_field($_GET['favhobby']),
      'favfood' => sanitize_text_field($_GET['favfood']),
    );

    //filter out Empty values, all above will not be entered
    //array and function to run 
    //As long as its not empty and belongs to above, it will return sth. 
    return array_filter($temp, function($x) {
      return $x;
    });

  }

  //Slightly modify array. we only need actual value, not property name
  //first arg function and 
  function createPlaceholders() {
    return array_map(function($x) {
      return $x;
    }, $this->args);
  }

  //dynamic text build out
  function createWhereText() {
    $whereQuery = "";


    if (count($this->args)) {
      $whereQuery = "WHERE ";
    }


    //
    $currentPosition = 0;

    //Loop through args to add 
    foreach($this->args as $index => $item) {
      $whereQuery .= $this->specificQuery($index);

      //dont add and if its last one
      if ($currentPosition != count($this->args) - 1) {
        $whereQuery .= " AND ";
      }
      $currentPosition++;
    }

    return $whereQuery;
  }

  //min max is not in database so translating them to petweight
  function specificQuery($index) {
    switch ($index) {
      case "minweight":
        return "petweight >= %d";
      case "maxweight":
        return "petweight <= %d";
      case "minyear":
        return "birthyear >= %d";
      case "maxyear":
        return "birthyear <= %d";
      default:
        return $index . " = %s";
    }
  }

}