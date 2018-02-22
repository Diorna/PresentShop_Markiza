<?
class add_subcateg extends ACore_admin{
    
    protected function proc_post(){
        
        $name = $_POST['name'];
        $categ_parent = $_POST['categ'];
        
        if((empty($name))||(empty($categ_parent))){
            exit("Не заполнены обязательные поля: название подкатегории и категория - родитель");
        }
        
        
        $query = "INSERT into t_subcateg (name_subcateg, id_categ) VALUES ('$name', '$categ_parent')";
        if(!mysql_query($query)){
            exit(mysql_error());
        }else{
            $_SESSION['res'] = "Изменения сохранены. Добавить еще один пункт";
            header("Location:?item=add_subcateg");
            exit;
        }
    }
    
    
    public function get_content(){
        
        $categ = $this->get_categories();
        
        $HTML .= "<div class='page_admin'>";
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        $HTML .= "<form action='' method='post'>
            <p>Наименование подкатегории <br>
                <input type='text' name='name' style='width: 350px;'>
            </p>";
        $HTML .= "</select>
            </p>
            <p>Категория: <br>
                <select name='categ' id='categ'>
                    <option value=' '> </option>";
         foreach($categ as $item){
             $HTML .= " <option value='".$item['id']."'>".$item['categ']."</option>";
         }   
         $HTML .= "  </select>";
        
        
        $HTML .= "    <p><input type='submit' name='add_button' value='Сохранить'>
            </p>
        </form>
        </div>";  
        
       return $HTML;
    }
    
}
?>