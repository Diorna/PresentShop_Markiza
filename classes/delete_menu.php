<?
class delete_menu extends ACore_admin{
   
    public function proc_post(){
        if($_GET['del']){
            $id_menu = (int)$_GET['del'];
            
            $query = "DELETE FROM t_menu WHERE (id='$id_menu')";
            if(mysql_query($query)){
                $_SESSION['res'] = "Удалено";
                header("Location:?item=edit_menu");
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