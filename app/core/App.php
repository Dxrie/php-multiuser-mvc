<?php
use App\Controllers\Home;
use App\Controllers\Auth;
use App\Controllers\SellerAuth;
use App\Controllers\AdminAuth;
use App\Controllers\SellerDashboard;
use App\Controllers\AdminDashboard;

class App
{
    private $routes = [
        "/" => [Home::class, "index"],
        "/login" => [Auth::class, "login"],
        "/register" => [Auth::class, "register"],
        "/seller/register" => [SellerAuth::class, "index"],
        "/seller/dashboard" => [SellerDashboard::class, "index"],
        "/admin/login" => [AdminAuth::class, "index"],
        "/admin/dashboard" => [AdminDashboard::class, "index"],
    ];

    public function __construct()
    {
        $url = $this->parseURL() ? "/" . $this->parseURL() : "/";

        if (array_key_exists($url, $this->routes)) {
            $controller = $this->routes[$url][0];
            $method = $this->routes[$url][1];
            $controller = new $controller();
            $controller->$method();
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
    /**
     * @return mixed
     */
    public function parseURL()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return $url;
        }
    }
}
