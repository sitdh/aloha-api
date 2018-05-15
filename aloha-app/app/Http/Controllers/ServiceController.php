<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
  private $simpleConditionsFields = [
    'additional_info',
    'amenities',
    'city',
    'country',
    'description',
    'highlight_value',
    'image_urls',
    'internet',
    'landmark',
    'occupancy',
    'pageurl',
    'property_address',
    'property_name',
    'property_type',
    'qts',
    'query_time_stamp',
    'room_types',
    'search_term',
    'service_value',
    'similar_hotel',
    'sitename',
    'things_to_do',
    'things_to_note',
    'uniq_id'
  ];

  private $numberConditionsFields = [
    'room_price',
    'hotel_star_rating',
    'image_count',
    'property_id',
  ];

  private $geometryConditionFields = [
    'latitude',
    'longitude',
  ];

  private $dateTimeConditionFields = [
    'check_in_date',
    'check_out_date',
    'crawl_date',
  ];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    return DB::table('properties')
      ->paginate(20);
  }

  public function search(Request $req) {
    $result = DB::table('properties');
    foreach($req->all() as $k => $v) {
      $result = $this->simpleConditions($result, $k, $v);
      $result = $this->numberConditions($result, $k, $v);
      $result = $this->dateConditions($result, $k, $v);
    }

    $queryResult = $result->get();

    return $queryResult;
  }

  private function simpleConditions($tableResource, $q, $v) {
    if (in_array($q, $this->simpleConditionsFields))
      $tableResource = $tableResource->where($q, $v);

    return $tableResource;
  }

  private function numberConditions($tableResource, $q, $v) {
    if (in_array($q, $this->numberConditionsFields))
      if (strpos($v, '-') > 0) {
        list($min, $max) = explode('-', $v);
        $tableResource = $tableResource->whereBetween($q , [$min, $max]);
      } else {
        $tableResource = $tableResource->where($q, $v);
      }

    return $tableResource;
  }

  private function dateConditions($tableResource, $q, $v) {
    if (in_array($q, $this->dateTimeConditionFields)) {
      $date = DateTime::createFromFormat('d-m-Y', $v);
      $tableResource = $tableResource->whereDate($q, $date->format('d-m-Y'));
    }

    return $tableResource;
  }

  private function conditionsExtract($key, $value) {
    $result = [];
    if (strpos($value, '-') > 0) {
      $result = [$key, explode('-', $value)];
    } else {
      $result = [$key, '=', $value];
    }

    return $result;
  }

}
