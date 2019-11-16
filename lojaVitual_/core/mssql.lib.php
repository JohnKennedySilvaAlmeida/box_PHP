<?php

function db_connect($argHost, $argDatabase, $argUser, $argPass) {
  $link = mssql_connect($argHost, $argUser, $argPass);
  mssql_select_db($argDatabase);

    return $link;
};

function sql_select_db($argDatabase) {
    mssql_select_db($argDatabase);
}

function db_close($argLink) {
  $Status = mssql_close($argLink);

    return $Status;
};

function db_query($argQry) {
    $resultIndex = mssql_query($argQry);

    return $resultIndex;
};

function db_result($argIndex, $argRow=0, $argField=0) {
  $result = mssql_result($argIndex, $argRow, $argField);

    return $result;
};

function db_fetch_row($argIndex) {
  $result = mssql_fetch_row($argIndex);

    return $result;
};

function db_fetch_array($argIndex) {
    $result = mssql_fetch_array($argIndex);

    return $result;
};

function db_fetch_object($argIndex) {
    $result = mssql_fetch_object($argIndex);

    return $result;
};

function db_free_result($argIndex) {
    mssql_free_result($argIndex);

    return;
}

function db_num_rows($argIndex) {
  $result = mssql_num_rows($argIndex);

    return $result;
};

function db_num_fields($argIndex) {
    $result = mssql_num_fields($argIndex);

    return $result;
};

function db_error() {
    $result = mssql_get_last_message();

  return $result;
}
?>