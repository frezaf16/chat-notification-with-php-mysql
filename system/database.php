<?php



/*==============================================================================================================

 * Nama Dokumen : database.php 

 * Fungsi       : Mengkoneksikan ke database mysql

 * Penulis      : Faisal Reza

 * Website      : http://coding-arena.id

 *==============================================================================================================*/



class database

{
    public $conn;
    private $dbhost;
    private $dbuser;
    private $dbpass;
    private $dbname;

    function __construct($params = array())
    {
        $this->conn   = false;
        $this->dbhost = 'localhost'; 
        $this->dbuser = 'root';
        $this->dbpass = '';
        $this->dbname = 'al_blog_demo';
        $this->connect();
    }

    

    function connect()

    {

        if (!$this->conn) {

            

            $this->conn = @new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);

            

            // cek koneksi  berhasil atau tidak

            if ($this->conn->connect_error) {

               // jika terjadi error, matikan proses dengan die() atau exit();

               die('Gagal menyambungkan ke database: '. $this->conn->connect_error);

            }

		}

 

		return $this->conn;

    }

}
