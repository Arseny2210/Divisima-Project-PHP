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

	public function get_products()
	{
		return $this->db->custom_query("SELECT * FROM products limit 8");
	}

}