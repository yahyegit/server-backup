<?php

require 'connet.php';
if($checkexistes != "@#@#WERWsdsafsdfFSDF]))(*(&*234dfg5^%^#2454{}[") {
		die();
	
	}

  if(if_logged_in() != true){
die();
 }
 	
if (isset($_POST['date1'])){

 
$date_to_select		=   trim(mysql_real_escape_string(htmlentities($_POST['date1'])));


	$query_select = "SELECT `id`, `name`, `cash_in_day`, `cash_out_day`, `blance` , `dolla_in`,`dolla_out`,`dolla_blance`,`number`,`time` FROM `daily_details` WHERE `date`='$date_to_select' ORDER BY `name` "; 
	
		if(@$query_run = mysql_query($query_select)){
	


		$table_data = '';
		$table_data .= '<table class="table" ><thead> <tr> <th> Name </th><th>Cash In </th><th>Cash Out</th> <th>Balance</th>  <th> Doller In </th> <th> Doller Out </th> <th> Doller Balance </th><th> Number </th> <th> Time </th> </tr> </thead> <tbody>';
		
			
			while($sql_row = mysql_fetch_assoc($query_run)){
			
				$name = 	$sql_row['name'];
				$cash_in = 		number_format($sql_row['cash_in_day']);
				$cash_out = 	number_format($sql_row['cash_out_day']);
				$blance = 		number_format($sql_row['blance']);
			 	$dolla_in = 		number_format($sql_row['dolla_in']);
				$dolla_out = 		number_format($sql_row['dolla_out']);	
				$dolla_blance = 		number_format($sql_row['dolla_blance']);	
				$number = 			$sql_row['number'];	
				$date = 		$sql_row['time'];	

				
				

				$table_data .= '<tr><td class="day" date="'.$date.'">'.$name.'</td><td>'.$cash_in.' </td><td>'.$cash_out.'</td><td>'.$blance.'</td> <td>$'.$dolla_in.'</td> <td>$'.$dolla_out.'</td><td>$'.$dolla_blance.'</td> <td>'.$number.'</td>     <td>'.$date.'<b> <a href="#"   name="'.$name.'" cash_in="'.$sql_row['cash_in_day'].'" cash_out="'.$sql_row['cash_out_day'].'" blance="'.$sql_row['blance'].'" dolla_in="'.$sql_row['dolla_in'].'" dolla_out="'.$sql_row['dolla_out'].'" dolla_blance="'.$sql_row['dolla_blance'].'"   edit_="edit_"  class="button edit">edit</a>  </b> </td></tr>'; 
				}
		$table_data .= '</tbody></table>';
		
			echo $table_data;
		}

}

?>


