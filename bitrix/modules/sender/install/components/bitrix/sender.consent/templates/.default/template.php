<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

use Bitrix\Main\Localization\Loc;
/** @var CAllMain $APPLICATION */
/** @var array $arParams */
/** @var array $arResult */

\Bitrix\Main\UI\Extension::load([
		'ui.layout-form',
		'ui.buttons',
		'ui.common',
		'ui.opensans',
	]
);
\CJSCore::Init();
?>

<?if($arParams['SHOW_HTML_META'] === 'Y'):?>
	<!doctype html>
	<html>
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<?$APPLICATION->ShowHead()?>
	</head>
	<body>
<?endif;?>
<div class="sender-message-done">
	<div class="sender-message-mailing-icon"></div>
	<div class="ui-title-1"><?=Loc::getMessage('SENDER_CONSENT_DEFAULT_TITLE')?></div>
	<div class="ui-title-3"
	>			<?if($arResult['SUCCESS']):?>
			<?=$arResult['METHOD'] === 'apply'? Loc::getMessage('SENDER_CONSENT_APPLY') : Loc::getMessage('SENDER_CONSENT_REJECT')?>
		<?elseif(!empty($arResult["ERROR"])):?>
			<?=htmlspecialcharsbx($arResult["ERROR"])?>
		<?endif;?>
	</div>
</div>
<?if($arParams['SHOW_HTML_META'] === 'Y'):?>
	</body>
	</html>
<?endif;?>