<?
class delete_categ extends ACore_admin{
   
    public function proc_post(){
        if($_GET['del']){
            $id = (int)$_GET['del'];
            
            $query = "DELETE FROM t_categ WHERE (id='$id')";
            if(mysql_query($query)){
                $_SESSION['res'] = "Удалено";
                header("Location:?item=edit_category");
                exit();
            }else{
                exit("Ошибка при удалении");
            }
            
        }else{
            exit("Неверные данные для страницы");
        }
        
    }
    
    public function get_content(){
        
    }
    
}
?>