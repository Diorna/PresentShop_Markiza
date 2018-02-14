<?
class catalog extends ACore{
    
    public function get_content(){
    
      $HTML .= "<div id='body_page'>";
        
      $query = 'Select id, name, image, color, price, date FROM t_catalog ORDER BY date'; 
      $result=mysql_query($query);
        if(!$result){
            exit(mysql_error());
        }
      
        
    $HTML .= "<div class='catalog'>";
    
        $row = array();
        for($i=0;$i<mysql_num_rows($result);$i++){
            $row = mysql_fetch_array($result,MYSQL_ASSOC);
            $HTML .= "<div class = 'one_tovar'>
                <pre>".$row['name']."</pre>
                <pre class='price'>".$row['price']." =</pre>
                <img src='".$row['image']."'><br>
                <span class='link_infoAboutProduct'><a href='?item=view&id_product=".$row['id']."'>Подробнее</a></span>
                <span class='link_BuyProduct'>В корзину</span>
            </div>";
        }
        
    $HTML .= " </div></div>" ;
          
       return ($HTML)  ;
       
    }
    
}
?>