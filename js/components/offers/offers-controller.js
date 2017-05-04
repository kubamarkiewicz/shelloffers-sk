app.controller('OffersController', function($scope, $rootScope, $http, config) {  

    $scope.offersData = [];
    $scope.jobTitlesData = [];
    $scope.provincesData = [];
    $scope.citiesData = [];

    $scope.filters = {};
    $scope.offersCount = 0;
    $scope.page = 1;
    $scope.pageSize = 0;
    $scope.showMoreButton = false;

    $scope.loadJobTitlesData = function()
    {
        $http({
            method  : 'GET',
            url     : config.api.urls.getJobTitles
         })
        .success(function(data) {
            $scope.jobTitlesData = data;
        });
    }
    $scope.loadJobTitlesData();

    $scope.loadProvincesData = function()
    {
        $http({
            method  : 'GET',
            url     : config.api.urls.getProvinces,
            params  : {
                jobTitleId: $scope.filters.jobTitle ? $scope.filters.jobTitle.id : ''
            }
         })
        .success(function(data) {
            $scope.provincesData = data;
        });
    }
    $scope.loadProvincesData();

    $scope.loadCitiesData = function()
    {
        $http({
            method  : 'GET',
            url     : config.api.urls.getCities,
            params  : {
                jobTitleId: $scope.filters.jobTitle ? $scope.filters.jobTitle.id : '',
                provinceId: $scope.filters.province ? $scope.filters.province.id : ''
            }
         })
        .success(function(data) {
            $scope.citiesData = data;
        });
    }
    $scope.loadCitiesData();


    $scope.loadOffersData = function(resetPage)
    {
        if (resetPage !== undefined && resetPage == true) {
            $scope.page = 1;
            $scope.showMoreButton = false;
        }
        
        $http({
            method  : 'GET',
            url     : config.api.urls.getOffers,
            params  : {
                keyword: $scope.filters.keyword,
                jobTitleId: $scope.filters.jobTitle ? $scope.filters.jobTitle.id : '',
                provinceId: $scope.filters.province ? $scope.filters.province.id : '',
                city: $scope.filters.city ? $scope.filters.city.city : '',
                page: $scope.page
            }
         })
        .success(function(data) {
            if (resetPage !== undefined && resetPage == true) {
                $scope.offersData = [];
            }
            $scope.offersData = $scope.offersData.concat(data.offers);
            $scope.offersCount = data.totalCount;
            $scope.pageSize =  data.pageSize;
            $scope.showMoreButton = ($scope.page == 1) && (data.totalCount > data.pageSize);
        });
    }

    $scope.loadNextPage = function () 
    {
        ++$scope.page;
        $scope.loadOffersData();
    }

    $scope.onOfferHeaderClick = function(event)
    {
        var article = $(event.target).closest('article');

        // check if clicked h3 or p
        if (article.hasClass('expanded') && $(event.target).is('h3')) {
            return false;
        }

        $('section.offers-list article').not(article).removeClass('expanded');
        article.toggleClass('expanded');

        $('html, body').scrollTop(article.offset().top);
    }


    // load number of offers
    $http({
        method  : 'GET',
        url     : config.api.urls.getOffers
     })
    .success(function(data) {
        $scope.offersCount = data.totalCount;
    });

    
    $scope.apply = function (event) {

        // adobe analytics track apply event
        _satellite.track('apply');

    }


});
