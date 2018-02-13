<?
class view extends ACore{
    
    public function get_content(){
        
        $HTML .= "<div id='body_page'>";
        
        if(!$_GET['id_product']){
            $HTML .= "Неправильные данные для вывода товара";
        }else{
            $id_productCard = (int)$_GET['id_product'];
            if(!$id_productCard){
                $HTML .= "Неправильные данные для вывода товара";
            }else{
                $query = 'SELECT name, description, image, price FROM t_catalog WHERE id ='.$id_productCard; 
                $result=mysql_query($query);
                if(!$result){
                    exit(mysql_errno());
                }
                $row = mysql_fetch_array($result, MYSQL_ASSOC);
                $HTML .= "
                            <div class='descriptionProduct'>
                                <div><img src='".$row['image']."'></div>
                                <div class='description'>
                                    <h2>".$row['name']."</h2>
                                    <p>".$row['description']."</p>
                                    <div class='count'>
                                        <lable>Количество: <lable>
                                        <input type='text' name='countProduct' id='countProduct' value='1'>
                                    </div>
                                    <div class='cost'>
                                        <table>
                                            <tr>
                                                <td>Цена(за 1 ед)</td>
                                                <td>".$row['price']."=</td>
                                            </tr>
                                            <tr>
                                                <td>Сумма: </td>
                                                <td>".$row['price']."=</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <span class='link_BuyProduct'>В корзину</span>
                                </div>
                                
                            </div>
                        </div>" ;
                }
            }          
       return ($HTML)  ;
       
    }
    
}
?>