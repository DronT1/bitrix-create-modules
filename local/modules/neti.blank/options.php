<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);

$request = HttpApplication::getInstance()->getContext()->getRequest();
$module_id = htmlspecialchars($request['mid'] != '' ? $request['mid'] : $request['id']);

Loader::includeModule($module_id);

$aTabs = array(
    array(

        'DIV'     => 'neti.blank',
        'TAB'     => Loc::getMessage('NETIAPI_OPTIONS_TAB_GENERAL'),
        'TITLE'   => Loc::getMessage('NETIAPI_OPTIONS_TAB_GENERAL'),
        'OPTIONS' => array(
            array(
                'option-1',
                Loc::getMessage('NETI_BLANK_OPTION_1'),
                '',
                array('text', 45)
            ),
            array(
                'option-2',
                Loc::getMessage('NETI_BLANK_OPTION_2'),
                '',
                array('text', 45)
            ),
            array(
                'option-3',
                Loc::getMessage('NETI_BLANK_OPTION_3'),
                '',
                array('text', 45)
            ),
        )
    )
);

$tabControl = new CAdminTabControl(
    'tabControl',
    $aTabs
);

$tabControl->begin();
?>
    <form action="<?= $APPLICATION->getCurPage(); ?>?mid=<?=$module_id; ?>&lang=<?= LANGUAGE_ID; ?>" method="post">
        <?= bitrix_sessid_post(); ?>
        <?php
        foreach ($aTabs as $aTab) {
            if ($aTab['OPTIONS']) {
                $tabControl->beginNextTab();
                __AdmSettingsDrawList($module_id, $aTab['OPTIONS']);
            }
        }
        $tabControl->buttons();
        ?>
        <input type="submit" name="apply"
               value="<?= Loc::GetMessage('NETI_BLANK_OPTIONS_INPUT_APPLY'); ?>" class="adm-btn-save" />
        <input type="submit" name="default"
               value="<?= Loc::GetMessage('NETI_BLANK_OPTIONS_INPUT_DEFAULT'); ?>" />
    </form>

<?php
$tabControl->end();

if ($request->isPost() && check_bitrix_sessid()) {
}
if ($request->isPost() && check_bitrix_sessid()) {

    foreach ($aTabs as $aTab) {
        foreach ($aTab['OPTIONS'] as $arOption) {
            if (!is_array($arOption)) {
                continue;
            }
            if ($arOption['note']) {
                continue;
            }
            if ($request['apply']) {
                $optionValue = $request->getPost($arOption[0]);
                Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(',', $optionValue) : $optionValue);
            } elseif ($request['default']) {
                Option::set($module_id, $arOption[0], $arOption[2]);
            }
        }
    }

    LocalRedirect($APPLICATION->getCurPage().'?mid='.$module_id.'&lang='.LANGUAGE_ID);

}
?>