^���>I���y+6Z����2����c�����nr$�5�a$���A){��u��;�^uп��m����7�{���G����n����&1��`c�ޡo���q��O%�ǈy�l���[I����|�����W�>O����n'����u��͜��wR\_�^7�ӆ�~>�;��oi�
ڶ*-�5m$ �B�SҦ�P&08��iE�����"UV�T
8F!y�3������Ov�UL)E�

��D(�'ؼ�kO�"sr�(�����q:�����S *�sN�<T��֨ :Y�E48�w����K7*QI��D09�`0�r'�E(�+�^3�����C$r�����h�(�❢�ꛚ��Z*x4�m7-�9������ctAh�G�Z�^�ׅU�U8�cvn��By��TqR��
�PN�8P�uvHh����Z"�N9�$섾�2�j������:��r(��	�&�FAM���ri`U=�q&��ҷUR���J�U*��_�� ?�� ���b'c���&Sp�-�B��;X�VǇ���� ?�(W,%e�sP��5E�j�o�)Pt��\Q�j�STP�DC��
�䬌�7��#+�A���3��̎���QH�Ɲ�~�vǽ3Or_Ț�L���RFw[�Q+����c�����3���4����������y���z�"'��Ι��Q]�:4���>�����'�|:�n��?�� ?�$�a��.(g��=1�)��-U�����lq� <Ũ(��L`�?��+�-���j#'�2�K:�9�ԥ���F�L�G^����1�Cl�2<}J�e��Γ� ���?xZq>��PJ��5W���͓�U�M�Ŕ�D��T�����V���f�����p�O/�2h�y̎	��L�ޖ�B�:��-�ƌ��Z�˳�D���^��Kc�?����{�P}%����`[m����;�|Ot�ou�iƑ>X%����3(s��-΁\Cl_-5���k���
s��'V,ə:�������u:�:9G����8��BY�1�榐���c�m�H��9\."��p."�ٍi�bt�5��d%%2�S��j\\��9����ڥ,�Z�C2|��5�q{���+u�T�9\�r=�6�u�o��|kDc%���q�S�̅ѵ�N>*|R��e��O�b�8w~⣃�X������d���E$K�p{l�l�V�N��g�7ܿX��U�E����B�EaP��}��Y�|��*;0*oP�+1�O��L���=������+��>�,!��l�c��}�ޡYl̥J�'f���Z1���������׽�Z�V��#�e��ǧ��3���o��uK�n�֐B��x[�5�f�ekb
�Q��sL���N���re2.����3ޭ�P84��岃�5���	�F}3���w����:~c'�M�}����������s���[�3�#��:�ޘ9�m�=A�Dw�dq���%���|&�����>�z.���Q��z�Y_T�?N�j#�O!
��aN�KW qaR��`c��D�[�6�+�ڸcC^�F�����ߘ�����mH>[D0�R�z���HQ�̅I�T�j��Dn�6V9�'L��J;0���w5�m6^���inb�PH6����\����q�;1��s]m�!�T�6�&N��5�R���K1��[ ���ծ%.�����\T�i-<E�����x�Ybp{-����T��Ϡ�Z����GS�as�_��:9
�:��Fa��u�g?�Ă��v����ޗ����Ҿ%a@ļ�V��{��ƣ�_�S:/�Z�6�I/��H�	g���t���µ�q�%���F��K��΀Rlr�Us8�5�	#a	�#�w*�S�1lSi��ތNǛEؙ����7�G�+e9�nZ$�$Ռ���s'fa^��t.�U���$���k�[�e.(yԺ�ݝ���N*}� ��L�$���9�O��GF�D�H��9�7S �Q#���s�k�aM����c_�r��+����gζ�UU�c�S#���Ĩ�	�(i����;mlA�(<R�n�y�Q�=�� \<(?W3�m��8��&��I_���qiCx�
�f|�3�\U;8SY��I;Y�8�/b��K� �&��T�Nw���F���i�j�v�����~��ʓ���
R�]��l��er���v�<�k�'��^�S�C�[~�����J��iq66�mش���f�Լi6��J=��Q&����vW=�����o�]�-��V�0ػ9�f� �b�og�b����b�탈j�߻n�ٰq���}��Z�)M��Ԣ�h��m��� �-�}{�����i1��(R�W�����ͮ[}՗���v{�έ�{�t��:N=�1^��]o��1�VZ��64�Es�­����ܓ����ں�֬��%ɺ�(%�)E��}�Q?]&7U��y�k����\v^��\���JO���n5�Hi���[\�ڢ��񥾷�ݜE}}DW����g*ɉ��gƚ?tR�붽����m��~&����^� �Vݍq�s[�λo��F��եMT��e����{��m��+���K�E� �� ?� ��ׂx";�"9K��x�Ch�,B���Rn��b^gVkg�BN�S�~�E�6J!��	E���)[�H0`�I5�V]��*��� y~�+sx�y��J��AsEV�*��9v��\ռ�����
�J A�Q*'��D�D�A� ��[�K���r��?��|-��W��;�z?7�����?����,����_���?�῎���/�C��?��3O�!��� �|/��˗.c�n?�P��
�����!��~?�jf����ς�£r��¼jT����� ?� ��@���~�7��1�3T���4)�/G�8s= ������+V��ƍ32^���2������/�{D=s�7��h�w������o�Qk�*���i����s��иv:ޱ�&v�>��!f�����}���Ч�gI�f �4mF|��ς�9���7��|��7�A5!�K�3
r9� �����5��@�/H��م�]�8���f{���� ��S�d�E�Z쫪���%���
b�İl4���� �IKn۝w�j��`��Z0AC��c^� Z:��^���g[X��㖩�����5���[��@�{e��B�1�*��4�AR�\pq�F"˘��8�o�B^<e�Vb��GK�7�8��Mf�Ƥ�T�UM"������\��MX��0�{AK8�!3&i�M��h�dq����6��>�b�&�N�'�z�jێ=b�2v�f��9M��>���q7����|�4�&7�)�0�q�Y�'yJ���&�IÏf1��ԨM��!��\c�T�@U�q��y���d�;�߸�����8�2��5�3<�W�5��5�j�i;G����%@�9�p�0��*Mq�+�jJ��N6�N8�K�5�8���ӎ>��F���Mҡ.��:�'Cߎ1,�V�q�J��yq�i�q�۴�\������X�&�q�q���9�u�����\q�5���
Da�L�38�:G�8�4���^8⠝|q�i�]�Yq��V<1s:��� ����ˆ8��.<��� x�3��\i�w2������ӎ;����(�~�����yDֹ��(�����v���r���-˂KK���cqL�[-�� '�� ?� �D���1���X�k%淂���5��{)�1\�? )8n!YT�kb�!h�qZ�5`+��&+(2�e[B�u,6]�f�R����#N��U��s�����b�H ��)�B`:�Θ���ME˿�Dchpm�(/���J��-��R.f�s�*�V	�LC�h�9�nT�*D����	&���+�R�ٝ�yF���ᛴ��yK��W,�1�V]$���i�Z񊀭\�BD�#l5^`įm+��Rځ����r���U���9WXת��V�CJ���uD)l�V�"�f�gݏ)KU�U�E����. PT�Y�����c_3)��2RQDFS��k�-:lbjA��(S�{��eB���1TQ"F��e��f���(l(����(��b$ӳ�J�+	XX�ŎO �6���!i�hGb3�n��.�0��acpܒB�Sv�T$�'7\
t��Qmj�sU.����_ir�{Ќ�8��%R�~��F@B����5�u�,z5J�J<3!�
�P��ӘhGHw[�řf=﷌�У_Jo�3��!��Y�F�d-�00-4���u��![R� �.���f��n��V�u��Z�#)&��f[����亚�#2���7����4� T�'/X��+J�͙Ū���L���x]����$K ��#�Ṯ������0����<fă���f.R��/Ӧ�%o�N;ךj.����`@b�p�q�P@�("=2J468.�)I���p��H�	�OԵ�����+�h�1B�͋�PD��*�ʍj[H궳�b=�H�*ג   �l�V�V4�Źp�j*3d6�ij*�E��R�h\[���B��`��A�k� Qkq���F��C�(���EYm�д4t����Vt��h�kފ���x��R�.}�
�Y>��ft��k-��v����^�R98�d���I��F���r0�Z����j�|E[M5��*!n��Z5���0t׍��4�ZT�ֹ�L���k��@����%��U5{j�F�W[@j��5���[������]NZ����S�.K�__x�B����[�_�M��#N�v��Q��p�ZEl�;{&f]h���b�n	��m׌Kř���aN����߬9q�|?D<����\L5eӾ��(hu/M�#M��n^�5�NZ���
�VR��6شR��V<��4w��H���_)��|� ^|�n�N���O]��I�b��0�ڌ27�9��-`�p��f��MH�t0^G?\�G`Q���&�C��־Q��H�|�(�3���E՚Q����f�������i-����� �V�� �CC&�����aa�Pъ����LL�m�K.uE|c�e�B�ټ5���&u��묾y2��6+^[zi `�ӻ�iٞ?�t&t�ޘ���^U�b,��~�u���4��3Z����7嬶s��m�^�������cq�ك�G5�r�Y��u�Ʋ�6ӏ9�gK��x��5Z�DW�J�p��ɔ��בZ�oiT!A��z{�Fܙ������b~��	t���s|9�5�?R�лޱ��G����G��+֫^\3� 2�S�O6{C=WH-����VKꅚp�8��" �/�,^���q�c�e8�t<�l�;jףpi�I��-z���mY���K|1��������Uv3�G٘4b�t�O4P��;w�L�a�n�37kn�X�Z����=�
������(�����;�U9�k���o���Y��
^��Z���M������^Pms]P�^�'��5��� rc���A�`� O�a����%��(qg�(�����yAFW1����2Y7珦N��0�!�H����ޫ�0�K�h��Y�:]����eLnr�4�C佞ġH-�|'�H�Q4Î_^�)�����f!f�@�&�X�9��D�5�ٓ+��~�(��w�PKzv��X oZ�y�#�3�w[{�7:ݽ^oZ�-.���+A��������/�s��R:�k9�����Je���jֻh�4	�o��҂��W�}5�q-Q@�߭|�Pqeb�����M����i�u/~/�Y�)k���{�Ӡ��/�8��������Ε��ģ�1�yţU���S����`����"��yJz1קߔ�Ǵ���$M�w�G3{�zE��n�t��K%洿="����s/c���7k�#�Y�$�x�i�6J5Ь�=& 0���b�1.SO1Y�u�����OI�9GE_F4cv��A�u�0����5m��e-r��7[=5iei�0/T3������X]��y~���r���'I�9��P�=� �f��W�o_���h�;��R��;��97��iGa8�-"��v?q�X���"�zjާ�	�j���f�ϖg�ŜĠ�1/���c��]ۇ{�zRlj<���������f<a}�{r������).��0�^�tn]�`�G'F��ʡ��x���p�t�{i4�9�\�mgSg��:��>��
^穾=b�k��||���9u�-?�b����-�b�sv;L�mȹ�xu�;�_��0
�U���6�5e���J�ؚ_����g_>]e��CJ�r��clM3i�}&�r���� "Ɇ��o�5�2U�<��p�bE�|���%���h���T�i�;z@+n۶�挶�-P|���3ۖU������g*�耰��R��mϤ���}⺾�ǔG����GCX��i������3]�fɳy���Է���?��