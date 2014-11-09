<?php
class Post extends AppModel
{
	public $name = 'Post';
	public $useTable = 'posts';
	public $actsAs = array('Upload');

	public $validate = array(
		'title' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Titulo es requerido',
			),
		),
		'post' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El texto es principal',
			),
		),
	);

	public $hasMany = array(
		'PostComment' => array(
			'order' => array(
				'PostComment.id' => 'desc',
			),
			'conditions' => array(
				'PostComment.status' => 1,
			),
		),
	);

	public function beforeSave() {
		parent::beforeSave();

		if (empty($this->data[$this->alias]['update_count'])) {
			if (!empty($this->data[$this->alias]['post_date'])) {
				$this->data[$this->alias]['post_date'] = date("Y-m-d", strtotime($this->data[$this->alias]['post_date']));
			} else {
				$this->data[$this->alias]['post_date'] = date("Y-m-d");
			}

			$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

			if (!empty($this->data[$this->alias]['image']['name'])) {
				$image_name = $this->uploadPic('posts');
				$this->data[$this->alias]['image'] = $image_name;
			}

			if (!empty($this->data[$this->alias]['title'])) {
				$this->data[$this->alias]['slug'] = $this->slugify($this->data[$this->alias]['title']);
			}
		}

		return true;
	}

	private function slugify($text)
	{
		$text = $this->normalize($text);
		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		// trim
		$text = trim($text, '-');

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// lowercase
		$text = strtolower($text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		if (empty($text))
		{
			return 'n-a';
		}

		return $text;
	}

	private function normalize($text) {
		$table = array(
			'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
			'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
			'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
			'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
			'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
			'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
			'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
			'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
		);

		return strtr($text, $table);
	}

}