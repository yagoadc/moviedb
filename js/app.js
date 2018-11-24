var myApp = angular.module('starter', ['ui.router', 'starter.controllers'])

.config(function($stateProvider,$urlRouterProvider) {
  
  $stateProvider

  .state('app', {
    url: '/app',
    templateUrl: 'templates/menu.html?version='+version,
    controller: 'AppCtrl'
  })

  .state('app.principal', {
    url: '/principal',
    templateUrl: 'templates/principal.html?version='+version+"1",
    controller: 'PrincipalCtrl'
  })

  $urlRouterProvider.otherwise(function ($injector, $location) {
    var $state = $injector.get("$state");
    $state.go("app.principal");
  });
})