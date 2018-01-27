<div id="sideBar">
    <div id="productsList">
        <?php foreach($this->productsList as $value){?>
        <a href="<?php echo URL?>products/edit/<?php echo $value["id"]?>"><?php echo $value["prodName"]?></a><br>
        <?php }?>
    </div>
    <button onclick="showAddProductForm('<?php echo URL;?>');">Добавить продукт</button>
    <div id="addProd"></div>
</div>
<div id="priceTable">
    <p>Цена по умолчанию: <?php if(isset($this->productInfo['defaultPrice'])){ echo $this->productInfo['defaultPrice'];}?></p>
    <?php if(!empty($this->intervals)){?>
    <table cellpadding="10">
        <tr>
            <th>С</th>
            <th>По</th>
            <th>Цена</th>
        </tr>
        <?php foreach($this->intervals as $value){?>
        <tr>
            <td><?php echo $value["startDate"]?></td>
            <td><?php echo $value["endDate"]?></td>
            <td><?php echo $value["Price"]?></td>       
        </tr>
        <?php }?>
    </table>
    <?php }?>
    <button type="button" onclick="addNewInterval();">Добавить новый интервал</button>
    <div id="addNewInterval"><?php require 'views/products/addNewIntervalForm.php';?></div>
</div>
<div id="determinePrice">
    <form id="priceOneDay" action="javascript:void(null);" onsubmit="determinePriceOneDay('<?php echo URL;?>products/determinePriceOneDay/<?php echo $this->productInfo["id"]?>');">
        <div class="onePart">
            <p>Приоритетнее цена:</p>
            <label><input type="radio" name="determinePrice" value="short_period" checked>  &nbsp;с меньшим периодом действия</label><br>
            <label><input type="radio" name="determinePrice" value="later">         &nbsp;установленная позднее</label><br>
        </div>
        <div class="onePart">
            <p>Установить день для определения цены:</p>
            <select name="thisDay" id="thisDay">
                <?php foreach($this->days as $key => $value){?>
                    <option value="<?php echo $value?>"><?php echo $value?></option>
                <?php }?>
            </select>
            <select name="thisMonths" id="thisMonths" onchange="month_changed('this');">
                <?php foreach($this->months as $key => $value){?>
                    <option value="<?php echo $key+1;?>" ><?php echo $value;?></option>
                <?php }?>
            </select>
            <select name="thisYears" id="thisYears" onchange="year_changed('this');">
                <?php foreach($this->years as $value){?>
                    <option value="<?php echo $value?>" ><?php echo $value?></option>
                <?php }?>
            </select>
        </div><br><br>
        <input type="submit" value="Определить">
    </form>
    <div id="resultPrice"></div>
</div>
<div id="graphicsPlace">
    <button type="button" onclick="createGraphic('<?php echo URL;?>products/createGraphic/<?php echo $this->productInfo["id"]?>/short_period','shortPeriod')">
        Вывести график зависимости (с 01.01.2016 по текущий день), где приоритетнее цена с наименьшим периодом действия:
    </button><br><br>
    <div id="shortPeriod"></div><br><br>
    <button type="button" onclick="createGraphic('<?php echo URL;?>products/createGraphic/<?php echo $this->productInfo["id"]?>/later','later')">
        Вывести график зависимости (с 01.01.2016 по текущий день), где приоритетнее цена установленная позднее:
    </button><br>
    <div id="later"></div>
</div>