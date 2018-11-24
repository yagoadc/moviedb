<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, X-Auth-Token, Origin, Authorization');
$req_method = $_SERVER['REQUEST_METHOD'];
// $_POST = $_GET;
class nuevoPDO
{
  private $querySql = array();
  private $options = array();
  public $res;
  public $resquery;
  public $content = "";
  private $db;
  private $token;

    public function __construct()
    {
      if(isset($_POST['bd']))
        define('db', $_POST['bd']);
      include "../conexion/connectPDO.php";
        $this->db = $db;
        $this->token = $token;

        $this->createQuery();
        $this->executeQuery();  
    }

    private function createQuery(){
      $arrayOptions = array();

      switch ($_POST['get']) {

        ///////////////////////////////////
        //----------DashService----------//
        ///////////////////////////////////
          case 'login':
            $this->querySql['query'] = 'SELECT r.Alias as Rol, r.Nombre as RolNombre,u.Id as Id,u.usuario as Nombre from usuarios as u inner join roles as r on r.Id = u.IdRol where u.Alias =:alias and u.Key =:key';
              array_push($arrayOptions,"alias","key");
            break;
          case 'Filmes':
            $this->querySql['query'] = 'SELECT Nome, Diretor, Tipo, ID from Filmes';
            break;
          default:
            http_response_code(405);
            $this->querySql['query'] = '';
      }

      $this->createOptions($arrayOptions);
    }

    private function createOptions($arrayOptions){
          foreach ($arrayOptions as $key => $value) {
          $this->options[':'.$value] = $_POST[$value];
        }
    }

    private function pdo_sql_debug($sql,$placeholders){
        foreach($placeholders as $k => $v){
            // echo $k,$v;
            $sql = preg_replace('/'.$k.'/',"'".$v."'",$sql);
        }
        return $sql;
    }

    private function executeQuery(){      
      $this->resquery = $this->pdo_sql_debug($this->querySql['query'],$this->options);
      // echo $this->resquery,"\n";
      // echo $this->querySql['query'],"\n";
      $stmt = $this->db->prepare($this->querySql['query']);
      try {
        $this->res = $stmt->execute($this->options);
        if($this->res){
          // $this->content = $stmt->fetchAll();   
          $existen=$stmt->rowCount();

          switch ($_POST['get']) {

            ///////////////////////////////////
            //----------DashService----------//
            ///////////////////////////////////
              case 'login':
                while ($row=$stmt->fetch()) {
                  $arreglo[]=array(
                    "Rol" => $row['Diretor'],
                    "Token" => $row['Diretor'],
                    "Nombre" => $row['Diretor'],
                    "RolNombre" => $row['Diretor'],
                    "Id" => $row['Diretor']
                    );
                }
                break;
              case 'Filmes':
                while ($row=$stmt->fetch()) {
                  $arreglo[]=array(
                    "Nome" => $row['Nome'],
                    "Diretor" => $row['Diretor'],
                    "ID" => $row['ID'],
                    "Tipo" => $row['Tipo']                    
                    );
                }
                break;
              default:
                http_response_code(405);
                $this->querySql['query'] = '';
          }

          if($existen>0)
          {
            $this->content = $arreglo;
          }
          else
          {
            $this->content = 0;
          }
        }
        else
        {
          $this->content = $stmt->errorInfo();
          http_response_code(406);
        }
      } catch(PDOException $e) {
        $this->content = $stmt->errorInfo();
        http_response_code(400);
      }
      $stmt = NULL;
    }
}

$w = new nuevoPDO();

$respuesta = array(
    'contenido' => $w->content,
    'response' => $w->res,
    'post' => $_POST,
    'method' =>$req_method,
    'query' =>$w->resquery,
  );
// print_r($_POST);
echo json_encode($respuesta);

?>