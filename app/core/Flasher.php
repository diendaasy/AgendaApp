<?php

class Flasher
{

    public static function setFlash($icon, $title, $text)
    {
        $_SESSION['flash']['icon'] = $icon;
        $_SESSION['flash']['title'] = $title;
        $_SESSION['flash']['text'] = $text;
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<script>
                    Toast.fire({
                        icon: "' . $_SESSION['flash']['icon'] . '",
                        title: "' . $_SESSION['flash']['title'] . '",
                        text: "' . $_SESSION['flash']['text'] . '",

                    });
                </script>';
            unset($_SESSION['flash']);
        }
    }
}
