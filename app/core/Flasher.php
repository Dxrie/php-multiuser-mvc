<?php
namespace App\Core;

class Flasher
{
    public static function setFlash($message, $type = "success")
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION["flash"] = [
            "message" => $message,
            "type" => $type,
        ];
    }

    public static function flash()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_SESSION["flash"])) {
            $flash = $_SESSION["flash"]; ?>
            <div class="alert alert-<?php echo htmlspecialchars(
                $flash["type"]
            ); ?>" role="alert">
                <?php echo htmlspecialchars($flash["message"]); ?>
            </div>
            <?php unset($_SESSION["flash"]);
        }
    }
}
