<?php
#atur timezone
date_default_timezone_set('Asia/Jakarta');

include 'system/database.php';
include 'system/model_post.php';

$db     = new database();
$post   = new model_post($db->connect());
$db     = $db->connect();

if(isset($_POST['nama'])){
    $nama = $_POST['nama'];
    $pesan = $_POST['pesan'];
    $waktu  = date('Y-m-d H:i:s');
    
    $post->simpanchat($nama, $pesan, $waktu);
    
    $jumlah = $post->hitungchat();
    
    $data = array();
    $data['countchat']   = $jumlah;
    $data['newchat']    = '<div class="item">
                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right">'.$post->waktuchat($waktu).'</small>
                                '.$nama.'
                            </a>
                            '.$pesan.'
                        </p>
                    </div>';
            
    echo json_encode($data);
}