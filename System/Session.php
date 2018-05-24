<?php
    final class Session {
        public final static function begin() {
            session_start();
        }

        public final static function end() {
            self::clear();
            session_destroy();
        }

        public final static function clear() {
            $_SESSION = [];
        }

        public final static function set($key, $value) {
            if (self::isValidKeyName($key)) {
                $_SESSION[$key] = $value;
                return true;
            } else {
                return false;
            }
        }

        public final static function get($key) {
            if (self::exists($key)) {
                return $_SESSION[$key];
            } else {
                return false;
            }
        }

        public final static function exists($key) {
            if (self::isValidKeyName($key)) {
                return isset($_SESSION[$key]);
            } else {
                return false;
            }
        }

        private final static function isValidKeyName($key) {
            return preg_match('/^[a-z][A-z0-9_]*$/', $key);
        }
    }
