var app = angular.module("myApp", [
    "ngRoute",
    "ngSanitize",
    'pascalprecht.translate'
]);

// load config from file
app.constant('config', window.config);

// translations
app.config(['$translateProvider', 'config', function ($translateProvider, config) {

    $translateProvider.useStaticFilesLoader({
        prefix: 'js/lang/',
        suffix: '/lang.json'
    });
    $translateProvider.preferredLanguage(config.lang);

}]);

// routes
app.config(function ($routeProvider) { 
    $routeProvider 

        .when('/', { 
            controller: 'OffersController', 
            templateUrl: 'js/components/offers/index.html' 
        })   
        .when('/application/:offerId', { 
            controller: 'ApplicationController', 
            templateUrl: 'js/components/application/index.html' 
        })  
        .when('/application-sent', { 
            // controller: 'ApplicationController', 
            templateUrl: 'js/components/application/sent.html' 
        })     
        .otherwise({ 
            redirectTo: '/' 
        }); 
        
});

// CORS fix
app.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
    }
]);


app.run(function($rootScope, $sce) {

    // when URL changes
    $rootScope.$on( "$routeChangeStart", function(event, next, current) {

        // scroll iframe to top
        window.scrollTo(0, 0);
        
    });


    // fix for displaying html from model
    $rootScope.trustAsHtml = function(string) {
        return $sce.trustAsHtml(string);
    };

});

