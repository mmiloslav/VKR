/* CSS #1 */
var giftofspeed = document.createElement('link');
giftofspeed.rel = 'stylesheet';
giftofspeed.href = 'css/onload.css';
giftofspeed.type = 'text/css';
var godefer = document.getElementsByTagName('link')[1000];
// godefer.parentNode.insertBefore(giftofspeed, godefer);

var n = 1; // №п/п для вывода монет
var kc = 0; // к-во монет для вывода в конце табл
var pc = 0; // стоимоть монет

// присвоение ID по нажатию кнопки в countries.php, collections.php, albums.php
function getID(arg) {
	ID = arg;
	// alert(ID);
};

// вывод монет нажатой страны в countries.php

jQuery(document).ready(function() {
    jQuery(".button_cntry").bind("click", function() {
		
        jQuery.ajax({
           	url: "clicked.php",
            type: "POST",
            data: {ID: ID}, // Передаем данные для записи
            dataType: "json",
            success: function(result) {
                if (result){
                	jQuery('.remove').remove();
                	var div_fixed = document.getElementById('fixed').style;
					div_fixed.width="1640px"; // расширяем <div id="fixed"> до 1640px
					jQuery('.table tr').remove();
                    jQuery('.rows').append(function(){
                        var res = '<div class="h1-line flex"><div class="h1">' + result.countries.name_country[ID] + '<img class="flag_h1" src="img/flags/' + result.countries.id_country[ID] + '.png"></div><div class="font"><form method="post" action="#" class="font-size-form"><button type="button" name="12px" onclick="make12();">12px</button><button type="button" name="14px" onclick="make14();">14px</button><button type="button" name="16px" onclick="make16();">16px</button></form></div></div><table class="table"><tr><th>#</th><th>id</th><th>Номинал</th><th>Название</th><th>Коллекция</th><th>Год</th><th>МД</th><th>Тираж</th><th>Металл</th><th>к-во</th><th>Альбом</th><th>Цена</th><th>k</th><th>Сумма</th></tr>'; // шапка таблицы
						for(var i = 0; i < result.coins.id_coin.length; i++){
							if(ID == result.coins.country[i]) {
								res += '<tr><td class="bold">' + n + '</td><td onclick="var var1=' + result.coins.id_coin[i] + '; getID(var1); openModal2();" class="pointer">' + result.coins.id_coin[i] + '</td><td>' + result.coins.denom[i] + '</td><td>' + result.coins.name[i] + '</td><td>' + result.collections.name_coll[result.coins.collection[i]] + '</td><td>' + result.coins.year[i] + '</td><td class="mint-td pointer" onmouseenter="var var1=' + result.coins.id_coin[i] + '; getID(var1); showMint()" onmouseleave="hideMint()">' + result.mints.name_mint[result.coins.mint[i]] + '<div class="mint2 td' + result.coins.id_coin[i] + '"></div></td><td>' + result.coins.circulation[i] + '</td><td>' + result.metals.name_metal[result.coins.metal[i]-1] + '</td><td>' + result.qualities.name_q[result.coins.quality[i]-1] + '</td><td>' + result.albums.name_album[result.coins.album[i]] + '</td><td>' + result.coins.price[i] + '$' + '</td><td>' + result.coins.quantity[i] + '</td><td>' + result.coins.price[i] * result.coins.quantity[i] + '$' + '</td></tr>';
								n++;
                                kc += result.coins.quantity[i] * 1;
                                pc += result.coins.price[i] * result.coins.quantity[i];
							}
						}
                        res += '<tr><td colspan="12"></td><td>' + kc + '</td><td>' + pc + '$</td></tr></table>'
						return res;
					});
					console.log(result);
                }else{
                    alert(result.message);
               	}
				return false;
            }
        });
	return false;
   });
});

// вывод монет кликнутой коллекции в collections.php

