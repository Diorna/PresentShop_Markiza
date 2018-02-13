<?

abstract class ACore{
    
    protected $db;
    
    //Конструктор класса, при создании объекта выполняет подключение к БД db_markiza
    public function __construct(){
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
        
        include "header.tpl";
        
        $HTML = "";
                $query = "SELECT id,name_menu FROM t_menu where (id>=7)";
                $row = $this->item_array($query); //Вызов метода создания массива элементов верхнего меню  
                foreach($row as $item){
                    //Настройка классов стилей для активных ссылок
                    if($item['id']==$_GET['id_menu']){
                        $clmenu="a";
                    } else {
                        $clmenu="n";
                    }

                    $HTML .= "<a href='?item=menu&id_menu=".$item['id']."'class='".$clmenu."menu'>"
                        .$item['name_menu']."</a>";
                };
                
        
        $HTML .=   "</div>";
                $query = "SELECT link_vk,link_inst FROM company where(id=1)";
                $row = $this->item_array($query);
        foreach($row as $item)
        {
            $HTML .=       "<div class='social_top'>
                            <a href='".$item['link_vk']."' target='_blank'>
                                <i class='fa fa-vk' aria-hidden='true'></i>
                            </a>
                            <a href='".$item['link_inst']."' target='_blank'>
                                <i class='fa fa-instagram' aria-hidden='true'></i>
                            </a>  
                        </div>";
        }   
                    
            $HTML .= "<div class='call_manager'>
                            <div id='manager'>
                                Звонок менеджеру
                            </div>
                            <div id='connection'>
                                <input type='button' class='btn_call_buzzer' data-toggle='modal' data-target='#call-order'value ='8 982 243 93 99'>
                            </div>
                        </div>
                        
                        <div class='enter_registration'>
                            <div id='enter'>
                                <a href='#'>Вход<i class='fa fa-sign-in' aria-hidden='true'></i></a>
                            </div>
                            <div id='registration'>
                                <a href='#'>Регистрация<i class='fa fa-check-square' aria-hidden='true'></i></a>
                            </div>
                        </div>
                    </div><hr>";
        return ($HTML);
    }
//------------------Метод построения и вывода шапки сайта на экран
    protected function get_header(){
        
        
            $HTML .= "  <div id='about'>
                            <a href='https://yandex.ru/maps/-/CBU1b6hZsA' target='_blank' title='Перейти на карту'>ТЦ Весна<br>Инженерная 3а</a>
                            <br/>8 982 243 93 99
                        </div>
                        <div id='info'>
                            <div class='dost'>
                                Доставка по Перми
                            </div>
                            <div class='assort'>
                                Яркие эмоции для любимых
                            </div>
                        </div>
                        <div class='basket'>
                            <i class='fa fa-shopping-basket' aria-hidden='true'></i>
                        </div>
                    </header>
                    <div class='main_menu'>
                        <div id='menuShow'>
                            <i class='fa fa-bars' aria-hidden='true'></i>
                        </div>
                        <div id='hideMenu'>";
        
        $query = "SELECT * FROM `t_kateg`";
        $row = $this->item_array($query); //Вызов метода создания массива элементов меню  
        foreach($row as $item){
            //Настройка классов стилей для активных ссылок
            if($item['id']==$_GET['id_menu']){
                $clmenu="a";
            } else {
                $clmenu="n";
            }
            
            $HTML .= "<a href='?item=category&id_categ=".$item['id']."'class='".$clmenu."menu'>
            ".$item['kateg']."</a>";
        }
        $HTML .= "  </div> 
                    <div id='search'>
                        <span>Поиск</span>
                        <i class='fa fa-search' aria-hidden='true'></i>
                    </div>
                    
                    <div id='mobileMenu'>";
        foreach($row as $item){
            $HTML .= "<a href='?item=category&id_categ=".$item['id']."'class='nmenu'>
            ".$item['kateg']."</a><br/>";
        }
        $HTML .= "<hr></div>
                </div>";
        return $HTML;
    }

    
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
 
    protected function get_footer(){
        $query = "SELECT * FROM company";
        $row = $this->item_array($query); //Вызов метода создания массива элементов меню 
        include 'footer.tpl';
        
        foreach($row as $item)
        $HTML = "
                <div class='footer_item'>
                    <h4>Сделать заказ можно по телефону: </h4>
                    <p>".$item['telephone1']."</p>";
        if($row['telephone2']!=""){
                $HTML .= "<p>".$item['telephone2']."</p>";
        }    
        $HTML .= "</div>
                    <div class='social'>
                        <a href='".$item['link_vk']."' target='_blank'>
                            <i class='fa fa-vk' aria-hidden='true'></i>
                        </a>
                        <a href='".$item['link_inst']."' target='_blank'>
                            <i class='fa fa-instagram' aria-hidden='true'></i>
                        </a>  
                    </div>
              <div class='rights'>
                <a href=''> &copy;2015-".date('Y').' '.$item['name_company']."</a>
              </div>
            </footer>
 <!--Скрипт для изменения отображения категорий  на разных экранах-->  
                <script src='//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
                <script>
                    $('#menuShow').click(function(){
                        if($('#mobileMenu').is(':visible'))
                            $('#mobileMenu').hide();
                        else
                            $('#mobileMenu').show();
                    }) 
                    $(document).scroll(function(){
                        if($(document).width()>785){
                            if($(document).scrollTop()>$('header').height() +10)
                                $('.main_menu').addClass('fixed');
                            else
                                $('.main_menu').removeClass('fixed');
                        }
                    });

                    window.onresize = function(event){
                        $('#mobileMenu').hide();
                    }
                </script>

        </body>
        </html>";
        return $HTML;
    }
    
    //Метод вывода всех элементов страницы
    public function get_body(){
        echo $this->get_top_menu();
        echo $this->get_header();
        echo $this->get_content();
        echo $this->get_footer();
        
    }
    
    //Абстрактный метод вывода контента, перегружается во всех дочерних классах
    abstract function get_content();
    
}
?>