<?php
// Here's an example query that will take a long time to execute.
$sql = "
  select *
  from information_schema.tables t1
  join information_schema.tables t2
  join information_schema.tables t3
  join information_schema.tables t4
  join information_schema.tables t5
  join information_schema.tables t6
  join information_schema.tables t7
  join information_schema.tables t8
";

$mysqli = mysqli_connect('localhost', 'root', '');
$mysqli->query($sql, MYSQLI_ASYNC | MYSQLI_USE_RESULT);
$links = $errors = $reject = [];
$links[] = $mysqli;

// wait up to 1.5 seconds
$seconds = 1;
$microseconds = 500000;

$timeStart = microtime(true);

if (mysqli_poll($links, $errors, $reject, $seconds, $microseconds) > 0) {
  echo "query finished executing. now we start fetching the data rows over the network...\n";
  $result = $mysqli->reap_async_query();
  
  if ($result) {
    while ($row = $result->fetch_row()) {
      // print_r($row);
      
      if (microtime(true) - $timeStart > 1.5) {
        // we exceeded our time limit in the middle of fetching our result set.
        echo "timed out while fetching results\n";
        var_dump($mysqli->close());
        break;
      }
    }
  }
} else {
  echo "timed out while waiting for query to execute\n";
  
  // kill the thread to stop the query from continuing to execute on
  // the server, because we are abandoning it.
  var_dump($mysqli->kill($mysqli->thread_id));
  var_dump($mysqli->close());
}
