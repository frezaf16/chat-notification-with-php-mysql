<?php



/*==============================================================================================================

 * Nama Dokumen : model_post.php 

 * Fungsi       : Membuat fungsi crud

 * Penulis      : Faisal Reza
 * Website      : http://www.coding-arena.id

 *==============================================================================================================*/



class model_post

{

    private $db;

    

    public function __construct($db_conn)

    {

        $this->db = $db_conn;

    }

    

    public function allchat()

    {

        $sql = 'SELECT chat_nama, chat_pesan, chat_waktu FROM al_chat ORDER BY chat_id ASC';

         

        /* Prepare statement */

        $stmt = $this->db->prepare($sql);

         

        /* Execute statement */

        $stmt->execute();

         

        /* Fetch result to array */

        $stmt->bind_result($chat_nama, $chat_pesan, $chat_waktu);

        $stmt->store_result();        

        $count = $stmt->num_rows;

        

        $data = array();

        $i = 0;

        

        while($stmt->fetch()){

            $i++;

            $data[$i]['chat_nama'] = $chat_nama;

            $data[$i]['chat_pesan'] = $chat_pesan;

            $data[$i]['chat_waktu'] = $chat_waktu;

        }


        

        return array('data' => $data, 'count' => $count);

    }

    

    public function simpanchat($nama, $pesan, $waktu)

    {

        $sql = 'INSERT INTO al_chat (chat_nama, chat_pesan, chat_waktu) VALUES (?, ?, ?)';

        

        /* Prepare statement */

        $stmt = $this->db->prepare($sql);

         

        /* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */

        $stmt->bind_param('sss', $nama, $pesan, $waktu);

        $stmt->execute();

        

        // Check for successful insertion

        if ( $stmt->affected_rows ) {

            return true;

        }

			

        return true;

    }

    

    
    public function hitungchat()

    {

        $sql = 'SELECT chat_nama, chat_pesan, chat_waktu FROM al_chat ORDER BY chat_id DESC';

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        

        $stmt->bind_result($chat_nama, $chat_pesan, $chat_waktu);

        $stmt->store_result();        

        $count = $stmt->num_rows;

        

        return $count;

    }

    

    public function waktuchat($datetime, $full = false) {

        $now = new DateTime;

        $ago = new DateTime($datetime);

        $diff = $now->diff($ago);

    

        $diff->w = floor($diff->d / 7);

        $diff->d -= $diff->w * 7;

    

        $string = array(

            'y' => 'tahun',

            'm' => 'bulan',

            'w' => 'minggu',

            'd' => 'hari',

            'h' => 'jam',

            'i' => 'menit',

            's' => 'detik',

        );

        foreach ($string as $k => &$v) {

            if ($diff->$k) {

                if($v == 'tahun'){

                    list($tanggal, $waktu) = explode(' ', $datetime);

                    list($tahun, $bulan, $hari) = explode('-', $tanggal);

                    $v = $hari.'-'.$bulan.'-'.$tahun.' '.$waktu;

                } else {

                    $v = $diff->$k . ' ' . $v . ' yang lalu';

                }

            } else {

                unset($string[$k]);

            }

        }

        

        if (!$full) $string = array_slice($string, 0, 1);

        return implode(', ', $string);

    }

}