jQuery(document).ready(function() {
    jQuery(".button_coll").bind("click", function() {
		
        jQuery.ajax({
           	url: "clicked.php",
            type: "POST",
            data: {ID: ID}, // Передаем данные для записи
            dataType: "json",
            success: function(result) {
                if (result){
                	jQuery('.remove').remove();
                	var div_fixed = document.getElementById('fixed').style;
					div_fixed.width="1640px";
					jQuery('.table tr').remove();
                    jQuery('.rows').append(function(){
                    var res = '<div class="h1-line flex"><div class="flex"><div class="h1">' + result.collections.name_coll[ID] + '</div><div class="h1_g">&nbsp;| Коллекция</div></div><div class="font"><form method="post" action="#" class="font-size-form"><button type="button" name="12px" onclick="make12();">12px</button><button type="button" name="14px" onclick="make14();">14px</button><button type="button" name="16px" onclick="make16();">16px</button></form></div></div><table class="table"><tr><th>#</th><th>id</th><th>Страна</th><th>Номинал</th><th>Название</th><th>Год</th><th>МД</th><th>Тираж</th><th>Металл</th><th>к-во</th><th>Альбом</th><th>Цена</th><th>k</th><th>Сумма</th></tr>'; // шапка таблицы
						for(var i = 0; i < result.coins.id_coin.length; i++){
							if(ID == result.coins.collection[i]) {
								res += '<tr><td class="bold">' + n + '</td><td onclick="var var1=' + result.coins.id_coin[i] + '; getID(var1); openModal2();" class="pointer">' + result.coins.id_coin[i] + '</td><td>' + result.countries.name_country[result.coins.country[i]] + '</td><td>' + result.coins.denom[i] + '</td><td>' + result.coins.name[i] + '</td><td>' + result.coins.year[i] + '</td><td class="mint-td pointer" onmouseenter="var var1=' + result.coins.id_coin[i] + '; getID(var1); showMint()" onmouseleave="hideMint()">' + result.mints.name_mint[result.coins.mint[i]] + '<div class="mint2 td' + result.coins.id_coin[i] + '"></div></td><td>' + result.coins.circulation[i] + '</td><td>' + result.metals.name_metal[result.coins.metal[i]-1] + '</td><td>' + result.qualities.name_q[result.coins.quality[i]-1] + '</td><td>' + result.albums.name_album[result.coins.album[i]] + '</td><td>' + result.coins.price[i] + '$' + '</td><td>' + result.coins.quantity[i] + '</td><td>' + result.coins.price[i] * result.coins.quantity[i] + '$' + '</td></tr>';
								n++;
                                kc += result.coins.quantity[i] * 1;
                                pc += result.coins.price[i] * result.coins.quantity[i];
							}
						}
                        res += '<tr><td colspan="12"></td><td>' + kc + '</td><td>' + pc + '$</td></tr></table>'
						return res;
					});
					console.log(result);
                }else{
                    alert(result.message);
               	}
				return false;
            }
        });
	return false;
   });
});

// вывод монет из кликнутого альбома

