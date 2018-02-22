<?
class delete_subcateg extends ACore_admin{
   
    public function proc_post(){
        if($_GET['del']){
            $id = (int)$_GET['del'];
            
            $query = "DELETE FROM t_subcateg WHERE (id_subcateg='$id')";
            if(mysql_query($query)){
                $_SESSION['res'] = "Удалено";
                header("Location:?item=edit_subcateg");
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