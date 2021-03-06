<?php defined('SYSPATH') OR die('No direct access allowed.');

$lang = Array
(

'username' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'alpha_numeric' => 'Полето трябва да бъде буквено-цифрено.', 
	'length' => 'Полето трябва да е от 5 до 20 символа.', 
	'username_exists' => 'Името вече се използва.', 
	'not_found' => 'Грешно име или парола.', 
	'default' => 'Невалиден вход.', 
),

'password' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'length' => 'Паролата трябва да бъде от поне 5 символа.', 
	'default' => 'Невалиден вход.', 
),

'password_confirm' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'matches' => 'Паролите не съвпадат.', 
	'default' => 'Невалиден вход.', 
),

'email' => Array 
(
	'email' => 'Моля посочете валидна имейл поща.', 
	'length' => 'Максималната дължина на полето е 30 символа. ', 
	'email_exists' => 'Пощата вече съществува.', 
	'required' => 'Полето за въвеждане е задължително.', 
	'blocked_domain' => 'Не приемаме временни пощенски кутии.', 
	'default' => 'Невалиден вход.', 
),

'captchaanswer' => Array 
(
	'captchaerror' => 'Моля, решаване на теста за човек.', 
),

'emailconfirm' => Array 
(
	'matches' => 'Пощите не съвпадат.', 
	'required' => 'Полето за въвеждане е задължително.', 
	'default' => 'Невалиден вход.', 
),

'referral_id' => Array 
(
	'numeric' => 'Моля напишете валиден Реферален код.', 
	'id_notexisting' => 'Посоченият код не е намерен в нашата база данни.', 
),

'accepttos' => Array 
(
	'tos_notaccepted' => 'Вие трябва да прочетете и приемете поверителност и условия от правила за ползване.', 
),

'charname' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'wrongformat' => 'Полето трябва да съдържа само Европейски символи,без специални символи или числа.', 
	'length' => 'Полето трябва да е от 5 до 20 символа.', 
	'username_exists' => 'Името вече се използва.', 
	'not_found' => 'Грешно име/парола', 
	'default' => 'Невалиден вход.', 
),

'charsurname' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'wrongformat' => 'Полето трябва да съдържа само Европейски символи,без специални символи или числа.', 
	'length' => 'Полето трябва да е от 5 до 20 символа.', 
	'username_exists' => 'Името вече се използва.', 
	'not_found' => 'Грешно име/парола', 
	'default' => 'Невалиден вход.', 
),

'charpoints' => Array 
(
	'chars' => 'Има още няколко точки, които могат да бъдат разпределени в раздел Статистика.', 
	'notequal_50' => 'Общата сума на статистиката трябва да бъде равна на 50 точки.', 
	'notinrange' => 'Една или повече статистики не са в необходимия обхват на точки (1-20).', 
),

'charspokenlanguage1' => Array 
(
	'required' => 'Полето е задължително.', 
),

'to' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'length' => 'Полето трябва да е от 1 до 20 символа.', 
	'char_not_exist' => 'Получателят не е открит.', 
	'incoherentmode' => 'Вие не можете да настроите масивен режим и укажете получател', 
),

'choosenkingdom_id' => Array 
(
	'required' => 'Please choose a Kingdom.', 
),

'subject' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'length' => 'Полето трябва да е от 1 до 20 символа.', 
	'postcontainsbadwords' => 'Полето съдържа някой забранени думи (маркирани с ***).', 
),

'body' => Array 
(
	'length' => 'Дължината на полето трябва да бъде между 20 и 4096 символа.', 
	'required' => 'Полето е задължително.', 
	'postcontainsbadwords' => 'Полето съдържа някой забранени думи (маркирани с ***).', 
),

'law_name' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'length' => 'Полето трябва да бъде между 3 и 50 символа.', 
),

'law_desc' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'length' => 'Полето трябва да бъде между 3 и 2048 символа.', 
),

