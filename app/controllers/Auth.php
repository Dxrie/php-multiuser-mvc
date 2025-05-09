<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flasher;

class Auth extends Controller
{
    public function login(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_COOKIE["session"])) {
            header("Location: .");
            exit();
        }

        if (isset($_SESSION["session"])) {
            header("Location: .");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["username"] ?? "";
            $password = $_POST["password"] ?? "";
            $remember = $_POST["remember"] ?? false;

            $user = $this->model("UserModel")->getByUsername($username);

            if (!$user || !password_verify($password, $user["password"])) {
                Flasher::setFlash("Invalid username or password", "danger");
                $this->view("login");
                return;
            }

            $role = $this->model("UserModel")->getRoleById($user["id"]);

            if ($remember) {
                $user = [
                    "id" => $user["id"],
                    "username" => $user["name"],
                    "role" => $role["role"],
                ];

                setcookie("session", json_encode($user), time() + 60 * 60 * 24);
            } else {
                $_SESSION["session"] = [
                    "id" => $user["id"],
                    "username" => $user["name"],
                    "role" => $role["role"],
                ];
            }

            if ($role["role"] === "penjual") {
                header("Location: seller/dashboard");
                exit();
            }

            header("Location: .");
            exit();
        } else {
            $this->view("login");
        }
    }

    public function register(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_COOKIE["session"])) {
            header("Location: .");
            exit();
        }

        if (isset($_SESSION["session"])) {
            header("Location: .");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["username"] ?? "";
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";
            $confirmPassword = $_POST["confirm_password"] ?? "";
            $phoneNumber = $_POST["phone"] ?? "";

            if ($password !== $confirmPassword) {
                Flasher::setFlash("Passwords do not match", "danger");
                $this->view("register", ["error" => "Passwords do not match"]);
                return;
            }

            $success = $this->model("UserModel")->create([
                "name" => $username,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "phoneNumber" => $phoneNumber,
            ]);

            if ($success["success"]) {
                Flasher::setFlash("Registration successful", "success");
                header("Location: login");
                exit();
            } else {
                Flasher::setFlash($success["error"], "danger");
                $this->view("register", ["error" => $success["error"]]);
                return;
            }
        } else {
            $this->view("register");
        }
    }
}
