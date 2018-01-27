function showAddProductForm(url)
{
    $.ajax({
        type: 'POST',
        url:  url + 'products/add_prod_form',
        success: function(data)
        {
            $("#addProd").html(data).slideToggle('slow');
        }
    })
}
function month_changed(side){
    var month = document.getElementById(side + "Months").value;
    var year = document.getElementById(side + "Years").value;
    var this_day = document.getElementById(side + "Day").value;
    if(year !== '-'){
        var days = new Date(year, month, 0).getDate();
        document.getElementById(side + "Day").innerHTML='';
        var objSel = document.getElementById(side + "Day");
        for(var i = 1; i <= days; i++){
            if(Number(this_day) === i){
                objSel.options[i-1] = new Option(i, i, true, true);
            }else{
                objSel.options[i-1] = new Option(i, i);
            }
        }
    }
}
function year_changed(side){
    var month = document.getElementById(side + "Months").value;
    var year = document.getElementById(side + "Years").value;
    var this_day = document.getElementById(side + "Day").value;
    var days = new Date(year, month, 0).getDate();
    document.getElementById(side + "Day").innerHTML='';
    var objSel = document.getElementById(side + "Day");
    for(var i = 1; i <= days; i++){
        if(Number(this_day) === i){
            objSel.options[i-1] = new Option(i, i, true, true);
        }else{
            objSel.options[i-1] = new Option(i, i);
        }
    }
}
function setDisable(side){
    $("#" + side + "Day").val("disable","disable");
    $("#" + side + "Months").val("disable","disable");
    $("#" + side + "Years").val("disable","disable");
}
function addNewInterval()
{
    $("#addNewInterval").slideToggle('slow');
}
function determinePriceOneDay(url){
    var data = $("#priceOneDay").serialize();
    $.ajax({
        type: 'POST',
        url:  url,
        data: data,
        success: function(data)
        {
            $("#resultPrice").html(data);
        }
    })
}
function createGraphic(url,id){
    $.ajax({
        type: 'POST',
        url:  url,
        success: function(data)
        {
            $("#" + id).html(data);
        }
    })
}