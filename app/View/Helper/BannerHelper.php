<?php
class BannerHelper extends AppHelper
{
	public function getBanner($banner){
		$path = '/files/banners';
		$banner_info = pathinfo($path . DS . $banner['Banner']['image']);

		$banner_str = '';

		if ($banner_info['extension'] == 'swf') {
			if ($banner['Banner']['type'] == 'L' || $banner['Banner']['type'] == 'R'){
				$banner_str = '<embed width="160" height="600" src="' . $path . DS . $banner['Banner']['image'] . '">';
			} else {
				$banner_str = '<embed width="480" height="60" src="' . $path . DS . $banner['Banner']['image'] . '">';
			}
		} else {
			if ($banner['Banner']['type'] == 'L' || $banner['Banner']['type'] == 'R'){
				$banner_str = '<a href="' . $banner['Banner']['link'] . '"><img src="' . $path . DS . $banner['Banner']['image'] . '" alt="' . $banner['Banner']['link'] . '" width="160" height="600"></a>';
			} elseif ($banner['Banner']['type'] == 'W') {
				$banner_str = 'style="background: url(' . $path . DS . $banner['Banner']['image'] . ')"';
			} else {
				$banner_str = '<a href="' . $banner['Banner']['link'] . '"><img src="' . $path . DS . $banner['Banner']['image'] . '" alt="' . $banner['Banner']['link'] . '" width="480" height="60"></a>';
			}
		}

		echo $banner_str;
	}
}