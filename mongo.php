<?php
  # get the mongo db name out of the env
  $mongo_url = parse_url(getenv("mongodb://humi:humi@linus.mongohq.com:10020/app10036823"));
  $dbname = str_replace("/", "", $mongo_url["path"]);

  # connect
  $m   = new Mongo(getenv("mongodb://humi:humi@linus.mongohq.com:10020"));
  $db  = $m->$dbname;
  $col = $db->access;

  # insert a document
  $visit = array( "ip" => $_SERVER["HTTP_X_FORWARDED_FOR"] );
  $col->insert($visit);

  # print all existing documents
  $data = $col->find();
  foreach($data as $visit) {
    echo "<li>" . $visit["ip"] . "</li>";
  }

  # disconnect
  $m->close();
?>