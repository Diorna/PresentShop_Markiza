<?
class add_menu extends ACore_admin{
    
    protected function proc_post(){
        
        $name = $_POST['name'];
        $description = $_POST['description'];
        
        if(empty($name) || empty($description)){
            exit("Не заполнены обязательные поля: название, описание");
        }
        
        
        $query = "INSERT into t_menu (name_menu,text_menu) VALUES ('$name', '$description')";
        if(!mysql_query($query)){
            exit(mysql_error());
        }else{
            $_SESSION['res'] = "Изменения сохранены. Добавить еще один пункт? ";
            header("Location:?item=add_menu");
            exit;
        }
        
    }
    
    
    public function get_content(){
        
        $HTML .= "<div class='page_admin'>";
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        $HTML .= "<form action='' method='post'>
            <p>Заголовок меню <br>
                <input type='text' name='name' style='width: 350px;'>
            </p>
            <p>Текст <br>
                <textarea name='description' id='description' cols='60' rows='10'></textarea>
            </p>
            <p><input type='submit' name='add_button' value='Сохранить'>
            </p>
        </form>
        </div>";  
       return $HTML;
    }
    
}
?>