<?php
$addon = rex_addon::get('ycom_impersonate');
$form = rex_config_form::factory($addon->name);

$field = $form->addSelectField('default_id', null, ['class' => 'form-control']);
$field->setAttribute('class', 'form-control selectpicker');
$field->setAttribute('"data-live-search', 'true');
$field->setLabel($addon->i18n('ycom_impersonate_default_id'));
$select = $field->getSelect();
$select->setSize(1);
$select->addOption($addon->i18n('ycom_impersonate_select'),0);
$mSql = rex_sql::factory();
        foreach ($mSql->getArray('SELECT id, firstname, name FROM ' . rex::getTablePrefix() . 'ycom_user ORDER BY name') as $m) {
            $select->addOption($m['firstname'].' '.$m['name'], (int) $m['id']);
}
$field->setNotice($addon->i18n('ycom_impersonate_default_id_notice'));

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $addon->i18n('ycom_impersonate_settings'), false);
$fragment->setVar('body', $form->get(), false);
echo $fragment->parse('core/page/section.php');
