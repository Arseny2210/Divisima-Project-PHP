<?
namespace app\models;

use App\Core\Model;

class Main extends Model
{
	public function get_banners()
	{
<<<<<<< HEAD
		return $this->db->custom_query("SELECT url_name FROM assets WHERE type_id=1");
	}

	public function get_features()
	{
		return $this->db->custom_query("SELECT url_name FROM assets WHERE type_id=2");
=======
		return $this->db->custom_query("SELECT * FROM assets WHERE type_id=1");
>>>>>>> master
	}
}