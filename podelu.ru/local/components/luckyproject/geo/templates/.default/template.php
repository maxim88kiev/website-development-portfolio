<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php
    global $COUNT_BRANCHES_CITIES_CACHED;
    $COUNT_BRANCHES_CITIES_CACHED;
?>
<div class="geo-text-container" style="text-align: right;">
    Ваш город:
    <?php if((empty($arResult['CURRENT_CITY_NAME']))):?>
       <?php
        $arResult['CURRENT_CITY_NAME'] = 'Москва';
        $arResult['CURRENT_REGION_NAME'] = 'Москва';
        ?>
    <?php endif;?>
    <?php if( !empty($arResult['CURRENT_CITY_NAME'])) { ?>
        <?php if($arResult['CURRENT_CITY_NAME'] === 'Москва') { ?>
            <span><?php echo $arResult['CURRENT_CITY_NAME']; ?></span>
        <?php } else if($arResult['CURRENT_CITY_NAME'] === 'Санкт-Петебург') { ?>
            <span><?php echo $arResult['CURRENT_CITY_NAME']; ?></span>
        <?php } else { ?>
            <span><?php echo $arResult['CURRENT_CITY_NAME']; ?></span>
        <?php }  ?>
    <?php } else { ?>
        <span><?php echo "Выбрать"; ?></span>
    <?php } ?>
</div>

<div class="select-region-layer"></div>
<div class="select-region">
    <div class="city-close"></div>

    <p><b>Ваш город не <?php echo $arResult['CURRENT_CITY_NAME']; ?>?</b></p>

    <input type="text" name="search" placeholder="Введите город">

    <ul>
        <?php foreach($arResult['JSON_CITIES'] as $cityName) { ?>

            <?php $regionName = searchInAllGeoData($arResult['GEO_DATA'], $cityName); ?>
            <li>
                <a href="/ajax/region.php?city=<?php echo $cityName;?>&region=<?php echo $regionName; ?>"><?php echo $cityName; ?>, <?php echo $regionName; ?></a>
            </li>

        <?php } ?>
    </ul>
</div>