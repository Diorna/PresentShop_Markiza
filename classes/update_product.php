<?
class update_product extends ACore_admin{
    
    protected function proc_post(){
        if(!empty($_FILES['img_src']['tmp_name'])){
            if(!move_uploaded_file($_FILES['img_src']['tmp_name'], 'views/img/catalog/'.$_FILES['img_src']['name'])){
                exit("Не удалось загрузить файл");
            }
            $img_src = 'views/img/catalog/'.$_FILES['img_src']['name'];
        }
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $date = date("Y-m-d", time());
        $description = $_POST['description'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $category = $_POST['categ'];
        
        if(empty($name) || empty($price)){
            exit("Не заполнены обязательные поля: название, описание, цена");
        }
        
        $query = "UPDATE t_catalog SET name='$name', description = '$description', image = '$img_src', price = '$price', color = '$color', kateg = '$category', date = '$date' WHERE (id = '$id')";
        if(!mysql_query($query)){
            exit(mysql_error());
        }else{
            $_SESSION['res'] = "Изменения сохранены.";
            header("Location:?item=admin");
            exit;
        }
        
    }
    
    
    public function get_content(){
        
        $categ = $this->get_categories();
        $color = $this->get_colorProduct();
        
        if($_GET['id_product']){
            $id_product = (int)$_GET['id_product'];
        }else{
            exit("Неправильные данные для страницы");
        }
        $product_description = $this->get_text_description($id_product);
        
        
        $HTML .= "<div class='page_admin'>";
        if($_SESSION['res']){
            $HTML .= "<h3>".$_SESSION['res']."</h3>";
            unset($_SESSION['res']);
        }
        $HTML .= "<form action='' method='post' enctype='multipart/form-data'>
            <p>Наименование товара: <br>
                <input type='text' name='name' style='width: 350px;' value = '".$product_description['name']."'>
                <input type='hidden' name='id' style='width: 350px;' value = '".$product_description['id']."'>
            </p>
            <p>Изображение: <br>
                <img src='".$product_description['image']."' width='150'>
                <p>Загрузить новое изображение <input type='file' name='img_src'></p>
            </p>
            <p>Описание: <br>
                <textarea name='description' id='description' cols='60' rows='10'>".$product_description['description']."</textarea>
            </p>
            <p>Цена за единицу: <br>
                <input type='text' name='price' style='width: 50px;' value = '".$product_description['price']."'><lable>руб</lable>
            </p>
            <p>Цвет: <br>
                <select name='color' id='color'>
                    <option value=' '> </option>";
    foreach($color as $item){
        if($product_description['color'] == $item['color']){
            $HTML .= " <option selected value='".$item['id']."'>".$item['color']."</option>";
        }else{
            $HTML .= " <option value='".$item['id']."'>".$item['color']."</option>";
        }
     } 
     $HTML .= "</select>
            </p>
            <p>Категория: <br>
                <select name='categ' id='categ'>
                    <option value=' '> </option>";
     foreach($categ as $item){
         if($product_description['kateg'] == $item['id']){
            $HTML .= " <option selected value='".$item['id']."'>".$item['categ']."</option>";
        }else{
            $HTML .= " <option value='".$item['id']."'>".$item['categ']."</option>";
        }
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