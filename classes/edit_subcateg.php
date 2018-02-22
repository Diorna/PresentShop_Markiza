<?
class edit_subcateg extends ACore_admin{
    
    public function get_content(){
        $query = 'SELECT * from t_subcateg';
        $result = mysql_query($query);
        if(!$result){
            exit(mysql_errno());
        }
        
        $HTML = "<div class='page_admin'>";
        $HTML .= "<a href='?item=add_subcateg'>Добавить новую подкатегорию</a>";
        
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        
        $row = array();
        
        for($i=0;$i<mysql_num_rows($result);$i++){
            $row = mysql_fetch_array($result,MYSQL_ASSOC);
            $HTML .= "<p class = 'name_itemList'>
                        <a href='?item=delete_subcateg&del=".$row['id_subcateg']."' class='del_product' title='Удалить данную подкатегорию'>x</a> 
                        <a href='?item=update_subcateg&id_subcateg=".$row['id_subcateg']."' title='Редактировать подкатегорию'>".$row['name_subcateg']."</a>
                      </p>";
            
        }
        $HTML .= "</div>";
        return($HTML);
    }
    
}
?>