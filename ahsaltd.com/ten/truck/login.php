<?php
 session_start();
if (isset($_SESSION['user_id'])){
header('location: index.php');

}else {

  require 'includes/inc_func.php';
  $companyName =  mysql_result(mysql_query("SELECT `storeName` FROM `adminSettings`  LIMIT 1"),0);
  $first = '02'.rand(2,55).'.';
  $key = '.02'.rand(2,55);
 

}





?>





<html>
<head>

<title>  login to <?php echo $companyName; ?> </title>
<link checkAds="1"  rel="shortcut icon" href="images/wall5.jpg" />

 <script   checkAds="1"  src="https://code.jquery.com/jquery-1.11.3.js"  charset="utf-8"  type="text/javascript"><!--sorry this page is can't loaded correctly--></script>

<style checkAds="1" >


html,
body {height: 100%;}
body {
    font-family: /* 'Istok Web' ,*/ "Helvetica", sans-serif;
    font-size: 12px;
    margin: 0;
    background-color: #363839;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#7C8084), to(#363839));
    background-image: -webkit-linear-gradient(top, #7C8084, #363839);
    background-image: -moz-linear-gradient(top, #7C8084, #363839);
    background-image: -ms-linear-gradient(top, #7C8084, #363839);
    background-image: -o-linear-gradient(top, #7C8084, #363839);
    background-image: linear-gradient(top, #7C8084, #363839);
}
#login { /* box formulaire */
	background:
	  radial-gradient(black 15%, transparent 16%) 0 0,
	  radial-gradient(black 15%, transparent 16%) 8px 8px,
	  radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px,
	  radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
	background:
		-moz-radial-gradient(black 15%, transparent 16%) 0 0,
		-moz-radial-gradient(black 15%, transparent 16%) 8px 8px,
		-moz-radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px,
		-moz-radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
	background:
		-webkit-radial-gradient(black 15%, transparent 16%) 0 0,
		-webkit-radial-gradient(black 15%, transparent 16%) 8px 8px,
		-webkit-radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 0 1px,
		-webkit-radial-gradient(rgba(255,255,255,.1) 15%, transparent 20%) 8px 9px;
	background-color:#373737;
	background-size:16px 16px;
	-webkit-background-size:16px 16px;
	-moz-background-size:16px 16px;
	-o-background-size:16px 16px;
    height: 310px;
    width: 420px;
    margin: -175px 0 0 -240px;
    padding: 30px;
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 0;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    -webkit-box-shadow:
          0 0 2px rgba(0,0,0,0.5),
          0 1px 1px rgba(0,0,0,0.5),
          0 3px 0 #373737,
          0 4px 0 rgba(0,0,0,0.5),
          0 6px 0 #373737,
          0 7px 0 rgba(0,0,0,0.5),
          0 -10px 5px 10px rgba(0, 0, 0, 0.3) inset,
          0 10px 10px 15px rgba(255, 255, 255, 0.1) inset;
    -moz-box-shadow:
          0 0 2px rgba(0, 0, 0, 0.5),
          1px 1px   0 rgba(0,0,0,0.5),
          3px 3px   #373737,
          4px 4px   0 rgba(0,0,0,0.5),
          6px 6px   #373737,
          7px 7px   0 rgba(0,0,0,0.5)
          0 -10px 5px 10px rgba(0, 0, 0, 0.3) inset,
          0 10px 10px 15px rgba(255, 255, 255, 0.1) inset;
    box-shadow:
          0 0 2px rgba(0, 0, 0, 0.5),
          0 1px 1px rgba(0,0,0,0.5),
          0 3px 0 #373737,
          0 4px 0 rgba(0,0,0,0.5),
          0 6px 0 #373737,
          0 7px 0 rgba(0,0,0,0.5),
          0 -10px 5px 10px rgba(0, 0, 0, 0.3) inset,
          0 10px 10px 15px rgba(255, 255, 255, 0.1) inset;
}
#login:before { /* couture autour du formulaire */
    content: '';
    position: absolute;
    z-index: -1;
    border: 1px dashed rgba(143, 143, 143, 0.7);
    top: 5px;
    bottom: 5px;
    left: 5px;
    right: 5px;
    -moz-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.8),0 0 5px 1px rgba(0, 0, 0, 0.5) inset;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.8),0 0 5px 1px rgba(0, 0, 0, 0.5) inset;
    box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.8),0 0 5px 1px rgba(0, 0, 0, 0.5) inset;
}
#login:after{
	-moz-transform: none;
    border-bottom: 28px solid transparent;
    border-left: 28px solid #DE6625;
    border-right: 28px solid #DE6625;
    height: 40px;
    position: absolute;
    right: -36px;
    width: 0;
    top: 88px;
    content: "";
    display: block;
    z-index: 20;
}
h1 {
    text-transform:  capitalize;
    text-align: right;
    margin: 0 0 30px 0;
    letter-spacing: 4px;
    font-size:35px;
    letter-spacing: -0.06em;
}
#ff-proof.ribbon:after { /* ruban tombant */
    -moz-transform: none;
    border-top: 55px solid transparent;
    border-left: 55px solid #DE6625;
    border-right: 55px solid transparent;
    height: 40px;
    position: absolute;
    right: -107px;
    width: 0;
    bottom: -43px;
    content: "";
    display: block;
    z-index: 20;
}
.ribbon:before { /*  ombre du ruban tombant */
	transform: rotate(280deg);
    -moz-transform: rotate(280deg);
    -webkit-transform: rotate(280deg);
    transform-origin: right bottom;
    -webkit-transform-origin: right bottom;
    -moz-transform-origin: right bottom;
    border-top: 55px solid rgba(0, 0, 0, 0.3);
    border-right: 55px solid transparent;
    bottom: 30px;
    content: "";
    display: block;
    height: 0;
    position: absolute;
    right: -53px;
    width: 20px;
    z-index: 10;
    box-shadow: -2px -2px 2px rgba(0, 0, 0, 0.3);
}
.ribbon { /* ruban  */
    background-color: #C94700;
    background-size:5px 5px,100% 100% ;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#C94700), to(#B84100));
    background-image: -webkit-linear-gradient(45deg , transparent 0%, transparent 25%, rgba(0, 0, 0, 0.15) 25%, rgba(0, 0, 0, 0.15) 50%, transparent 50%, transparent 75%, rgba(0, 0, 0, 0.15) 75%, rgba(0, 0, 0, 0.15) 100%), rgba(0, 0, 0,.125) 20px),
    -webkit-linear-gradient(top, #C94700, #B84100);
    background-image: -moz-linear-gradient(45deg , transparent 0%, transparent 25%, rgba(0, 0, 0, 0.15) 25%, rgba(0, 0, 0, 0.15) 50%, transparent 50%, transparent 75%, rgba(0, 0, 0, 0.15) 75%, rgba(0, 0, 0, 0.15) 100%),
    -moz-linear-gradient(top, #C94700, #B84100);
    background-image: -ms-linear-gradient(45deg , transparent 0%, transparent 25%, rgba(0, 0, 0, 0.15) 25%, rgba(0, 0, 0, 0.15) 50%, transparent 50%, transparent 75%, rgba(0, 0, 0, 0.15) 75%, rgba(0, 0, 0, 0.15) 100%), rgba(0, 0, 0,.125) 20px),
    -ms-linear-gradient(top, #C94700, #B84100);
    background-image: -o-linear-gradient(45deg , transparent 0%, transparent 25%, rgba(0, 0, 0, 0.15) 25%, rgba(0, 0, 0, 0.15) 50%, transparent 50%, transparent 75%, rgba(0, 0, 0, 0.15) 75%, rgba(0, 0, 0, 0.15) 100%), rgba(0, 0, 0,.125) 20px),
    -o-linear-gradient(top, #C94700, #B84100);
    background-image: linear-gradient(45deg , transparent 0%, transparent 25%, rgba(0, 0, 0, 0.15) 25%, rgba(0, 0, 0, 0.15) 50%, transparent 50%, transparent 75%, rgba(0, 0, 0, 0.15) 75%, rgba(0, 0, 0, 0.15) 100%), rgba(0, 0, 0,.125) 20px),
    linear-gradient(top, #C94700, #B84100);
    /* border-bottom: 1px solid rgba(255, 255, 255, 0.3); */
    border-top-right-radius: 20px 5px;
    color: #301607;
    height: 55px;
    width: 460px;
    line-height: 55px;
    padding: 0 5px 0 0;
    margin-left: -32px;
    position: relative;
    text-shadow: 0px 1px 0 rgba(255, 255, 255, 0.3);
    box-shadow: 0 -25px 25px rgba(0, 0, 0, 0.2) inset, 0 0 0 2px rgba(255, 255, 255, 0.25) inset, 0 0 0 1px rgba(0, 0, 0, 0.75) inset, 0 2px 5px rgba(0, 0, 0, 0.25), 0px 1px 2px rgba(0, 0, 0, 0.7),inset 4px 0 2px -1px rgba(0,0,0,0.3),0 -2px 5px rgba(0, 0, 0, 0.2) ;
    -moz-box-shadow: 0 -25px 25px rgba(0, 0, 0, 0.2) inset, 0 0 0 2px rgba(255, 255, 255, 0.25) inset, 0 0 0 1px rgba(0, 0, 0, 0.75) inset, 0 2px 5px rgba(0, 0, 0, 0.25), 0px 1px 2px rgba(0, 0, 0, 0.7),inset 4px 0 2px -1px rgba(0,0,0,0.3),0 -2px 5px rgba(0, 0, 0, 0.2) ;
    -webkit-box-shadow: 0 -25px 25px rgba(0, 0, 0, 0.2) inset, 0 0 0 2px rgba(255, 255, 255, 0.25) inset, 0 0 0 1px rgba(0, 0, 0, 0.75) inset, 0 2px 5px rgba(0, 0, 0, 0.25), 0px 1px 2px rgba(0, 0, 0, 0.7),inset 4px 0 2px -1px rgba(0,0,0,0.3),0 -2px 5px rgba(0, 0, 0, 0.2) ;
}
fieldset {
    position: relative;
    border: 0;
    padding: 0;
    margin: 0;
    text-align: center;

}
fieldset#actions{
	display: block;
    height: 92px;
    overflow: hidden;
    position: relative;
}
fieldset#inputs{ /* contour des inputs */
	padding: 10px;
    margin: 0px;
    width: 400px;
    background-color: #C8BCB6;
    background: -webkit-gradient(linear, left top, left bottom, from(#C8BCB6), to(#B3A39A));
    background: -webkit-repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0, .05) 10px, rgba(0, 0, 0, .05) 20px),-webkit-linear-gradient(top, #C8BCB6, #B3A39A);
    background: -moz-repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0, 0.05) 10px, rgba(0, 0, 0, 0.05) 20px) repeat scroll 0 0%, -moz-linear-gradient(center top , #C8BCB6, #B3A39A);
    background: -ms-repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0,.05) 10px, rgba(0, 0, 0,.05) 20px),-ms-linear-gradient(top, #C8BCB6, #B3A39A);
    background: -o-repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0,.05) 10px, rgba(0, 0, 0,.05) 20px),-o-linear-gradient(top, #C8BCB6, #B3A39A);
    background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0,.05) 10px, rgba(0, 0, 0,.05) 20px),linear-gradient(top, #C8BCB6, #B3A39A);
    -moz-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.5) inset, 0 2px 2px 2px #1F1F1F inset;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.5) inset, 0 2px 2px 2px #1F1F1F inset;
    box-shadow: inset 0 0 1px 1px rgba(0, 0, 0, 0.5) inset, 0 2px 2px 2px #1F1F1F inset;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}
