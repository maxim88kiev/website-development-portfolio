<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?include 'include/right_column.php'?>
<div class="content_block_rs__left_cont">
<div class="article">
    <?=$arResult['PROPERTIES']['PROPERTY_TEXT']['~VALUE']['TEXT']?>
</div>

<?include 'include/block_user.php'?>
