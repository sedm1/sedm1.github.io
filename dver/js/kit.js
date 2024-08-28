function number_format(number, decimals, dec_point, thousands_sep) {
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

function kalk(){

var koef = jQuery('#koef').val();

var kolvo3 = jQuery('#kolvo3').val();	
var podg = jQuery('#podg option:selected').val();
var kolvo4 = jQuery('#kolvo4').val();	
var zam = jQuery('#zam option:selected').val();

if(jQuery('#opl').val() == 0){
var podg2 = podg;
var zam2 = zam*koef;
}
if(jQuery('#opl').val() == 1){
var podg2 = podg*1.07;
var zam2 = zam*koef*1.07;
}
if(jQuery('#opl').val() == 2){
var podg2 = podg*1.2;
var zam2 = zam*koef*1.2;
}

var podg3 = podg2*kolvo3;
var zam3 = zam2*kolvo4;

var podg22 = number_format(podg2, 0, ',', ' ');
var podg33 = number_format(podg3, 0, ',', ' ');
var zam22 = number_format(zam2, 0, ',', ' ');
var zam33 = number_format(zam3, 0, ',', ' ');

jQuery('#sum1').val(podg22+' руб.');
jQuery('#sum2').val(podg33+' руб.');
jQuery('#sum3').val(zam22+' руб.');
jQuery('#sum4').val(zam33+' руб.');

var kol1 = jQuery('#kol1').val();
var kold1 = kol1*7;
var kol2 = jQuery('#kol2').val();
var kold2 = kol2*8;

var kol3 = jQuery('#kol3').val();
var kold3 = kol3*9;
var kol4 = jQuery('#kol4').val();
var kold4 = kol4*11;

var kol5 = jQuery('#kol5').val();
var kold5 = kol5*10;
var kol6 = jQuery('#kol6').val();
var kold6 = kol6*15;

var kol7 = jQuery('#kol7').val();
var kold7 = kol7*11;
var kol8 = jQuery('#kol8').val();
var kold8 = kol8*19;

var kol9 = jQuery('#kol9').val();
var kold9 = kol9*12;
var kol10 = jQuery('#kol10').val();
var kold10 = kol10*21;

var kol11 = jQuery('#kol11').val();
var kold11 = kol11*12;
var kol12 = jQuery('#kol12').val();
var kold12 = kol12*20;

var kol13 = jQuery('#kol13').val();
var kold13 = kol13*14;
var kol14 = jQuery('#kol14').val();
var kold14 = kol14*27;

var kol15 = jQuery('#kol15').val();
var kold15 = kol15*19;
var kol16 = jQuery('#kol16').val();
var kold16 = kol16*35;

var kol17 = jQuery('#kol17').val();
var kold17 = kol17*21;
var kol18 = jQuery('#kol18').val();
var kold18 = kol18*42;

var kol19 = jQuery('#kol19').val();
var kold19 = kol19*25;
var kol20 = jQuery('#kol20').val();
var kold20 = kol20*49;

var kol21 = jQuery('#kol21').val();
var kold21 = kol21*18;
var kol22 = jQuery('#kol22').val();
var kold22 = kol22*45;

var kolds = kold1+kold2+kold3+kold4+kold5+kold6+kold7+kold8+kold9+kold10+kold11+kold12+kold13+kold14+kold15+kold16+kold17+kold18+kold19+kold20+kold21+kold22;
var vys=0;
jQuery('.vy').each(function(){
vys += +(jQuery(this).val());
});
var dls=0;
jQuery('.dl').each(function(){
dls += +(jQuery(this).val());
});

var dlin2 = parseInt(jQuery('#dlin2').val());
var vyso2 = parseInt(jQuery('#vyso2').val());
var kompl2 = jQuery('#kompl2').val();
var sed2 = (dlin2*vyso2/1000000).toFixed(2);
jQuery('#sed2').val(sed2);
var sob2 = (sed2*kompl2).toFixed(2);
jQuery('#sob2').val(sob2);

var dlin = parseInt(jQuery('#dlin').val());
var vyso = parseInt(jQuery('#vyso').val());
var kompl = jQuery('#kompl').val();
var sed0 = dlin*vyso/1000000-sob2;
var sed = (dlin*vyso/1000000-sob2).toFixed(2);
jQuery('#sed').val(sed);
var sob = (sed*kompl).toFixed(2);
jQuery('#sob').val(sob);


if(kol3>0){ 
var polos3 = (dlin/1000*2)*kol3;
} else {
var polos3 = 0;
}
if(kol4>0){ 
var polos4 = (dlin/1000*4)*kol4;
} else {
var polos4 = 0;
}
if(kol5>0){ 
var polos5 = (dlin*2/1000*2)*kol5;
} else {
var polos5 = 0;
}
if(kol6>0){ 
var polos6 = (dlin*2/1000*4)*kol6;
} else {
var polos6 = 0;
}
if(kol7>0){ 
var polos7 = (dlin*3/1000*2)*kol7;
} else {
var polos7 = 0;
}
if(kol8>0){ 
var polos8 = (dlin*3/1000*4)*kol8;
} else {
var polos8 = 0;
}
if(kol9>0){ 
var polos9 = (dlin*4/1000*2)*kol9;
} else {
var polos9 = 0;
}
if(kol10>0){ 
var polos10 = (dlin*4/1000*4)*kol10;
} else {
var polos10 = 0;
}
if(kol11>0){ 
var polos11 = ((dlin+vyso)/1000*2)*kol11;
} else {
var polos11 = 0;
}
if(kol12>0){ 
var polos12 = ((dlin+vyso)/1000*4)*kol12;
} else {
var polos12 = 0;
}
if(kol13>0){ 
var polos13 = ((dlin*2+vyso)/1000*2)*kol13;
} else {
var polos13 = 0;
}
if(kol14>0){ 
var polos14 = ((dlin*2+vyso)/1000*4)*kol14;
} else {
var polos14 = 0;
}
if(kol15>0){ 
var polos15 = ((dlin*3+vyso)/1000*2)*kol15;
} else {
var polos15 = 0;
}
if(kol16>0){ 
var polos16 = ((dlin*3+vyso)/1000*4)*kol16;
} else {
var polos16 = 0;
}
if(kol17>0){ 
var polos17 = ((dlin*4+vyso)/1000*2)*kol17;
} else {
var polos17 = 0;
}
if(kol18>0){ 
var polos18 = ((dlin*4+vyso)/1000*4)*kol18;
} else {
var polos18 = 0;
}
if(kol19>0){ 
var polos19 = ((dlin*5+vyso)/1000*2)*kol19;
} else {
var polos19 = 0;
}
if(kol20>0){ 
var polos20 = ((dlin*5+vyso)/1000*4)*kol20;
} else {
var polos20 = 0;
}
if(kol21>0){ 
var polos21 = ((dlin*2+vyso*2)/1000*2)*kol21;
} else {
var polos21 = 0;
}
if(kol22>0){ 
var polos22 = ((dlin*2+vyso*2)/1000*4)*kol22;
} else {
var polos22 = 0;
}
var polos = polos4+polos6+polos8+polos10+polos12+polos14+polos16+polos18+polos20+polos22;
var poloses = polos3+polos4+polos5+polos6+polos7+polos8+polos9+polos10+polos11+polos12+polos13+polos14+polos15+polos16+polos17+polos18+polos19+polos20+polos21+polos22;
var poloz = (polos/4).toFixed(1);
jQuery('#pol').val(poloz);

var sob3 = sed*kompl+sed2*kompl2;
jQuery('#sob3').val(sob3);
var g49 = sob3*900+2000;

var tru1 = ((vyso*0.001)*2+(dlin*0.001)*2).toFixed(1);
jQuery('#tru1').val(tru1);
//var tru2 = (tru1*2+(vyso*0.001)*2+(dlin*0.001)*6).toFixed(1);
//var tru2 = tru1*2+(vyso*0.001)*2+(dlin*0.001)*6;
var tru2 = (tru1*2+poloses).toFixed(1);
jQuery('#tru2').val(tru2);
var l35 = kolds*297+tru1*96+tru2*46+144+poloz*136+g49;
//var l35 = kolds*297+tru1*96+tru2*44+pol*136+g49;

if(jQuery('#opl').val() == 0){
var m35 = l35*koef;
}
if(jQuery('#opl').val() == 1){
var m35 = l35*koef*1.07;
}
if(jQuery('#opl').val() == 2){
var m35 = l35*koef*1.2;
}

var mm35 = number_format(m35, 2, ',', ' ');
jQuery('#sum5').val(mm35+' руб.');

if(jQuery('#stek').val() == 0){
var stek = 0;
}
if(jQuery('#stek').val() == 1){
var stek = sed*1420;
}
if(jQuery('#stek').val() == 2){
var stek = sed*1400;
}
if(jQuery('#stek').val() == 3){
var stek = sed*2660;
}
if(jQuery('#stek').val() == 4){
var stek = sed*3160;
}
if(jQuery('#stek').val() == 5){
var stek = sed*1800;
}
if(jQuery('#stek').val() == 6){
var stek = sed*2300;
}

if(jQuery('#furn').val() == 0){
var furn = 0;
}
if(jQuery('#furn').val() == 1){
var furn = 5374;
}
if(jQuery('#furn').val() == 2){
var furn = 10931;
}
if(jQuery('#furn').val() == 3){
var furn = 10857*vyso/96180;
}
if(jQuery('#furn').val() == 4){
var furn = 19027*vyso/96360;
}
if(jQuery('#furn').val() == 5){
var furn = 9637;
}
if(jQuery('#furn').val() == 6){
var furn = 17214;
}
if(jQuery('#furn').val() == 7){
var furn = 22427;
}

var stfu = stek+furn;

var stfu2 = stfu*kompl;

var stfu22 = (stfu2).toFixed(2);

if(jQuery('#opl').val() == 0){
var m40 = stfu*koef;
}
if(jQuery('#opl').val() == 1){
var m40 = stfu*koef*1.07;
}
if(jQuery('#opl').val() == 2){
var m40 = stfu*koef*1.2;
}


var n40 = m40*kompl;
var mm40 = number_format(m40, 2, ',', ' ');
jQuery('#sum6').val(mm40+' руб.');
var nn40 = number_format(n40, 2, ',', ' ');
jQuery('#sum7').val(nn40+' руб.');


if(jQuery('#stek2').val() == 0){
var stek2 = 0;
}
if(jQuery('#stek2').val() == 1){
var stek2 = sed0*1420;
}
if(jQuery('#stek2').val() == 2){
var stek2 = sed0*1400;
}
if(jQuery('#stek2').val() == 3){
var stek2 = sed0*2660;
}
if(jQuery('#stek2').val() == 4){
var stek2 = sed0*3160;
}
if(jQuery('#stek2').val() == 5){
var stek2 = sed0*1800;
}
if(jQuery('#stek2').val() == 6){
var stek2 = sed0*2300;
}

if(jQuery('#furn2').val() == 0){
var furn2 = 0;
}
if(jQuery('#furn2').val() == 1){
var furn2 = 5374;
}
if(jQuery('#furn2').val() == 2){
var furn2 = 10931;
}
if(jQuery('#furn2').val() == 3){
var furn2 = 10857*vyso2/96180;
}
if(jQuery('#furn2').val() == 4){
var furn2 = 19327*vyso2/96360;
}

if(jQuery('#ruch').val() == 0){
var ruch = 3785;
}
if(jQuery('#ruch').val() == 1){
var ruch = 1780;
}

if(jQuery('#koro').val() == 0){
var koro = 0;
}
if(jQuery('#koro').val() == 1){
var koro = ((dlin2+vyso2*2)/189000)+(3150+sed2*300);
}
if(jQuery('#koro').val() == 2){
var koro = ((dlin2+vyso2*2)/189000)+(9270+sed2*300);
}

var stfu3 = stek2+furn2+koro+ruch;
//jQuery('#sumo').val(stfu3);

if(jQuery('#opl').val() == 0){
var m43 = stfu3*koef;
}
if(jQuery('#opl').val() == 1){
var m43 = stfu3*koef*1.07;
}
if(jQuery('#opl').val() == 2){
var m43 = stfu3*koef*1.2;
}
var n43 = m43*kompl2;

var mm43 = number_format(m43, 2, ',', ' ');
jQuery('#sum8').val(mm43+' руб.');
var nn43 = number_format(n43, 2, ',', ' ');
jQuery('#sum9').val(nn43+' руб.');
	
if(jQuery('#mont').val() == 0){
var mont = 0;
}
if((jQuery('#mont').val() == 1)&&(sob3 < 5.5)){
var mont = 7500/sob3;
}
if((jQuery('#mont').val() == 1)&&(sob3 > 5.5)){
var mont = 1400;
}

var l49 = mont*sob3;
if(jQuery('#opl').val() == 0){
var m49 = mont*koef;
}
if(jQuery('#opl').val() == 1){
var m49 = mont*koef*1.07;
}
if(jQuery('#opl').val() == 2){
var m49 = mont*koef*1.2;
}
var mm49 = number_format(m49, 2, ',', ' ');
jQuery('#sum11').val(mm49+' руб.');
var n49 = m49*sob3;
var nn49 = number_format(n49, 2, ',', ' ');
jQuery('#sum12').val(nn49+' руб.');

 jQuery('#stfu').val(stfu);
 jQuery('#stfu3').val(stfu3);
 jQuery('#stfu2').val(stfu22);
 jQuery('#stfu4').val(stfu4);
 jQuery('#montt').val(mont);
 jQuery('#l49').val(l49);
 jQuery('#l35').val(l35);

var km = jQuery('#km').val();
if(jQuery('#dost').val() == 0){
var dost = 0;
jQuery('#dos100').text('комп.');
}
if(jQuery('#dost').val() == 1){
var dost = 3500*km;
jQuery('#dos100').text('комп.');
}
if(jQuery('#dost').val() == 2){
var dost = 7000*km;
jQuery('#dos100').text('комп.');
}
if(jQuery('#dost').val() == 3){
var dost = 3500+60*km;
jQuery('#dos100').text('км.');
}
if(jQuery('#dost').val() == 4){
var dost = 7000+120*km;
jQuery('#dos100').text('км.');
}

if(jQuery('#opl').val() == 0){
var m51 = dost*koef;
}
if(jQuery('#opl').val() == 1){
var m51 = dost*koef*1.07;
}
if(jQuery('#opl').val() == 2){
var m51 = dost*koef*1.2;
}
var mm51 = number_format(m51, 2, ',', ' ');
jQuery('#sum13').val(mm51+' руб.');

var et = jQuery('#et').val();
if(jQuery('#razg').val() == 0){
var razg = 0;
jQuery('#raz100').text('комп.');
}
if(jQuery('#razg').val() == 1){
var razg = 2400*et;
jQuery('#raz100').text('комп.');
}
if(jQuery('#razg').val() == 2){
var razg = 4800*et;
jQuery('#raz100').text('комп.');
}
if(jQuery('#razg').val() == 3){
var razg = 2400+350*et;
jQuery('#raz100').text('этаж');
}
if(jQuery('#razg').val() == 4){
var razg = 4800+350*et;
jQuery('#raz100').text('этаж');
}
if(jQuery('#razg').val() == 5){
var razg = 7200+350*et;
jQuery('#raz100').text('этаж');
}

if(jQuery('#opl').val() == 0){
var m52 = razg*koef;
}
if(jQuery('#opl').val() == 1){
var m52 = razg*koef*1.07;
}
if(jQuery('#opl').val() == 2){
var m52 = razg*koef*1.2;
}
var mm52 = number_format(m52, 2, ',', ' ');
jQuery('#sum14').val(mm52+' руб.');
	
var stfu4 = stfu3*kompl2;	
sum110 = parseInt(jQuery('#sum10').val());
var sebe = zam3+podg3+l35+stfu22*kompl+stfu3*kompl2+(1/18*10)+l49+dost+razg;
var sebes = number_format(sebe, 2, ',', ' ');
jQuery('#sebe').val(sebes+' руб.');

if(jQuery('#opl').val() == 0){
var opl = 0;
}
if(jQuery('#opl').val() == 1){
var opl = sebe*koef*0.07;
}
if(jQuery('#opl').val() == 2){
var opl = sebe*koef*0.2;
}
var nds = number_format(opl, 2, ',', ' ');
jQuery('#nds').val(nds+' руб.');

var itog = sebe*koef+opl+sum110;
var itogo = number_format(itog, 2, ',', ' ');
jQuery('#itog').val(itogo+' руб.');
jQuery('#ito').text(itogo+' руб.');

var mar = itog-sebe-opl-0;
var marg = number_format(mar, 2, ',', ' ');
jQuery('#mar').val(marg+' руб.');

}	
kalk()