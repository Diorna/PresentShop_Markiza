<?
class edit_menu extends ACore_admin{
    
    public function get_content(){
        $query = 'SELECT id, name_menu from t_menu';
        $result = mysql_query($query);
        if(!$result){
            exit(mysql_errno());
        }
        
        $HTML = "<div class='page_admin'>";
        $HTML .= "<a href='?item=add_menu'>Добавить пункт меню</a>";
        
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        
        $row = array();
        
        for($i=0;$i<mysql_num_rows($result);$i++){
            $row = mysql_fetch_array($result,MYSQL_ASSOC);
            $HTML .= "<p class = 'name_itemList'>
                        <a href='?item=delete_menu&del=".$row['id']."' class='del_product' title='Удалить пункт меню'>x</a> 
                        <a href='?item=update_menu&id_menu=".$row['id']."' title='Редактировать информацию о товаре'>".$row['name_menu']."</a>
                      </p>";
        }
        
        
        $HTML .= "</div>";
        return($HTML);
    }
    
}
?>