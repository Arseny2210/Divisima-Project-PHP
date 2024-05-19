<?
namespace app\controllers;

use app\core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $banners = $this->model->get_banners();
        $this->view->render($banners);

    }
}