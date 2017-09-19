<?php
/*
	Set the name of the session that your app uses to save the current logged on user id.
*/
define('SESSION', 'userid');

/* Functions */

/*
	Received arguments:
		 - $userid = current logged in user ID (same as getuserid())

	Must return a single one-dimension array with all the IDs of the
	logged on users that are friends with $userid (or not, if you don't want).
	An empty array (0 values) must be returned if no users are online.
*/
function getcontacts($userid) {
	$userid = mysql_real_escape_string(stripslashes(getuserid()));
	$qry = mysql_query("SELECT u.codUsu 
						FROM tbusuario u 
						LEFT JOIN sample_friends f 
						ON (f.user1=u.codUsu OR f.user2=u.codUsu) 
						WHERE (f.user1='$userid' OR f.user2='$userid') 
						AND u.codUsu!='$userid'");
	$users = array();
	if(mysql_num_rows($qry)) {
		while($row = mysql_fetch_array($qry)) {
			$users[] = $row['codUsu'];
		}
	}
	return $users;
}

/*
	Received arguments:
		- $userid = User ID to get the display name

		Must return a string with the user display name.
		It can be the username/login or user real name. Up to you.
*/

function get_display_name($userid) {
	$userid = mysql_real_escape_string(stripslashes($userid));
	$qry = mysql_query("SELECT nomUsu FROM tbusuario WHERE codUsu='$userid'");
	if(mysql_num_rows($qry)) {
		$fetch = mysql_fetch_array($qry);
		return $fetch['nomUsu'];
	} else return null;
}

/* Optional: Edit file "integrated_functions.php" for more options */