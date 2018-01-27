<?php
class Products extends Controller{

    function __construct() {
        parent::__construct();
        require 'models/products_model.php';

        $this->model = new Products_Model();
        $this->getProductsList();
        $this->getDaysList();
        $this->getMonthsList();
        $this->getYearsList();
    }
    function index(){
       $this->view->render('products/index');
    }
    private function getProductsList()
    {
        $this->view->productsList = $this->model->getProductsList();
    }
    public function addProduct()
    {
        $this->model->addProduct();
        header("Location: " . URL);
    }
    public function edit($productID = 1)
    {
        $this->getProductInfo($productID);
        $this->getAllPriceInterval($productID);
        $this->index();
    }
    public function getProductInfo($productID)
    {
       $this->view->productInfo = $this->model->getProductInfo($productID);
    }
    public function add_prod_form()
    {
        require 'views/products/addProduct.php';
    }
    public function getDaysList()
    {
        $days = array();
        for($n = 1; $n <= 31; $n++)
        {
            $days[] = $n;
        }  
        $this->view->days = $days;   
    }
    public function getMonthsList() {
        $months = array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
        $this->view->months = $months;
    }
    public function getYearsList() {
        $years = array();
        $thisYear = date('Y');
        for($i = $thisYear; $i >= 2016; $i--)
        {
            $years[] = $i;
        }
        $this->view->years = $years;
    }
    public function addNewInterval($productID)
    {
        $this->model->addNewInterval($productID);
        header("Location: " . URL . "products/edit/" . $productID);
    }
    public function getAllPriceInterval($productID)
    {
        $this->view->intervals = $this->model->getAllPriceInterval($productID);
    }
    public function determinePriceOneDay($productID)
    {
        $checkDay = strtotime($_POST["thisYears"] . "-" . str_pad($_POST["thisMonths"],2,'0',STR_PAD_LEFT) . "-" . str_pad($_POST["thisDay"],2,'0',STR_PAD_LEFT));
        echo $this->getPriceOnDay($productID, $checkDay,$_POST["determinePrice"]);
    }
    private function getPriceOnDay($productID,$checkDay,$typeOfPrice)
    {
        $intervalArray = $this->model->getAllPriceInterval($productID);
        $countDays = array();
        $prices = array();
        $timeAdd = array();
        $i = 0;
        foreach ($intervalArray as $value)
        {
            $startDate = ($value["startDate"] == '0000-00-00') ? strtotime("2016-01-01") : strtotime($value["startDate"]);
            $endDate = ($value["endDate"] == '0000-00-00') ? time() : strtotime($value["endDate"]);
            if($startDate <= $checkDay && $checkDay <= $endDate){
                $countDays[$i] = floor(($endDate - $startDate) / (60 * 60 * 24));
                $prices[$i] = $value["Price"];
                $timeAdd[$i] = strtotime($value['addTime']);
                $i++;
            }
        }
        if($typeOfPrice == "short_period" && !empty($countDays))
        {
            $key = array_keys($countDays, min($countDays))[0];
        }
        elseif ($typeOfPrice == 'later' && !empty($countDays)) 
        {
            $key = array_keys($timeAdd, max($timeAdd))[0];
        }  
        $productInfo = $this->model->getProductInfo($productID);
        $result = !isset($key) ? $productInfo["defaultPrice"] : $prices[$key];
        return $result;
    }
    private function getAllDatePoints($productID)
    {
        return $this->model->getAllDatePoints($productID);
    }
    public function createGraphic($productID,$typeOfPrice)
    {
        $points = $this->getAllDatePoints($productID);
        $prices = array();
        foreach($points as $value)
        {
            $prices[] = $this->getPriceOnDay($productID,$value,$typeOfPrice);
        }
        $lineChart = new gLineChart(600,300);
  	$lineChart->addDataSet($prices);
  	$lineChart->setLegend(array("price"));
  	$lineChart->setColors(array("ff3344"));
  	$lineChart->setVisibleAxes(array('x','y'));
  	$lineChart->setDataRange(4000,22000);
  	$lineChart->addAxisRange(0, 1, count($prices), 50);
  	$lineChart->addAxisRange(1, 4000, 22000);
        echo '<img src="'. $lineChart->getUrl() .'">';
    }
}