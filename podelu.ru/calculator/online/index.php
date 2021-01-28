<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Тарифы банков на РКО с открытием онлайн, дистанционная подача заявки.");
$APPLICATION->SetPageProperty("description", "Список тарифов банков с открытием расчетного счета онлайн и удаленной подачей заявки. Стоимость обслуживания и переводов для ИП и ООО.");
$APPLICATION->SetTitle("Бесплатное открытие счета");
?><? $APPLICATION->IncludeComponent(
    "luckyproject:count.payment",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PAYMENT_TITLE" => "Выберите количество платежей",
        "PAYMENT_MIN" => "0",
        "PAYMENT_MAX" => "19",
        "PAYMENT_STEP" => "1",
        "PAYMENT_START" => "5"
    ),
    false
);?>

    <div id="content-bank-ajax">
        <?php
        $step = 5;
        if (isset($_GET['step'])) {
            $step = intval($_GET['step']);
        }

        $GLOBALS['arFilter'] = [
            'ID' => getTariffIdListByGeoFilter($step),
            'PROPERTY_PROPERTY_BANK' => [
                10, // Сбербанк
                1678, // Альфа-Банк
                1680, // Открытие
                1681, // Тинькофф
                1682, // Точка
                1683, // Промсвязьбанк
                1685, // РайффайзенБанк
                1694, // ДелоБанк
                1687, // МодульБанк
                // Сфера (пока нет - зарезервировать номер)
            ],
        ];
        ?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "tariff-list",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "N",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "FILTER_NAME" => "arFilter",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "2",
                "IBLOCK_TYPE" => "PODELU",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "999",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "PROPERTY_NAME",
                    1 => "PROPERTY_INTERVAL_FROM",
                    2 => "PROPERTY_INTERVAL_TO",
                    3 => "PROPERTY_OPEN_COST",
                    4 => "PROPERTY_ACCOUNT_FREE_TERM",
                    5 => "PROPERTY_ACCOUNT_PAYMENT",
                    6 => "PROPERTY_ACCOUNT_PERCENT_MOUNT",
                    7 => "PROPERTY_BUSINESS_TRANSFER",
                    8 => "PROPERTY_BUSINESS_TRANSFER_TELECOM",
                    9 => "PROPERTY_BUSINESS_TRANSFER_PAPER",
                    10 => "PROPERTY_PEOPLE_TRANSFER",
                    11 => "PROPERTY_CASH_IN_CASHBOX",
                    12 => "PROPERTY_CASH_IN_SELF",
                    13 => "PROPERTY_CASH_OUT_CASHBOX",
                    14 => "PROPERTY_CASH_OUT_SELF",
                    15 => "PROPERTY_COMMISION_FOR_INCOMING_TRANSFER",
                    16 => "PROPERTY_OVERDRAFT",
                    17 => "PROPERTY_TRADING_ACQUIRING",
                    18 => "PROPERTY_INTERNET_ACQUIRING",
                    19 => "PROPERTY_SALARY_PROJECT",
                    20 => "PROPERTY_CARD_ISSUE",
                    21 => "PROPERTY_MOBILE_BANK_CONNECTION",
                    22 => "PROPERTY_TARRIF_ZONE",
                    23 => "PROPERTY_BANK",
                    24 => "PROPERTY_COUNT_BRANCHES_IN_COUNTRY",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "PROPERTY_PROPERTY_BANK.ID",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "tariff-list"
            ),
            false
        );?>
    </div>

<?$APPLICATION->IncludeComponent(
	"ambase:faq", 
	".default", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "TAGS",
			5 => "SORT",
			6 => "PREVIEW_TEXT",
			7 => "PREVIEW_PICTURE",
			8 => "DETAIL_TEXT",
			9 => "DETAIL_PICTURE",
			10 => "DATE_ACTIVE_FROM",
			11 => "ACTIVE_FROM",
			12 => "DATE_ACTIVE_TO",
			13 => "ACTIVE_TO",
			14 => "SHOW_COUNTER",
			15 => "SHOW_COUNTER_START",
			16 => "IBLOCK_TYPE_ID",
			17 => "IBLOCK_ID",
			18 => "IBLOCK_CODE",
			19 => "IBLOCK_NAME",
			20 => "IBLOCK_EXTERNAL_ID",
			21 => "DATE_CREATE",
			22 => "CREATED_BY",
			23 => "CREATED_USER_NAME",
			24 => "TIMESTAMP_X",
			25 => "MODIFIED_BY",
			26 => "USER_NAME",
			27 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "SITE",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "PROPERTY_ASK",
			1 => "PROPERTY_QUESTION",
			2 => "PROPERTY_SHOW_IN_RKO",
			3 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"ID_LIST" => array(
			0 => "8325",
		)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>