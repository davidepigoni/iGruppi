<?php
/**
 * Description of UdM
 * 
 * @author gullo
 */
class Model_Prodotti_UdM {
    
    const _CONFEZIONE = "Confezione";
    const _PEZZO      = "Bottiglia";
    const _KG         = "Kg";
    const _LITRO      = "Litro";
    
    static private $_arUdM = array(
        self::_CONFEZIONE => 'Confezione',
        self::_PEZZO      => 'Bottiglia',
        self::_KG         => 'Kg',
        self::_LITRO      => 'Litro'
    );
    
    static private $_arUdMWithMultip = array(
        self::_PEZZO      => array('label' => 'Bottiglie', 'ndec' => '0'),
        self::_KG         => array('label' => 'Kg',    'ndec' => '2'),
        self::_LITRO      => array('label' => 'Litri', 'ndec' => '2')
    );

    public static function getArUdm(){
        return self::$_arUdM;
    }
    
    public static function getArWithMultip()
    {
        return self::$_arUdMWithMultip;
    }
}