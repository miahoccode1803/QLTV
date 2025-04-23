<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $host = 'localhost';
        $db   = 'QLTVQLTV';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $options);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function prepare($sql) {
        return $this->pdo->prepare($sql);
    }

    public function getData($table, $field = NULL , $id = NULL) {
        $sql = "";
        if ($field == NULL && $id == NULL) {
            $sql = "SELECT * FROM $table";
        } else {
            $sql = "SELECT * FROM $table WHERE $field = :id";
        }
        $stmt = $this->prepare($sql);
        if ($field == NULL && $id == NULL) {
            $stmt->execute();
        } else {
            $stmt->execute([':id' => $id]);
        }
        
        return $stmt;
    }

    public function getDatas($sql) {
        $stmt = $this->prepare($sql);
        $stmt->execute();
        
        return $stmt;
    }

    function insert_data($table, $data) {
        // Tạo một mảng để lưu trữ các trường và các giá trị
        $fields = array();
        $values = array();
      
        // Duyệt qua mảng dữ liệu để lấy các trường và các giá trị
        foreach ($data as $field => $value) {
          // Thêm dấu ngoặc kép cho các trường
          $fields[] = "`$field`";
          // Thêm dấu hai chấm cho các giá trị
          $values[] = ":$field";
        }
      
        // Nối các trường và các giá trị thành chuỗi, cách nhau bởi dấu phẩy
        $fields = implode(", ", $fields);
        $values = implode(", ", $values);
      
        // Tạo câu truy vấn SQL để thêm dữ liệu vào bảng
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        
      
        // Chuẩn bị câu truy vấn
        $stmt = $this->prepare($sql);
      
        // Thực thi câu truy vấn với mảng dữ liệu
        try {
            $stmt->execute($data);
        } 
        catch (PDOException $e) {
            echo $e;
            exit;
        }
        
      
        // Trả về số dòng bị ảnh hưởng
        return $stmt->rowCount();
    }

    function update_data($table, $data, $where) {
        // Tạo một mảng để lưu trữ các trường và các giá trị
        $fields = array();
      
        // Duyệt qua mảng dữ liệu để lấy các trường và các giá trị
        foreach ($data as $field => $value) {
          // Thêm dấu ngoặc kép cho các trường
          $fields[] = "`$field` = :$field";
        }

        // Nối các trường và các giá trị thành chuỗi, cách nhau bởi dấu phẩy
        $fields = implode(", ", $fields);

      
        // Tạo câu truy vấn SQL để thêm dữ liệu vào bảng
        $sql = "UPDATE $table SET $fields WHERE $where";
        // Chuẩn bị câu truy vấn
        $stmt = $this->prepare($sql);

        
      
        // Thực thi câu truy vấn với mảng dữ liệu
        try {
            $stmt->execute($data);
        } 
        catch (PDOException $e) {
            return -1;
        }
        
      
        // Trả về số dòng bị ảnh hưởng
        return $stmt->rowCount();
    }

    function delete_data($table, $where) {
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $this->prepare($sql);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return -1;
        }

        return $stmt->rowCount();
    }
}
?>