@media screen and (-webkit-animation) {fieldset#inputs:before {width: 440px!important;}}
fieldset#inputs:before{ /* couture autour des inputs */
	content: "";
	padding: 0px;
    margin: -18px -22px;
	width: 435px;
	height: 145px;
	position: absolute;
	border: 1px dashed rgba(143, 143, 143,0.7);
	-moz-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.8),0 0 1px 1px rgba(0, 0, 0, 0.5) inset;
	-webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.8),0 0 1px 1px rgba(0, 0, 0, 0.5) inset;
	box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.8),0 0 1px 1px rgba(0, 0, 0, 0.5) inset;
	-moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
	z-index: -1;
}
#inputs input { /* pictos des inputs */
    background: #f1f1f1 url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAABkCAYAAACPQLC2AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAhtJREFUeNrsV1FuwjAMbRECBAIqxD+7ARyhOwE9QvfDd28wbrB+8wNHaG9QblBuAP9IzeADAYLOntwqZQlk6z6mKZEMkRO/2o7T+plpmhplRsUoOTSABtAA/wagij+z2ayg7Pf7XfgLQGxSRSDOdrt95/dNJhOxB9frNQCxQQwSnAdSD24HvOZsgdpWzgG+J0ViWdZAFSASAESMsY0qgIMGWQ4I0FHOwW63w2w/t9vtwX6/3yjVQbPZ7IK8tVqtFCSBeW6Mc9ThGu6RheCDeBSvBfMptzZFHX2EPACZFwAajcYYYnW5c0dxQT9EkayN8xwAsisJMb4TPtqEGYDzg2vg5B6gW6UuU5kvdOVO5T2SiAfAyluAMAVDRns/c2DqBkMDaAANoAE0gAbQAH+PsdyyFQFz8amls0jNSOcjg6nKjHu93gDav5gzzEbWBjuwx5aGQI2UxTdYMBZoCPMYZATiCT0AZjIU0Z4kSV5o3SBS5slIly1q8TqdzpDWnayrl5EuS9L+xUBCGL8uA4junByfVCYDcBXLIPiSA2QjCEAxxg9a3mnBA2Ahc2QjHN21JU9em6bpHA6HTQ5Qr9fnnOuZ8ZrOHgtqlCXyeDyGBb5Qq9VExp+s5HQ6rWgeCu8CjFeB2wxc9M/n8+rhZeIqLn8yxgfGS6XbSAWx5t2+XC5L5fcBHckTHYsH4YTfeR9oxqIBNIAG+DWADwEGAAgZ5RSSVu1LAAAAAElFTkSuQmCC) no-repeat;
    padding: 15px 15px 15px 30px;
    margin: 0 0 10px 5px;
    width: 85%;
    border: 1px solid #ccc;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow: 0 1px 1px #525252 inset, 0 1px 0 #6A6A6A;
    -webkit-box-shadow: 0 1px 1px #525252 inset, 0 1px 0 #6A6A6A;
    box-shadow: 0 1px 1px #525252 inset, 0 1px 0 #6A6A6A;
}
#username {
    background-position: 5px -2px !important;
}
#password {
    background-position: 5px -52px !important;
}
#inputs input:focus {
    background-color: #fff;
    border-color: #e8c291;
    outline: none;
    -moz-box-shadow: 0 0 0 1px #e8c291 inset;
    -webkit-box-shadow: 0 0 0 1px #e8c291 inset;
    box-shadow: 0 0 0 1px #e8c291 inset;
}
/*--------------------*/
#actions {
    margin: 25px 0 0 0;
}
#submit {/* bouton de connection */
    background-color: #ffb94b;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#C94700), to(#B84100));
    background-image: -webkit-linear-gradient(top, #C94700, #B84100);
    background-image: -moz-linear-gradient(top, #C94700, #B84100);
    background-image: -ms-linear-gradient(top, #C94700, #B84100);
    background-image: -o-linear-gradient(top, #C94700, #B84100);
    background-image: linear-gradient(top, #C94700, #B84100);
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    text-shadow: 0 1px 0 rgba(0, 0, 0,0.7);
     -moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5), 0 17px 2px rgba(255, 255, 255, 0.2) inset, 0 5px 5px rgba(255, 255, 255, 0.2) inset;
     -webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5), 0 17px 2px rgba(255, 255, 255, 0.2) inset, 0 5px 5px rgba(255, 255, 255, 0.2) inset;
     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5), 0 17px 2px rgba(255, 255, 255, 0.2) inset, 0 5px 5px rgba(255, 255, 255, 0.2) inset;
    display: block;
    border: none;
	position: relative;
    float: none;
    height: 35px;
    padding: 0;
    margin: 0 auto 20px;
    width: 120px;
    cursor: pointer;
    font-size:18px ;
    color: #FFF;
    text-transform:  capitalize;
}
#submit:hover,#submit:focus {
    background-color: #C94700;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#B84100), to(#C94700));
    background-image: -webkit-linear-gradient(top, #B84100, #C94700);
    background-image: -moz-linear-gradient(top, #B84100, #C94700);
    background-image: -ms-linear-gradient(top, #B84100, #C94700);
    background-image: -o-linear-gradient(top, #B84100, #C94700);
    background-image: linear-gradient(top, #B84100, #C94700);
}
#submit:active {
    outline: none;
     -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
     -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
     box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
}
#submit::-moz-focus-inner {border: none;}
#actions a {
    color: #000000;
    float: none;
    line-height: 35px;
    margin-left: 10px;
    text-decoration: none;
}
#actions a:hover{color: #FFFFFF;text-decoration: underline;}

.option {
	margin: auto;
    width: 250px;
	background-color: #C8BCB6;
    background: -webkit-gradient(linear, left top, left bottom, from(#C8BCB6), to(#B3A39A));
    background: -webkit-repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0, .05) 10px, rgba(0, 0, 0, .05) 20px),-webkit-linear-gradient(top, #C8BCB6, #B3A39A);
    background: -moz-repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0, 0.05) 10px, rgba(0, 0, 0, 0.05) 20px) repeat scroll 0 0%, -moz-linear-gradient(center top , #C8BCB6, #B3A39A);
    background: -ms-repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0,.05) 10px, rgba(0, 0, 0,.05) 20px),-ms-linear-gradient(top, #C8BCB6, #B3A39A);
    background: -o-repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0,.05) 10px, rgba(0, 0, 0,.05) 20px),-o-linear-gradient(top, #C8BCB6, #B3A39A);
    background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0,.05) 10px, rgba(0, 0, 0,.05) 20px),linear-gradient(top, #C8BCB6, #B3A39A);
    -moz-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.5) inset, 0 2px 2px 2px #1F1F1F inset;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.5) inset, 0 2px 2px 2px #1F1F1F inset;
    box-shadow: inset 0 0 1px 1px rgba(0, 0, 0, 0.5) inset, 0 2px 2px 2px #1F1F1F inset;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}
