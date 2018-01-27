<?php

class Products_Model extends Model
{
    public function __construct() {
        parent::__construct();
    }
    public function addProduct()
    {
        $sth = $this->db->prepare("INSERT INTO `products` (`prodName`,`defaultPrice`,`determinePrice`) VALUES (:prodName,:defaultPrice,:determinePrice);");
        $sth->execute(array(
            ':prodName'         => Controller::checkString($_POST["prodName"]),
            ':defaultPrice'     => Controller::checkString($_POST["defaultPrice"]),
            ':determinePrice'   => Controller::checkString($_POST["determinePrice"])
        )); 
    }
    public function addNewInterval($productID) {
        $startDate = $_POST["startYears"] . "-" . str_pad($_POST["startMonths"],2, "0", STR_PAD_LEFT) . "-" . str_pad($_POST["startDay"],2, "0", STR_PAD_LEFT);
        $endDate = $_POST["endYears"] . "-" . str_pad($_POST["endMonths"],2, "0", STR_PAD_LEFT) . "-" . str_pad($_POST["endDay"],2, "0", STR_PAD_LEFT);
        $sth = $this->db->prepare("INSERT INTO `prices` (`productID`,`startDate`,`endDate`,`Price`,`addTime`) VALUES (:productID,:startDate,:endDate,:Price,:addTime);");
        $sth->execute(array(
            ':productID'            => $productID,
            ':startDate'            => Controller::checkString($startDate),
            ':endDate'              => Controller::checkString($endDate),
            ':Price'                => Controller::checkString($_POST["price"]),
            ':addTime'              => date("Y-m-d H:i:s")
        ));
    }
    public function getProductsList()
    {
        $sth = $this->db->prepare("SELECT `id`,`prodName`,`defaultPrice`,`determinePrice` FROM `products` ORDER BY `id`;");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(); 
        return $sth->fetchAll();
    }
    public function getProductInfo($productID)
    {
        $sth = $this->db->prepare("SELECT `id`,`prodName`,`defaultPrice`,`determinePrice` FROM `products` WHERE `id`='" . $productID . "';");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(); 
        $arr = $sth->fetchAll()[0];
        $result = (empty($arr)) ? array() : $arr;
        return $result;
    }
    public function getAllPriceInterval($productID)
    {
        $sth = $this->db->prepare("SELECT `id`,`startDate`,`endDate`,`Price`,`addTime` FROM `prices` WHERE `productID`='$productID' ORDER BY `addTime`;");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(); 
        return $sth->fetchAll();
    }
    public function getAllDatePoints()
    {
        $dates = array();
        $start = strtotime('2016-01-01');
        $finish = time();
        for($i=$start; $i<$finish; $i+=86400)
        {
            list($year,$month,$day) = explode("|",date("Y|m|d",$i));
            $dates[] = strtotime($year . "-" . $month . "-" . $day);
        }
        return $dates;
    }
}