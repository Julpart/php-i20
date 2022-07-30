<?php
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$link = new mysqli(DB['host'], DB['login'], DB['password'], DB['base']);
if (!$link) {
    echo 'Ошибка: ' .  mysqli_connect_errno() . ':' . mysqli_connect_error();
}



function selectById(int $id, string $base)
{
    $baseId = "{$base}_id";
    global $link;
    if (!$link) {
        die('Ошибка соединения с базой данных');
    }
    $sql = "SELECT * FROM $base where $baseId = ?";
    $stmt = $link->prepare($sql);
    if (!$stmt) die('Ошибка запроса');
    $stmt->bind_param('i',  $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    return ($row);
}


function selectCategory($a = 1)
{
    global $link;
    if (!$link) {
        die('Ошибка соединения с базой данных');
    }
    $sql = "SELECT s.section_id, s.header, count(p.product_id) as count FROM section s 
	LEFT JOIN sectionproduct sp ON sp.section_id = s.section_id 
    LEFT JOIN product p ON p.product_id =sp.product_id and p.display = true
    GROUP BY s.section_id
    HAVING count>=$a
    ORDER BY count DESC";
    $result = $link->query($sql);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
    return ($rows);
}

function selectProductsOfCategory(int $id, bool $bool = true, int $start = 0, int $end = 0)
{
    if ($bool) {
        $limit = "12";
    } else {
        $limit = "{$start}, {$end}";
    }
    global $link;
    if (!$link) {
        die('Ошибка соединения с базой данных');
    }
    $sql = "SELECT p.product_id,p.header as name,p.mainSection_id,s.header as category ,i.url,i.alt FROM `product` p
    JOIN section s
    ON s.section_id = p.mainSection_id
    JOIN image i
    ON i.image_id = p.mainimg_id
    JOIN sectionproduct sp
    ON sp.product_id=p.product_id
    WHERE sp.section_id = $id and p.display=true LIMIT $limit;";
    $result = $link->query($sql);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
    return ($rows);
}
function selectCountOfCategory(int $id)
{
    global $link;
    if (!$link) {
        die('Ошибка соединения с базой данных');
    }
    $sql = "SELECT count(*) as count FROM `product` p
    JOIN sectionproduct sp
    ON sp.product_id=p.product_id
    WHERE sp.section_id = $id and p.display=true;";
    $result = $link->query($sql);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    return $row['count'];
}
function selectProductCat(int $id)
{
    global $link;
    if (!$link) {
        die('Ошибка соединения с базой данных');
    }
    $sql = "SELECT s.section_id,s.header FROM `section` s
        JOIN sectionproduct sp
        ON sp.section_id = s.section_id
        WHERE sp.product_id = $id";
    $result = $link->query($sql);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
    return ($rows);
}
function selectProductImg(int $id)
{
    global $link;
    if (!$link) {
        die('Ошибка соединения с базой данных');
    }
    $sql = "SELECT i.image_id,i.url,i.alt FROM `image` i
        JOIN imageproduct ip
        ON ip.image_id = i.image_id
        WHERE ip.product_id = $id";
    $result = $link->query($sql);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
    return ($rows);
}
function submitForm($name, $email, $date, $gender, $theme, $info, $contract)
{
    global $link;
    if (!$link) {
        return false;
    }
    $sql = "INSERT INTO form(name,email,date,gender,theme,info,contract) VALUES(?,?,?,?,?,?,?)";
    $stmt = $link->prepare($sql);
    if (!$stmt) {
        return false;
    }
    if ($contract == "on") {
        $contract = 1;
    } else $contract = 0;
    $stmt->bind_param('ssssssi',  $name, $email, $date, $gender, $theme, $info, $contract);
    if ($stmt->execute()) return true;
    else return false;
}
