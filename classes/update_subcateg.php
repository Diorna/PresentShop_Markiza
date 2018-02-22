<? 
    class update_subcateg extends ACore_admin{
    
    protected function proc_post(){
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $category = $_POST['categ'];
        
        $query = "UPDATE t_subcateg SET name_subcateg='$name', id_categ = '$category' WHERE (id_subcateg = '$id')";
        if(!mysql_query($query)){
            exit(mysql_error());
        }else{
            $_SESSION['res'] = "Изменения сохранены.";
            header("Location:?item=edit_subcateg");
            exit;
        }
    }
    
    public function get_content(){
        if($_GET['id_subcateg']){
            $id_subcateg = (int)$_GET['id_subcateg'];
        }else{
            exit("Неправильные данные для страницы");
        }
        $subcateg_description = $this->get_subcategory($id_subcateg);
        $categ = $this->get_categories();
        
        $HTML .= "<div class='page_admin'>";
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        
        
        $HTML .= "<form action='' method='post'>
            <p>Заголовок подкатегории: <br>
                <input type='text' name='name' style='width: 350px;' value = '".$subcateg_description['name_subcateg']."'>
                <input type='hidden' name='id' style='width: 350px;' value = '".$subcateg_description['id_subcateg']."'>
            </p>
            <p>Категория - родитель: <br>
                <select name='categ' id='categ'>
                    <option value=' '> </option>";
            foreach($categ as $item){
                 if($subcateg_description['id_categ'] == $item['id']){
                    $HTML .= " <option selected value='".$item['id']."'>".$item['categ']."</option>";
                }else{
                    $HTML .= " <option value='".$item['id']."'>".$item['categ']."</option>";
                }
             }                   
            $HTML .= " </select>
            </p>";
      
        $HTML .= "    
                <p><input type='submit' name='add_button' value='Сохранить'></p>
            </form>
        </div>";  

        return $HTML;
    }
}
?>