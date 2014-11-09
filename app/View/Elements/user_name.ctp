<?php
$user = $this->requestAction('/users/getUser/' . $id);
if (isset($get_image)) {
	if (empty($user['User']['image'])) {
		echo '<img class="img-thumbnail" src="/files/users/user.jpg">';
	} else {
		echo '<img class="img-thumbnail" src="/files/users/' . $user['User']['image'] . '">';
	}
}
if (isset($get_full_name)) {
	echo $user['User']['first_name'] . ' ' . $user['User']['last_name'];
}