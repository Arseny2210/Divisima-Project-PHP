<?
namespace app\controllers;

use app\core\Controller;

class MainController extends Controller
{

    public function indexAction()
    {
        $banners_urls = $this->model->get_banners();
        $features_urls = $this->model->get_features();
        $categories = $this->model->get_categories();
        $products = $this->model->get_products();

        include LIB . '/texts/main.php';

        $banners = $this->add_object_texts($banners_urls, $banners_texts);
        $features = $this->add_object_texts($features_urls, $features_texts);

        $data = compact('banners', 'features', 'categories', 'products');
        $this->view->render((object) $data);
    }

    private function add_object_texts($data, $data_texts)
    {
        foreach ($data as $ind => $item) {
            $item->texts = (object) $data_texts[$ind];
        }
        return $data;
    }

    public function productsHandlerAction()
    {
        if ($this->isFetch()) {
            echo 'hello world';
        }
    }

}