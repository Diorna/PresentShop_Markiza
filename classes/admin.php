<?
class admin extends ACore_admin{
    
    public function get_content(){
        $HTML = "<div class='page_admin'>";
        $query = 'SELECT id, name from t_catalog';
        $result = mysql_query($query);
        if(!$result){
            exit(mysql_errno());
        }
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        $row = array();
        $HTML .= "<a href='?item=add_product'>Добавить товар</a>";
        for($i=0;$i<mysql_num_rows($result);$i++){
            $row = mysql_fetch_array($result,MYSQL_ASSOC);
            $HTML .= "<p class = 'name_itemList'>
                        <a href='?item=delete_product&del=".$row['id']."' class='del_product' title='Удалить товар из каталога'>x</a> 
                        <a href='?item=update_product&id_product=".$row['id']."' title='Редактировать информацию о товаре'>".$row['name']."</a>
                      </p>";
        }
        
        
        $HTML .= "</div>";
        return($HTML);
    }
    
}
?>