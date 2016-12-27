<?php
#atur timezone
date_default_timezone_set('Asia/Jakarta');

include 'system/database.php';
include 'system/model_post.php';

$db     = new database();
$post   = new model_post($db->connect());
$chat   = $post->allchat();

$datachat = '';
foreach($chat['data'] as $c){
    $datachat .= '<div class="item">
                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> '.$post->waktuchat($c['chat_waktu']).'</small>
                                '.$c['chat_nama'].'
                            </a>
                            '.$c['chat_pesan'].'
                        </p>
                    </div>';
}

$data = array();
$data['countchat']   = $chat['count'];
$data['newchat']    = $datachat;/*'<div class="item">
                        <p class="message">
                            <a href="#" class="name">
                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> '.$post->waktuchat($chat['row']['chat_waktu']).'</small>
                                '.$chat['row']['chat_nama'].'
                            </a>
                            '.$chat['row']['chat_pesan'].'
                        </p>
                    </div>';*/
        
echo json_encode($data);