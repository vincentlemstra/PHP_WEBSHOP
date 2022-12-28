<?php
class SiteModel {
    public function getFieldinfo($page) {
        // todo: REFACTOR
        switch ($page) {
            case 'contact':
                return array (
                    'name' 	    =>  array (
                                            'type' => 'text', 		
                                            'label'=> 'Name',
                                            'placeholder' => 'NAME',
                                    ),		
                    'email' 	=>  array (
                                            'type' => 'email',
                                            'label'=> 'Email',
                                            'placeholder' => 'EMAIL',
                                    ),	
                    'phone' 	=>  array (
                                            'type' => 'tel',
                                            'label'=> 'Phone-number',
                                            'placeholder' => 'PHONE',
                                    ),	
                    'message' 	=>  array (
                                            'type' => 'textarea',
                                            'label'=> 'Message',
                                            'placeholder' => 'MESSAGE',
                                    ),		
                );
            break;

            case 'login':
                return array (
                    'email' 	=>  array (
                                            'type' => 'email',
                                            'label'=> 'Email',
                                            'placeholder' => 'EMAIL',
                    ),
                    'password' 	=>  array (
                                            'type' => 'password', 		
                                            'label'=> 'Password',
                                            'placeholder' => 'PASSWORD',
                                    ),		
                );
            break;

            case 'register':
                return array (
                    'name' 	            =>  array (
                                            'type' => 'text', 		
                                            'label'=> 'Name',
                                            'placeholder' => 'NAME',
                                    ),
                    'email' 	        =>  array (
                                            'type' => 'email',
                                            'label'=> 'Email',
                                            'placeholder' => 'EMAIL',
                                    ),
                    'shippingadress' 	=>  array (
                                            'type' => 'text', 		
                                            'label'=> 'Shippingadress',
                                            'placeholder' => 'SHIPPINGADRESS',
                                    ),
                    'billingadress' 	=>  array (
                                            'type' => 'text', 		
                                            'label'=> 'Billingadress',
                                            'placeholder' => 'BILLINGADRESS',
                                    ),
                    'password' 	        =>  array (
                                            'type' => 'password', 		
                                            'label'=> 'Password',
                                            'placeholder' => 'PASSWORD',     
                                    ),		
                    'repeat_password' 	=>  array (
                                            'type' => 'password', 		
                                            'label'=> 'Repeat password',
                                            'placeholder' => 'REPEAT PASSWORD',
                                    ),		
                );
            break;

            case 'cart':
                return array (
                    'quantity'          => array (
                                            'type' => 'number', 		
                                            'label'=> 'quantity',
                                            'value' => '1',
                                    ),
                );

            case 'checkout':
                return array ();
            break;
        }
    }
}