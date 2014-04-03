<?php
$banner = $this->requestAction('/banners/getBannerByType/' . $type);
echo $this->Banner->getBanner($banner);
