<?
namespace app\models;

use App\Core\Model;

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
}