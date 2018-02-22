<?
class add_categ extends ACore_admin{
    
    protected function proc_post(){
        
        $name = $_POST['name'];
        
        if(empty($name)){
            exit("Не заполнены обязательные поля: название");
        }
        
        
        $query = "INSERT into t_categ (categ) VALUES ('$name')";
        if(!mysql_query($query)){
            exit(mysql_error());
        }else{
            $_SESSION['res'] = "Изменения сохранены. Добавить еще один пункт";
            header("Location:?item=add_categ");
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
            <p>Наименование категории <br>
                <input type='text' name='name' style='width: 350px;'>
            </p>
            <p><input type='submit' name='add_button' value='Сохранить'>
            </p>
        </form>
        </div>";  
       return $HTML;
    }
    
}
?>