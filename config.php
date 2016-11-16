<?php
/* config.php */
function dbcon()
{
    @mysql_connect("localhost:8889", "root", "root") or die(mysql_error());
    @mysql_select_db("hprod") or die(mysql_error());
}
?>