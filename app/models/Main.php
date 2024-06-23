<?
namespace app\models;

use app\core\Model;

class Main extends Model
{
	public function get_banners()
	{
		return $this->db->custom_query("SELECT url_name FROM assets WHERE type_id=1");
	}
	public function get_features()
	{
		return $this->db->custom_query("SELECT url_name FROM assets WHERE type_id=2");
	}

	public function get_categories()
	{
		return $this->db->fetchAll('categories');
	}

	public function get_products($start, $limit)
	{
		return $this->db->custom_query("SELECT * FROM products LIMIT {$limit} OFFSET {$start}");
	}

	public function get_category_products($category_id, $start, $limit)
	{
		return $this->db->custom_query("SELECT * FROM products WHERE category_id=? LIMIT {$limit} OFFSET {$start}", [$category_id]);
	}

	public function get_hot_products($hot)
	{
		return $this->db->custom_query("SELECT * FROM products WHERE hot >= {$hot}");
	}
}