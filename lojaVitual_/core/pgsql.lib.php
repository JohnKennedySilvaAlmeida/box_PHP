<?php
$pgLink = 0;

function db_connect($argHost, $argDatabase, $argUser, $argPass)
{
	global $pgLink;
	$HostArray = split(":", $argHost);
	if ($HostArray[0]) $ConnectCommand .= "host=".$HostArray[0];
	if ($HostArray[1]) $ConnectCommand .= " port=".$HostArray[1];
	if ($argUser) $ConnectCommand .= " user=".$argUser;
    if ($argPass) $ConnectCommand .= " password=".$argPass;
	$ConnectCommand .= " dbname=".$argDatabase;
	$pgLink = pg_Connect($ConnectCommand);
	return $pgLink;
};

function sql_select_db($argDatabase)
{
	global $pgLink;
	$pgLink = pg_Connect("dbname=".$argDatabase);
	return $pgLink;
}

function db_close($argLink)
{
	$Status = pg_close($argLink);
	return $Status;
};

function db_query($argQry)
{
	global $pgLink;
	$argQry = eregi_replace("LIMIT *([0-9]*), *([0-9]*)","LIMIT \\2 OFFSET \\1",$argQry);
	$resultIndex = pg_exec($pgLink,$argQry);
	return $resultIndex;
};

function db_result($argIndex, $argRow=0, $argField=0)
{
	$result = pg_result($argIndex, $argRow, $argField);
	return $result;
};

function db_fetch_row($argIndex)
{
	$result = pg_fetch_row($argIndex);
	return $result;
};

function db_fetch_array($argIndex)
{
	$result = pg_fetch_array($argIndex);
	return $result;
};

function db_fetch_object($argIndex)
{
	$result = pg_fetch_object($argIndex);
	return $result;
};

function db_free_result($argIndex)
{
	pg_freeresult($argIndex);
	return;
}

function db_num_rows($argIndex)
{
	$result = pg_numrows($argIndex);
	return $result;
};

function db_num_fields($argIndex)
{
	$result = pg_numfields($argIndex);
	return $result;
};

function db_error()
{
	$result = pg_errormessage();
	return $result;
}
?>
