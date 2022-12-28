<?php
require_once "page.base.controller.php";
class PageController extends PageBaseController
{
    // --- PROPERTIES ---
    private $response;

    // --- PROTECTED METHODS ---
    protected function validateRequest() {
        $this->response = $this->request;
        if ($this->request['posted']) { 
                // validate postresult
                require_once 'model/validator.model.php';
                $validator = new Validator();
                $this->response['postresult'] = $validator->checkFields();
    
                if ($this->response['postresult']['error'] === false) {
                    switch ($this->request['page']) {
                        case 'contact':
                            $this->response['page'] = 'response';
                            break;
    
                        case 'register': 
                            require_once 'model/user.model.php';
                            $userModel = new UserModel($this->crud);
                            $this->response['postresult'] = $userModel->saveRegister(
                                $this->response['postresult']['name'],
                                $this->response['postresult']['email'],
                                $this->response['postresult']['password'],
                                $this->response['postresult']['repeat_password'],
                                $this->response['postresult']['shippingadress'],
                                $this->response['postresult']['billingadress']);

                            if (!isset($this->response['postresult']['postError'])) {
                                $this->response['page'] = 'login';
                            }
                            break;

                        case 'login':
                            require_once 'model/user.model.php';
                            $userModel = new UserModel($this->crud); 
                            $this->response['postresult'] = $userModel->checkLogin($this->response['postresult']['email'], $this->response['postresult']['password']);
                            if (!isset($this->response['postresult']['postError'])) {
                                $this->response['page'] = 'home';
                            }
                            break;
                        
                        case 'cart':
                            require_once 'model/shop.model.php';
                            $shopModel = new ShopModel($this->crud);
                            $shopModel->updateCartContent();
                            $this->response['cartcontent'] = $shopModel->getCartContent();
                            break;

                        case 'checkout':
                            require_once 'model/shop.model.php';
                            $shopModel = new ShopModel($this->crud);
                            $shopModel->checkout();
                            break;
                    }
                } 
        } else { 
            switch ($this->request['page']) {
                case 'logout':
                    session_unset();
                    session_destroy();
                    $this->response['page'] = 'login';
                    break;

                case 'shop':
                    require_once 'model/shop.model.php';
                    $shopModel = new ShopModel($this->crud);
                    $this->response['shopcontent'] = $shopModel->getShopContent();
                    break;

                case 'item':
                    require_once 'model/shop.model.php';
                    $shopModel = new ShopModel($this->crud);
                    $this->response['itemcontent'] = $shopModel->getItemContent($_GET['id']);
                    
                    require_once 'model/rating.model.php';
                    $ratingModel = new RatingModel($this->crud);
                    $this->response['itemrating'] = $ratingModel->getRatingInfo($_GET['id']);
                    break;

                case 'cart':
                    require_once 'model/shop.model.php';
                    $shopModel = new ShopModel($this->crud);
                    $this->response['cartcontent'] = $shopModel->getCartContent();
                    break;
            }
        }
    }

    protected function showResponse() {
        $page = isset($this->response['page']) ? $this->response['page'] : 'home';

        switch ($this->response['page']) {
            case 'contact':
            case 'register':
            case 'login':
            case 'rate':
                require_once 'view/form.view.php';
                $base = new Form($page, PageBaseController::getArrayVar($this->response, 'postresult', []));
                $base->show();
                break;

            case 'response':
                require_once 'view/response.view.php';
                $base = new $page($page, $this->response['postresult']);
                $base->show();
                break;
                    
            case 'shop':
                require_once 'view/shop.view.php';
                $base = new $page($page, $this->response['shopcontent']);
                $base->show();
                break;
                
            case 'item':
                require_once 'view/item.view.php';
                $base = new $page($page, $this->response['itemcontent'], $this->response['itemrating']);
                $base->show();
                break;

            case 'cart':
                require_once 'view/cart.view.php';
                $base = new $page($page, $this->response['cartcontent']);
                $base->show();
                break;

            default:
                require_once 'view/'.$page.'.view.php';
                $base = new $page($page);
                $base->show();
                break;
        }
    }
}