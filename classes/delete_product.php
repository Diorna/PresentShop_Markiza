<?
class delete_product extends ACore_admin{
   
    public function proc_post(){
        if($_GET['del']){
            $id_product = (int)$_GET['del'];
            
            $query = "DELETE FROM t_catalog WHERE (id='$id_product')";
            if(mysql_query($query)){
                $_SESSION['res'] = "Удалено";
                header("Location:?item=admin");
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