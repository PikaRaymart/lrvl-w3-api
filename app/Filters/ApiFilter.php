<?php

namespace App\Filters;

use Illuminate\Http\Request;


class ApiFilter {
  protected $safeParams = [];
  protected $columnMap = [];
  protected $operatorMap = [];

  function transform(Request $request){
    $eloQuery = [];

    foreach($this->safeParams as $param => $operator) {
      $query = $request->query($param);

      if (!isset($query)) {
        continue;
      }

      $column = $this->columnMap[$param] ?? $param;

      foreach($operator as $operator) {
        if (isset($query[$operator])) {
          $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
        }
      }
    }

    return $eloQuery;
  }
}