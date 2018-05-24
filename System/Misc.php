<?php
final class Misc {
    public final static function redirect($link) {
        ob_clean();
        header('Location: ' . Configuration::BASE . $link);
        exit;
    }

    public final static function redirectAbsolute($link) {
        ob_clean();
        header('Location: ' . $link);
        exit;
    }
}
