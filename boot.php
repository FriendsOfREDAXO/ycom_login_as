<?php
rex_extension::register('YCOM_AUTH_USER_CHECK', function ($ep) {
    // inspired by Ingo Winter
    if (rex_backend_login::hasSession() && $beUser = rex_backend_login::createUser()) {
        if ($beUser->isAdmin() || $beUser->hasPerm('ycom[]')) {
            $addon = rex_addon::get('ycom_login_as');
            $user_id = (int) $addon->getConfig('default_id');
            /*
            $user_id_link = rex_get('ycom_user_id', 'int', 0);
            if ($user_id_link > 0) {
                $user_id = $user_id_link;
            }
            */
            if (($user_id >= 1 && !rex_ycom_auth::getUser()) || $user_id_link && rex_ycom_auth::getUser() && $ycom_user->id != $user_id_link) {

                if ($ycom_user = rex_ycom_auth::loginWithParams(['id' => $user_id])) {
                    $addon->setProperty('ycom_login_as', true);
                    return true;
                }
            }
        }
    }
});

/*
if (rex::isBackend() && rex_request('table_name') == 'rex_ycom_user') {
    rex_extension::register('YFORM_DATA_LIST', function ($ep) {
        // die Liste holen
        $list = $ep->getSubject();
        $list->setColumnFormat('login', 'custom', function ($params) {
            return $params['list']->getValue('login') . '<br><a target="_blank" rel="noreferrer noopener" href="' . rex_url::frontend() . '?ycom_user_id=' . $params['list']->getValue('id') . '">' . rex_i18n::msg('ycom_impersonate_login_as') . ' ' . $params['list']->getValue('login') . '</a>';
        });
    });
}
*/
