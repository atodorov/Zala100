<?php
require 'mysql_connection.php';

// Get news by user id
function getNewsByUserId($id) {
	return getQuery("SELECT * FROM club_news cn
					 RIGHT JOIN news n ON n.id = cn.News_Id
					 LEFT JOIN club_members cm ON cm.Club_Id = cn.Club_Id
					 WHERE cn.id IS NULL OR cm.User_id = " . $user_id);
}
/* Possible query for getNewsById
"select n.* from club_news cn
right join news n on n.id = cn.News_Id
where cn.id is null

union 

select n.* from club_news cn
inner join news n on n.id = cn.News_Id
left join club_members cm on cm.Club_Id = cn.Club_Id
where cm.User_Id = " . $user_id
*/

?>