.option:after{
	content: "";
	width: 260px;
	height: 40px;
	left: 78px;
	top: 50px;
	position: absolute;
	border: 1px dashed rgba(143, 143, 143,0.7);
	border-bottom: none;
	-moz-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.8),0 0 1px 1px rgba(0, 0, 0, 0.5) inset;
	-webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.8),0 0 1px 1px rgba(0, 0, 0, 0.5) inset;
	box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.8),0 0 1px 1px rgba(0, 0, 0, 0.5) inset;
	-moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
	z-index: -1;
}
.apple, .butt:before, .top span:after, .butt:after, .top:before, .top:after, .butt:before, .butt:after {
    background: #FFF; /* foreground color */
}
.bite, .butt span, .butt, .top, .top span {
    background: #DE6625; /* background color */
}
.apple {
    width: 25.06px;
    height: 22.2px;
    border-radius: 36% 36% 41% 41% / 42% 42% 75% 75%;
    position: absolute;
    margin: 0px;
    right: -9px;
    top: 77px;
    z-index: 100;
}
.bite {
    position: absolute;
    width: 60%;
    height: 62%;
    right: -40%;
    top: 8%;
    border-radius: 60%;
}
.butt span {
    display: block;
    position: absolute;
    border-radius: 100% 100% 0% 0%;
    width: 24.5%;
    height: 400%;
    bottom: -239%;
    left: 38%;
}
.butt {
    position: absolute;
    width: 100%;
    height: 4%;
    bottom: -1%;
}
.butt:before {
    content: '';
    position: absolute;
    width: 24%;
    height: 400%;
    border-radius: 0% 0% 100% 100%;
    left: 21%;
    bottom: 38%;
}
.butt:after {
    content: '';
    position: absolute;
    width: 23.4%;
    height: 400%;
    border-radius: 0% 0% 100% 100%;
    right: 21%;
    bottom: 38%;
}


