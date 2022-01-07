<?php 

// Working draft.

rex_extension::register('YCOM_AUTH_USER_CHECK', function ($ep) {
    // backendnutzer bei jedem seitenaufruf einloggen (wg ycom benutzerwechsel)
    if (rex_backend_login::hasSession() && $beUser = rex_backend_login::createUser()) {
        if ($beUser->isAdmin() || $beUser->hasPerm('permdafuer[]')) {
            $user_id = rex_get('user_id', 'int', 0);
            if ($user_id) {
                $ycom_user = rex_ycom_auth::loginWithParams(['id' => $user_id]);
                if ($ycom_user) {
                    return true;
                }
            }
        }
    }
});
