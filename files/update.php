<?php
define("DBUSER", "100p");
define("DBPASS", "100p_secret");
define("DBNAME", "100p");
define("DBHOST", "localhost");
$db = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
$db->query("SET NAMES utf8");
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$sql = "INSERT INTO `books` (`Name`, `Author`, `Year_Of_Publish`, `Category_Id`, `Language_Id` ) VALUES (?,?,?,?,?)";
$books_insert_statement = $db->prepare($sql);
$sql = "INSERT INTO `categories` (`Name`) VALUES (?)";
$category_insert_statement = $db->prepare($sql);
$sql = "SELECT `id` FROM `categories` WHERE `Name` = ? LIMIT 1";
$category_select_statement = $db->prepare($sql);
$sql = "INSERT INTO `languages` (`Name`) VALUES (?)";
$language_insert_statement = $db->prepare($sql);
$sql = "SELECT `id` FROM `languages` WHERE `Name` = ? LIMIT 1";
$language_select_statement = $db->prepare($sql);
$first = true;
if (($handle = fopen("books.csv", "r")) !== FALSE) 
{
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    {
        if($first)
        {
            $first=false;
            continue;
        }
        if(empty($data[0]))
        {
            continue;
        }
        $name = trim($data[1]);
        $author = trim($data[2]);
        $category = clearQuotes($data[3]);
        if(empty($category))
        {
            continue;
        }
        $year = trim($data[4]);
        $lang = (empty($data[6])) ? 'ру' : $data[6];
        $lang = trim($lang);
        
        $category_select_statement->bind_param('s',$category);
        $category_select_statement->execute();
        $category_select_statement->store_result();
        if($category_select_statement->num_rows)
        {
            $category_select_statement->bind_result($Category_Id);
            $category_select_statement->fetch();
        }
        else
        {
            $category_insert_statement->bind_param('s',$category);
            $category_insert_statement->execute();
            $Category_Id = $db->insert_id;     
        }
                
        $language_select_statement->bind_param('s',$lang);
        $language_select_statement->execute();
        $language_select_statement->store_result();
        if($language_select_statement->num_rows)
        {
            $language_select_statement->bind_result($Language_Id);
            $language_select_statement->fetch();
        }
        else
        {
            $language_insert_statement->bind_param('s',$lang);
            $language_insert_statement->execute();
            $Language_Id = $db->insert_id;     
        }
        
        $books_insert_statement->bind_param('ssiii',$name,$author,$year,$Category_Id,$Language_Id);
        $books_insert_statement->execute();
        var_dump($books_insert_statement->error);
            
    }
    fclose($handle);
}
function clearQuotes($data)
{
    return trim(str_replace(array('\'', '"'), '', $data)); 
}
?>