.top span {
    display: block;
    position: absolute;
    border-radius: 0 0 44% 44% / 0 0 100% 100%;
    width: 63%;
    height: 259%;
    top: -92%;
    left: 18.6%;
    z-index: 3;
}
.top span:after {
    border-radius: 100% 0 100% 0;
    content: "";
    height: 242%;
    left: 41%;
    position: absolute;
    top: -193%;
    width: 90%;
}
.top {
    position: absolute;
    width: 42%;
    height: 4%;
    top: 0px;
    left: 29%;
}
.top:before {
    content: '';
    position: absolute;
    width: 62%;
    height: 260%;
    border-radius: 100% 100% 0% 0% / 100% 200% 0% 0%;
    left: -27%;
    top: 1%;
}
.top:after {
    content: '';
    position: absolute;
    width: 62%;
    height: 260%;
    border-radius: 100% 100% 0% 0% / 200% 100% 0% 0%;
    right: -27%;
    top: 1%;
}

.container {width: 200px; margin: 0 auto;  
 
}
/* Loading Circle */
 .circle {
	background-color: rgba(0,0,0,0);
	border:5px solid rgba(0,183,229,0.9);
	opacity:.9;
	border-right:5px solid rgba(0,0,0,0);
	border-left:5px solid rgba(0,0,0,0);
	border-radius:50px;
	box-shadow: 0 0 35px #2187e7;
	width:50px;
	height:50px;
	margin:0 auto;
	-moz-animation:spinPulse 1s infinite ease-in-out;
	-webkit-animation:spinPulse 1s infinite linear;
}
.circle1 {
	background-color: rgba(0,0,0,0);
	border:5px solid rgba(0,183,229,0.9);
	opacity:.9;
	border-left:5px solid rgba(0,0,0,0);
	border-right:5px solid rgba(0,0,0,0);
	border-radius:50px;
	box-shadow: 0 0 15px #2187e7; 
	width:30px;
	height:30px;
	margin:0 auto;
	position:relative;
	top:-50px;
	-moz-animation:spinoffPulse 1s infinite linear;
	-webkit-animation:spinoffPulse 1s infinite linear;
}



