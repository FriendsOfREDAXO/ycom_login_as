<?php
rex_extension::register('YCOM_AUTH_USER_CHECK', function ($ep) {
    if (rex_backend_login::hasSession() && $beUser = rex_backend_login::createUser()) {
        if ($beUser->isAdmin() || $beUser->hasPerm('ycom[]')) {
            $addon = rex_addon::get('ycom_login_as');
            $user_id = (int) $addon->getConfig('default_id');
            if (($user_id >= 1 && !rex_ycom_auth::getUser())) {
                if ($ycom_user = rex_ycom_auth::loginWithParams(['id' => $user_id])) {
                    $addon->setProperty('ycom_login_as', true);
                    return true;
                }
            }
        }
    }
});
