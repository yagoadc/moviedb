var controllers = angular.module('starter.controllers',[]);
var tempDate = new Date();
var version =('00' + (tempDate.getMonth() + 1)).slice(-2) + ('00' + tempDate.getDate()).slice(-2);

controllers
.controller('AppCtrl', function($scope,$state,AjaxService,$timeout,$sce) {  
  //tipo: error,success,warning,info
  $scope.alert = function(tipo,_texto){
    var texto = "";
    switch(tipo) {
      case 'Error_Red':
          titulo = 'Error';
          texto = 'Error de red, actualizar e intente de nuevo';
          tipoAlerta = "error";
          break;
      default:
          titulo = 'Error';
          texto = 'Error Indefinido, comunicarse al 3006513170, con este dato:' + tipo;
          tipoAlerta = "error";
          break;
    }

    $timeout(function() {
      swal({
        title: titulo,
        text: texto,
        icon: tipoAlerta,
        button: "OK",
      });
    }, 10);
    
  }

  $scope.confirm = function(titulo,texto,callBack){
    swal({  
      title: titulo,   
      text: texto,   
      icon: "warning",
      buttons: {
          cancel: {
            text: "Cancelar",
            value: "cancel",
            visible: true,
          },
          aceptar: {
            text: "Aceptar",
            value: "ok",
          }
        },
      }).then((value) => {
      switch (value) {
     
        case "ok":
          callBack();
          break;
     
        case "cancel":
          break;
     
        default:
          break;
      }
    }).catch(err => {
      console.log(err);
      swal.stopLoading();
      swal.close();
    });;
  }
})

.controller('PrincipalCtrl',function($scope,AjaxService,$timeout,FilmeService){
  var filme = {
    Nome: "harry potter",
    tipo: "magia",
    Diretor: "Daniel",
    Id: "1"
  }

  FilmeService.getAllFilmes(AjaxService.miAjax).then(function(data){
    //resposta do resolve
    $scope.Filmes = data;
    $timeout(function(){
      $('#example').DataTable({
          "searching": false,
          "info":     false,
          "lengthChange": false
      });    
  },10); 
  }, function(){
    //resposta do reject
  });
})