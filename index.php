<?php
require "src/util/helpers.php";

$attempt = $_GET["attempt"];

$jsonForPersonsInfo = file_get_contents("dateBase/data_cars.json");
if (isset($jsonForPersonsInfo) && !empty($jsonForPersonsInfo)) {
  $personsInfo = json_decode($jsonForPersonsInfo, true);
  $personCount = count($personsInfo);
}

$jsonForAttemptsInfo = file_get_contents("dateBase/data_attempts.json");
if (isset($jsonForAttemptsInfo) && !empty($jsonForAttemptsInfo)) {
  $attemptsInfo = json_decode($jsonForAttemptsInfo, true);
}

$attemptCount = 0;
$fullInfo = [];
$defaultLocation = "Location: /index.php?attempt=fullResult";

if (isset($attemptsInfo) && !empty($attemptsInfo) && isset($personsInfo) && !empty($personsInfo)) {
  $attemptCount = count($attemptsInfo) / count($personsInfo);

  if (!$attempt) {
    header($defaultLocation);
  }

  if ($attempt !== "fullResult" && !((int)$attempt <= $attemptCount)) {
    header($defaultLocation);
  }

  if ($attempt === "fullResult" || ((int)$attempt && (int)$attempt <= $attemptCount)) {
    foreach ($personsInfo as $personKey => $person) {
      $fullresult = 0;
      $currentNumber = 0;
      $attemptInfo = [];

      foreach ($attemptsInfo as $attemptKey => $attemptValue) {
        if ($attemptValue["id"] === $person["id"]) {
          $fullresult += $attemptValue["result"];
          $currentNumber += 1;
          $key = strval($currentNumber) . "-result";
          $attemptInfo[$key] = $attemptValue["result"];
        }
      }
      $fullInfo[$personKey] = array_merge($person, $attemptInfo);
      $fullInfo[$personKey]["fullResult"] = $fullresult;
    }
  }
}

if ($attempt === "fullResult") {
  usort($fullInfo, function ($a, $b) {
    return $a["fullResult"] < $b["fullResult"];
  });
}

if ((int)$attempt && (int)$attempt <= $attemptCount) {
  usort($fullInfo, function ($a, $b) {
    return $a[$_GET["attempt"] . "-result"] < $b[$_GET["attempt"] . "-result"];
  });
}


$dataForTemplate["fullInfo"] = $fullInfo;
$dataForTemplate["attemptCount"] = $attemptCount;

if (isset($dataForTemplate)) {
  $page_content = include_template("table.php", $dataForTemplate);
  $layout_content = include_template("layout.php", ["content" => $page_content, "title" => "table"]);
} else {
  $layout_content = include_template("layout.php", ["content" => "ERROR 404", "title" => "table"]);
}

if (isset($layout_content) && !empty($layout_content)) {
  print($layout_content);
}

$fd = fopen("src/sass/variables/dinamic.scss", 'w');
fwrite($fd, "$" . "columnCount: " . ($attemptCount + 5) . ";");
fwrite($fd, "$" . "rowCount: " . ($personCount + 1) . ";");
fclose($fd);
