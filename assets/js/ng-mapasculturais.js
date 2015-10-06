//Inicia o mapa para a busca e configura o timeout do scroll
jQuery(document).ready(function() {

    if ($('body').hasClass('action-search')) {
        MapasCulturais.Map.initialize({mapSelector: '.js-map', locateMeControl: false, exportToGlobalScope: true, mapCenter: MapasCulturais.mapCenter});
    }

});


(function(angular) {
    var app = angular.module('ng-mapasculturais', []);
    app.config(["$httpProvider", function($httpProvider) {

            $httpProvider.responseInterceptors.push(['$q', '$rootScope', function($q, $rootScope) {

                return function(promise) {
                    $rootScope.$broadcast("event:startProgress");
                    return promise
                        .then(
                            function(response) {
                                $rootScope.$broadcast("event:endProgress");
                                return response;
                            },
                            function(response) { //on error
                                $rootScope.$broadcast("event:endProgress");
                                return $q.reject(response);
                            }
                        );

                };
            }]);
        }]);
})(angular);

