<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Перспектива</title>
    <style>
        table {
            border-spacing: 0;
            border-collapse: separate;
        }
    </style>
</head>
<body>
<table border="1" width="100%">
    <tr bgcolor="yellow">
        <th>Название</th>
        <th>Сcылка</th>
        <th>Дата</th>
        <th>Время</th>
    </tr>
    <?php

    function dom($souce)
    {
        $dom = new DOMDocument();
        $dom->loadHTMLFile($souce);
        $articles = $dom->getElementsByTagName("div");
        foreach ($articles as $article) {
            $class = $article->getAttribute("class");
            if ($class === "genericItemView") {
                $title = $article->getElementsByTagName("h2")->item(0);
                if ($title->getAttribute("class") === "genericItemTitle") {
                    $value = trim($title->nodeValue);
                    echo "<td>$value</td>";
                }
                $link = $title->getElementsByTagName("a")->item(0);
                $value = $link->getAttribute("href");
                echo "<td>http://rgazeta.by$value</td>";
                $date = $article->getElementsByTagName("span")->item(0);
                if ($date->getAttribute("class") === "genericItemDateCreated") {
                    $matches = array();
                    $value = trim($date->nodeValue);
                    preg_match("/[0-9][0-9]/", $value, $matches);
                    echo "<td>$matches[0].03.2016</td>";
                }
                if ($date->getAttribute("class") === "genericItemDateCreated") {
                    $matches = array();
                    $value = trim($date->nodeValue);
                    preg_match("/[0-9][0-9]\:[0-9][0-9]/", $value, $matches);
                    echo "<td>$matches[0]</td>";
                }
                echo "</tr>";
            }
        }
    }

    error_reporting(0);
    $from = $_REQUEST["from"];
    for ($i = $from; $i < 32; $i++) {
        dom("http://rgazeta.by/component/k2/itemlist/date/2016/3/$i.html");
        dom("http://rgazeta.by/component/k2/itemlist/date/2016/3/$i.html?start=12");
        dom("http://rgazeta.by/component/k2/itemlist/date/2016/3/$i.html?start=24");
    }
    ?>
</table>
</body>
</html>