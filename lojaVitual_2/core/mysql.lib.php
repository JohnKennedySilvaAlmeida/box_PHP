<?php

function db_connect($argHost, $argDatabase, $argUser, $argPass)
{
    $link = mysql_connect($argHost, $argUser, $argPass);
    mysql_select_db($argDatabase);
    return $link;
};

function sql_select_db($argDatabase) {
    mysql_select_db($argDatabase);
}

function db_close($argLink)
{
    return mysql_close($argLink);
};

function db_query($argQry)
{
    return mysql_query($argQry);
};

function db_result($argIndex, $argRow=0, $argField=0)
{
    return mysql_result($argIndex, $argRow, $argField);
};

function db_fetch_row($argIndex)
{
    return mysql_fetch_row($argIndex);
};

function db_fetch_array($argIndex)
{
    return mysql_fetch_array($argIndex);
};

function db_fetch_object($argIndex)
{
    return mysql_fetch_object($argIndex);
};

function db_free_result($argIndex)
{
    mysql_free_result($argIndex);
    return;
}

function db_num_rows($argIndex)
{
    return mysql_num_rows($argIndex);
};

function db_num_fields($argIndex)
{
    return mysql_num_fields($argIndex);
};

function db_error()
{
    return mysql_error();
}
?>