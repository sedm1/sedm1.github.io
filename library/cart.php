<?php 
class Cart {
    
    protected $CI;
    protected $_cart_contents = array();
    
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->_cart_contents = $_SERVER['CART_CONTENT'];
        if ($this->_cart_contents === NULL)
        {
            // No cart exists so we'll set some base values
            $this->_cart_contents = array('cart_total' => 0, 'total_items' => 0);
        }
        
        log_message('info', 'Cart Class Initialized');
    }
}