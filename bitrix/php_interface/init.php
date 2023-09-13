<?
AddEventHandler("iblock", "OnAfterIblockElementAdd", "FillCodeField");
function FillCodeField(&$arFields) {
    global $USER;
    
    $arTransParams = array( //(максимальная длина кода,регистр(нижний,верхний,не менять),
			//заменять пробел на...,остальные символы менять на...,удалять лишние символы замены)
	   "max_len" => 100,
	   "change_case" => 'L', // 'L' - toLower, 'U' - toUpper, false - do not change
	   "replace_space" => '-',
	   "replace_other" => '-',
	   "delete_repeat_replace" => true
	);
    $codeName = CUtil::translit($arFields['NAME'], "ru", $arTransParams);
    // AddMessage2Log($codeName, "block3");

    $el = new CIBlockElement;
    $arProps = ["MODIFIED_BY" => $USER->GetID(), "CODE" => $codeName];
    $res = $el->Update($arFields['ID'], $arProps);
}
?>