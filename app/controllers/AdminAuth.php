<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flasher;

class AdminAuth extends Controller
{
    public function index(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_COOKIE["session"])) {
            header("Location: ..");
            exit();
        }

        if (isset($_SESSION["session"])) {
            header("Location: ..");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["username"] ?? "";
            $password = $_POST["password"] ?? "";
            $remember = $_POST["remember"] ?? false;

            $admin = $this->model("AdminModel")->getByUsername($username);

            if (!$admin || !password_verify($password, $admin["password"])) {
                Flasher::setFlash("Invalid username or password", "danger");
                $this->view("adminLogin");
                return;
            }

            if ($remember) {
                $user = [
                    "id" => $admin["id"],
                    "username" => $admin["name"],
                    "role" => "admin",
                ];

                setcookie("session", json_encode($user), time() + 60 * 60 * 24);
            } else {
                $_SESSION["session"] = [
                    "id" => $admin["id"],
                    "username" => $admin["name"],
                    "role" => "admin",
                ];
            }

            header("Location: dashboard");
            exit();
        }

        $this->view("adminLogin");
    }
}
