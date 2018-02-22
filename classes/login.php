<?
class login extends ACore{
    
    protected function proc_post(){
        $login = strip_tags(mysql_real_escape_string($_POST['login']));
        $password = strip_tags(mysql_real_escape_string($_POST['password']));
        
        if(!empty($login) && !empty($password)){
            $password = md5($password);
            
            $query = "SELECT id FROM t_users WHERE(login = '$login' AND password = '$password')";
            $result = mysql_query($query);
            if(!$result){
                exit(mysql_error());
            }
            
            if(mysql_num_rows($result) == 1){
                $_SESSION['user'] = true;
                header("Location:?item=admin");
                exit();
            }else{
                echo('Такого пользователя нет!');
                exit();
                
            }
        }else{
            echo('Заполните обязательные поля!');
        }
    }
    
    public function get_content(){
    
        $HTML .= "<div class='auth_div'>
        <div id='body_page'>";
        
        $HTML .= "<form action='' method='post' >
            <p>Логин: <br>
                <input type='text' name='login' >
            </p>
            <p>Пароль: <br>
                <input type='password' name='password' >
            </p>
            <p><input type='submit' name='add_button' value='Войти' class='enter_login'>
            </p>
        </form>"; 
        
        $HTML .= " </div></div>" ;
          
       return ($HTML)  ;
       
    }
    
}
?>