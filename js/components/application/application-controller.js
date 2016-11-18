app.controller('ApplicationController',function($scope, $rootScope, $http, $routeParams, config, shellAnalyticsService, $translate) {  

    $scope.provincesData = [];

    $scope.loadProvincesData = function()
    {
        $http({
            method  : 'GET',
            url     : config.api.urls.getProvinces,
            params  : {
                all: true
            }
         })
        .success(function(data) {
            $scope.provincesData = data;
        });
    }
    $scope.loadProvincesData();

 	/*
        From validation
        Documentation of jQuery Validation Plugin: http://jqueryvalidation.org
    */
	$("#my-form").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			email: {
				required: true,
				email: true
			},
			tel: "required"
		},
        highlight: function(element) {
	        $(element).closest('.form-group').addClass("has-error");
	    },
	    unhighlight: function(element) {
	        $(element).closest('.form-group').removeClass("has-error");
	    },
		errorElement: "small",
		errorClass: "help-block"
	});

	// custom validation messages
    $translate(['application.field-required', 'application.email-required']).then(function (translations) {
    	jQuery.extend(jQuery.validator.messages, {
    		required: translations['application.field-required'],
    		email: translations['application.email-required']
        });
    });


    // SUBMIT FORM
    $scope.submit = function () {

        if (!$("#my-form").valid()) {
            return false;
        }

        // send Shell Analytics data
        shellAnalyticsService.onApplicationSent();

        var url = config.api.urls.postApplication;

        var formData = new FormData($scope.data);

        formData.append('offerId', $routeParams.offerId);

        formData.append('firstname', $scope.firstname != undefined ? $scope.firstname : '');
        formData.append('lastname', $scope.lastname != undefined ? $scope.lastname : '');
        formData.append('email', $scope.email != undefined ? $scope.email : '');
        formData.append('tel', $scope.tel != undefined ? $scope.tel : '');
        formData.append('province', $scope.province != undefined ? $scope.province.name : '');
        formData.append('city', $scope.city != undefined ? $scope.city : '');
        formData.append('message', $scope.message != undefined ? $scope.message : '');
        
        formData.append('file_1', $scope.file_1);
        formData.append('file_2', $scope.file_2);

        $http.post(url, formData, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined,'Process-Data': false}
        })
        .success(function(){
            document.location = '#/application-sent';
        })
        .error(function(){
            console.log("error");
        });
         
         
        // block button 
        $("#my-form button[type=submit]").button('loading').attr('disabled', true);

    }

});