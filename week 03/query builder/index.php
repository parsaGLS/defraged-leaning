<?php
interface DatabaseConnectionInterface {
    public static function getInstance(string $host, string $user,string  $password,string  $database);
    public static function getConnection() : PDO;
}

class MySqlDatabaseConnection implements DatabaseConnectionInterface
{
    private static $_instance = null;
    public function __construct()
    {
    }


    public static function getInstance(string $host, string $user,string  $password,string  $database)
    {

        if( !is_object(self::$_instance) ){
            $dsn = 'mysql:host='. $host .';dbname='. $database;
            $pdo=new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            self::$_instance = $pdo;
        }
        return self::$_instance;
    }

    public static function getConnection(): PDO
    {
        return self::$_instance;
    }
}







interface DatabaseInterface {
    public function __construct(PDO $connection);
    public function table(string $table) : DatabaseInterface;
    public function select(array $cols = ['*']) : DatabaseInterface;
    public function insert(array $fields) : DatabaseInterface;
    public function update(array $fields) : DatabaseInterface;
    public function where(string $val1, string $val2, string $operation = '='): DatabaseInterface;
    public function fetch();
    public function fetchAll();
    public function exec() : bool;
}


class MySqlDatabase implements DatabaseInterface{
    public static PDO  $connection;
    public static string $sql;
    public static string $table;
    public static array $input;
    public static string $mode;

    public function __construct(PDO $connection)
    {
            self::$connection=$connection;
    }
    public function reset(){
        self::$sql="";
        self::$table="";
        self::$input=[];
    }

    public function table(string $table): DatabaseInterface
    {
        self::$table=$table;


//        echo "<pre>";
//        echo var_dump($this);
//        echo "</pre>";

        return $this;
    }

    public function select(array $cols = ['*'], bool $distinct=false): DatabaseInterface
    {
        self::$mode="select";
        $cols_str = implode(',', $cols);
        $temp=self::$table;
        $distinct_str=" ";
        if ($distinct){
            $distinct_str=" DISTINCT ";
        }
        self::$sql= "SELECT".$distinct_str."$cols_str FROM $temp ";
        return $this;
    }
    public function delete(): DatabaseInterface{
        self::$sql="DELETE FROM ".self::$table;
        return $this;
    }

    public function insert(array $fields): DatabaseInterface
    {
        self::$mode="insert";
        self::$input=$fields;
        $keys=array_keys($fields);
        $keys_str=implode(',', $keys);
        $keys_val="";
        $lastKey = array_keys(array_reverse($fields))[0];
        foreach ($keys as $key) {
            if ($key === $lastKey) {
                $keys_val.=":".$key;
            } else {
                $keys_val.=":".$key.", ";
            }
        }
        $temp=self::$table;

        self::$sql = "INSERT INTO $temp($keys_str) VALUES($keys_val) ";

        return $this;

    }






    public function create(array $fields): DatabaseInterface
    {
        //['id']=>"attrib"
        self::$mode="create";
        self::$input=$fields;
        $keys_val="";
        $lastKey = array_keys(array_reverse($fields))[0];
        foreach ($fields as $key=>$value) {
            if ($key === $lastKey) {
                $keys_val.=$key." ".$value;
            } else {
                $keys_val.=$key." ".$value.", ";
            }
        }


        $temp=self::$table;

        self::$sql = "CREATE TABLE $temp($keys_val);";

        return $this;

    }










    public function update(array $fields): DatabaseInterface
    {
        self::$mode="update";
        self::$input=$fields;
        $keys=array_keys($fields);
        $keys_val="";
        $lastKey = array_keys(array_reverse($fields))[0];
        foreach ($keys as $key) {
            if ($key === $lastKey) {
                $keys_val.=$key." = ".":".$key;
            } else {
                $keys_val.=$key." = ".":".$key.", ";
            }
        }
        $temp=self::$table;
        self::$sql = "UPDATE $temp SET $keys_val ";

        return $this;
    }

    public function where(string $val1, string $val2, string $operation = '='): DatabaseInterface
    {
        self::$sql.=" WHERE $val1 $operation $val2 ";
        return $this;
    }



    public function order(string $val1, string $operation = ''): DatabaseInterface
    {
        self::$sql.=" ORDER BY $val1 $operation ";
        return $this;
    }
    public function group(string $val1): DatabaseInterface
    {
        self::$sql.=" GROUP BY $val1 ";
        return $this;
    }


    public function limit(string $num = '1'): DatabaseInterface
    {
        self::$sql.=" LIMIT $num ";
        return $this;
    }


    public function join(string $mode_join = '',string $table_name , string $condition): DatabaseInterface
    {
        self::$sql.=" $mode_join JOIN $table_name ON $condition ";
        return $this;
    }




