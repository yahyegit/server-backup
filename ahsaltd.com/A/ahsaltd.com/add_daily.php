<?php

require 'connet.php';

if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}

  if(if_logged_in() != true){
die();
 }

if ( isset($_POST['namex2']) && isset($_POST['cash_inx2']) && isset($_POST['cash_outx2']) &&  isset($_POST['dol_inx2']) &&  isset($_POST['dol_outx2'])){

$namex1		=   trim(mysql_real_escape_string(htmlentities($_POST['namex2'])));
$cash_inx1 	=   trim(mysql_real_escape_string(htmlentities($_POST['cash_inx2'])));
$cash_outx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['cash_outx2'])));
$dol_inx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['dol_inx2'])));
$dol_outx1	    =   trim(mysql_real_escape_string(htmlentities($_POST['dol_outx2'])));


$date_openday    =   trim(mysql_real_escape_string(htmlentities($_POST['date_openday'])));




$cashRate	    =   trim(mysql_real_escape_string(htmlentities($_POST['cashRate'])));
$dollRate    =   trim(mysql_real_escape_string(htmlentities($_POST['dollRate'])));

 
 
$dol_outx1 = str_replace(' ','',$dol_outx1);
$cash_outx1 = str_replace(' ','',$cash_outx1);
$cash_inx1 = str_replace(' ','',$cash_inx1);
$dol_inx1 = str_replace(' ','',$dol_inx1);

if($cash_inx1 == ''){
$cash_inx1 =0;
}else if($dol_inx1 == ''){
$dol_inx1 =0;
}
  
	if (!is_numeric($cash_inx1) || !is_numeric($cash_outx1)|| !is_numeric($dol_inx1) ||!is_numeric($dol_outx1)){
	exit('<font style="color:red ;font:bold 16px verdana;"> invalid digit number !</font>');
	}
    if(empty($dollRate)){
exit('<font style="color:red ;font:bold 16px verdana;"> Please Enter the Dollar Rate!</font>');
 }
    if(!is_numeric($dollRate)){
exit('<font style="color:red ;font:bold 16px verdana;">  Error Invalid Dollar Rate !</font>');
 }



    if(empty($date_openday)){
      exit('<font style="color:red ;font:bold 16px verdana;">  please enter the date !</font>');
		 }else{
			 
				   $date_e  =  date('d/M/Y',strtotime(str_replace('/','-',$date_openday)));
			 
				   $admitiondate   =  $date_e;
				   $month   =  date('m/Y',strtotime(str_replace('/','-',$date_openday)));
		 
		 }



	 
	if($namex1 == ''){
	$namex1 = date('d/M/Y');
	}


 		
			$cash_blance = 	$cash_inx1 - $cash_outx1;
			$doll_blance = 	$dol_inx1 - $dol_outx1;
			
				$chack_exist_query = "SELECT `date` FROM `oppen_day` WHERE `date`='$admitiondate'";
				$chack_exist_query_run   =  mysql_query($chack_exist_query);
				
				if(mysql_num_rows($chack_exist_query_run) == 1){			
						exit("<font style='color:red ;font:bold 16px verdana;'>$admitiondate is all ready exists</font>");
					}else{
							$update_query = "INSERT INTO `oppen_day`  VALUES('','$namex1','$cash_inx1','$cash_outx1','$cash_blance', '$dol_inx1','$dol_outx1','$doll_blance','$admitiondate','$month','$cashRate','$dollRate')";
										
							if(@mysql_query($update_query) == true){			
								
							fix_bugs();
							echo 1;
							}																
						}
	
 
		

}
?>
�#�d$��Z�B�wD;�"'��w���ܨ$���e�I$��k����)�Photoshop 3.0 8BIM          8BIM%     ��\�/���{g��dպ8BIM�    <?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>com.apple.print.PageFormat.PMHorizontalRes</key>
	<dict>
		<key>com.apple.print.ticket.creator</key>
		<string>com.apple.jobticket</string>
		<key>com.apple.print.ticket.itemArray</key>
		<array>
			<dict>
				<key>com.apple.print.PageFormat.PMHorizontalRes</key>
				<real>72</real>
				<key>com.apple.print.ticket.stateFlag</key>
				<integer>0</integer>
			</dict>
		</array>
	</dict>
	<key>com.apple.print.PageFormat.PMOrientation</key>
	<dict>
		<key>com.apple.print.ticket.creator</key>
		<string>com.apple.jobticket</string>
		<key>com.apple.print.ticket.itemArray</key>
		<array>
			<dict>
				<key>com.apple.print.PageFormat.PMOrientation</key>
				<integer>1</integer>
				<key>com.apple.print.ticket.stateFlag</key>
				<integer>0</integer>
			</dict>
		</array>
	</dict>
	<key>com.apple.print.PageFormat.PMScaling</key>
	<dict>
		<key>com.apple.print.ticket.creator</key>
		<string>com.apple.jobticket</string>
		<key>com.apple.print.ticket.itemArray</key>
		<array>
			<dict>
				<key>com.apple.print.PageFormat.PMScaling</key>
				<real>1</real>
				<key>com.apple.print.ticket.stateFlag</key>
				<integer>0</integer>
			</dict>
		</array>
	</dict>
	<key>com.apple.print.PageFormat.PMVerticalRes</key>
	<dict>
		<key>com.apple.print.ticket.creator</key>
		<string>com.apple.jobticket</string>
		<key>com.apple.print.ticket.itemArray</key>
		<array>
			<dict>
				<key>com.apple.print.PageFormat.PMVerticalRes</key>
				<real>72</real>
				<key>com.apple.print.ticket.stateFlag</key>
				<integer>0</integer>
			</dict>
		</array>
	</dict>
	<key>com.apple.print.PageFormat.PMVerticalScaling</key>
	<dict>
		<key>com.apple.print.ticket.creator</key>
		<string>com.apple.jobticket</string>
		<key>com.apple.print.ticket.itemArray</key>
		<array>
			<dict>
				<key>com.apple.print.PageFormat.PMVerticalScaling</key>
				<real>1</real>
				<key>com.apple.print.ticket.stateFlag</key>
				<integer>0</integer>
			</dict>
		</array>
	</dict>
	<key>com.apple.print.subTicket.paper_info_ticket</key>
	<dict>
		<key>PMPPDPaperCodeName</key>
		<dict>
			<key>com.apple.print.ticket.creator</key>
			<string>com.apple.jobticket</string>
			<key>com.apple.print.ticket.itemArray</key>
			<array>
				<dict>
					<key>PMPPDPaperCodeName</key>
					<string>Letter</string>
					<key>com.apple.print.ticket.stateFlag</key>
					<integer>0</integer>
				</dict>
			</array>
		</dict>
		<key>PMTiogaPaperName</key>
		<dict>
			<key>com.apple.print.ticket.creator</key>
			<string>com.apple.jobticket</string>
			<key>com.apple.print.ticket.itemArray</key>
			<array>
				<dict>
					<key>PMTiogaPaperName</key>
					<string>na-letter</string>
					<key>com.apple.print.ticket.stateFlag</key>
					<integer>0</integer>
				</dict>
			</array>
		</dict>
		<key>com.apple.print.PageFormat.PMAdjustedPageRect</key>
		<dict>
			<key>com.apple.print.ticket.creator</key>
			<string>com.apple.jobticket</string>
			<key>com.apple.print.ticket.itemArray</key>
			<array>
				<dict>
					<key>com.apple.print.PageFormat.PMAdjustedPageRect</key>
					<array>
						<real>0.0</real>
						<real>0.0</real>
						<real>734</real>
						<real>576</real>
					</array>
					<key>com.apple.print.ticket.stateFlag</key>
					<integer>0</integer>
				</dict>
			</array>
		</dict>
		<key>com.apple.print.PageFormat.PMAdjustedPaperRect</key>
		<dict>
			<key>com.apple.print.ticket.creator</key>
			<string>com.apple.jobticket</string>
			<key>com.apple.print.ticket.itemArray</key>
			<array>
				<dict>
					<key>com.apple.print.PageFormat.PMAdjustedPaperRect</key>
					<array>
						<real>-18</real>
						<real>-18</real>
						<real>774</real>
						<real>594</real>
					</array>
					<key>com.apple.print.ticket.stateFlag</key>
					<integer>0</integer>
				</dict>
			</array>
		</dict>
		<key>com.apple.print.PaperInfo.PMPaperName</key>
		<dict>
			<key>com.apple.print.ticket.creator</key>
			<string>com.apple.jobticket</string>
			<key>com.apple.print.ticket.itemArray</key>
			<array>
				<dict>
					<key>com.apple.print.PaperInfo.PMPaperName</key>
					<string>na-letter</string>
					<key>com.apple.print.ticket.stateFlag</key>
					<integer>0</integer>
				</dict>
			</array>
		</dict>
		<key>com.apple.print.PaperInfo.PMUnadjustedPageRect</key>
		<dict>
			<key>com.apple.print.ticket.creator</key>
			<string>com.apple.jobticket</string>
			<key>com.apple.print.ticket.itemArray</key>
			<array>
				<dict>
					<key>com.apple.print.PaperInfo.PMUnadjustedPageRect</key>
					<array>
						<real>0.0</real>
						<real>0.0</real>
						<real>734</real>
						<real>576</real>
					</array>
					<key>com.apple.print.ticket.stateFlag</key>
					<integer>0</integer>
				</dict>
			</array>
		</dict>
		<key>com.apple.print.PaperInfo.PMUnadjustedPaperRect</key>
		<dict>
			<key>com.apple.print.ticket.creator</key>
			<string>com.apple.jobticket</string>
			<key>com.apple.print.ticket.itemArray</key>
			<array>
				<dict>
					<key>com.apple.print.PaperInfo.PMUnadjustedPaperRect</key>
					<array>
						<real>-18</real>
						<real>-18</real>
						<real>774</real>
						<real>594</real>
					</array>
					<key>com.apple.print.ticket.stateFlag</key>
					<integer>0</integer>
				</dict>
			</array>
		</dict>
		<key>com.apple.print.PaperInfo.ppd.PMPaperName</key>
		<dict>
			<key>com.apple.print.ticket.creator</key>
			<string>com.apple.jobticket</string>
			<key>com.apple.print.ticket.itemArray</key>
			<array>
				<dict>
					<key>com.apple.print.PaperInfo.ppd.PMPaperName</key>
					<string>US Letter</string>
					<key>com.apple.print.ticket.stateFlag</key>
					<integer>0</integer>
				</dict>
			</array>
		</dict>
		<key>com.apple.print.ticket.APIVersion</key>
		<string>00.20</string>
		<key>com.apple.print.ticket.type</key>
		<string>com.apple.print.PaperInfoTicket</string>
	</dict>
	<key>com.apple.print.ticket.APIVersion</key>
	<string>00.20</string>
	<key>com.apple.print.ticket.type</key>
	<string>com.apple.print.PageFormatTicket</string>
