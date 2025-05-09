<?php
namespace App\Controllers;

use App\Core\Controller;

class SellerDashboard extends Controller
{
    public function index(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_COOKIE["session"]) && !isset($_SESSION["session"])) {
            header("Location: login");
            exit();
        }

        if (isset($_POST["logout"])) {
            session_destroy();
            setcookie("session", "", time() - 3600);
            header("Location: login");
            exit();
        }

        $data = [
            "user" => isset($_COOKIE["session"])
                ? json_decode($_COOKIE["session"], true)
                : $_SESSION["session"],
        ];

        $this->view("sellerDashboard", $data);
    }
}
