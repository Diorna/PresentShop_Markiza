<?
class update_categ extends ACore_admin{
    
    protected function proc_post(){
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        foreach($subcateg as $item){
           
        } 
        
        if(empty($name) || empty($description)){
            exit("Не заполнены обязательные поля: название, описание");
        }
        
        $query = "UPDATE t_menu SET name_menu='$name', text_menu = '$description' WHERE (id = '$id')";
        if(!mysql_query($query)){
            exit(mysql_error());
        }else{
            $_SESSION['res'] = "Изменения сохранены.";
            header("Location:?item=edit_menu");
            exit;
        }
    }
    
    
    public function get_content(){
        
        
        
        if($_GET['id_categ']){
            $id_categ = (int)$_GET['id_categ'];
        }else{
            exit("Неправильные данные для страницы");
        }
        $categ_description = $this->get_categ($id_categ);
        
        $subcateg = $this->get_subcateg($id_categ);
        
        $HTML .= "<div class='page_admin'>";
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        $HTML .= "<form action='' method='post'>
            <p>Заголовок категории: <br>
                <input type='text' name='name' style='width: 350px;' value = '".$categ_description['categ']."'>
                <input type='hidden' name='id' style='width: 350px;' value = '".$categ_description['id']."'>
            </p>
            <p>Подгруппы категории: </p>";
            
        foreach($subcateg as $item){
            $HTML .= " 
                
                <input type='text' name='name_subcateg' style='width: 350px;' value = '".$item['name_subcateg']."'>
                <input type='hidden' name='id' style='width: 350px;' value = '".$item['id']."'>
                <a href='?item=delete_subcateg&del=".$item['id']."' class='del_product' title='Удалить данную подкатегорию'>x</a>";
        } 
        $HTML .= "    
            <p><input type='submit' name='add_button' value='Сохранить'></p>
        </form>
    </div>";  
        
        return $HTML;
    }
    
}
?>



                