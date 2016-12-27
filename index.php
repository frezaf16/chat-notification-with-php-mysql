<?php

#atur timezone

date_default_timezone_set('Asia/Jakarta');



include 'system/database.php';

include 'system/model_post.php';



$db     = new database();

$post   = new model_post($db->connect());

$db     = $db->connect();



$chat = $post->allchat();

?>

<!doctype html>

<html lang="en">

<head>

<title>Membuat chat sederhana menggunakan php, mysql dan jquery</title>

<link rel="shortcut icon" href="img/favicon.ico">

<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript" src="js/jquery.playSound.js"></script>

<script type="text/javascript" src="plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script>

$(function () {

    //SLIMSCROLL FOR CHAT WIDGET

    $('#chat-box').slimScroll({

        height: '350px',

        railVisible: true,

        alwaysVisible: true

    });

});



function chatbaru(){

    timer = setInterval(function(){

  		$.ajax({ 

 			url: "ambildata.php",

 			type: "POST",

            dataType: "json",

 			cache: true,	

 			success: function(newdata){

    			 

                var newchatdata = localStorage.getItem('chatbaru');

                

                if(newchatdata == ''){

                    newchatdata = <?php echo $chat['count']; ?>;

                } else {

                    newchatdata = newchatdata;

                }

                

                var messages_content = jQuery('#chat-box');

                var shouldScroll = messages_content[0].clientHeight + messages_content[0].scrollTop >= messages_content[0].scrollHeight;

                    

                $('#chat-box').html(newdata.newchat);

                if (shouldScroll) {

                    jQuery('#chat-box').slimscroll({ scrollBy: '400px' });

                }

                        

                if(newdata.countchat > newchatdata){

                    

                    $.playSound("/audio/pling");

                    localStorage.setItem('chatbaru', newdata.countchat);

                } else {

                    localStorage.setItem('chatbaru', newdata.countchat);

                }

 			}

  		});

    }, 3500);

};



function kirimdata()

{

    form = $("#formchat");

	$.ajax({

		url: "simpandata.php",

		type: "POST",

		data: form.serialize(), // serializes the form"s elements.

        cache: true,

        dataType: "json",

		beforeSend: function(xhr) {

            // Let them know we are saving

            $(".loading").show();

			$("#kirim").val("Sedang Proses...");

            $("#nama").attr("disabled", "disabled");

            $("#pesan").attr("disabled", "disabled");

            $("#kirim").attr("disabled", "disabled");

		},

        success: function(data) {

            localStorage.setItem('chatbaru', data.countchat);

            $(".loading").hide();

            $("#nama").removeAttr("disabled");

            $("#pesan").removeAttr("disabled");

            $("#kirim").removeAttr("disabled");

			$("#nama").val("");

			$("#pesan").val("");

			$("#kirim").val("Kirim");

            $('#chat-box').append(data.newchat);

            var messages_content = jQuery('#chat-box');

            jQuery('#chat-box').slimscroll({ scrollBy: messages_content[0].scrollHeight });

		},

        error: function(jq,status,message) {

            alert("A jQuery error has occurred. Status: " + status + " - Message: " + message);

        }

	});

}



$(document).ready(function() {

    

    var messages_content = jQuery('#chat-box');

    jQuery('#chat-box').slimscroll({ scrollBy: messages_content[0].scrollHeight });

    

    chatbaru();

    

    $('#kirim').click(function(e) {

    	kirimdata();

    	e.preventDefault();

    });

});

</script>

</head>

<body>

	<div class="header">

		<div class="header-inner clearfix">

			<div class="pull-left">

				<a href="http://www.coding-arena.id" target="_blank">

                    <img src="img/logo.png" style="height: 25px;"/>

                </a>

			</div>



			<div class="pull-right">

				<p class="small-text no-margin"><a href="http://www.coding-arena.id" style="color: #FFFFFF;">Membuat chat dan notifikasi suara sederhana menggunakan php, mysql dan jquery</a></p>

			</div>

		</div>

	</div>



	<div class="container">

        <div class="content">

            <div class="box box-success">

                <div class="box-header">

                    <h3 class="box-title">Chat</h3>

                </div>

                <div class="box-body chat" id="chat-box">

                    <?php

                    foreach($chat['data'] as $row){

                    ?>

                    <div class="item">

                        <p class="message">

                            <a href="#" class="name">

                                <small class="text-muted pull-right"><?php echo $post->waktuchat($row['chat_waktu']); ?></small>

                                <?php echo $row['chat_nama']; ?>

                            </a>

                            <?php echo $row['chat_pesan']; ?>

                        </p>

                    </div>

                    <?php

                    }

                    ?>

                </div>

                <div class="box-footer">

                    <div class="loading">Loading...</div>

                    <form method="post" name="formchat" id="formchat" class="form-horizontal">

                        <div class="form-group">

                            <label for="nama" class="col-sm-2 control-label">Nama</label>

                            <div class="col-sm-10">

                                <input type="text" name="nama" class="form-control" id="nama" required="required">

                            </div>

                            <div style="clear: both;"></div>

                        </div>

                        <div class="form-group">

                            <label for="pesan" class="col-sm-2 control-label">Pesan</label>

                            <div class="col-sm-10">

                                <textarea name="pesan" class="form-control" id="pesan" required="required"></textarea>

                            </div>

                            <div style="clear: both;"></div>

                        </div>

                        <div class="form-group">

                            <input type="button" class="btn btn-info pull-right" id="kirim" value="Kirim">

                            <div style="clear: both;"></div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    

    <div class="page-footer">

	   <center><p><a href="http://www.coding-arena.id" target="_blank">Coding-Arena</a></strong></p></center>

	</div>

</body>

</html>