jQuery(document).ready(function() {
    jQuery(".button_alb").bind("click", function() {
		
        jQuery.ajax({
           	url: "clicked.php",
            type: "POST",
            data: {ID: ID}, // Передаем данные для записи
            dataType: "json",
            success: function(result) {
                if (result){
                	jQuery('.remove').remove();
                	var div_fixed = document.getElementById('fixed').style;
					div_fixed.width="1640px";
					jQuery('.table tr').remove();
                    jQuery('.rows').append(function(){
                        var res = '<div class="h1-line flex"><div class="flex"><div class="h1">' + result.albums.name_album[ID] + '</div><div class="h1_g">&nbsp;| Альбом</div></div><div class="font"><form method="post" action="#" class="font-size-form"><button type="button" name="12px" onclick="make12();">12px</button><button type="button" name="14px" onclick="make14();">14px</button><button type="button" name="16px" onclick="make16();">16px</button></form></div></div><table class="table"><tr><th>#</th><th>id</th><th>Страна</th><th>Номинал</th><th>Название</th><th>Год</th><th>МД</th><th>Тираж</th><th>Металл</th><th>к-во</th><th>Альбом</th><th>Цена</th><th>k</th><th>Сумма</th></tr>'; // шапка таблицы
						for(var i = 0; i < result.coins.id_coin.length; i++){
							if(ID == result.coins.album[i]) {
								res += '<tr><td class="bold">' + n + '</td><td onclick="var var1=' + result.coins.id_coin[i] + '; getID(var1); openModal2();" class="pointer">' + result.coins.id_coin[i] + '</td><td>' + result.countries.name_country[result.coins.country[i]] + '</td><td>' + result.coins.denom[i] + '</td><td>' + result.coins.name[i] + '</td><td>' + result.collections.name_coll[result.coins.collection[i]] + '</td><td>' + result.coins.year[i] + '</td><td class="mint-td pointer" onmouseenter="var var1=' + result.coins.id_coin[i] + '; getID(var1); showMint()" onmouseleave="hideMint()">' + result.mints.name_mint[result.coins.mint[i]] + '<div class="mint2 td' + result.coins.id_coin[i] + '"></div></td><td>' + result.coins.circulation[i] + '</td><td>' + result.metals.name_metal[result.coins.metal[i]-1] + '</td><td>' + result.qualities.name_q[result.coins.quality[i]-1] + '</td><td>' + result.coins.price[i] + '$' + '</td><td>' + result.coins.quantity[i] + '</td><td>' + result.coins.price[i] * result.coins.quantity[i] + '$' + '</td></tr>';
								n++;
                                kc += result.coins.quantity[i] * 1;
                                pc += result.coins.price[i] * result.coins.quantity[i];
							}
						}
                        res += '<tr><td colspan="12"></td><td>' + kc + '</td><td>' + pc + '$</td></tr></table>'
						return res;
					});
					console.log(result);
                }else{
                    alert(result.message);
               	}
				return false;
            }
        });
	return false;
   });
});

// вывод монет кликнутого континента

jQuery(document).ready(function() {
    jQuery(".button_cont").bind("click", function() {
		
        jQuery.ajax({
           	url: "clicked.php",
            type: "POST",
            data: {ID: ID}, // Передаем данные для записи
            dataType: "json",
            success: function(result) {
                if (result){
                	jQuery('.remove').remove();
                	var div_fixed = document.getElementById('fixed').style;
					div_fixed.width="1640px";
					jQuery('.table tr').remove();
                    jQuery('.rows').append(function(){
                        var res = '<div class="h1-line flex"><div class="h1">' + result.continents.name_cont[ID] + '</div><div class="font"><form method="post" action="#" class="font-size-form"><button type="button" name="12px" onclick="make12();">12px</button><button type="button" name="14px" onclick="make14();">14px</button><button type="button" name="16px" onclick="make16();">16px</button></form></div></div><table class="table"><tr><th>#</th><th>id</th><th>Страна</th><th>Номинал</th><th>Название</th><th>Коллекция</th><th>Год</th><th>МД</th><th>Тираж</th><th>Металл</th><th>к-во</th><th>Альбом</th><th>Цена</th><th>k</th><th>Сумма</th></tr>'; // шапка таблицы
						var c;
						for (var j = 0; j < result.countries.id_country.length; j++) {
							if (ID == result.countries.continent[j]) {
								c = result.countries.id_country[j];
								for(var i = 0; i < result.coins.id_coin.length; i++){
									if(c == result.coins.country[i]) {
										res += '<tr><td class="bold">' + n + '</td><td onclick="var var1=' + result.coins.id_coin[i] + '; getID(var1); openModal2();" class="pointer">' + result.coins.id_coin[i] + '</td><td>' + result.countries.name_country[c] + '</td><td>' + result.coins.denom[i] + '</td><td>' + result.coins.name[i] + '</td><td>' + result.collections.name_coll[result.coins.collection[i]] + '</td><td>' + result.coins.year[i] + '</td><td class="mint-td pointer" onmouseenter="var var1=' + result.coins.id_coin[i] + '; getID(var1); showMint()" onmouseleave="hideMint()">' + result.mints.name_mint[result.coins.mint[i]] + '<div class="mint2 td' + result.coins.id_coin[i] + '"></div></td><td>' + result.coins.circulation[i] + '</td><td>' + result.metals.name_metal[result.coins.metal[i]-1] + '</td><td>' + result.qualities.name_q[result.coins.quality[i]-1] + '</td><td>' + result.albums.name_album[result.coins.album[i]] + '</td><td>' + result.coins.price[i] + '$' + '</td><td>' + result.coins.quantity[i] + '</td><td>' + result.coins.price[i] * result.coins.quantity[i] + '$' + '</td></tr>';
										n++;
                                        kc += result.coins.quantity[i] * 1;
                                        pc += result.coins.price[i] * result.coins.quantity[i];
									}
								}
							}

						}
                        res += '<tr><td colspan="12"></td><td>' + kc + '</td><td>' + pc + '$</td></tr></table>'
						return res;
					});
					console.log(result);
                }else{
                    alert(result.message);
               	}
				return false;
            }
        });
	return false;
   });
});