</dict>
</plist>
8BIM�      H     H    8BIM&               ?�  8BIM        x8BIM        8BIM�     	         8BIM
       8BIM'     
        8BIM�     H /ff  lff       /ff  ���       2    Z         5    -        8BIM�     p  �����������������������    �����������������������    �����������������������    �����������������������  8BIM       8BIM                     8BIM0     8BIM-         8BIM          @  @    8BIM         8BIM    O              �  �    i m p a l a _ s u b n a v                                �   �                                            null      boundsObjc         Rct1       Top long        Leftlong        Btomlong   �    Rghtlong  �   slicesVlLs   Objc        slice      sliceIDlong       groupIDlong       originenum   ESliceOrigin   autoGenerated    Typeenum   
ESliceType    Img    boundsObjc         Rct1       Top long        Leftlong        Btomlong   �    Rghtlong  �   urlTEXT         nullTEXT         MsgeTEXT        altTagTEXT        cellTextIsHTMLbool   cellTextTEXT        	horzAlignenum   ESliceHorzAlign   default   	vertAlignenum   ESliceVertAlign   default   bgColorTypeenum   ESliceBGColorType    None   	topOutsetlong       
leftOutsetlong       bottomOutsetlong       rightOutsetlong     8BIM(        ?�      8BIM        	8BIM    
]      �   '  �  I   
A  ���� JFIF   H H  �� Adobe_CM �� Adobe d�   �� � 			
��  ' �" ��  
��?          	
         	
 3 !1AQa"q�2���B#$R�b34r��C%�S���cs5���&D�TdE£t6�U�e���u��F'���������������Vfv��������7GWgw�������� 5 !1AQaq"2����B#�R��3$b�r��CScs4�%���&5��D�T�dEU6te����u��F���������������Vfv��������'7GWgw�������   ? 򤕇adz!�����`�o��{T��^�R��~����>�=ܡ�;��$��L�<V�^�I1��D���<gV̌K�u�)m����ƕ��z�K�R2�4H���Md�����pv���]�׭����z�n��ڬuo��g�6��<c���zD��ݷi�n�F�����8��_�������������� �t��w�@&Av�����S�u^�p0��G����6�0������^�kȭ��MYM��K\�{�ױ(�b���J
