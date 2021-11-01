<?php
require_once (__DIR__.'\Db.php');
class Router {

    protected $link;
    protected $db;
    public function __construct()
    {
        $this->db=new Db();
        $this->link=trim($_SERVER['REQUEST_URI'], '/');
    }

    public function randomd(){
        $text = ['!', '@', '#', '$', '%', '&', '?', '-', '+', '=', '~', 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $num = count($text);
        do{
            for ($i = 0; $i <= 7; $i++) {
                $new_url .= $text[rand(0, $num)];
            }
            $params = [
                'link' => $new_url,
            ];
            $link = $this->db->row('Select * From link_url Where url=:link', $params);
                    } while(!empty($link));
        return $new_url;
    }

    public function run()
    {

        if($this->link==='' && empty($_POST)){
           $tex=!empty($_POST['link']) ? 'Insert the link':'';
            echo '<html>
<head>
    <title>link shortening</title>
    <meta charset="utf-8">
    <style>
        body{
            background-color:#1d2fcf;
            font-size: 20px;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            overflow: auto;
               }
        form{
            width: 350px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -125px 0 0 -125px;
        }
        input{
            width: 100%;
            height: 30px;
            border-radius: 9px;
            font-size: 15px;
        }
        button{
            width: 50%;
            margin-top: 25px;
            margin-left: 25%;
            height: 42px;
            background-color: chartreuse;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<form action="/" method="post">
'.$tex.'
<p style="font-size: 20px;color:white;text-align: center">Link Shortening Service</p>
    <input name="link" placeholder="Https://linp.ru/fhhsd">
    <button>Shorten</button>
</form>
</body>
</html>';
        }elseif (isset($this->link)&& isset($_POST['link']) ) {

            $new_url=$this->randomd();
            $params = [
                'id' => NULL,
                'new_url' =>$new_url,
                'url' => $_POST['link'],
            ];
            $this->db->query('INSERT INTO link_url VALUES (:id, :new_url,:url)', $params);
            echo '
<head>
    <title>link shortening</title>
    <meta charset="utf-8">
    <style>
        body{
            background-color:#1d2fcf;
            color:white;
            font-size: 20px;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            overflow: auto;
               }
        input{
            width: 350px;
            height: 25px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -125px 0 0 -125px;
        }
        button{
         width: 50px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -77px 0 0 0px;
        }
       </style>
</head>
<body>
<a href="/" style="color: white;">Home</a>     <input id="Inp" value="https://' . $_SERVER['SERVER_NAME'] . '/' . $new_url.'">
<button onclick="copy()">Copy text</button>

<script>
function copy() {
  var copyText = document.getElementById("Inp");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text");
}
</script>
</body>

</html>';
        }
else {

            $params = [
                'link' => $this->link,
            ];

            $link = $this->db->row('Select * From link_url Where url=:link', $params);
            $link=$link[0]['send_url'];
           header("Location: $link");
            die();
            exit();

        }
    }

}