// открыть модальное окно с фотографией

function openModal() {
    $('.modal-overlay').css('display','inline');
    $('.modal_div').css('display','inline');
    $('.modal-overlay2').css('display','inline');
    $('.modal_div2').css('display','inline');

}

// закрыть модальное окно с фотографией

function closeModal() {
    $('.modal-overlay').css('display','none');
    $('.modal_div').css('display','none');
    $('.modal-overlay2').css('display','none');
    $('.modal_div2').css('display','none');
}

//

function openModal2() {
    jQuery.ajax({
            url: "clicked.php",
            type: "POST",
            data: {ID: ID}, // Передаем данные для записи
            dataType: "json",
            success: function(result) {
                if (result){
                    ID = ID - 1;
                    jQuery('.modal').append(function(){
                        var res = '<div class="modal-overlay2" id="modal-overlay"><div class="modal_div2" id="modal_div"><div class="flex"><div class="x"><img onclick="closeModal();" src="img/x.png"></div><div class="modal_text">' + result.countries.name_country[result.coins.country[ID]] + '&nbsp;|&nbsp;' + result.coins.denom[ID] + '&nbsp;|&nbsp;' + result.coins.name[ID] + '&nbsp;|&nbsp;' + result.coins.year[ID] + '&nbsp;|&nbsp;' + result.qualities.name_q[result.coins.quality[ID]-1] + '</div></div><img class="modal_photo" src=img/coins_ph/' + result.coins.id_coin[ID] + '.jpeg alt="' + result.coins.id_coin[ID] + '"></div></div>';
                        return res;
                    });
                    console.log(result);
                }else{
                    alert(result.message);
                }
                return false;
            }
        });
}

// монетный двор при наведении

function showMint() {
    jQuery.ajax({
            url: "clicked.php",
            type: "POST",
            data: {ID: ID}, // Передаем данные для записи
            dataType: "json",
            success: function(result) {
                if (result){
                    jQuery('.td' + ID).append(function(){
                        var res = '<div class="mint-hint">' + result.mints.longname[result.coins.mint[ID-1]] + '</div>';
                        return res;
                    });
                    console.log(result);
                }else{
                    alert(result.message);
                }
                return false;
            }
    });
}

function hideMint() {
    jQuery('.mint-hint').remove();
}

// index diagram

var na = $('div.diagram-data').data('na');
var sa = $('div.diagram-data').data('sa');
var eu = $('div.diagram-data').data('eu');
var as = $('div.diagram-data').data('as');
var af = $('div.diagram-data').data('af');
var au = $('div.diagram-data').data('au');

