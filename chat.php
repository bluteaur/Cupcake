<?php
session_start();
if($_SESSION['login'] == false || !isset($_SESSION['login']) || $_SESSION['bot'] || !isset($_POST['id'])){
 header('Location: PageNotFound.php');
 exit;
}
?>
<!doctype html>
<html>
  <head>
    <title>Cupcake Messaging</title>
    <?php
    if($_SESSION['mobile'])
       echo '<link rel="stylesheet" type="text/css" href="chatMobile.css">';
      else
       echo '<link rel="stylesheet" type="text/css" href="chat.css">';
    ?>
    <meta name="Cupcake Messaging" content="Your messaging site!">
    <meta name="Cupcake Messaging" content="We don't sell your information. You have control.">
  <style>
  <?php
     
     echo '#innerChat' . $_POST['id'] . " {\n";
echo <<<EOF
   text-color: #919191;
   font-size:6vw;
   text-align:left;
}
EOF;
     echo '#innerChat' . $_SESSION['id'] . " {\n";
echo <<<EOF
   text-color: #000000;
   font-size:6vw;
   text-align:right;
}
EOF;
  ?>
  </style>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
    var from = <?php echo $_SESSION['id']; ?>;
    $("form").on("submit", function (e) {
        e.preventDefault();
        var message = $("#message").val();
        var id = $("#to").val();
        if(message == '' || id == '' || id=='-1') {
          return;
        }
        else {
          var dataString = 'message='+ message + '& id=' + id;
          var addMessage = '<div id = innerchat' + from + '>' + message + '</div>';
          $.ajax({
               type: "POST",
               url: "MessageCenter.php",
               data: dataString,
               success: function(){
                 //var keep =  document.getElementById('chatbox').innerHTML;
                 //document.getElementById('chatbox').innerHTML = keep + addMessage;
                 document.getElementById('message').innerHTML = "";
               }
           });
        }
    }
    var row = 0;
    function myFunction()
    {
        $.ajax({                                      
      url: 'getMessages.php',                  //the script to call to get data          
      data: "id=<?php echo $_post['id']; ?>&row=" + row,    //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply
      {
        row++;
        var message = data[0];         //get message
        if(message == null || !isset(data[0]) || data[0] == ' ')
           return;
        //--------------------------------------------------------------------
        // 3) Update html content
        //--------------------------------------------------------------------
        $('#chatbox').append("<div id=innerChat<?php echo $_POST['id']; ?>>" + data[0] + "</div>"); //Set output element html
        //recommend reading up on jquery selectors they are awesome 
        // http://api.jquery.com/category/selectors/
      } 
    });
  }); 

        setTimeout(myFunction, 3000);
    }

    myFunction();
  </script>
  </head>
  <body>
    <div id="LoginForm">
       To be made.<br />
       <?php
         if($_SESSION['mobile']){
            echo '<div id=chatbox><div id=innerChat'. $_POST['id'] .'>Start of chat.</div></div>';
            echo <<<EOF
            <form action = "">
              <input type="submit" id="send" name="send">
EOF;
echo '              <input type="hidden" name="to" value="'. $_POST['id'] .'">\n';
echo <<<EOF
              <textarea name="message" placeholder="Type something"></textarea>
            </form>
EOF;
         }
       ?>
       Received id: <?php echo $_POST['id']; ?><br />
       <a href="main.php">Click here to go back!</a><br />
    </div>
  </body>
</html>
