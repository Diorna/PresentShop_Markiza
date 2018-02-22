<?

abstract class ACore_admin{
    
    protected $db;
    
    //Конструктор класса, при создании объекта выполняет подключение к БД db_markiza
    public function __construct(){
        
        if(!$_SESSION['user']){
            header("Location:?item=login");
        }
        
        $this->db = mysql_connect(HOST,USER,PASS);
        if(!$this->db){
            exit("Ошибка соединения с базой данных".mysql_error());
        }
        if(!mysql_select_db(DB,$this->db)){
            exit("Такой базы данных не существует".mysql_error());
        }
    }
    
//---------------Метод построения и вывода верхнего меню
    protected function get_top_menu(){
        
        include "temp/header.tpl";
        
        $HTML = "";
        $HTML .= "<h2>Разделы для редактирования: </h2>";
        $HTML .= "<a href='?item=admin'class='admin_menu'>Карточки товаров</a>";
        $HTML .= "<a href='?item=edit_menu'class='admin_menu'>Меню</a>";
        $HTML .= "<a href='?item=edit_category'class='admin_menu'>Категории товаров</a>";
        
        $HTML .= "<a href='?item=edit_subcateg' class='admin_menu'>Подкатегории товаров</a>";
        
        $HTML .=   "</div>";
        $HTML .= "<div class='enter_registration'>
                            <div id='enter'>
                                <a href='#'>Вход<i class='fa fa-sign-in' aria-hidden='true'></i></a>
                            </div>
                            <div id='registration'>
                                <a href='#'>Регистрация<i class='fa fa-check-square' aria-hidden='true'></i></a>
                            </div>
                      </div>
                    </div>
                </header>";
        return ($HTML);
    }
//------------------Метод построения и вывода футера сайта на экран
    protected function get_footer(){
        include 'temp/footer.tpl';
        $HTML .= "
              <div class='rights'>
                <a href=''> &copy;".date('Y')." Маркиза</a>
              </div>
            </footer>
        </body>
        </html>";
        return $HTML;
    }
    
//------------Вывод всех элементов страницы
    public function get_body(){
        if($_POST || $_GET['del']){
            $this->proc_post();
        }
        echo $this->get_top_menu();
        echo $this->get_content();
        echo $this->get_footer();
        
    }
    
//----------Абстрактный метод вывода контента, перегружается во всех дочерних классах
    abstract function get_content();
    
    
//Метод для получения массива элементов, хранящихся в базе данных    
    protected function item_array($query){
        $result = mysql_query($query);
        if(!$result){
            exit(mysql_error());
        }
        $row = array();
        
        for($i=1;$i <= mysql_num_rows($result); $i++){
            $row[] = mysql_fetch_array($result, MYSQL_ASSOC);
        }
        return $row;
    }
    
    protected function get_categories(){
        $query = "SELECT * from t_categ";
        $row = $this->item_array($query);
        return $row;
    }
    protected function get_colorProduct(){
        $query = "SELECT * from t_color";
        $row = $this->item_array($query);
        return $row;
    }
    protected function get_subcateg($id){
        $query = "SELECT * from t_subcateg WHERE (id_categ='$id')";
        $row = $this->item_array($query);
        return $row;
    }
    protected function get_text_description($id){
        $query = "SELECT * from t_catalog WHERE (id = '".$id."')";
        $result = mysql_query($query);
        if(!$result){
            exit(mysql_error());
        }
        $row = array();
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        
        return $row;
    }
    protected function get_text_menu($id){
        $query = "SELECT * from t_menu WHERE (id = '".$id."')";
        $result = mysql_query($query);
        if(!$result){
            exit(mysql_error());
        }
        $row = array();
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        
        return $row;
    }
    protected function get_categ($id){
        $query = "SELECT * from t_categ WHERE (id = '".$id."')";
        $result = mysql_query($query);
        if(!$result){
            exit(mysql_error());
        }
        $row = array();
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        
        return $row;
    }
    
    protected function get_subcategory($id){
        $query = "SELECT * from t_subcateg WHERE (id_subcateg = '".$id."')";
        $result = mysql_query($query);
        if(!$result){
            exit(mysql_error());
        }
        $row = array();
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        
        return $row;
    }
    
    
}
?>