<?
namespace app\controllers;

use app\core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
<<<<<<< HEAD
        $banners_urls = $this->model->get_banners();
        $features_urls = $this->model->get_features();

        include LIB . '/texts/main.php';

        $banners = $this->add_object_texts($banners_urls, $banners_texts);
        $features = $this->add_object_texts($features_urls, $features_text);

        $data = compact('banners', 'features');
        $this->view->render((object) $data);

    }

    private function add_object_texts($data, $data_texts)
    {
        foreach ($data as $ind => $item) {
            $item->texts = (object) $data_texts[$ind];
        }
        return $data;
=======
        $banners = $this->model->get_banners();
        $this->view->render($banners);

>>>>>>> master
    }
}