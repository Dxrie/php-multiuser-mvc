<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Flasher;

class SellerAuth extends Controller
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

        $user = isset($_COOKIE["session"])
            ? json_decode($_COOKIE["session"], true)
            : $_SESSION["session"];

        if ($user["role"] === "penjual") {
            header("Location: ..");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($this->model("UserModel")->getByUsername($user["username"])) {
                if (
                    $this->model("UserModel")->getSellerByUsername(
                        $_POST["seller_name"]
                    )
                ) {
                    Flasher::setFlash("Seller already exists", "danger");
                    $this->view("sellerRegister");
                    return;
                }

                $success = $this->model("UserModel")->registerSeller(
                    $_POST["seller_name"],
                    $_POST["description"],
                    $user["id"]
                );

                if ($success) {
                    if (isset($_SESSION["session"])) {
                        $_SESSION["session"]["role"] = $this->model(
                            "UserModel"
                        )->getRoleById($user["id"])["role"];
                    } elseif (isset($_COOKIE["session"])) {
                        $_COOKIE["session"]["role"] = $this->model(
                            "UserModel"
                        )->getRoleById($user["id"])["role"];
                    }

                    Flasher::setFlash(
                        "Seller registered successfully",
                        "success"
                    );
                    header("Location: ..");
                    exit();
                } else {
                    Flasher::setFlash("Failed to register seller", "danger");
                    $this->view("sellerRegister");
                    return;
                }
            } else {
                Flasher::setFlash("User not found.", "danger");
                $this->view("sellerRegister");
                return;
            }
        } else {
            $this->view("sellerRegister");
        }
    }
}
