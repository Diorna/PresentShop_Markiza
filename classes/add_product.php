<?
class add_product extends ACore_admin{
    
    protected function proc_post(){
        if(!empty($_FILES['img_src']['tmp_name'])){
            if(!move_uploaded_file($_FILES['img_src']['tmp_name'], 'views/img/catalog/'.$_FILES['img_src']['name'])){
                exit("Не удалось загрузить файл");
            }
            $img_src = 'views/img/catalog/'.$_FILES['img_src']['name'];
        }else{
            exit("Необходимо загрузить изображение!");
        }
        
        $name = $_POST['name'];
        $date = date("Y-m-d", time());
        $description = $_POST['description'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $category = $_POST['categ'];
        
        if(empty($name) || empty($price)){
            exit("Не заполнены обязательные поля: название, описание, цена");
        }
        
        
        $query = "INSERT into t_catalog (name,description, image, price, color, kateg, date) VALUES ('$name', '$description', '$img_src', '$price', '$color', '$category', '$date')";
        if(!mysql_query($query)){
            exit(mysql_error());
        }else{
            $_SESSION['res'] = "Изменения сохранены. Добавить еще одно наименование? ";
            header("Location:?item=add_product");
            exit;
        }
        
    }
    
    
    public function get_content(){
        
        $categ = $this->get_categories();
        $color = $this->get_colorProduct();
        
        $HTML .= "<div class='page_admin'>";
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        $HTML .= "<form action='' method='post' enctype='multipart/form-data'>
            <p>Наименование товара: <br>
                <input type='text' name='name' style='width: 350px;'>
            </p>
            <p>Изображение: <br>
                <input type='file' name='img_src'>
            </p>
            <p>Описание: <br>
                <textarea name='description' id='description' cols='60' rows='10'></textarea>
            </p>
            <p>Цена за единицу: <br>
                <input type='text' name='price' style='width: 50px;'><lable>руб</lable>
            </p>
            <p>Цвет: <br>
                <select name='color' id='color'>
                    <option value=' '> </option>";
    foreach($color as $item){
         $HTML .= " <option value='".$item['id']."'>".$item['color']."</option>";
     } 
     $HTML .= "</select>
            </p>
            <p>Категория: <br>
                <select name='categ' id='categ'>
                    <option value=' '> </option>";
     foreach($categ as $item){
         $HTML .= " <option value='".$item['id']."'>".$item['categ']."</option>";
     }   
     $HTML .= "   </select>
            </p>
            <p><input type='submit' name='add_button' value='Сохранить'>
            </p>
        </form>";  
        
        
        $HTML .= "</div>";
        return $HTML;
    }
    
}
?>