'description' => Array 
(
	'alpha_numeric' => 'Полето трябва да бъде буквено-цифрено.', 
	'length' => 'Полето трябва да бъде между 1 и 2048 символа.', 
),

'boarddescription' => Array 
(
	'required' => 'Това поле е задължително', 
	'length' => 'Дължината на полето трябва да бъде между 5 и 255 символа.', 
),

'old_password' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'matches' => 'Текущата парола е грешна.', 
),

'promomessage' => Array 
(
	'length' => 'Полето за въвеждане трябва да бъде по-малко от 255 символа.', 
),

'ann_title' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'length' => 'Полето трябва да бъде между 3 и 50 символа.', 
),

'name' => Array 
(
	'required' => 'Това поле е задължително', 
	'length' => 'Дължината на полето трябва да бъде между 5 и 50 символа.', 
),

'ann_desc' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
	'length' => 'Полето трябва да бъде между 3 и 4096 символа.', 
),

'region' => Array 
(
	'required' => 'Полето е задължително.', 
	'length' => 'Полето трябва да бъде между 3 и 50 символа.', 
	'doesnotexist' => 'Не мога да намеря този регион.', 
),

'quantity' => Array 
(
	'required' => 'Полето за въвеждане е задължително.', 
),

'slogan' => Array 
(
	'length' => 'Полето трябва да бъде между 1 и 30 символа.', 
),

'group_name' => Array 
(
	'required' => 'Полето е задължително.', 
	'length' => 'Полето трябва да жъде между 3 и 60 символа.', 
	'groupname_exists' => 'Името ,което искате е заето вече.', 
),

'group_description' => Array 
(
	'required' => 'Полето е задължително.', 
	'length' => 'Полето трябва да бъде между 3 и 255 символа.', 
),

'group_image' => Array 
(
	'default' => 'Невалидно.', 
	'valid' => 'Изображението не е валидно.', 
	'required' => 'изи.', 
	'type' => 'Снимките трябва да бъдат png  формат.', 
	'size' => 'Снимката на герба не трябва да бъде по - голяма от 300кб.', 
),

'group_charname' => Array 
(
	'required' => 'Полето е задължително.', 
	'char_not_exist' => 'Героят не съществува.', 
),

'group_message' => Array 
(
	'required' => 'Полето е задължително.', 
	'length' => 'Полето трябва да бъде между 1 и 1024 символа.', 
),

'group_subject' => Array 
(
	'required' => 'Полето е задължително.', 
	'length' => 'Дължината на полето трябва да е между 1 и 255 знака.', 
),

'independentregion' => Array 
(
	'required' => 'Полето е задължително.', 
),

'captain' => Array 
(
	'required' => 'Полето е задължително.', 
),

'kingcandidate' => Array 
(
	'doesnotexist' => 'Този играч не съществува.', 
),

'foreignershourlycost' => Array 
(
	'default' => 'Стойността трябва да бъде >0', 
),

'message' => Array 
(
	'default' => 'Полето е задължително.', 
),

'validity' => Array 
(
	'default' => 'Въведи стойност > 2', 
),

'title' => Array 
(
	'required' => 'Полето е задължително.', 
	'length' => 'Полето трябва да бъде между 3 и 50 символа.', 
),

'reason' => Array 
(
	'required' => 'Полето е задължително.', 
),

'wardrobe_parts' => Array 
(
	'default' => 'Снимката не е валидна, форматът трябва да е PNG и размерът трябва да е <=150к.', 
),

'date' => Array 
(
	'required' => 'Полето е задължително.', 
),

'time' => Array 
(
	'required' => 'Полето е задължително.', 
),

'location' => Array 
(
	'required' => 'Полето е задължително.', 
),

'domainname' => Array 
(
	'required' => 'Полето е задължително.', 
),

'discussionurl' => Array 
(
	'required' => 'Полето е задължително.', 
),

);

?>