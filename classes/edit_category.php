<?
class edit_category extends ACore_admin{
    
    public function get_content(){
        $query = 'SELECT id, categ from t_categ';
        $result = mysql_query($query);
        if(!$result){
            exit(mysql_errno());
        }
        
        $HTML = "<div class='page_admin'>";
        $HTML .= "<a href='?item=add_categ'>Добавить новую категорию</a>";
        
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        
        $row = array();
        
        for($i=0;$i<mysql_num_rows($result);$i++){
            $row = mysql_fetch_array($result,MYSQL_ASSOC);
            $HTML .= "<p class = 'name_itemList'>
                        <a href='?item=delete_categ&del=".$row['id']."' class='del_product' title='Удалить данную категорию товара'>x</a> 
                        <a href='?item=update_categ&id_categ=".$row['id']."' title='Редактировать категорию'>".$row['categ']."</a>
                      </p>";
            
        }
        
        
        $HTML .= "</div>";
        return($HTML);
    }
    
}
?>