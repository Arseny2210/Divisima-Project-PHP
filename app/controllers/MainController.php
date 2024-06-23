<?
namespace app\controllers;

use app\core\Controller;

class MainController extends Controller
{
    private $start = 0;
    private $limit = 4;

    public function indexAction()
    {
        include LIB . '/texts/main.php';

        $banners_urls = $this->model->get_banners();
        $features_urls = $this->model->get_features();
        $categories = $this->model->get_categories();
        $products = $this->model->get_products($this->start, $this->limit);
        $hot = 4;
        $hot_products = $this->model->get_hot_products($hot);

        $banners = $this->add_object_texts($banners_urls, $banners_texts);
        $features = $this->add_object_texts($features_urls, $features_texts);

        $data = compact('banners', 'features', 'categories', 'products', 'hot_products');
        $this->view->render((object) $data);
    }

    private function add_object_texts($data, $data_texts)
    {
        foreach ($data as $ind => $item) {
            $item->texts = (object) $data_texts[$ind];
        }
        return $data;
    }

    public function categoryProductsHandlerAction()
    {
        if ($this->isFetch()) {
            //Здесь теперь принимаем объект ->start   ->category_id
            $json = file_get_contents('php://input'); // []
            $data = json_decode($json);
            $category_id = $data->categoryId;
            $load_more_limit = 2;
            if ($data->start) {

            }

            if (is_numeric($category_id) and $category_id == 0) {
                $products = $this->model->get_products(
                    $data->start ? $data->start : $this->start,
                    $data->start ? $load_more_limit : $this->limit
                );
                echo json_encode($products);
            } elseif (is_numeric($category_id)) {
                $products = $this->model->get_category_products(
                    $category_id,
                    $data->start ? $data->start : $this->start,
                    $data->start ? $load_more_limit : $this->limit
                );
                echo json_encode($products);
            } else {
                echo json_encode(false);
            }
        }
    }

}