<?php defined('SYSPATH') OR die('No direct access allowed.');

$lang = Array
(
'pending_action_exists' => 'Вы не можете выполнить это действие, вы заняты другими задачами.', 
'donate_ok' => 'Вы избавились от своих вещей.', 
'take_ok' => 'Вы взяли некоторые предметы.', 
'donate_executeerror' => 'Во время процесса пожертвования произошла ошибка. Свяжитесь со служащими.', 
'take_executeerror' => 'Во время сделки произошла ошибка. Свяжитесь со служащими.', 
'take_maxweightreached' => 'Вы перегружены и не можете взять предмет.', 
'global_notenoughmoney' => 'У вас не хватает денег.', 
'house_buyok' => 'Вы купили %s за %s монет.', 
'sellhouse_ok' => 'Вы продали %s за %s монет. Вы заплатили налог %s монет.', 
'sellhouse_housenotfound' => 'Этого дома не существует или он не ваш.', 
'sellhouse_itemsinhouse' => 'Вы должны освободить свой дом прежде, чем продать его.', 
'drop_storablecapacityfinished' => 'Вы превысили вместимость здания.', 
'drop_ok' => 'Вы положили свои предметы.', 
'market_itemsnotowned' => 'Нет такого количества таких предметов.', 
'item_notexist' => 'Предмет не существует.', 
'item_notininventory' => 'У вас нет стольки предметов.', 
'item_soldsubject' => 'Кто-то купил ваш товар на рынке.', 
'item_soldbody' => 'Вы продали %s %s за %s монеты.', 
'itemsquantitynotowned' => 'У вас нет стольки предметов.', 
'marketsellitem_pricelessthanzero' => 'Отпускная цена должна быть положительной.', 
'marketbuyitem_cannotbuyownitems' => 'Вы не можете купить объекты, которые сами выставили на продажу.', 
'marketcancellsell_ok' => 'Вы отменили свою продажу.', 
'item_notwearable' => 'Вы не можете носить эту вещь.', 
'item_notundressable' => 'Вы не можете убрать эту вещь.', 
'getwood_no_energy' => 'Вам не хватает энергии для рубки леса.', 
'getwood_no_handaxe' => 'Чтобы рубить лес возьмите в руки топор.', 
'knifeneeded' => 'Вам нужен нож для выполнения этого действия.', 
'pickaxeneeded' => 'Для работы в шахте вы должны держать в руках кирку.', 
'breedingbuy_ok' => 'Вы купили хозяйство.', 
'terrainbuy_ok' => 'Вы купили поле за %s монет.', 
'terrainsell_ok' => 'Вы продали поле за %s монет. Вы заплатили %s монет налога.', 
'royalp_appointvassal_ok' => 'Вы назначили %s на должность попечителя %s.', 
'royalp_candidateisincharge' => 'У кандидата уже есть должность.', 
'royalp_candidateisfromdifferentkingdom' => 'Кандидат - подданный другого государства.', 
'resign_from_role_messagesubject' => '%s подал в отставку со своего поста.', 
'resign_from_role_messagebody' => '%s подал в отставку со своего поста и по следующуей причине: %s', 
'resign_from_role_ok' => 'Вы подали в отставку со своего поста.', 
'revoke_role' => 'Отозвать должность', 
'revoke_role_ok' => 'Вы отозвали должность %s у %s.', 
'char_hasntrole' => 'У выбранного игрока нет должности.', 
'castle_deletelaw_ok' => 'Вы отменили закон.', 
'castle_editlaw_ok' => 'Вы изменили закон.', 
'askaudience_messagesubject' => '%s попросил личной встречи', 
'royalp_askaudience_ok' => 'Вы только что попросили о личной встрече у князя.', 
'appoint_priest' => 'Назначьте приходского священника', 
'appoint_bishop' => 'Назначьте епископа', 
'appoint_cardinal' => 'Назначьте митрополита', 
'askaudience_ok' => 'Вы попросили о личной встрече.', 
'marketbuy_maxweightreached' => 'Вы перегружены, вам не удалось купить вещь.', 
'wear_ok' => 'Вы надели: %s.', 
'undress_ok' => 'Вы сняли: %s.', 
'shop_craftok' => 'Вы начали изготовление вещи.', 
'craft_cantcreateobject' => 'Вы не можете создать такой предмет.', 
'craft_chardoesnthaveneededitems' => 'Вам чего-то не хватает для изготовления.', 
'negative_quantity' => 'Пожалуйста, введите положительное число.', 
'free_motivationempty' => 'Укажите причину для освобождения заключенного из под стражи.', 
'freeprisoner_ok' => 'Вы выпустили %s.', 
'publishsentence_parametersempty' => 'Укажите получателя и текст приговора.', 
'publishsentence_ok' => 'Вы огласили приговор.', 
'publishsentence_characterhasarole' => 'Вы не можете огласить приговор %s, суд разберется с этим вопросом.', 
'publishsentence_messagesubject' => 'Судья огласил приговор.', 
'publishsentence_sentencetoolong' => 'Текст приговора не должен превышать 250 символов.', 
'deletesentence_notnew' => 'Невозможно отменить уже оглашенный приговор.', 
'deletesentence_messagesubject_target' => 'Судья отменил приговор.', 
'deletesentence_ok' => 'Вы удалили приговор.', 
'castle_candidateisfromdifferentnode' => 'Вы можете назначать лишь жителей своей области.', 
'castle_appointsheriff_ok' => 'Вы назначили начальника стражи %s %s.', 
'castle_appointmagistrate_ok' => 'Вы назначили %s судью %s.', 
'charhasnomorerole' => 'Вы не можете снять %s с должности.', 
'change_city_samecity' => 'Вы не можете переехать в %s, потому что вы и так уже живете там.', 
'change_city_ok' => 'Вы переехали и теперь являетесь гражданином %s.', 
'change_city_timenotexpired' => 'Вы не можете переехать, потому что слишком мало времени прошло с момента вашего предыдущего переезда.', 
'change_city_charhasarole' => 'Перед переездом, пожалуйста, уйдите со своей должности.', 
'starving_subject' => '%s, вы умираете от голода...', 
'starving_body' => '%s, если вы не съедите что-нибудь, завтра или послезавтра вы умрёте. Ваш персонаж %s и имущество будут удалены, и вам придется создавать нового персонажа.', 
'charinroledied_subject' => '%s умер от голода, его должность теперь свободна.', 
'item_notcure' => 'Вы не можете излечить себя таким предметом.', 
'cure_ok' => 'Вы излечились и чувствуете себя замечательно!', 
'shop_configure_ok' => 'Ваш рекламный текст был сохранен.', 
'castle_addannouncement_ok' => 'Объявление было размещено.', 
'castle_editannouncement_ok' => 'Объявление было изменено.', 
'cannotcancelwardeclaration' => 'Вы не можете отменить объявление войны, теперь уже слишком поздно.', 
'deletewaraction_ok' => 'Объявление войны было отменено.', 
'senditem' => 'Послать предмет', 
'senditem_helper' => 'Здесь вы можете переслать объект персонажу всего за несколько монет. Время, которое посылка будет находиться в пути, и цена доставки зависят от местоположения отправителя и адресата, а так же веса посланного премета(ов).', 
'senditem_sendnormalitem' => 'Вы собираетесь отправить', 
'senditem_sendcoins' => 'Вы отправили', 
'senditem_ok' => 'Вы отправили предмет.', 
'senditem_shortmessage' => 'Предмет отправлен', 
'senditem_longmessage' => 'Вы отправляете предмет', 
'equipped_item' => 'Вы не можете отправить предмет, который носите.', 
'norole' => 'У вас еще нет должности.', 
'cannotattackchurch' => 'Вы не можете напасть на церковь.', 
'bf_add_attack_ok' => 'Вы присоединились к отряду нападаших.', 
'bf_add_defend_ok' => 'Вы присоединились к отряду защитников.', 
'bf_retire_ok' => 'Вы оставили сражение.', 
'giveitems_ok' => 'Предметы изменены.', 
'toplist_doesnt_exist' => 'Этот список не формируется.', 
'buy_avatar_ok' => 'Вы купили аватар для своего персонажа. Наши служащие получили уведомление по почте и скоро обновят ваш профиль.', 
'senditem_costmessage' => 'Вы собираетесь послать <b>%d %s</b> <b>%s</b> общим весом <b>%s кг</b> и стоимостью <b>%d монет</b>. Предмет(ы) будет получен <b>%s</b>.', 
'sending_alreadysending' => 'Вы в настоящее время посылаете <b>%d %s</b> <b>%s</b>. Предмет(ы) будет получен <b>%s</b>.', 
'renthorse_ok' => 'Вы наняли сильную лошадь', 
'hirehelper_ok' => 'Вы наняли рабочего', 
'item_wrongsex' => 'Тщательно поразмыслив, вы решаете не носить такую одежду', 
'feedanimals_ok' => 'Вы кормите своих животных', 
'sail_no_porto' => 'В этой области нет причала.', 
'sail_no_route' => 'Между этими городами нет морского пути.', 
'item_wrongrole' => 'Вы не соответствуете требованиям к носке такой одежды.', 
'item_not_enough_str' => 'Вы недостаточно сильны, чтобы использовать или носить этот предмет.', 
'incompatible_worn_items_1' => 'Вам не удалось надеть эту одежду. Вы понимаете, что сначала надо кое-что снять.', 
'incompatible_worn_items_2' => 'Вам не удалось надеть эту одежду. Вы понимаете, что сначала надо кое-что снять.', 
'change_city_destregionisfull' => '%s сейчас перенаселен и не может принять новых граждан.', 
'convertcurrency_ok' => 'Вы обменяли монеты.', 
'volunteerworkhourscheck' => 'Вы можете работать добровольно от 1 до 9 часов.', 
'paidworkhourscheck' => 'Вы можете работать три, шесть или девять часов.', 
'notenoughenergyglut' => 'Вы слишком устали или голодны, чтобы выполнить это действие.', 
'worknotenoughslots' => 'К вам подходит стражник. Он сообщает, что оплачиваемой работы здесь больше нет.', 
'workonproject_ok' => 'Вы начали работать над проектом.', 
'sendmoneynotoldenough' => 'Вы пока не можете отправлять деньги с посыльным.', 
'change_city' => 'Стать гражданином', 
'transfer' => 'Переезд', 
'changeattributes_ok' => 'Вы перераспределили способности.', 
'sellproperty_propertynotempty' => 'На складе что-то есть. Свяжитесь с владельцем и попросите его освободить склад.', 
'sellproperty_pendingactionexists' => 'В настоящее время владелец работает. Свяжитесь с ним и попросите прервать работу.', 
'sendnotsendableitem' => 'Вы не можете посылать такие предметы.', 
'restrain' => 'Блок', 
'craft_neededitemsmissing' => 'Некоторые необходимые для производства предметы отсутствуют. Проверьте склад лавки.', 
'structure_fullinventory' => 'Склад полон. Попытайтесь избавиться от некоторых предметов прежде, чем произведёте новые.', 
'change_city_destnodeisindependent' => 'Вы не можете переехать в эту область, так как ею никто не управляет.', 
'change_city_helper' => 'Если вы хотите переехать в (%s), придется заплатить <b>%s</b> монет.', 
'sendnormalitemslimitation' => 'Вы можете послать только один предмет.', 
'senditem_totalitemsmessage' => 'В общей сложности вы имеете <b>%d</b> %s.', 
'acquireclearancepermit_ok' => 'Вы купили пропуск.', 
'onlyoneoccurrenceforthisitem' => 'Вы можете нести только один такой предмет.', 
'acquiresupercart_ok' => 'Вы купили отменную телегу.', 
'itemtrashed_ok' => 'Вы избавились от некоторых вещей.', 
'shovel_no_shovel' => 'Чтобы накопать песка возьмите лопату в руки.', 
'fish_no_fishing_net' => 'Возьмите рыболовную сеть.', 
'regionisindependent' => 'Около здания группа крестьян блокирует Ваш путь.', 
'canbuyonlyone' => 'Вы можете купить только один такой предмет.', 
'buyship_ok' => 'Вы купили торговое судно.', 
'customerscantbemerchant' => 'Отправитель и грузополучатель должны быть двумя различными людьми. Вы не можете быть отправителем и грузополучателем в одновременно.', 
'exhibit_scroll' => 'Показать свиток', 
'exhibit_scroll_helper' => 'Может случиться, что какой-нибудь воевода, судья или игрок будет просить вас показать свиток. Вы можете показать его, выбрав соответвующее действие из всплывающей подсказки. В событиях появится сообщение с координатами для прочтения свитка. Вы можете показать свиток только персонажу, который находится в одной с вами области.', 
'only_generic_scroll' => 'Вы можете показать только свитки и документы!', 
'travel_to_bf' => 'Вы движитесь прямо на поле боя', 
'select_color_tint' => 'Выберите краску', 
'tint_helper' => 'Вы можете выбрать краситель для ткани. Для окраски ткани вам понадобится плошка с красителем.', 
'missing_dyebowl' => 'Чтобы окрасить ткань, Вам понадобится красильная чашка.', 
'dye_ok' => 'Вам удалось перекрасить предмет', 
'move_charisrestrained' => 'Вы пытаетесь покинуть облась, но охрана преграждает вам путь %s.', 
'castle_candidateisfromdifferentregion' => 'Кандидат должен быть жителем области.', 
'acquirequeue_ok' => 'Вы приобрели несколько зелий выносливости.', 
'craft_toomanyslot' => 'Для изготовления предмета не требуется столько действий.', 
'marketsellitem_itemislocked' => 'Это личный предмет, вы не можете от него избавиться.', 
'declarerevolt_notpossible' => 'Новости о том, что бунт уже начался, заставляют вас прекратить писать письмо.', 
'house_declarerevolt_running_helper' => 'Восстание началось, и попечитель уже в курсе. Ваша армия собирается возле дворца, битва скоро начнется в <b>%s</b>.', 
'revolt_kingcantsupportrevolt' => 'Вы думаете, что поддержка восстания -- не лучшая затея.', 
'revolt_choosefaction_ok' => 'Вы знаете, кого будете поддерживать.', 
'revolt_charfactionnotchosen' => 'Вы не выбрали, кого вы всё-таки хотите поддержать.', 
'revolt_leaverevolt_ok' => 'Вообще-то, если задуматься, вы понимаете, что не хотите поддерживать ни одну из сторон. Возможно будет лучше, если вы уберётесь подальше отсюда.', 
'revolt_leadercantsupportking' => 'После некоторых размышлений вы осознаёте, что поддержка попечителя была не лучшей затеей.', 
'declarerevolt_alreadyfighting' => 'Вы уже сражаетесь.', 
'revolt_charmustbekingdomresident' => 'Подойдя ближе, вы замечаете, что люди очень недоверчивы и не хотят вторжения посторонних.', 
'defender_underrevolt' => 'Вы были проинформированы о надвигающейся восстания в %s, но думаете, что лучше подождать, прежде чем переходить к враждебным действиям.', 
'chooserevoltfaction_notoldenough' => 'На вас все еще смотрят как на чужеземца и не позволяют принять участия в восстании.', 
'bonus-hasalreadybonus' => 'Этот бонус уже действует, или действует какой-то другой бонус, несовместимый с этим.', 
'bonus-acquirebonusok' => 'Вы приобрели бонус.', 
'travelmessage' => 'Вы путешествуете из %s в %s.', 
'hammerneeded' => 'Возьмите в руки молоток.', 
'hoeneeded' => 'Возьмите в руки мотыгу.', 
'bucketneeded' => 'Возьмите в руки ведро.', 
'bellowneeded' => 'Возьмите в руки богомола.', 
'reason_cleanprisons' => 'Чистка тюрем', 
'reason_boardvisibility' => ' Видимость объявления', 
'reason_questreward' => 'Награда за выполнение задания', 
'reason_travelerpackage' => 'Приобрести Набор путешественника', 
'reason_studycost' => 'Обучение/Упражнения', 
'reason_marketbuy' => 'Товары на рынке', 
'reason_supercartbonus' => 'Набор "Отменная телега"', 
'reason_basicpackage' => 'Приобрести базовый пакет', 
'reason_senditems' => 'Отправить предметы', 
'reason_notspecified' => 'Не указана причина', 
'reason_sailcost' => 'Цена фрахта', 
'reason_toplistvote' => 'Лист голосования', 
'reason_structurebuy' => 'Приобрести строение', 
'reason_referralbonus' => 'Реферальный бонус', 
'reason_structuresold' => 'Продажа собственности', 
'reason_marketsale' => 'Проданные товары на рынке', 
'reason_becomeking' => 'Расходы на коронацию', 
'reason_adminsend' => 'Сообщение от администрации', 
'loot' => 'Искать', 
'reason_game_diceelite' => 'Игра в кости (комната для знати)', 
'reason_workerpackage' => 'Приобрести Набор работника', 
'reason_buildsalary' => 'Зарплата строителя', 
'reason_game_dicesimple' => 'Игра в кости (комната для крестьян)', 
'reason_purchase' => 'Приобрести', 
'reason_duelpresence' => 'Присутствие на дуэли', 
'reason_duelabsence' => 'Отсутствие на дуэли', 
'reason_lootdiscovered' => 'Обнаружено ограбление', 
'error-notenough-questpoints' => 'Вы не можете использовать эту функцию без %d очков заданий.', 
'achievementmissing' => ' Вам так и не удалось достигнуть следующую задачу: %s', 
'reason_prayer' => ' Молитва', 
'paperpieceneeded' => ' Вы должны иметь лист бумаги.', 
'paperpieceandwaxsealneeded' => ' Вы должны иметь лист бумаги и восковую печать.', 
'reason_questtoken' => ' Отправлено 10 квестовых жетонов.', 
'reason_resttavern' => 'Отдых в кабаке', 
'reason_donatecoins' => ' Донат', 
'reason_goodsandservicestax' => 'Налог на продажи и сборы', 
'reason_wage' => 'Плата', 
'reason_atelierlicense' => 'Приобрести лицензию на Ателье', 
'error-notenabledwhenrestrained' => 'Вы задержаны и не можете выполнить это действие.', 
'reason_tavernincome' => 'Доход от таверны', 
'reason_dailyrevenue' => 'Ежедневный доход с активных жителей', 
'reason_revokerole' => 'Уволить с должности', 
'reason_roleassignment' => 'Назначить на должность', 
'userisnotactive' => 'Ваша учетная запись не активирована. Активируйте ее, следуя инструкциям в письме, полученном после регистрации.', 
'reason_suggestionsponsorship' => 'Спонсировать предложение', 
'reason_wardrobeapproval' => 'Одобрить смену гардероба', 
'battlefielddismountedcantgoback' => 'Васильковое поле было удалено, вы не можете вернуться назад.', 
'info-answered' => 'Вы ответили на брачное предложение.', 
'error-proposalnotfound' => 'Предложение не найдено.', 
'error-weddingproposalnotaccepted' => 'Свадебное предложение не может быть отправлено или не может быть принято.', 
'error-proposalalreadyanswered' => 'Вы откликнулись на это предложение.', 
'error-charnotavailableforregfunctions' => '%s отклонил ваше предложение, поскольку не хочет принимать участие.', 
'reason_coursegain' => 'Завершение курса', 
'reason_wardrobeapprovalfree' => 'Бесплатное подтверждение изменения гардероба', 
'error-tooyoung' => 'Вы слишком молоды для выполнения этого действия.', 
'reason_diamondring' => 'Приобрести бонус: Бриллиантовое кольцо', 
'reason_professionaldesk' => 'Приобрести бонус: рабочий стол', 
'reason_atelier-license-weapon' => 'Приобрести лицензию на гардероб: Оружие/Огнестрел', 
'reason_atelier-license-avatar' => 'Приобрести лицензию на гардероб: Аватар', 
'reason_elixirofhealth' => 'Приобрести бонус: Эликсир здоровья', 
'reason_elixirofdexterity' => 'Приобрести бонус: Эликсир ловкости', 
'reason_elixirofstrength' => 'Приобрести бонус: Эликсир силы', 
'reason_elixirofconstitution' => 'Приобрести бонус: Эликсир телосложения', 
'reason_elixirofintelligence' => 'Приобрести бонус: Эликсир интеллекта', 
'reason_elixirofstamina' => 'Приобрести бонус: Эликсир выносливости', 
'reason_sparringpartner' => 'Тренировка со спарринг партнером', 
'glance' => 'Подглядеть', 
'equipment_failed' => 'На вас не одеты необходимые для выполнения этого действия предметы', 
'charissick' => 'Вы не можете начать медитацию, пока больны', 
'reason_dailyreward' => 'Ежедневный приз', 
'curedisease' => 'Лечить болезнь', 
'curehealth' => 'Восстановить здоровье', 
'initiation' => 'Обращение в веру', 
'error_structure_tool_missing' => 'В здании отсутствуют необходимые для совершения действия инструменты', 
'confirm_operation_consume' => 'Подтверждаете употребление %d %s', 
'equipment_failed_craft' => 'Для этого действия вы должны быть одеты и обуты, а также держать %s', 
'reason_ipcheckshield' => 'Купить Защиту от проверки IP-адреса', 
'reason_rosary' => 'Купить Чётки', 
'reason_supercart' => 'Купить Профессиональную телегу', 
'reason_elixirofcuredisease' => 'Купить Зелье излечения болезенй', 
'attack' => 'Атака', 
'error-moduleisdisabled' => 'Эта фича временно отключена.', 
'equipmentfailed_missing' => 'Вам нужно надеть следующие предметы чтобы совершить это действие: %s', 
'equipmentfailed_wrong' => 'Вы не можете совершить это действие потому что на вас надеты следующие предметы:<br/> %s.', 
'info-unequippedall' => 'Вы сняли все снаряжение.', 
'senditems_updatesponsorstats' => 'Обновить статистику покуки дублонов', 
'sendinfo' => 'Отправка этих предметов будет стоить <span class=\'value\' id=\'cost\'>?</span> серебряных монет и будет доставлена в течении <span class=\'value\' id=\'time\'>?</span>.', 
'marketbuyitem_cannotbuyreserveditem' => 'Вы не можете купить этот предмет, он зарезервирован для другого персонажа.', 

);

?>