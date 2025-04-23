<?php
require_once 'Models/TaiKhoan.php';
require_once 'Models/NhanVien.php';

class LoginController {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        switch ($action) {
            case 'login':
                $this->login();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index() {
        include 'Views/Login/login.php';
    }

    private function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = TaiKhoan::Login($username, $password);
            $error = '';
                $usernamenull = '';
                $passwordnull = '';
            if ($user) {
                $_SESSION['user'] = $user;
                
                
                header("location:index.php?controller=home&action=index");
            } else {
                
                if ($username == ''){
                    $error = 'Tài khoản không được để trống';
                    $usernamenull = 'border-danger';
                    include 'Views/Login/login.php';
                } elseif ($password == ''){
                    $error = 'Mật khẩu không được để trống';
                    $passwordnull = 'border-danger';
                    include 'Views/Login/login.php';
                } else {
                    $error = 'Tài khoản hoặc mật khẩu không đúng';
                    include 'Views/Login/login.php';
                }
                
            }
        }
    }
}
?>