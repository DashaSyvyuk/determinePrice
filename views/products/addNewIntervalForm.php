<form method="POST" action="<?php echo URL?>products/addNewInterval/<?php echo $this->productInfo["id"]?>">
    <p>Добавить новую цену</p>
    <p> c&nbsp;&nbsp;&nbsp; :
        <select name="startDay" id="startDay">
            <?php foreach($this->days as $key => $value){?>
                <option value="<?php echo $value?>"><?php echo $value?></option>
            <?php }?>
        </select>
        <select name="startMonths" id="startMonths" onchange="month_changed('start');">
            <?php foreach($this->months as $key => $value){?>
                <option value="<?php echo $key+1;?>" ><?php echo $value;?></option>
            <?php }?>
        </select>
        <select name="startYears" id="startYears" onchange="year_changed('start');">
            <?php foreach($this->years as $value){?>
                <option value="<?php echo $value?>" ><?php echo $value?></option>
            <?php }?>
        </select>
        <button type="button" onclick="setDisable('start')">Передать значение пустым</button>
    </p>
    <p> по :
        <select name="endDay" id="endDay">
            <?php foreach($this->days as $key => $value){?>
                <option value="<?php echo $value?>"><?php echo $value?></option>
            <?php }?>
        </select>
        <select name="endMonths" id="endMonths" onchange="month_changed('end');">
            <?php foreach($this->months as $key => $value){?>
                <option value="<?php echo $key+1;?>" ><?php echo $value;?></option>
            <?php }?>
        </select>
        <select name="endYears" id="endYears" onchange="year_changed('end');">
            <?php foreach($this->years as $value){?>
                <option value="<?php echo $value?>" ><?php echo $value?></option>
            <?php }?>
        </select>
        <button type="button" onclick="setDisable('end')">Передать значение пустым</button>
    </p>
    <p>Цена:</p>
    <input type="text" name="price"><br><br>
    <input type="submit" value="Добавить интервал">
</form>