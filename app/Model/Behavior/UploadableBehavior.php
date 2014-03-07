<?php
class UploadableBehavior extends ModelBehavior {
	public function uploadPic(Model $Model, $destination){
		if (!$destination) {
			$destination = 'products';
		}
		$pics = $Model->data[$Model->alias];

		var_dump($pics);
		exit();

		$pics_dir = WWW_ROOT.'files'.DS.$destination;
		var_dump($pics_dir);
		exit();
		$allowed_types = array('image/gif','image/jpeg','image/pjpeg','image/png', 'application/x-shockwave-flash');

		$filename = false; //in case there is no file to be uploaded we return false.

		if ($pics[$this->alias]['image']['name'] != '' && $pics[$this->alias]['image']['error'] == 0) {     //make sure there is a file to upload and there is no error
			$filename = str_replace(' ', '_', $pics[$this->alias]['image']['name']);

			$typeOK = false;

			foreach ($allowed_types as $type) {     //check to make sure file type is allowed
				if ($type == $pics[$this->alias]['image']['type']) {
					$typeOK = true;
					break;
				}
			}

			if ($typeOK) {  //upload
				if(!move_uploaded_file($pics[$this->alias]['image']['tmp_name'], $pics_dir.DS.$filename) || !$this->make_thumb($filename, $options=array('files_dir' => $pics_dir)) ) {
					return false;
				}
			}
		}

		return $filename;
	}
}
