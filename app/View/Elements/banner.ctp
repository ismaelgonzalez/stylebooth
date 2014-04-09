<?php
$banner = $this->requestAction('/banners/getBannerByType/' . $type);
if (!empty($banner)) {
	echo $this->Banner->getBanner($banner);
}