@-moz-keyframes spin {
	0% { -moz-transform:rotate(0deg); }
	100% { -moz-transform:rotate(360deg); }
}
@-moz-keyframes spinoff {
	0% { -moz-transform:rotate(0deg); }
	100% { -moz-transform:rotate(-360deg); }
}
@-webkit-keyframes spin {
	0% { -webkit-transform:rotate(0deg); }
	100% { -webkit-transform:rotate(360deg); }
}
@-webkit-keyframes spinoff {
	0% { -webkit-transform:rotate(0deg); }
	100% { -webkit-transform:rotate(-360deg); }
}


@-moz-keyframes spinPulse {
	0% { -moz-transform:rotate(160deg); opacity:0; box-shadow:0 0 1px #2187e7;}
	50% { -moz-transform:rotate(145deg); opacity:1; }
	100% { -moz-transform:rotate(-320deg); opacity:0; }
}
@-moz-keyframes spinoffPulse {
	0% { -moz-transform:rotate(0deg); }
	100% { -moz-transform:rotate(360deg);  }
}
@-webkit-keyframes spinPulse {
	0% { -webkit-transform:rotate(160deg); opacity:0; box-shadow:0 0 1px #2187e7; }
	50% { -webkit-transform:rotate(145deg); opacity:1;}
	100% { -webkit-transform:rotate(-320deg); opacity:0; }
}
@-webkit-keyframes spinoffPulse {
	0% { -webkit-transform:rotate(0deg); }
	100% { -webkit-transform:rotate(360deg); }
}

@-moz-keyframes move{
	0%{-moz-transform: scale(1.2);opacity:1;}
	100%{-moz-transform: scale(0.7);opacity:0.1;}
}
@-webkit-keyframes move{
	0%{-webkit-transform: scale(1.2);opacity:1;}
	100%{-webkit-transform: scale(0.7);opacity:0.1;}
}

 

</style>
</head>
<body style="background-image:url('images/background.jpg');">
<form id="login" action="none" style="display:none;">
    <h1 id="ff-proof" class="ribbon"> <?php echo $companyName; ?> </h1>
    <div class="apple">
    
     <img src="images/wall2.jpg" alt="logo" style="
    width: 48px;
    border-radius: 16em;
    height: 70px;
    /* color: black; */
">
    
	</div>
    <fieldset id="inputs">
        <input id="username" type="text" placeholder="Username"  onblur="if(jQuery.trim($(this).val())=='')this.value='Username';" onfocus="if(this.value=='Username')this.value='';" value="Username" />
        <input id="password" type="password" placeholder="Password" />
    </fieldset>
    <fieldset id="actions">
       
		  <div class="container" id="loading" title="loading"  style="display:none; padding:4px; margin:5px;" >
			  <div class="content">
			  <div id="loading" title="loading" class="circle" >    </div>
			   <div id="loading" title="loading" class="circle1" >    </div>
		  </div>
		 </div>
		
		
		
		 <input type="submit" id="submit" value="LogIn"/>
	   <p id="errors" style="	font: bold 13px Arial; color:red; padding:3px;"></p>   
    </fieldset>
	<span hello="<?php echo $key; ?>" id="k" style=" display:none;margin-left: 10px;color: rgb(19, 16, 16);" ><?php echo $key; ?></span>
</form>

<span id="hk" hello_k="<?php echo $first; ?>" ></span>




 <script   checkAds="1"  src="js/jquery-ui-and-jquery/js/jquery-ui-1.10.3.custom.min.js" charset="utf-8"  type="text/javascript"><!--sorry this page is can't loaded correctly--></script>
 <script   checkAds="1"  charset="utf-8"  type="text/javascript"><!--


$('document').ready( function () {


$('form#login').fadeIn();
 // remove hosting Adds 

	  $('script,link,style').each(function(){

		   if($(this).attr('checkAds') != '1'){  

			   $(this).remove();

			 }

        });

      $('div.container').next('div').remove();

	    $('div.container').next('div').remove();

		  $('div.container').next('div').remove();

		    $('div.container').next('div').remove();

			  $('div.container').next('div').remove();

			    $('div.container').next('div').remove();

				  $('div.container').next('div').remove();

			// end of hostin adds 	





 $('#login').draggable()
$('#username').focus();
 
 
 $('form').dblclick( function (){
	 $('#k').show().css('color','#fff');
 });
 
function logmei(){

	var username  =   $('#username').val();
	var password  =   "<?php echo $first; ?>"+$('#password').val();
	var myuser    =  "<?php echo $key; ?>";
    $('#submit').fadeOut();
	$('#loading').slideDown().fadeIn();
 
		$.post('logPos.php',{ username: username, password: password, myuser:myuser}, function (data) {
		
			if(data == 2){
			location.reload();
			}else{
			$('#loading').slideUp();
			 $('#submit').fadeIn();
			$('#errors').fadeOut().html(data).fadeIn();
			}
		
		}).complete( function () {
	
	}).success( function () {
	});
	 
}


$('#submit').click( function (){
	logmei();
return false;
 });
 
 
$('#username, #password').keyup( function (e) {
if(e.keyCode == 13 ){
	logmei();
	return false;
}

});



 });

	-->
	</script>




</body>
</html>