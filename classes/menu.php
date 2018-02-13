<?
class menu extends ACore{
    
    public function get_content(){
        
        $HTML .= "<div id='body_page'>";
        
        if(!$_GET['id_menu']){
            $HTML .= "Неправильные данные для вывода пункта меню";
        }else{
            $id_menu = (int)$_GET['id_menu'];
            if(!$id_menu){
                $HTML .= "Неправильные данные для вывода товара";
            }else{
                $query = 'SELECT id, name_menu, text_menu FROM t_menu WHERE (id='.$id_menu.')'; 
                $result=mysql_query($query);
                if(!$result){
                    exit(mysql_errno());
                }
                $row = mysql_fetch_array($result, MYSQL_ASSOC);
                $HTML .= "
                            <div class='descriptionItemMemu'>
                                <div class='description'>
                                    <h2>".$row['name_menu']."</h2>
                                    <p>".$row['text_menu']."</p>
                                </div>
                                
                            </div>
                        </div>" ;
                }
            }          
       return ($HTML)  ;
       
    }
    
}
?>