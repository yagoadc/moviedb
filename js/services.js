myApp
 
.service('AjaxService', function($q, $http){

  function miAjax(successCall,errorCall,info,tipo){
    // //console.log(info,tipo);
    var data = $.param(info);
    $http({
      method: 'POST',
      url: 'php/vistas/'+tipo+'Asistcole.php',
      dataType: "json",
      data,
      headers : {
        "Content-Type": "application/x-www-form-urlencoded;charset=utf-8"
      }
      }).then(function successCallback(response) {
        // console.log(response.data)
        successCall(response.data);
        // successCall(response);
      }, function errorCallback(response) {
        errorCall(response);
        // called asynchronously if an error occurs
        // or server returns response with an error status.
      });
  }

  return {
    miAjax:miAjax,
  };
})

.service('FilmeService', function($q, $http){

  var insertFilme = function(filme,functionAjax){
    return $q(function(resolve, reject) {
      var getsuccess = function(data){
        // console.log(data);
        resolve(data.contenido);
      }

      var geterror = function(response){
        // console.log(response);
        reject('no funciona');
      }

      var data = {
        nome: filme.Nome,
        tipo: filme.Tipo,
        diretor: filme.Diretor,
        id: filme.Id,
        get: 'filme'
      };
      functionAjax(getsuccess,geterror,data,'delete');
    });
  };

  var getAllFilmes = function(functionAjax){
    return $q(function(resolve, reject) {
      var getsuccess = function(data){
        // console.log(data);
        resolve(data.contenido);
      }

      var geterror = function(response){
        // console.log(response);
        reject('no funciona');
      }

      var data = {
        get: 'Filmes'
      };

      functionAjax(getsuccess,geterror,data,'get');
      
    });
  };

  return {
    insertFilme: insertFilme,
    getAllFilmes: getAllFilmes,
  };
})