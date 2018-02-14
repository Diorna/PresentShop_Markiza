<?
class update_menu extends ACore_admin{
    
    protected function proc_post(){
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        
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
        
        if($_GET['id_menu']){
            $id_menu = (int)$_GET['id_menu'];
        }else{
            exit("Неправильные данные для страницы");
        }
        $menu_description = $this->get_text_menu($id_menu);
        
        
        $HTML .= "<div class='page_admin'>";
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        $HTML .= "<form action='' method='post'>
            <p>Заголовок меню: <br>
                <input type='text' name='name' style='width: 350px;' value = '".$menu_description['name_menu']."'>
                <input type='hidden' name='id' style='width: 350px;' value = '".$menu_description['id']."'>
            </p>
            <p>Описание: <br>
                <textarea name='description' id='description' cols='60' rows='10'>".$menu_description['text_menu']."</textarea>
            </p>
            <p><input type='submit' name='add_button' value='Сохранить'>
            </p>
        </form>
    </div>";  
        
        
        return $HTML;
    }
    
}
?>