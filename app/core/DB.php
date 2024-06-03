<?
namespace app\core;

class DB
{
	public $db;
	public function __construct()
	{
		$db_config_file = 'app/config/db_config.php';
		if (file_exists($db_config_file)) {
			$db_config = require_once $db_config_file;
			$this->connect_db($db_config);
		} else {
			if (PROD) {
				echo '
        <script> 
          alert("Не удалось подключиться к БД");
        </script>';
			} else {
				echo 'Не удалось найти файл: ' . $db_config_file;
			}
		}
	}

	private function connect_db($db_config)
	{
		try {
			$this->db = new \PDO("mysql:host={$db_config['host']};dbname={$db_config['db_name']}", $db_config['user'], $db_config['password']);
		} catch (\PDOException $err) {
			if (PROD) {
				die("Не удалось подключиться к БД");
			} else {
				die('Не удалось подключиться к БД: ' . $err->getMessage());
			}
		}
	}

	public function fetchAll($table)
	{
		$stmt = $this->db->prepare("SELECT * FROM {$table}");
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_OBJ);
	}

	public function fetchOne($id, $table)
	{
		$stmt = $this->db->prepare("SELECT * FROM {$table} WHERE id=?");
		$stmt->execute([$id]);
		return $stmt->fetch(\PDO::FETCH_OBJ);
	}

	public function custom_query($query, $params = null)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute($params);
		return $stmt->fetchAll(\PDO::FETCH_OBJ);
	}

}