    public function fetch()
    {
        $stmt= self::$connection->prepare(self::$sql);
        if (empty(self::$input)) {
            $stmt->execute();
        }else{
            $stmt->execute(self::$input);
        }
        $this->reset();
        return $stmt->fetch();
    }

    public function fetchAll()
    {
        $stmt= self::$connection->prepare(self::$sql);
        if (empty(self::$input)) {
            $stmt->execute();
        }else{
            $stmt->execute(self::$input);
        }
        $this->reset();
        return $stmt->fetchAll();
    }

    public function exec(): bool
    {
        $output=true;
        $stmt=self::$connection->prepare(self::$sql);
        if (empty(self::$input)) {
            $output= $stmt->execute();
        }else{
            if (self::$mode=="create") {
                $output= $stmt->execute();
            }else{
                $output= $stmt->execute(self::$input);
            }
        }
        $this->reset();
        return $output;





    }
}




//testing....
//MySqlDatabaseConnection::getInstance("localhost","root","","testt");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$users = $query1->table('users')->select()->fetchAll(); // get all users
//
//echo "<pre>";
// var_dump($users);
//echo "</pre>";
// echo "<br>";
// echo "<br>";
// echo "<br>";
//$query2 = new MySqlDatabase($connection);
//$user = $query2->table("users")->select()->where('id', 2)->fetch(); // get user by id = 56
//echo "<pre>";
// var_dump($user);
//echo "</pre>";
//echo "<br>";
//echo "<br>";
//echo "<br>";
//$query3 = new MySqlDatabase($connection);
//$newUser = ['name' => "mohammad", 'lastname' => "shabani"];
//$query3->table('users')->insert($newUser)->exec();




//q1
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$input=['id'=>"INT NOT NULL AUTO_INCREMENT",'name'=>"varchar(255) NOT NULL",'length'=>"FLOAT NOT NULL",'album_id'=>"INT NOT NULL",'PRIMARY'=>"KEY(id)",'FOREIGN'=>"KEY(album_id) REFERENCES albums(id)"];
//echo "<br>";
//echo $query1->table('bb')->create($input)->exec() ?"true":"false";





//q2
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('bands')->select(["name AS 'Band Name' "])->fetchAll();
//
//
//
//
////q3
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('albums')->select()->where("release_year","IS NOT NULL"," ")->order("release_year")->limit()->fetchAll();
//
//
////q4
//
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('bands')->select(["bands.name AS 'Band Name'"])->join("","albums","bands.id=albums.band_id")->fetchAll();
//
//
////q5
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('bands')->select(["bands.name AS 'Band Name'"])->join("LEFT","albums","bands.id=albums.band_id")->where("albums.name","IS NULL"," ") ->fetchAll();
//
//
//
////q6
//
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('albums')->select(["albums.name AS 'Name'","albums.release_year AS 'Release Year'","SUM(songs.length) AS 'Duration'"])->
//join(" ","songs","songs.album_id=albums.id")->
//group("albums.id")->order("Duration","DESC")->limit()->fetchAll();
//
//
//
//
////q7
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('albums')->update(['release_year'=>1986])->where("id"," (SELECT id from albums WHERE release_year IS NULL) "," IN ");
//
//
//
////q8
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('albums')->update(['release_year'=>1986])->where("id"," (SELECT id from albums WHERE release_year IS NULL) "," IN ");
//
//
//
//
////q9
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('songs')->delete()->where("songs.name"," 'kafi nist' ")->exec();
//$resut=$query1->table('albums')->delete()->where("albums.name"," 'bozorg' ")->exec();
//$resut=$query1->table('bands')->delete()->where("bands.name"," 'MEHRAD HIDDEN' ")->exec();
//
//
//
////q10
//
//
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('songs')->select(["AVG(songs.length) AS 'Average Song Duration'"])->fetchAll();
//
//
////q11
//
//
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('albums')->select(["albums.name AS 'Albuml'","albums.release_year AS 'Release Year'","MAX(songs.length) AS 'Duration'"])->
//join(" ","songs","albums.id=songs.album_id")->group("albums.id")->fetchAll();
//
//
////q12
//MySqlDatabaseConnection::getInstance("localhost","root","","record_company");
//$connection=MySqlDatabaseConnection::getConnection();
//$query1 = new MySqlDatabase($connection);
//$resut=$query1->table('bands')->select(["bands.name AS 'Band'","COUNT(songs.id) AS 'Number of Songs'"])->
//join(" ","albums","albums.band_id=bands.id")->join(" ","songs","songs.album_id=albums.id")->group("bands.id")->fetchAll();
//
//
//
//
//
//