google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(drawChart);
   function drawChart() {
    var data = google.visualization.arrayToDataTable([
     ['continent', 'quantity'],
     ['Северная Америка', na],
     ['Южная Америка', sa],
     ['Европа', eu],
     ['Азия', as],
     ['Африка', af],
     ['Австралия и Океания', au]
    ]);
    var options = {
        legend: 'none',
        slices: {
            0: { color: '#DF0024' },
            1: { color: '#B639F4' },
            2: { color: '#0085C7' },
            3: { color: '#F4C300' },
            4: { color: '#000000' },
            5: { color: '#009F3D' }
          }
    };
    var chart = new google.visualization.PieChart(document.getElementById('air'));
     chart.draw(data, options);
   }

// table font-size

function make12() {
    $('.table').css('font-size','12px');
}

function make14() {
    $('.table').css('font-size','14px');
}

function make16() {
    $('.table').css('font-size','16px');
}

// select2.php

// function countryOnChange() {
//     const result = document.querySelector('.result-country');
//     result.textContent = `${event.target.value}`;

//     var countryID = $('div.select-data').data('countryID');
// }

jQuery(document).ready(function() {
    jQuery(".select-country").bind("click", function() {
        
        jQuery.ajax({
            url: "clicked.php",
            type: "POST",
            data: {ID: ID}, // Передаем данные для записи
            dataType: "json",
            success: function(result) {
                if (result){
                    jQuery('.remove').remove();
                    var div_fixed = document.getElementById('fixed').style;
                    div_fixed.width="1640px"; // расширяем <div id="fixed"> до 1640px
                    jQuery('.table tr').remove();
                    jQuery('.rows').append(function(){
                        var res = '<div class="h1-line flex"><div class="h1">' + result.countries.name_country[ID] + '<img class="flag_h1" src="img/flags/' + result.countries.id_country[ID] + '.png"></div><div class="font"><form method="post" action="#" class="font-size-form"><button type="button" name="12px" onclick="make12();">12px</button><button type="button" name="14px" onclick="make14();">14px</button><button type="button" name="16px" onclick="make16();">16px</button></form></div></div><table class="table"><tr><th>#</th><th>id</th><th>Номинал</th><th>Название</th><th>Коллекция</th><th>Год</th><th>МД</th><th>Тираж</th><th>Металл</th><th>к-во</th><th>Альбом</th><th>Цена</th><th>k</th><th>Сумма</th></tr>'; // шапка таблицы
                        for(var i = 0; i < result.coins.id_coin.length; i++){
                            if(ID == result.coins.country[i]) {
                                res += '<tr><td class="bold">' + n + '</td><td onclick="var var1=' + result.coins.id_coin[i] + '; getID(var1); openModal2();" class="pointer">' + result.coins.id_coin[i] + '</td><td>' + result.coins.denom[i] + '</td><td>' + result.coins.name[i] + '</td><td>' + result.collections.name_coll[result.coins.collection[i]] + '</td><td>' + result.coins.year[i] + '</td><td class="mint-td pointer" onmouseenter="var var1=' + result.coins.id_coin[i] + '; getID(var1); showMint()" onmouseleave="hideMint()">' + result.mints.name_mint[result.coins.mint[i]] + '<div class="mint2 td' + result.coins.id_coin[i] + '"></div></td><td>' + result.coins.circulation[i] + '</td><td>' + result.metals.name_metal[result.coins.metal[i]-1] + '</td><td>' + result.qualities.name_q[result.coins.quality[i]-1] + '</td><td>' + result.albums.name_album[result.coins.album[i]] + '</td><td>' + result.coins.price[i] + '$' + '</td><td>' + result.coins.quantity[i] + '</td><td>' + result.coins.price[i] * result.coins.quantity[i] + '$' + '</td></tr>';
                                n++;
                                kc += result.coins.quantity[i] * 1;
                                pc += result.coins.price[i] * result.coins.quantity[i];
                            }
                        }
                        res += '<tr><td colspan="12"></td><td>' + kc + '</td><td>' + pc + '$</td></tr></table>'
                        return res;
                    });
                    console.log(result);
                }else{
                    alert(result.message);
                }
                return false;
            }
        });
    return false;
   });
});