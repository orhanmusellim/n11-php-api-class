<?php

class N11 {
    protected static $_appKey, $_appSecret, $_parameters, $_sclient;
    public $_debug = false;
    public function __construct(array $attributes = array()) { 
        self::$_appKey = (!empty($attibutes["appKey"])) ? $attributes["appKey"] : "default";
        self::$_appSecret = (!empty($attibutes["appSecret"])) ? $attributes["appSecret"] : "default";
        self::$_parameters = array(
            'auth' => array(
                'appKey' => self::$_appKey,
                'appSecret' => self::$_appSecret
            )
        );
    }

    public function setUrl($url) {
        self::$_sclient = new \SoapClient($url);
    }

    //Kategori Servisleri
    public function GetTopLevelCategories() {
        /*
         * n11 üzerinde tanımlanmış tüm üst seviye kategorileri görmek için bu metot kullanılır. Cevap olarak n11 kategori kodu ve kategori adı döner.
         */
        $this->setUrl('https://api.n11.com/ws/CategoryService.wsdl');
        return self::$_sclient->GetTopLevelCategories(self::$_parameters);
    }

    public function GetSubCategories($parentCategoryId) {
        /*
         * Gönderilen Kategori ID sine ait 1. seviye alt kategorileri verir.
        */
        $this->setUrl('https://api.n11.com/ws/CategoryService.wsdl');
        self::$_parameters['categoryId'] = $parentCategoryId;
        return self::$_sclient->GetSubCategories(self::$_parameters);
    }

    public function GetCategoryAttributes($categoryId) {
        /*
         * Gönderilen kategoriye ait özellikleri verir.
         */
        $this->setUrl('https://api.n11.com/ws/CategoryService.wsdl');
        self::$_parameters['categoryId'] = $categoryId;
        self::$_parameters['pagingData'] = null;
        return self::$_sclient->GetCategoryAttributes(self::$_parameters);
    }

    public function GetCategoryAttributeValue($categoryProductAttributeId, $page) {
        /*
         * Gönderilen Kategori özelliği idsi ile özelliğe ait değerleri verir.
         */
        $this->setUrl('https://api.n11.com/ws/CategoryService.wsdl');
        self::$_parameters['categoryProductAttributeId'] = $categoryProductAttributeId;
        self::$_parameters['pagingData'] = array(
            'currentPage' => $page,
            'pageSize' => 100
        );
        return self::$_sclient->GetCategoryAttributeValue(self::$_parameters);
    }

    //Şehir Servisleri
    public function GetCities() {
        /*
         * Sisteme kayıtlı şehir kodları ve plaka numaralarını verir.
         */
        $this->setUrl('https://api.n11.com/ws/CityService.wsdl');
        return self::$_sclient->GetCities(self::$_parameters);
    }

    //Ürün Servisleri
    public function GetProductList($itemsPerPage, $currentPage) {
        /*
         * Sistemdeki ürünleri listeler.
         */
        $this->setUrl('https://api.n11.com/ws/ProductService.wsdl');
        self::$_parameters['pagingData'] = array(
            'itemsPerPage' => $itemsPerPage,
            'currentPage' => $currentPage
        );
        return self::$_sclient->GetProductList(self::$_parameters);
    }

    public function GetProductBySellerCode($sellerCode) {
        /*
         * Mağaza ürün kodunu kullanarak sistemde kayıtlı olan ürünün bilgilerini getirir.
         */
        $this->setUrl('https://api.n11.com/ws/ProductService.wsdl');
        self::$_parameters['sellerCode'] = $sellerCode;
        return self::$_sclient->GetProductBySellerCode(self::$_parameters);
    }

    public function SaveProduct($product = array()) {
        /*
         * Yeni ürün oluşturmak veya mevcut ürünü güncellemek için kullanılır.
         */
        $this->setUrl('https://api.n11.com/ws/ProductService.wsdl');
        self::$_parameters['product'] = $product;
        return self::$_sclient->SaveProduct(self::$_parameters);
    }

    public function UpdateStockByStockId($stockItem = array()) {
        /*
         * Ürün N11 Stok ID'si ile stok güncelleme
         */
        $this->setUrl('https://api.n11.com/ws/ProductStockService.wsdl');
        self::$_parameters['stockItems']['stockItem'] = $stockItem;
        return self::$_sclient->UpdateStockByStockId(self::$_parameters);
    }

    public function DeleteProductBySellerCode($sellerCode) {
        /*
         * Kayıtlı olan bir ürünü mağaza ürün kodu kullanılarak silmek için kullanılır.
         */
        $this->setUrl('https://api.n11.com/ws/ProductService.wsdl');
        self::$_parameters['productSellerCode'] = $sellerCode;
        return self::$_sclient->DeleteProductBySellerCode(self::$_parameters);
    }

    //Sipariş Servisleri
    public function OrderList(array $searchData = array()) {
        /*
         * Bu metot sipariş ile ilgili özet bilgileri listelemek için kullanılır.
         */
        $this->setUrl('https://api.n11.com/ws/OrderService.wsdl');
        self::$_parameters['searchData'] = $searchData;
        return self::$_sclient->OrderList(self::$_parameters);
    }

    public function OrderDetail($orderID = null) {
        /*
         * Bu metot sipariş idsi ile birlikte sipariş detayını almak için kullanılır..
         */
        $this->setUrl('https://api.n11.com/ws/OrderService.wsdl');
        self::$_parameters['orderRequest']['id'] = $orderID;
        return self::$_sclient->OrderDetail(self::$_parameters);
    }

    //Kargo Servisleri
    public function GetShipmentTemplateList() {
        /*
         * Oluşturulan teslimat şablonu bilgilerini listelemek için kullanılan metoddur.
         */
        $this->setUrl('https://api.n11.com/ws/ShipmentService.wsdl');
        return self::$_sclient->GetShipmentTemplateList(self::$_parameters);
    }

    public function __destruct() {
        if ($this->_debug) {
            print_r(self::$_parameters);
        }
    }
}