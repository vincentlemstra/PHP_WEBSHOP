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
                require_once MODELS.'validator.model.php';
                $validator = new Validator();
                $this->response['postresult'] = $validator->checkFields();
    
                if ($this->response['postresult']['error'] === false) {
                    switch ($this->request['page']) {
                        case 'contact':
                            $this->response['page'] = 'response';
                            break;
    
                        case 'register': 
                            require_once MODELS.'user.model.php';
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
                            require_once MODELS.'user.model.php';
                            $userModel = new UserModel($this->crud); 
                            $this->response['postresult'] = $userModel->checkLogin($this->response['postresult']['email'], $this->response['postresult']['password']);
                            if (!isset($this->response['postresult']['postError'])) {
                                $this->response['page'] = 'home';
                            }
                            break;
                        
                        case 'cart':
                            require_once MODELS.'shop.model.php';
                            $shopModel = new ShopModel($this->crud);
                            $shopModel->updateCartContent();
                            $this->response['cartcontent'] = $shopModel->getCartContent();
                            break;

                        case 'checkout':
                            require_once MODELS.'shop.model.php';
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
                    require_once MODELS.'shop.model.php';
                    $shopModel = new ShopModel($this->crud);
                    $this->response['shopcontent'] = $shopModel->getShopContent();
                    break;

                case 'item':
                    require_once MODELS.'shop.model.php';
                    $shopModel = new ShopModel($this->crud);
                    $this->response['itemcontent'] = $shopModel->getItemContent($_GET['id']);
                    
                    require_once MODELS.'rating.model.php';
                    $ratingModel = new RatingModel($this->crud);
                    $this->response['itemrating'] = $ratingModel->getRatingInfo($_GET['id']);
                    break;

                case 'cart':
                    require_once MODELS.'shop.model.php';
                    $shopModel = new ShopModel($this->crud);
                    $this->response['cartcontent'] = $shopModel->getCartContent();
                    break;
            }
        }
    }

    protected function showResponse() {
        $handler;
        $page = isset($this->response['page']) ? $this->response['page'] : 'home';

        switch ($this->response['page']) {
            case 'contact':
            case 'register':
            case 'login':
            case 'rate':
                require_once VIEWS.'form.view.php';
                $handler = new Form($page, PageBaseController::getArrayVar($this->response, 'postresult', []));
                break;

            case 'response':
                require_once VIEWS.'response.view.php';
                $handler = new $page($page, $this->response['postresult']);
                break;
                    
            case 'shop':
                require_once VIEWS.'shop.view.php';
                $handler = new $page($page, $this->response['shopcontent']);
                break;
                
            case 'item':
                require_once VIEWS.'item.view.php';
                $handler = new $page($page, $this->response['itemcontent'], $this->response['itemrating']);
                break;

            case 'cart':
                require_once VIEWS.'cart.view.php';
                $handler = new $page($page, $this->response['cartcontent']);
                break;

            default:
                require_once VIEWS.$page.'.view.php';
                $handler = new $page($page);
                break;
        }
        $handler->show();
    }
}