<�\a�kk����%�8��������H�fu�+�*o�KE���cF�:��_����+�'���dGf+�okd7�z5� �zv+�͸������ֹŕn/w��o�عX�0�5��#������e���Ek�� w� V9�W�C�<��npu.%��:v��n�f�:��G=�~���D����.V��q��\�) o����}���u�n;�E����!�u�s]E���sj���������n��k���o����i���f[��HW����̩��V�����Ѧ~���wx!�U�����pxs�.=?���^��,�ݏ��q���-��Q��ʽM�c��:{z�r���Ţ�k��Ӫ�89�����N�?���!,+�%:u�� C�8��8���#u���oD{&�]���C�-�{�;}[X7�W���r�ln+}�m�������55�9��[�f�/�Y�P��j�d:	�S�c�U��{=�k����5�
���Ev�� ���kK��������Q��#X˂Rz�xc����Ĺ|q[�~�Ổ!�7�8�L錯�,ȯ�-/��KˍM�!�k�F�.�� .g� �Ꜯ���S-��o�v[k��� �o���?���� V�_Pf^^_L�U���o��,�m�`�r�����q�HX<V��UO���l�N��������|�7������m^��s�X_��}[�'����0.~N��p�6X}?�/�����1=c�����]�����ݹ��k^^*���}���l����k��1z-� k�5����ȳ#�*���9���1���{� }���+�T��%N�>..#�9d޸e��3������^2�S�����zϬ;������-��N���ecS�����d��,�ݕ��u�c�fWOūs�vK��̜�s�/�����S��B�Wկխp�%���p�8}��XqN~��6j�%�^߬�t�=w��?/'5���G����_�L���N�Rڬ�ӳ��Y_�~������J�Ǐ�V^f]#�2^ژ�γw��W�$��0�8JY#R��QÓ�����zѽ��L�:����M�U�����{��_[�f-��+���el���g�� Gg�:�[���=Y�:���%�^��ז�\�.����=�R��-_��;�T��� }�\���bc� ��/W�^��Ĵ�ѽ��7d��Ub�7���q`���I��z{�� ��p��A��?�� R�WKZƀ��)l{�r5u@p�֔���N�~mWc-l�=�i���n�a�|����W����\��Lh8|��w�5)�e6��	[ � �7+.�q����"�gK�c���wK��V��wұ�t����\�9;���A��*��,gR�A�e�46��ѻj�vWM~������ ��?;c��W0��VI�
	��[�G��Ұt5DX��kZݮw�A��k��t��S+�=G���'uA��繎-�ƿ3� >}?Я3}p$����B����U�1�y7Z���N���Iʬ�F�d�ڞ���?H�:�����k}�k���k~��� ��ms_/�����^���7 ~�?�/n�~��Ž�����v\��I����lc�i�97�������������`��aeb�Ci�����v����s��ޚ����I%)$�IJI$�R���O�v��_� �nY)'C揘D�S�^���Q x�i%�G���d����q����$�+�ޙ��/�� k��ȦJ�:�q� r�[�������#�d$��Z�B�wD;�"'��w���ܨ$���e�I$��k�� 8BIM!     U       A d o b e   P h o t o s h o p    A d o b e   P h o t o s h o p   C S 3    8BIM�     �maniIRFR   �8BIMAnDs   �            null       AFStlong        FrInVlLs   Objc         null       FrIDlongC�n�    FStsVlLs   Objc         null       FsIDlong        AFrmlong        FsFrVlLs   longC�n�    LCntlong      8BIMRoll           8BIM�     mfri                    8BIM          ���http://ns.adobe.com/xap/1.0/ <?xpacket begin="﻿" id="W5M0MpCehiHzreSzNTczkc9d"?> <x:xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 4.1-c036 46.276720, Mon Feb 19 2007 22:13:43        "> <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"> <rdf:Description rdf:about="" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:xap="http://ns.adobe.com/xap/1.0/" xmlns:xapMM="http://ns.adobe.com/xap/1.0/mm/" xmlns:stRef="http://ns.adobe.com/xap/1.0/sType/ResourceRef#" xmlns:photoshop="http://ns.adobe.com/photoshop/1.0/" xmlns:tiff="http://ns.adobe.com/tiff/1.0/" xmlns:exif="http://ns.adobe.com/exif/1.0/" dc:format="image/jpeg" xap:CreatorTool="Adobe Photoshop CS3 Macintosh" xap:CreateDate="2008-05-28T14:38:51-05:00" xap:ModifyDate="2008-05-28T14:38:51-05:00" xap:MetadataDate="2008-05-28T14:38:51-05:00" xapMM:DocumentID="uuid:32072416562EDD11AF1CCFDB426E587B" xapMM:InstanceID="uuid:33072416562EDD11AF1CCFDB426E587B" photoshop:ColorMode="3" photoshop:ICCProfile="sRGB IEC61966-2.1" photoshop:History="" tiff:Orientation="1" tiff:XResolution="720000/10000" tiff:YResolution="720000/10000" tiff:ResolutionUnit="2" tiff:NativeDigest="256,257,258,259,262,274,277,284,530,531,282,283,296,301,318,319,529,532,306,270,271,272,305,315,33432;E2EC1E2A2588C1101E9750D9F534B2D0" exif:PixelXDimension="737" exif:PixelYDimension="181" exif:ColorSpace="1" exif:NativeDigest="36864,40960,40961,37121,37122,40962,40963,37510,40964,36867,36868,33434,33437,34850,34852,34855,34856,37377,37378,37379,37380,37381,37382,37383,37384,37385,37386,37396,41483,41484,41486,41487,41488,41492,41493,41495,41728,41729,41730,41985,41986,41987,41988,41989,41990,41991,41992,41993,41994,41995,41996,42016,0,2,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,20,22,23,24,25,26,27,28,30;5F998DB4E0040C2D089B7CBE28ED4AC6"> <xapMM:DerivedFrom stRef:instanceID="uuid:F280CB27552EDD11AF1CCFDB426E587B" stRef:documentID="uuid:7057C911552EDD11AF1CCFDB426E587B"/> </rdf:Description> </rdf:RDF> </x:xmpmeta>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?xpacket end="w"?>��XICC_PROFILE   HLino  mntrRGB XYZ �  	  1  acspMSFT    IEC sRGB             ��     �-HP                                                 cprt  P   3desc  �   lwtpt  �   bkpt     rXYZ     gXYZ  ,   bXYZ  @   dmnd  T   pdmdd  �   �vued  L   �view  �   $lumi  �   meas     $tech  0   rTRC  <  gTRC  <  bTRC  <  text    Copyright (c) 1998 Hewlett-Packard Company  desc       sRGB IEC61966-2.1           sRGB IEC61966-2.1                                                  XYZ       �Q    �XYZ                 XYZ       o�  8�  �XYZ       b�  ��  �XYZ       $�  �  ��desc       IEC http://www.iec.ch           IEC http://www.iec.ch                                              desc       .IEC 61966-2.1 Default RGB colour space - sRGB           .IEC 61966-2.1 Default RGB colour space - sRGB                      desc       ,Reference Viewing Condition in IEC61966-2.1           ,Reference Viewing Condition in IEC61966-2.1                          view     �� _. � ��  \�   XYZ      L	V P   W�meas                         �   sig     CRT curv           
     # ( - 2 7 ; @ E J O T Y ^ c h m r w | � � � � � � � � � � � � � � � � � � � � � � � � �%+28>ELRY`gnu|����������������&/8AKT]gqz������������ !-8COZfr~���������� -;HUcq~���������+:IXgw��������'7HYj{�������+=Oat�������2FZn�������		%	:	O	d	y	�	�	�	�	�	�

'
=
T
j
�
�
�
�
�
�"9Qi������*C\u�����&@Zt�����.Id����	%A^z����	&Ca~����1Om����&Ed����#Cc����'Ij����4Vx���&Il����Ae����@e���� Ek���*Qw���;c���*R{���Gp���@j���>i���  A l � � �!!H!u!�!�!�"'"U"�"�"�#
#8#f#�#�#�$$M$|$�$�%	%8%h%�%�%�&'&W&�&�&�''I'z'�'�((?(q(�(�))8)k)�)�**5*h*�*�++6+i+�+�,,9,n,�,�--A-v-�-�..L.�.�.�/$/Z/�/�/�050l0�0�11J1�1�1�2*2c2�2�33F33�3�4+4e4�4�55M5�5�5�676r6�6�7$7`7�7�88P8�8�99B99�9�:6:t:�:�;-;k;�;�<'<e<�<�="=a=�=�> >`>�>�?!?a?�?�@#@d@�@�A)AjA�A�B0BrB�B�C:C}C�DDGD�D�EEUE�E�F"FgF�F�G5G{G�HHKH�H�IIcI�I�J7J}J�KKSK�K�L*LrL�MMJM�M�N%NnN�O OIO�O�P'PqP�QQPQ�Q�R1R|R�SS_S�S�TBT�T�U(UuU�VV\V�V�WDW�W�X/X}X�YYiY�ZZVZ�Z�[E[�[�\5\�\�]']x]�^^l^�__a_�``W`�`�aOa�a�bIb�b�cCc�c�d@d�d�e=e�e�f=f�f�g=g�g�h?h�h�iCi�i�jHj�j�kOk�k�lWl�mm`m�nnkn�ooxo�p+p�p�q:q�q�rKr�ss]s�ttpt�u(u�u�v>v�v�wVw�xxnx�y*y�y�zFz�{{c{�|!|�|�}A}�~~b~�#��G���
�k�͂0����W�������G����r�ׇ;����i�Ή3�����d�ʋ0�����c�ʍ1�����f�Ώ6����n�֑?����z��M��� �����_�ɖ4���
�u���L���$�����h�՛B��������d�Ҟ@��������i�ءG���&����v��V�ǥ8��������n��R�ĩ7�������u��\�ЭD���-������ �u��`�ֲK�³8���%�������y��h��Y�ѹJ�º;���.���!������
�����z���p���g���_���X���Q���K���F���Aǿ�=ȼ�:ɹ�8ʷ�6˶�5̵�5͵�6ζ�7ϸ�9к�<Ѿ�?���D���I���N���U���\���d���l���v��ۀ�܊�ݖ�ޢ�)߯�6��D���S���c���s��������2��F���[���p������(��@���X���r������4���P���m��������8���W���w����)���K���m���� Adobe d    �� � 		



��  �� ��  ]���            	
         	
 s !1AQa"q�2���B#�R��3b�$r��%C4S���cs�5D'���6Tdt���&�	
��EF��V�U(�������eu��������fv��������7GWgw��������8HXhx��������)9IYiy��������*:JZjz�������� m !1AQa"q��2������#BRbr�3$4C��S%�c��s�5�D�T�	
&6E'dtU7��()��󄔤�����eu��������FVfv��������GWgw��������8HXhx��������9IYiy��������*:JZjz����������   ? �*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W��\w>u��OK&�iY"we	q;���%�Cf>L�2�r����o�4Kش� T��"�cP�� zaG3���rF��7Q�,��"(��Ij�F��rN��V/�[�X#��]��� *bB3@�A�P���ـj��5��o�<r��j7�6x�"ws�<�<Ѣ��Zkڕ���X��¬UEN1qA@��Vq���Ƀ)�(BS����y���_���S:ԯ7\#�Z�/L8���y�e�qޖ��?el8��+zu�ԃ�=\̏k�c���o�(�"[�%�~�o�-%��f?�*�3�C �8�GT���D�������.�Q�rva@1p� �|��9��$=�?��.X��Z������[�X�IL�+�z�eW�z}��>)�#jF�Q|W�.��U��ae�!D� ��
�0Ҟ�᪅�%�j�@�h�Vf4�Zu���pI#U
A˨�<��O���~�S&1H1��7o�h�He�еH�;�W������5Ҽݠ���z�-4W��`*�� ��wUQL�ZY��j1�ħ��Wo�[�%�v��
�0��+���F�zS�*��1FL�HOL����9h7��P|`�R�����2��w6��xn-��k�@�Ȗ=�Bf8��8�T\?�&��ԝ�� uG�B�O/�n�g�#9��b�W��],���3?d�YIW� 4�͐��Q��|��_�DK�/.�����1J�c�UHߦ�wȍ^_ℇ�#M��(���HTjV>*������e�O�xE?��B�P�S�����(�$���Ho��wet��4o)`�9
v<iL�ǜH[T�����[i	�����Q�Gt��`�&2��� �I�F��4���Q��l#�B
w��5�ٺ�5��=��� �y%M����V��Z���M4�W�g',�&"�Tō8
�Su1WSl.6�և��R����"Rzz����9[�6J��{��d��{���H���� �;zQ� �@Gkr�����Oo�B��`����.�]��v*�Uث�Wb��]��v*�U���*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W�� ���t�w�iP�Y�� ��]��G�]���>/<�G���xC�C|�����h����s[,����������p�Pr� �΃���$7$X�E�ժ�����nǎ�F�@gc�t����G�����I$�ż�J���v Գ�3+I;�y��F����h�V���T�[I$�*󕄵� u�c��Y���زg9%�-��J1�N��>`�� ��v�>F8C���5j*�
�tt�����%$��1�|Lw$�I��b�+I��`�W%ĩ�M2^!B�NE9�|��˽io�1��O�)-8z�j	?~BSݘ�UKK�4
wȜ��"��C�d�*>��M>E��5� �M�U��/�Qi�y�7��2�0~b+�d���C
������B<��+���qn�7gi� <I4�� �_ �G�MNY��+�In֌Qn")ņ�~T�_����a�дc�S��d1�$iV�����Gn%�c,�<�-P��ȭ� �U��@ɤJ�w3_����yə�H)I�e��%�+���o����� >?�|	� ��O�-��4[�f&�Z~���`���3�4��b9ln�Q��~#,�R��xSBȺ�dWB�n���d̢wؤFap��IM%�F�;~8���L���.��h�,z��4�#��]��~�������������$y4�o�E��P0�@�[�'�.�ecP�c�\�!ؖ14K����"K��a�Q��t�y���ڹ=����8�6'�H������ M_����e�O�!���\- һٺ�e&�Z
{�X�Zֆ1��	�:�m)�***;��Xk�z�JA=�d^ɬrH�Z{%_���HǹX"4A��HQ�Gˬa�l�+Qk(�q�L�o�T�#a��� 󊓽��d3ɼ��_H�ݒ��8�Le��XP�Uث�Wb��]��v*�Uث�Wb��_���*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wӿ��`��ZC�+�4��ZF�C�JL����w
����ɏ�˝9Xx�},����Ε~�7�)bV�R���߅5z�B2��o�<��r�6�%�5�R���o��vu��RJT����p�{3mGGk].G�k}.{��s�� �G��k������H�xbz��ҭ�ҿIL�,�6v�쨻z�jF�� 
#�uXa�"O&�V4�4�}���\QR�����,� V�;V���[�k����}�$�4D}�� ��[ fFC��`W���c�qH7�=V=�)W� p�H��k�j�8���1��)�LW�g��Vm�b'���Ě.�HA0#�B��	�Ot1y���#�NA?�IQ�Չ���B#�8J}YTw'��2�A���^���[pp� {� ������7r�Y[�c����rI,��N��c'�Z�^�S�E�P��S�rn���9T�H��F,B<�I�ލĤ|�������X�����ixF��� �H�� kbk�c���0��:���g�tF6�mhi��ɝ��c�d�U� ����"�6��h� ����줟'z�����	I�m��g_ב=��� ��<� [/!�-����x����w��:�!��i1Ǘ�i~���G6��LL�X[�I�g�fH�&H�9��w^S�.h7v��6?3�	a��.!���<נ\ן���-��-�d|���d� _��^8�jGyqk$���Z�H���},�Ɍ{nY���C��#�������X��F�U�WU�`�XT5�҇�߇n�K�A��4$�Q���Ӏ��2p��Ыs��4B��U)���Q�?���}�K�8�O�S+I��f��OOVX����U�
 k�NS�4q�eɌ� +_y'\H��ٕK3!v����MD���1D�̡IrvZ~��Ȋ�_�x��/J�5Nf��3B��ʤ(T�y1��\�,��?�7���3o,h�Ei���b���|�s�s�ד���P�ж`�p����p� �g�$��+���/5U���M��DB!���QG������r$6��U� 8����֨l�CȼΔ@��9.�]��v*�Uث�Wb��]��v*�U���*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W�� �:�6>}ӭ�#h��\5(�,�L��i���|���4c󘇗�-:�G��[F{�C�!�+ V?K�W��Jv����V����.Q�;���:cZ%��foP7�ʀ�/ԁמm��ڝv��Ec�f]8�^��UֵMOEѼ����n���*���
^g|�I���gԹ��_��0�lB\�h���6�ƱE;���7�ff�=��c��?��Ia�/.\�"�!�u��2i�zq�t"��?���br�N'	'�ae���0�܅��(��>"s���q��%r�ڇ������4��|dh��썓�i�1m�	U>Y���K���l��I����9�MqG����G	<Ѭ�ЃĀ@j�PS�eYܱF�/��*	�_����B���}�(�%���mK]Ԓw<�w���D �6��{����}��«/G���D�9�r�O0&�� y΀�� /&>(�[k�+��VI!�@O&�u;�\�XM��L�Y��Zoꩭ{�2GLK#-�W��.l$e��j���\�=1��hX���2Z]�/�\���f��ζ�^\]Y��P"�@ 5#���r8�)�~}��+c%?ȑ�X{=�+�� �XzZ��Х?�g��,�ZR���N�P�ғ��ב��uL�J"?�����]T�.���k�஬�}�{�=莥[ԍ�VW���2q�{��K�kF�UT�#^K���(Sdf��)�F��1<@V��Y��n��dzt7
#F'��]� ��Q ��ٺ�U|lE]�_�_㙙�1�2A��yc[[mAc�**"e �J�3�Lr�1ݙ^Oh��XF�0-pZ���(Ǥ�wѮ��f���^ �� @"Fm�a�n�'Ӹc�ޑ��PP x�`6=:fn�L8vh��l3�\�l��I�k���a��#�Z���J�����d�(hC���4��=�v^���~�i�i�[iWz����<EV%�EYC1c��ja9"#|,�J&[2�� ��W���63۴�T9A�~����V��rb<b\Mr���8��բx����#%H_�����Ӝ`*ڌ"z��M��4�.j:m��K{u��zd�T��= ��LŞQ,������(l����>W��in!�~�fP�Y�" ޜ�:��ǩ�"��'��i�:��G��[��MZ�E{�1_$�id�QB����͆� ��2�� �q@�~s�9��+�� 	�R6\r�<���v*�Uث�Wb��]��v*�Uث���*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W՟�����e�jK����D��j�r?d������i���G���\�����$�s�&���Rc4����?g(8�v���,f7&1樦3-Vx��<gb�8��~̭6�8���11H ��q*h�:�� �́_{��g�˷�h��k�b���r��?��
��6Q�I����� 8����� �|�a�	D�U��
\'*�n+���k59|,R�FC� 5/�'~j�4�-y�,����K��U�*M~T��n�>��ǋ��ID�YW?�Zѷ�����ϧ���ͤ�M��� N���H�G��L�٨��4CyI���#�4�%7��Lr#���bq���K���������x�K4�(F�ޚ��7�irz�<��_��Z�Ɖ���$���V��,����%�E}(���CI�ܿv�͞q���Yx�$��F� ���*˩���u��֪)_�FuzLc,D��\sxf���,�1���B~{�"x��$q��m)��`���f�4G� ��gZ���ӳ���>�� ~�������4^�w�uz��^��7�/����M�F�y-~'la�ۏ���"8������fc+;+73M��l5OG����e�'�!�K��晣��	��r���G�)�\�����+x�f��6�:��sT���?�u��7E����2��Wj����CE�CwW-VJ٦���My� 9t�Z;7O��j:��� Q�U<@;PW|��8cB�U9%ޓ��a�6(� ~������1�r�ݭ�6�HT����1xM�_��7Q��n�ͻp�6#�^��#�"[�JQ,�<��jV��Yƪ��xĲH� �»ƫ���d9Cd-&��v��sR�Z��ߨ�dc�wG��4�#M���4�R��I}q#(
���)6�C�_F��7��u�=5^�Q�E�ӝ�� ���r��nogh�S��Wq�j/�z��*�d�x=GJ�ӯq�C?��;Y��8����o��1�`Bܫ��z���J��qu��5k�����'�!#*׈o�����>�#M��)���5˛�a&Vy"�k��m�z��E�v��8��%��؇i��K'��J҂ʒFH�E���?NY=~^N���e<����82I��#�(i���K� \���9vW��Z���5�l�h��W����Ϥ������ii��������س�9���}h$OP�5V���Kg	�Ӊ�z=�c��3�7>`����6h`��Չ#�lz���8�7fR����j���Q��1i��qq(�#{�Lz�3�81g#�:�� ��C�9��H�o���[hn�'�����">�)g�eO��Lc��#v̱��&��{=���цB}P
�/,� �;q��N_��̳*R,�����%�t�{�����U��E*�n	p�7�H�O�r8��l��� �E���[IX���H�I�߀��<7b��]��v*�Uث�Wb��]��v*� ���� �~�Uޜ��~�Uޜ��~�Un*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��l+���*��r�d̭25b��;`�mV��:�AJdIgo9���Zͅ�ܟV����y��cG��!�;�*��+��m�
W��M� y�Z38��7k(e(�(2�n*�
a�(������RѼ˦�[o�G�Z2�m��|bR ��5^�����pi�.�/�ef$��丑��4���~���3��Z{7'�"9$V�8.y�J<<�0J�B�QO�����`���j�D�O�ɯ�3Ca�X�+� umhZ�z�BSQ_��#��ECnHn����N�DBjx�zPu�6Q�^0;��2k�%�BZ��i3��{[y�d-�#`7� ����u2��]��Z�Ooj-�U�MUL�?�1f�4���� �����O 3 ?�?�-֣s29�B�P�7"hw�Fsyb	ܗvg(����Q�BP��޲��ԍ�µ�j9�쌑��?�� |���<%��hZ=����qBc��Qh+]�Y��	n\�>h�n����n���)����Q�PPg/�1�=�d��o��B��^�+WEi��
�A��*�uu��^ 0#w��0k�޶�ar�qpY�G%b^D�^Ǯl<g ���Y�����M#FGf��KQ���_R(�X�1aּ��r�;>~�g�z�t�DϠb�ol'�f�kb> �Nh�x�q��S��IQlē,�rGubۑ�v͜����e#����Y�W��x���b�r�֡J,r5H�k��f�/�����R"�K���1̣bQ�M���yk��j�L�e���q}��C�c��>�����FH�*��Sx�l�$8q =?���d��@���e�g��Ԇ�����U���d��6��%V��B�����.�6�5=�|;���:��b������]�g[([��VJt�KU��f,b1��^fBbTzg����6[�A�ڰY�g� �@�w4ʥ�4M7���ߔ�Sio�{�sujj�vj2Peٙs �E�#V��C�1�:b�۬�����sQ^<v�^���i5���p� Y�� ����i�T�m�3�+B�o�@ ��3�M=�MVV����y��'��eU��h�q�u9���H�O�3��1f��ta�X ���⌜�a:���qP���7 PS��П�3]�y��]�h�?��s���B�U����wtfE1�XK#֦�͉;�k_ՎI~����ߕ2;y�|\9W��?	�v~��90�.pyk���8��q�cvуusɭ��"���h3���e1�w�����j�P�*Zg¿1CO�0A����� ����wP\����U?�^���P�fxq�w�FY��V6������=ǩH���g\1�+y5�J� IIs-�=iq�l �(�����N4K~av�Z�����b��O���3�=G�q0����`o?��J��?-� -���r}F��������D�ƒG ��ϔ��8	b��̿��h��>��ɱ�M;���+��z7���� �lKN� �A��� ���� #��%�Р�e� ��F� ��_�M��i��(?�_�sѿ�}���`�Zw�
�W�\�o�u� d��-;���/��Z7���� �l<KN� �A��� ���� #��ӿ�P2�������&ǉi��(?��rѿ�}���a�ZyW�����;���\��k�K֒ٙ�>�I2�gX��ȵ�}�bmH��
�����E.�]��2Hv*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��-k��RF� �T�w����M��6�j�,q��P\O�s�J��k��s[`}/��nf3L�I�4,Ǘ#ʇ������C���.U��G"����r*�� �G���ʅ*�n��-"��ۏ�4��J�_v�g�0K&`���Í>󮢗ڄ�ƾ�'�:�"�7�7��i� ��1�� �4)rz�ؓ֯��c�d,I��΢?�����$��4����D���5��4�Nѡ04g�`���n��~"��0`�K�A�>T�����Ȣ��i�u����9�?��u��H�� 9�k�1�IO�.y���ă�Ji��a� ͘ݢh
��od�)%yt�����ߥs���ܓ��>K�����!�a:���K#(b�i�/�V᚟���Ie�d��Qf��([>���IH�_�z��ACAǍ3o�9��rq��J\Q����&���E����e�; PE��?��Z�$H���K���VHDz�K� 7҅�^�m���Q��oLȬ����]�_�<9�L��5��gOG�1'�s���T��խ���X�yLI�y_���3f~�M�>'Y��HφL�f�j!��pT��)��6$���1#$�{��#3���Σt��]�~�Amk+}V8�g���X�S��ʴC1Ď��d��x��T_U��z�T����6&�?���x�-�ie^�Ho�/�+1��!��Mј[��,�Z���9 �� ?�|���d�*it�>(��et9�a���,��%�'������&����2��P*���{>c���?̏ҝfpJ�]FC�]\��{p'���}5���nw�i3�>�z����ń�G�� ��;�>}NY�d�85�VI�Q�ʧ�ܳ��c�I;��==L��cV�G��D˩��Ą���:_U>{�1	�FE���[���H�g��jV�����:���M���z���� )4$��;z�1Fy���6P�>K�@�'�@G����b,�wC���Cz��z�&�,���j��\�,����PO"��K�=*]-���j� �,�I� ��{2k����+qw,r��8�d1�u^[��m	l�����L��,{u��FIO��Jw4%kN=2�2�צ��+y���V%A1Im��;�,��� W1� .�S��� ��W3�ē����r��FV��fp�����Ƶ�S�6���.�3�?�N-��R9+���?�}�<8��o��}��ǒ?�?[���n밖Mߺ�z��sK���v6�i��q$��6wf�%��>��RE�	�D���i��sF�Whq�!���%����2I,+(@W��;�����)2�T[�.x�̰ZD�HP�w���`�h�rK�Z��m����iډ���^b�2�l��4����w���wݥv���ē��	s{��W�NK_���� �xPC����=#R�&������h�a�8�����cn)*�3pv�K������[�����]�a����Jڵ�Vw�9K�ʢ�R-�Q>.>���֊R?*~jk���<�ws{	�4�>}gJxV2-��-kxYx�yl�◚�/���XiS�,��^��/����ȶ��Q^/�-QW��8b���"W��:�:�������X�y����6��[�w􅶧���u�\[�F���Y!�X)9��I��S�Ǌ���cX��+�n����ԭ-kXa��ҙ���9�H���?!X������|��_��G@��l_P����dC�M
'՚9������~U�Ku�_0y�]�lu�4;+TAk��O=�FoRSu�`A�#TgoW���i�u�C^�����k�;��^L�w[��4Y}.�Ê�\Uث����/��>b� �/���$�<*�U���E.��¨o�I�0��i<F6�w՟�~?�Zw՟�~8��i<F6��I�1�wդ��6�8Uث�Wb��]��v*��;(`EM.���#Zw՟�~8��i<G㍫��'��q���	������G����bݏFS��i�uRĊmT�Wb��]��THY�A�]�i<F6����Z�zt�R�/��I]?34�V >�j�<G�.��-�!}JoZ�bWtd����Fh�Ԍ�QH;UI)��L�l��v^����(��M7�ۖu��������v�K��]�L^�aZ���n�5��>,���� Cd�ɱ��Ee�$��?�dv&���v����e�����r2�6���0~"��}�f��[����� ����V,�v> ��92!B�ae�i�N�Y�F��dB~D������O>'E�� ��b�y�V�]�$C!/�ĩ�TPP�j;O(�!��\xq���R���Q����/i���������l�fun��8�?�����m2�ז�^����F���������w�f����� �4;�B4d~}?��|���s��q�a-Ų�c�S˒���|_fi�e3J��Ì���V}i���s��"w#m��sb0�(�'�X�\�K�.�!�Z�`��En]k�m 09>�j�L�>�G�u�F	�K���TH��+���X훭$�rT�V�z�N;��ǘuZ�h2�W������Z�O@~/��Yvlq����͸u&�v5�M/����H��tbI���Y�5��\R�?QE� �����JăчL���Q̖1�K��ի9 �_�eG��7'!8�أ���	����S@G�l̆�L4��T]��u,Ȓ�o0G��;��7�؜��ؽ�ڜv�T�b��V[���ȅ��o�%��BY	��NiJ�$F��-�1E"�咆�ea�.�<s��l���Q����K��+�m�}z��2Dm!
��h�� >�&?������O��Cy�?��{���� 9�_ysDK�{yc%gYh�1߈$�_�9��G�� �yA��ko lm�fe~:�zJz�?ᰝ>Ʒ��-�C���=�����Q���紱�� �gX�EO���ɘ�����&H��=r�s����c�?�e��?�6������q�\���E
��K1�Ha���Ξg���]CT����fҮ�b$� ̄��|$�ztl�8a)�g�:{������=j�T�T�8.�)=(�7$*���[#���\���e�'���<���.��3��!I�1/��8� 7��t��rN�kf�C�C�i��V�=�Q�<�	�D2,�j;��F|�� �g���C��VO&y���n���H�w߸c�1�pw:��!��B��m��]���N�8�oGT��kc��a���0�WP�������_��d�;q�.��J�_�� |Ʈy^��ʟ*��8���g�OOm����:�֗oI�C�ԏ��U�T5������##V�j �+�����>E�10�#���� ��kS��Q�:�����hat�l�P��/�:,��h����7#�!W�7�=A03���� ��R;_���{�+��Qd���Y
����9S)���\�G��&�0�+i�h�YM$%��
ӥ���lr�T��=O�qJ4O�+:O�o;S��2؛qs@��q��''���?5_���7�K��\] d[�YQRb��J��qn_�E�� *!l�+i��axux���.�5ϭ\IL]!���wH��Xӊ��dwT�X�� %�y���̺CKq�\i2jv�󳺧�(G��i?g�Q���.�厺|Ǣ���m䳵���"	)�z��^_c�����,�_�L���/3i����qgִ�[���^%�hanN�G���uM|���/0ح����-b�h�b��V��T�#Tt�)�ԯ�-�*]ou������d�k���\k)qs; UC$�N��
��yq\wUmkW����Ԧ�n�k�<"�{�il�X���`�?P)-×ğ���i>x�����m3M�.�kah�;hP��7�)'��?7�ƕ� +?�����n��B׷��ƕ��Yߖ����F�~��� ��Ҿ8�� �4�S�s^��.ᾱ�꾍մ�,O��n.��qee4���y)y�;���E,��� �>}�������{`�ѭ�4aK��/���Z�����\?	��˒s�'�̔��R��<#�6����� ĳ����כ|��)j1�����]��]d	"�BGQ���<X�Fܿ�N<�:>��kW�a�Y�z�ζ�/7*��h;.dO$`8������U�?�-j�$����g�K�r�T~e���:�?��p*i������.m�-ne�������sD⌮���x�Ό� �E��oo�R��	.����T��Mjq��E�J)<��������m/�Ӕ�V#�Q��2y+̎�WH�$��W�#�:�:?5�)}֗5�̖�QIoq�$2�.��H������i^E�F�ͥ�����xM,��44zq?~U�S��!��ɑ�~A�i^S��4 ��đG�ڹ��������-�O3�'��󋟘�/)������� �S����F9/�d��;�.?��3b���X�Y#��R�������Y#�`~l�?�������Z�i]y���H��$n⹷��jaǌ�����IDj�¯$�B��RI�  �̻�`��7�qk�Si�\�����ƲIg)��e�x1ǒ��?k9i�[�1�?���Tt�+� �V�� � -�u<y�� 4�� E�_�'�Bk� �tѴ+�ZK�;������P�ț��*|�O�6�.X�	3id�<����:;q�'�������?)��� ���S�vsL�<$���gf�W���jOÞw�V\���R�1�J.�Kc�e_�O*���l�� y�� �s���o���<� [�qǹ�� ��F��i�����,��r�}^5��S��;�d3�q��2�}G���@D�|�]ȡbG�s�pV⪰įZ�jR�	�N|��y|��M3D��e�.
�UT���~�rl�\�2?�8��>�o��� ˊ�:��@h�j�\g�d��P$xc���;O�-���{�7��g�T�j�;U���J^��bh���h�޲o��� !� �5O�2��������kƽ~,��7�Ç��������|�{�\�w�Zu�����gC��������1��Ul��!ثۿ�0��������V��4�..�J���Q��F�3�����Q��O%�~#����� 9�c�J"������F�VoJ�2���]��/�� ��B�63�D�2��k2�ܝ�*�b�w�xXD|�l^L�G���}na��a��/����F��E�����1��QFd� �s/�f���\�%��kH�u�Y�,ENb��Q �rtѨ!��{���uV �F������TE
?�(P� �P���C0�_����1�t�� ��y��R�rB�kWzn���@�mvd �B �V�����vD��Z�֓Q�3�����)F��I;��س�3w'�ݪ���<�iʑ��	�Di��IPBk�ک1�ٝyg]�B�"����TS2���B�W���-��"q��b�Sl}[Q}_R���	
�2ȜB������S���4��鱘��az��X�D����5�4i�Jfs2=V�x�n&���o�-����\HG>�yN�ђ)λ��Bw˥�B[�e`)=t�|1�+Ev�� Jv	����=��$g֍V�&��%F繏�v�y��q#dD
Hn�0ȼ��hA���) QC�"��T�je�M�`�2
�(	&��fV,�� oG�����D��\��U��V�>��<��>#��%�v�gCϭ�օ��J�_���:���}R6y[���.� n��?�'fOQ���]����������ˈ��m}(H��zV~���^��KqB��x�Y&dy$W!u���z�v�8f�\�����U�̙i��� d�F0��z��������X����(�T� d?~�s�Iŧ8��K��F]������9���ݞ�d�[-���CiP�����iy���-�y� L�?���eה�	���O:躮���x���2��*��w�O��7Y�zs�-޻Kf���uԢ�՝c����o�`MX��aC���}��,�xļ��V������H��������'�}��-�f�����v�		�G��y�_�޻e���3���$�M.�0��t �W�.�o���H�H�Ն<�"$�0>�%6�����aW�"P�hO�CC����
z,�xH���8�-�������F��HY�;�r�J��r�����O[ꠥu�]GL���Xؤ�I P�i��zCs��P8���V�i��B���OL���e�a�:�h&8��Jnuɗ�׮k�L����Gg��q䙚�L�%h沗�c���?g~U#9}f2%cw;6�vJ��5��qx ��I�����_+�J~��i�ڟ��I�;O+n�Y�g ���#z�N<" o']�����Ť�z���%r�WIu��7NG�(�2����^�扔�R� 9�+�-�f��1���
>av�k���o�1� �S���%����:� �ǎl�+uY���H� �|��8���L��׬a�%��VXi*\@��B��$qǗ�q��� ���o��~����FFʻ����[����� ���e]� B��-� R���� U��Wж�KԻ�}v���0YWз~Ko� :��>_� �|l���[%��]�� {/� �*����o��~����F*����m� �]� ��� ����w�o��K�� �e� �W�e]� B��-� R������(�e_*~v�kE���~��h�� T�->��{~rI�Դ�W��gsWv?a�%,$�b����l�K�/��M@��mcOcSe��Qɸ���s������蓛�;�ى�a�y�s�-� �S��ߴ�㦧�#g�{�����PS� �Y�2�e�\�Ŧ�pď
��y��̜:I�&��T|]�Fy`dv�	�I�lr(|�� 9��ߘ�_"q�֢[Š����1���z���J"~�~����j�R���� �>�V7��q�mZ.:��<N7��m���o�� ��9��Q�$�g��%��#K��E�!����2���L�k����_������bƧ��P�.����H�|�Q}� 8ת=��<Vŉ:v�s ��~.���e��'���ўoO$v���Nqy����?�z����������n^�ě�!@���Jg}�݅��i��_���ps�eA�Q�ç~a�z�bt�BËKm�z���P�z�0�o�/��%x���_�o����͋� �Siz|�H�����Z\�&��d�����r��d2�j%���k 1��7�q��u��ml_���q�܏�>�������� uf�ڎ��p�Q>��� ����qY��>�����4��_R~v��7NO��+O���#8�������� Ĺ�����_����.�[;�Xl/�H��kŭ��~�$�mN_����N�c���崿�/��V�7����*��:���WSѕ������ ���;���/%I�;_�!H�v�Μ硷��P�c=�5�S��� ��������"�~��3h�i~BO�~M�p֦?�ǿ�˟�{�{��|��ls�s� 9j�?���_׸ �BVv�Ɵ^Os���4g|띊�-k��RD�/y�{�:^�B"����uv��a^�?v�쳒����<^O�W��&+<E�֥��V7Z�� ��M��n�*����1�Fq����]LD�Ꮺ���3<�Fϛ�)�<��O�>�/1^��a�����d,Z��?�G;_i{,e��D~��3�7M��Q},� �B;g��پe� ���9�׭��i���7�-�cf?���{'�"x�}X���K�!�����ι�B�Z��9t��=��sW�V���	��������H<�G��-"X�M#��$�h��$��0���N �b�7�4����mo�L�񝤠�/� ��_��c���Y��>.`O,W� iԚ�,���|Z�^�,s�������==I����d��qq�/�&_�,8��yuռ�_M
�6-�|�Pp���AD�v�� ���Ue�R,'�W�Kz���A�-�����ξ��0�9�J�F��E7<�aA*�r4|G�\�ť�.�FL� 
��������vMBۙ� �\9go�)�	e憻��~��!X���"�H�	c��]� ���ӓ�I
K�o���K�,d�RRM(	����ݦ�ȣ\F�r�۾D�̢�Zi�Jʉ�o�S�����$���^�p�%��� T�
Ȼ��qv�&�pᕅW�2Kqi�H�YH܌kPM�4�¤��S����q��_6:�N��kH!�_n��t���'�&�D�u	�*h��l��y2���� ��`1[�;�u~�V���%Em\Zݪ�az��ze��ά �0!{�u�y)b ]�r&&��ُ,�'�X�t}I�o��k8%�G,*���בΪ:x��]W�g�,���'�U��2�?���T��.��S�X���&Z_1!��N�z=���kޔ�m���d������_�o�sA^�}��0�Y��Z�)���p�<����	ea��|#�t:����4:9g�a��y��5�Z}F{X����&b'�x�#�����S��-���.��})�����$�O�,̥�������Nh_׹v���ƀ�C6�{q7֖wk��Vn@�o���!��I����@�{=��)�@(�Aޞ9�����z��Ԉ�na��9�I��*�A!*��r���	����#P�(�a5����I�E�V�8�� ��W�v5��_��$��_Y�5�rc�O���:L�*d�<�:�|@�>Y*h�)��O,.�GC�~�\�� '��;vc�6�\���rHw�	��5��?x�4�����<�lf�w����Iz�f`8�r;F�8��T��5��#��Ԯ; 2w?�W�O&��t��ϕ��<���������T���M	�a�2����n�u(u1��Be1H9ƞ�?aI�~�˃�<=�狉�q�nm���4��m��܏�Ҁ�q� ��;J}Cҿ������B>��J���;�0��gԜ��c���`��u�1_ٯ��6�-���2^��ZAl�>3H����.3���}[C���/���.R�EkV�Y'��f��Y�O"��/���e��C�k�7�5_?j:%�z��o�H�強>�X�c�>e�Xٸ3q劥����X�#�%�\5��6ǧ?�n#��%7A	�.>���� v�S����	ӏ��.��"�:I�1�}`��k�Y���G�zL}�_�4��,U=ӵ{=<I�⭡� ��yy-�k!���D��T�ĲYz���z����y�L��Ş����y�J���N%/`u���}R��Fj� Ǿ*���k���f�֋���ɶV�����m�"�FU�byF?;h��I"{�nG��MR�0S�0-Ϩ�q����<
��E[yAt�kS��/ѵ�m$C�z�1��N\��?[l%P6�Q�>���?�Ms��飪�̧�� ������m�}�-��w�rK� 'O������ ��<*�U���E/�?�nK�s�ߥg-?�"���ߵ#��Z_��-S�<��vo��*Ҟt�$�m:�蕆z/����� z�u������,��6����oc�beo�����^�i#rO>� 2<��{ʗZ=ܑE�Y�m�;���zr�a��d4��2"8x��m�L�b�Ԭ5}6�Y�\I�jP�ͫ�q^'�O�sGۺ���3���%����)�<����R�ouh�ߡ'k�b"�'%��@p���(���ɥ��>y+����$G�%&���s��I��[K�5i>f��n��/�}.��~˴J	u� $����_��`�9}Y�� 5�n"Bp����斛�~wؽ�様�=i��=�hճ׻ ��#�������?��	d>N�'��� d��,�"3Q���ͺO�����ǣ������/�ot;˫P�'�&��1ȖJWo��u�ٽ�1�3,q����.L���0}[��W���o}�H��d"Z��%��k��ٵ���8��L��?��Y�F?Hy����o<��,��j�m�oinh]�wbvf��:<Z}7g�2��~���*q���T��A�4�H�Ѵ��++(�0������S������jr����qÆ4��,��������K�F���*;��B1`Í{e��ڙt�2�^��?�91	�؏�� !���=z�[�n�}mˊ�,f7WYBJA��o���8�9�|2���y�4щ��֙�o���@y�O�?�V1��4Ei� |R۝�܊z��/�=�t��%��_��w��6�ls�nw�á�O���?�
��=���J�vM?d�k����� l~�a���^@�{��>|� ��a�/-�h�L>��;�c���֝��� �S;�^�[�0D��)�VM��C�~h��mj�pܮ��0&���ꍗ����꣇�/�,�M��^�c�i��V����5��!�Tw�f���g�k5r�e9%�N�wz:�ٽ�吺����G�'�Xql�.����_є}?�Q�K�>S�ud���yC`�����\�~[��7��� k�c��$�Ċǐ��w�ig��F2�Q���|�o7yb��>\�Я��^GE��r�}ѷ̝�Zl��q� d�����^����\�z�����k���qFO�s����f��~�O(��H�� 쿎e0{���2/�6�pU}#�[ <�"D��*S��� �n�R��K�4yb�����Ϧ�	�YzQr�ɶ$p����}���E��w>���gGS2s����n(����L��&�R��}���u����b"�fh��3Fk���_l�s���Q�C��,j��yy<oVJ
nI&�����C�OK�<#xxTn-I���*bcV��Զ���a�G(J��M���ݫ����+��E��f�W��kTq��!Ǡ��V��n4��cog�_TzzV������ ��߂8�'�H$nmIm9�V3J��}�#�s+؆" #cF*��h�ubD�]�� �%�q��W�e��}#U��VX�8P֬��Aߟ�:y�����?I�n($M<Zr�;e��i�r���-� ���� K��8��pK�ZH����AcF�0�� �8�)�� M6�BQ���G�5�pD�"M���j�kP��~�5�te�\�ᙽ;H�iB�Pesԉr�x	h\_���:�A���� 
|2��{��(��2�э=y�M�Z
eR��Z+=7�����-��W t�6X%>��DCq��|�{��He�ː$@�{[%��K1�;�?�rY�k�5��r�x���A��"|���^��)V�Toטg�e�\\����)R�=b��HCB�
��ʚJ����U��K
;��5�Kv� U���������=�O���n����猥¬lMdn$r�9P���G��"��-�+J���H�C��x�ꦊ�����fL����1��z^ٰ��F=��
v��X�� Bj��)��H�ǡ5����kψG��꫃B=�û�0m�`��/��_����e.���P�V������pԙo��-�	�/�A��OZp^�M3��C0<]O��q�5HIC�&Ԯ%��L�������sݡ;��w���b����㺴�J�[�����aNU ���c���W��%J9;�x#39�����ʊ�ӿ�,U.n�� U 
 2���L����N��ؿ����K_���� �yP�?.�15�!ksk:E������j�z�IF�99(��na�ZX��7������9Ҝ��uZu��ӂ�h� ����Td]'D���懗]���+�� ���ŉqiZ$q����F� +�iZ� �������:'�Jz_W���}gV��r��Qc]'D�8�����J��J��]�c����<��.�)Q���+G�r��󮓢 �!6�_�� I�ƕ�� �\�bĂ8��8��E�� |��ƕN/��>����4�V���
w�8ү�ߘbc0�tA12�^���4�.�5/8����z�P�{}�z�[+�Cщ!^!�F�1�j� k	%"��_���D��W��m��i��Df������g-�fN0Η�r�c����ߞf����t���.�(�+I���Z� �c��?��.�Y�3� ��ko�R� w��ĎGq�.S퉑������rXG�� K�ۂMZ+��R�g�����c��#x�F��M�0��y�k��-�^���)������ =3m�gx�	T=Qj�d�S�	�s�Za.�ga�� �� �M�o)���������S�E �_�����s��k�<|�r����J����+���%j/�|˦u6�6�(�X�O�gQ�^��Mq�\]!��"h*y��|�� 9G�}_��w�Qo��4.P� ²�{#���?̙��V*OF� �^�{˫۲)��M���S�$͘�����=��Ge�Q��W�ޣ��`k��o�<�l���]���/�O�����	���ܺl��R��:׏zu��e0}=� 8���.h�W}~�U�ְĘd��e��SEFV`VI�� �3���M��B�w/Lc�7�y����_�V����vw7vP�E�)���*��0�����9�9�2��w��93�D��p�� ����aX����vq����������N��zN� �����w�j�m:��)n좂�%�pd��"�ƕ_�����@�.�؊�Y���η7Q��� %Z920#���Y�=��yF1���v?K�ǔͿ���L-N��}��X�~s��I����'���yO��l�	�k,�[��D7d���7���v�.L e91���'W� �=��q���X)���� �9�l���.^��z`#�:��\�-日ߔ��]�U1zѤ�k׏ i\�l���B%y��B�c�4�Ec�5�uO3$p�x�l�xTm�4�2�?�M���?���:� ��5��W]�5K�%�,�h�"8І���l��GeKW��.����!��0�ɦ[�� �H~Xɤ_����Z�Qf��0b�F@�隨{R���z��������y,�q�^�w/�ח�$��^T�;xc�@ lI����Z��cr�$I�ذpj�����W�^V���&��]3R�<�e������Z\I�E�?�ۈg�5� [8���w&|�x�?�9ص"�*_�?�h�ך�ڟ�%ԙ���Z���3��ſ?���a�,�/�Q�떬!��XeA<ѽFQ�D�s��.�ͣ���%���͐Op����/�����C� !;L�A����.p�Zy.�园A}y	��IP�ʤ��-�=?f�`m����nͬE��� ��^Aa�9��Dm�x/�uŎ B%�j�L��\ȍP�}3���*>g)�g���a5���MJ��Ѷ�y�jE=�r�v�q���)XHg���f�#?��\��L�|q�>K�Hx�!�do� �d|H��%;(�>>���q�!�P92A����O��2qK��&�����&�6R����w���3[�p ؕ��l1b�f� nϟ��� M� C�e��a�.Q�RU�G�:d/�?��qd�y��� �����o��-�h���J��i�cd���}�LqG����I.m2gz�r�o�3
�'!�d��&W� ��Uc��M}IGrT� ��G���� E��6�xhǽi�r��@9p�܌3�ܨ�-�Tz��*ǥ�ޅ2˒�#��FB� �sJ��;�	�X ��t�:��2�$/�\���/H���hU�ʜ���ڹdq��g	�����-^(p�z��FP�$���'�dN �/D�~�`�R2�B?����u49�e�k����6�yL��e)
�Tڌ���%bCW�:d�4�9 ��+0k~\N��sZf�0W��W׳�okf�4�Z��|2�a�fI����}���3�e`l}$�<��Tp�D0�J��.�HD���:�v��$��W>���+p2���Z7��9lL�O
=�+.4�(T�g�F	�r�z�@��m���O˷ᐬg�	\z2��2$��� O#ɏ�y�&d�V; 
d3�n9J{���j=+ei9!ؚ}�BC�,�G?h�jk�!�/�!eة�jP�9A����1�Q���J���Á�"j�?�L���vzi� 
�B��a�/�;e^�v��&;�Z���:/Č}E���33�<�ia��G��[nk�8$������^�� 8�� ����`o?��*��ⶫ��>y��-Fu�����$����P]Z�퀫�k/?�R�J�uHoY�0�Gַ��X��	Ɠ�d��>1����dR�ɭ�q��Y<Ժ��Ilc�� �HUZCZq^*����?���%�{�_j�c�_[���Ծ�ˏ���Oꞧ?���˟���TF��*i�~���_����p�z����Jw�ʩ^<���/�9'����*�Ǭ���h���Q����hB�����Wh��9s�yq㊤���G��mJ�Nԯ^�DIn���OI-J4��M|��rb����/i��j7���s��'��,� ��Jp>�~���U,�?2|��k?�o&�]H׌1���
�$�@񺧨���9|XҮo�o)�^]!f����i0�O��$���iだ伛�⿵�*����-���忦��[�3�1�qOF).�rK�xF�*���rK� 'O������ �/3b����D������7����J�_�㰼�P3,E$�Ib0��*��� �sݿ�Y5��`@��9|��_��/�Xߊ��L)��p?�ʟ�4p�:dz�>����x���?�7����/��'���s�-	Q!hMA�9��'c�K�_�.>|�t�|������='C��ӑ�E�E���BƬ��;L0���m/����-��:�ڒZ�ku�����/Zd��y �R�.y�U���k�i7i�Y�;y�U�N����B��l^��������k!����ԣ0fi�8G�+h�.�#��/0��R�Q��K�x~��B�9�+�j�r�\xA��?�a)s*M�ƽ��r-gB�]G�ȍ�E4g�r�h�뜺Pn����� �U~d3ZL$� -�/�����ؚN~?�Ÿ�{���w���-������������-^k����>�X�����)�̧M���<���,E��%��q�(ii�MÏ���^�A�9$D���rF/������f�>�m������8�O�.��j��Ω�]�r!����t���E(����]�>���~��N�pf	,U�RO�?~*�Nm|��H#��]�m��BEWs�*���� QႂmN��^h��Ӹ�/����%��+�B�
�o.%b'�����_��+l� �ߝ�y򆆺.�qh�+Ϋ=�s8y)��n�f&�E�7����Q��"������S� ������G�>��N�C?]�����5A�E���Ӈ�+M����|i��?�_���S�+;���7��?҅�޵��$?7ڟ�^OKq� a���d?ү�.��^�Mqq=��s��F�f 
��Y��h�t@������w�c�?�4�}f?�a��}b*׉��b�����ﬧ�ƕG��9v�_�$���6Zt���7\	M�{�'��+Վ����c2��mY	�q�o5iz>��w�żζ�����U͡�.&M4��ǵ�NB�[�}h��X�;ORx���"y9p��'��m$1r�I�(�"Gʠf,ĸiȟ5;���t�D�6a��ǥr�G�T�%fw�	���ʬ@Q�e ���1D�6����k��Ȍ�܊=�^i�N6��켘����\�ũ�:0�9��� b������S�jkRN��$kq�j����-wF�rϦZܚPG23�Qۋ����o��t�zM�k:d�ʖ��j���&��Mrqͧ�`@��R�Ƙ̠:��V��Hg���e��Ħn4���DȬ:ץEw������k!���	��	N%�J���|~�?��ڛ��h���@H
� �'"|�Pr-t��~0�ױ�A����|��ɗ_&�ZS+8'�����c��� L�<�@�����A�W�.ܟ��p�x?�/�H�p� L�F����<EZ��r㕁������]���e�ڴ+��n�FXq��-|r�m#�⌷s�9V�� Ì��S�.匰� zhv�**9�Ek���Ԙ�W�M�V�I�*��R��/�_ci���)�K�Ϩ졶��8a �|��I����l��� ~a���FSܦрǃƀuOP�>���?�� L��+�[��� W]Ԭ��+�����陌ȯ���(����̆�=G�uʎ���ch��$�O)%٘������o��?�I���漙��m�pdsG�ҧ������С��0d2�UB>#'�U{�ʼ|�Nh����@��T�_�����xK���$�h���3J�2���4в��с���\���t\��MIQ]�f^4o�!�j�_c�v��[H�D�KDG�c���\�pӵ��X�L��$���bA�2�~-P��e����q���j�JQ�:V���K�c�=B���i�P�z����6���;t�t��M��MH���f� �H� ��i� 07��oI�!���SY�����$�#���aF/�̊���ӗ�f��� z����K*��O.y��!�[O�tG�Ь����Q��[έ��� ic�Ŀm��>9BS�?%�Vn򾠷7��֖��޵��*@�E@��G6V�<��c���7�3�i�_��6�=K�zn]����W��=/���Y� #�©��?/ug�Ӓ'���c��~%��C5�IN�J�ۿ�� �,
�~Sy{�zm��{�d����0 �Ӡ[Xb������1*����5��<��/.�j�떖��\�-��2���Y�k"� w�*�j� �~g�,��/�s����,-o�/XO�I�Y�Dx�o�+��Y��j�,m<ɨy�ɺ֥`ַ�F�����n��	�˓C7��$Ѭ��'�:���:��^kso-��cNheH�<��:M��)��8�Y�yK���mN}'K��5+�V��o4藖i"Rk�[�L�sJ���TG��r¯ � ��� ���/�2� �0�<�
������c�8).��~[w�c�8)Zi�aFRG���l\F 4�ゕ��&`H��{�,�H�����R®�]��v*�Uث�Wb��]��v*�Uث�Wb��Qp�@���BW}f?�+���ƕd��!PN4�P�Uث�Wb��]���� ���W�M@�?�kc�Pן`sa���Dw��VB~�G�fLI��l�u�j�k�IW�I+�r]��=r��`wnx`��I�A�Jd�$ ��&���;�O��-����7�E�EҴ���W�2f].��߱�\]*������ #?�,]?�O�o�����%X�4p(��5?�ÿᓎ�q��>/x�*=��(;�Wo�g���� �b|n�Y�$B� ���~��c��cy{���RҀ�� $�6���x� ��|=�I��>M�KI��H�Z��o�\|=��������I�7���|>6By� �?�� ǜ4�#�<&iC�v޽0~[��i3������7I  &���ٹxt��&�� �(���� J�a��Y� �N�֝2cK��_�ǔ4�]?MR�4�)�ꤟ��/��K��i:r
+�ec�f��'*,_Η�&C&C�|zu�I&+]���S^���c��K��ꕭtyZ�r�Le$��_�	"�Q�GK���,����8c��\3�(9(F�ӱ�tp'��G<���@Vh\��D R���_������K�ryvEU��%J��8�߸��F�� �G�{��Z7rUQMn� ���0�w��L��O��H��ǌ���N�.Vt���bl��D�H��Rh����0�2?�������\|+Ȗ�Pv;m�� ;�eE��1,U�y�i��W�=;5��|ލ�]>�kǃ�կģaۯW���������*�����/١���K��$�V,S��*�:�#�޻���� ''��Lh�O��PAS���P^���p�%�������F��n_�D̲�9xʝ��`? M+�d�#{�b�^I��d�󊠍蠁�"��7<��n� X��N�y��*
�9����$���9�x��Y��sm��gs˭}�p��,�nGtRj��aI'���C�����R�����})?��?wl��&�$��U�ɑMf�_�#�C%����ɼ������-�������I�������\� ���{�����犽{��G�Ջ#a-��*��
���-�_������f��� �6�� C�O��x�a]� Y�����]1�Z� ���_�b�¶�t�� |/l+��4��ڋ�;+_��?���X�W�~d� �ƚ����R����������~���O�����,g
�����*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wџ�h[�N� �-�� �������H/[c�f�h�
�gQR2����+-�����PB�,���/X�:a�f� ;d�6n�<0�H�o���k����o��'ǅx��ヅx���<+����^&郅x�LxQn�
��0�ĺ�A��w#���H1�d�7�H}"w��k�@{�t�M̱�j -Y�m��Tר�#"��i�������������C0��pv27�L��0�ZCՍ}���!��$��� V��{�i-��'Ws5ۿӑݐQm�)S�� v#l�C���� |�;�	�X�N>6�0�f Z�H8pzӨ�9\�b!	'#�o|Đ��W|�ŉJ������B��v^�#ڔk�q,B���+n��H2{7��p��q�4��y��1�AJ?����Z�&��%�ݽ���m�_AͨY��K�N z����������.�ZMZ�5��������uQ		C*�%fE���h�p��J�����h������Z��[��-ؚ��!m�ݿ�����+��&�W��ƿu}����u[=Smy<��U�k�E�Xm#�f�j���n������.� 8��l�=�F�a�io�i즷2�&��+(��>�ĭs�O��o���ҧV�iԆ���:���W�ŝ���Ǭ-���E�h%g[�͗����}U��T��� ��zΙ�\���^�jqi��K�ۋ��hg��c�$W��N\���cJ���U�}Vm'D[�#F������	繀~�+Hn���������VT�Y���qmꬋ2,�\Q�aZ0��U1Wb��?�$��t����� ��R�<(v*� ���*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W�_�s��Ӎ?�Ol?�����w�� Y�$���`��6���f�!`���o�O�c���8���/t(ŏ���p�����:�
�7A��q5�/���S
m��¶�`�[u0���[[L��U2���a?�k/vaL�k?�*k��ǔ������(��5����Nf��dA9�;��C���-��R��������4F���Rmk�������BBҦ�Jl��M�����[n������e5���f���r��eD2�2;�VԈ2�����"b��!���ed ����{7��I� ��i� 07��oc��1iW:λc�j�Z$w�Oo5D�2�i8���\�,-�倫�}�-��Z��|��[�Ɠqe��maj-�'6ek���g���v��KV�����t�o�#����<�2��stl�kU���<|Q�ON��?c�%�|�c����1|�ae��n�"����[k�c�kg[�����r����}��T4�g��zU�ϚtI�}'F�G���3��e�I}O�̂��~ԘU3������//j:���y��^��8����~���%a�0GU�����^%����'���掺��$Au*^���/P����C�~��.�_�fS֡�5�z��i�*ɡ����_V���[K���imY�>L]�?V'����/Ê��/����J�t�-������E���0Ʃʞ��.8)Q� �� -�lѿ�!k� U1�w��� �_��4o��Z� �Li_� �@j�n����_i�p�X��OJ��D�'�e
7B��ee4?k$��*�U���*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W�?���w�?�����z|�;�?�� zT�O ����O�9!����9.x�����G����G����d$�c��w��x�J`1H�YM�&ݍ-�-��1H-dxR�T�c`{�ʉBy�@��/�1#��۲� ˲F䠼�k����f��wr�\�|�SA-6@�Z�m��V�Z�! �e�L�h�r$3��)mi��֕#"BAh퐤ڙ�x�N&�Ҭ+Q\�hv]�9Q�%)"A?#�!�IE׷�Ș�ST���+��[x m�!�~��ƊS1��8�J-�Tq�!H���=��q$�d�� ���7�`�|Uث�Wb��]��v*�Uث�Wb��]�����*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W�_��_?i��Ƕ� ���[�?ܟ�� ����ʦ?��.�p���K��	u+kJ��$�Y7�6�
T8���Kn#H.�
d$�G�"N����v�,��ү��'�Pq��ғy�� y
x?y�Gn��˲Ǣ�|�wq�_㘝��|���q�PvvD��Ӑ�@��3��k���⢞���$-2$2��?,HPV���!L�o�,�+��-��ƒ��l�
��z� R\oڞ=�3k
���L��PhȨ���3�:T�k^��*��W�$ EoD��MyU�i��Rw�)!�=��q4�d�� ���7�H5�<W �ث�Wb��]��v*�Uث�Wb��]�����*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W���c�w�?����z|�{���s��.�����^F@�ݺ�k�$�tm����Y����I��<MP�Q&�d$�6Ɨ���cL�kl	��1e��D��#L�j��m^�jk�gQ.�o������s=���}ٰ�K��>��?�%��|������8`��!.#l�
Z �K+k C V�ZȐɮ5�R�r�Ddi���7�&֕�����L�+XʼI��2%A҇�否AK���;��i��e&�����pz����d�}���	M��Jx� 0���K��$q�	��z���S���`o?���|��a�9K[�Wb��]��v*�Uث�Wb��]�����*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W�?��|�� �o� '�ί���O������?��y/�ۮ�q��֑���{a��Ҹ���2V�k[u0� V�[j�Sm�Au�)�u�
d
��V��;O�R8�6��W�i��+�ן��/�'�r=�o#�h�bFy_�\�u����SF��Y�!����`�����T�RێD�`��
H-�!�[�
P�:�!��@����)��@�V�����D���'�zdHH*l���}�2wSB;ǮA����S�r�!��#o�	2��v�2%E�REk�� C0�#jm�:� �]� �S ~q�S��o:�1����y��N�]��v*�Uث�Wb��]��v*�U���*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W�󒠟=�� �ȷ� ���S؟ܟ�� ����O��^LFٷ�Z��ڴA���1�춙%h�H$- �K��[b����ckkq��|,�j�m�Q� Zœaj}��4��@��Ǚ�SG��?;�����9Q�����c4�������Vl�_�z�I�nG' `!�up��9
d��9��r3Zz�!CGm��d�"R�l�f�}�*��Z��$,e�ughyj��NPC0T$���oq�!�*@�w ��V���h(:�� �/"O�ӦVSk@n<k�E��?��� +��� ˍ�O��2�� K^G��S�Wb��]��v*�Uث�Wb��]�����*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wտ��i� �ɷ� ���Oؿ���!��W���W�f��;lU�L!!�R�H�#%i�\<I��L ��{a�j�m-R�Uإ��+h��mn,�v,�mŋ�gف�J��_Q-X��w)%���㜆sy��@���� �\� �?Vn;}n�\�f����!�.�C ]�,�G�@���	��d�Ȗag�E-PS�#$�"R[��D�@�"�2q��BB��֣� Y�ɺ��Id��,Ek�|�d���o��(�	�VY�N}[��L��EĊ�>|K'��)�6�P���ɱ���5�xna�;v*�Uث�Wb��]��v*�Uث�W���*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�Wb��]��v*�Uث�W���t� ��&��Nϝ7ct�܇��_�G�KɎm�kXU�LT5��G
���U��,d��=rL��+G
��8BV�,��A*�S�W���5�������ŕ�s�#K��y��j�� k8�P{�����5Ϗ1��y���u��n�^�,�����G�D��ͣ� ��R���8d$�M9`d��+r�Y��mw>>��Hҧ+�B��r�2C�7�VY�r�m_� �L���W��)W�W���o?���lܚ�<?1Z���v*�Uث�Wb��]��v*�Uث��