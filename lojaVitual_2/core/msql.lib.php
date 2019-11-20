<?php

function db_connect($argHost, $argDatabase, $argUser, $argPass) {
  $link = msql_connect($argHost);
  msql_select_db($argDatabase);

    return $link;
};

function sql_select_db($argDatabase) {
    msql_select_db($argDatabase);
}

function db_close($argLink) {
  $Status = msql_close($argLink);

    return $Status;
};

function db_query($argQry) {
    $resultIndex = msql_query($argQry);

    return $resultIndex;
};

function db_result($argIndex, $argRow=0, $argField=0) {
  $result = msql_result($argIndex, $argRow, $argField);

    return $result;
};

function db_fetch_row($argIndex) {
  $result = msql_fetch_row($argIndex);

    return $result;
};

function db_fetch_array($argIndex) {
    $result = msql_fetch_array($argIndex);

    return $result;
};

function db_fetch_object($argIndex) {
    $result = msql_fetch_object($argIndex);

    return $result;
};

function db_free_result($argIndex) {
    msql_free_result($argIndex);

    return;
}

function db_num_rows($argIndex) {
  $result = msql_num_rows($argIndex);

    return $result;
};

function db_num_fields($argIndex) {
    $result = msql_num_fields($argIndex);

    return $result;
};

function db_error() {
    $result = msql_error();

  return $result;
}
?>