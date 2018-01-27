<form action="<?php echo URL;?>products/addProduct" method="POST" id="addProduct">
    <div class="onePart">
        <label for="prodName">Название продукта:</label><br>
        <input type="text" name="prodName" id="prodName">
    </div>
    <div class="onePart">
        <label for="defaultPrice">Цена по умолчанию:</label><br>
        <input type="text" name="defaultPrice" id="defaultPrice">
    </div>
    <div class="onePart">
        <p>Приоритетнее цена:</p>
        <label><input type="radio" name="determinePrice" value="short_period" checked>  &nbsp;с меньшим периодом действия</label><br>
        <label><input type="radio" name="determinePrice" value="later">                 &nbsp;установленная позднее</label><br>
    </div>
    <div class="onePart">
        <input type="submit" value="Добавить">
    </div>
</form>