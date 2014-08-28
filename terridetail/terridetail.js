//Cargamos el módulo de Routing
var terriDetailApp = angular.module('terriDetailApp', ['ngRoute']);

/*
Definimos el routing*/
terriDetailApp.config(function($routeProvider) {
        $routeProvider.
          when('/', {
            templateUrl: 'territorios-list.html',
            controller: 'TerritoriosListCtrl'
          }).
          when('/:idTerritorio', {
            templateUrl: 'territorios-detail.html',
            controller: 'TerritoriosDetailCtrl'
          }).
          otherwise({
            redirectTo: '/'
          });
});

terriDetailApp.factory('provServCacheRESTful', function($http){
        return {
          list: function (callback){
            $http({
              method: 'GET',
              url: '../../apibadasid/listaterritorios',
              cache: false
            }).success(callback);
          },
          find: function(id, callback){
			$http({
              method: 'GET',
              url: '../../apibadasid/territorio/' + id,
              cache: false
            }).success(callback);
          }
        };
      });

	  /*
terriDetailApp.controller('appController',[$scope,function($scope){
	$scope.$on('LOAD',function(){$scope.loading=true});
	$scope.$on('UNLOAD',function(){$scope.loading=false});
}]);
	  
	  */

terriDetailApp.controller('TerritoriosListCtrl', function ($scope, provServCacheRESTful){
  //$scope.$emit('LOAD');
  provServCacheRESTful.list(function(territorios) {
          $scope.territorios = territorios;
  });
  //$scope.$emit('UNLOAD');
});

/*
Controller para mostrar la información de detalle de una provincia
*/
terriDetailApp.controller('TerritoriosDetailCtrl', function ($scope, $routeParams, provServCacheRESTful){
  provServCacheRESTful.find($routeParams.idTerritorio, function(territorio) {
          $scope.terriDetail = territorio;
		  console.log("Carga en scope el valor:"+$scope.terriDetail.idterritorio);
  });
});
 

terriDetailApp.filter('encodeURI', function(){
        return window.encodeURI;
      });

