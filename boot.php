<?php 
$addon = rex_addon::get('ycom_impersonate');
$default_id = (int) $addon->getConfig('default_id');
// Working draft.
rex_extension::register('YCOM_AUTH_USER_CHECK', function ($ep) {
    // backendnutzer bei jedem seitenaufruf einloggen (wg ycom benutzerwechsel)
    if (rex_backend_login::hasSession() && $beUser = rex_backend_login::createUser()) {
        if ($beUser->isAdmin() || $beUser->hasPerm('ycom[]')) {
            $user_id_link = rex_get('ycom_user_id', 'int', 0);
            if ($user_id_link)
            {
                $user_id = $user_id_link;   
            }
            elseif ($user_id >= 1) {
                $user_id = $default_id;
            }
            if (($user_id >= 1 && !rex_ycom_auth::getUser()) || $user_id_link && rex_ycom_auth::getUser() && $ycom_user->id != $user_id_link ) {

                if ($ycom_user = rex_ycom_auth::loginWithParams(['id' => $user_id])) {
                    return true;
                }

            }
        }
    }
});
