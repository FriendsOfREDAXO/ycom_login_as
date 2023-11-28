<?php
echo rex_view::title($this->i18n('ycom_login_as_title'));
$subpage = rex_be_controller::getCurrentPagePart(2);
rex_be_controller::includeCurrentPageSubPath();
