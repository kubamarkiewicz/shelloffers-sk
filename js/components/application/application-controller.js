app.controller('ApplicationController',function($scope, $rootScope, $http, $routeParams, config, shellAnalyticsService, $translate) {  

    $scope.offerData = null;

    // load offer data
    $http({
        method  : 'GET',
        url     : config.api.urls.getOffers + '/' + $routeParams.offerId
     })
    .success(function(data) {
        $scope.offerData = data;
    });

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
    $.validator.addMethod("phone", function(phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 0 &&
            phone_number.match(/^[0-9\-\+\s\(\)]+$/);
    }, $translate.instant('application.tel-required'));

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, $translate.instant('application.filesize-limit')+' 5MB');

	$("#my-form").validate({
		rules: {
			firstname: {
                required: true,
                maxlength: 25
            },
			lastname: {
                required: true,
                maxlength: 50
            },
			email: {
				required: true,
				email: true,
                maxlength: 35
			},
            tel: {
                required: true,
                phone: true,
                maxlength: 20
            },
            city: {
                maxlength: 40
            },
			message: {
                maxlength: 1000
            },
            file_1: {
                filesize: 5200000,
                extension: "docx,doc,rtf,pdf"
            },
            file_2: {
                filesize: 5200000,
                extension: "docx,doc,rtf,pdf"
            }
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
    $translate(['application.field-required', 'application.email-required', 'application.file-extension', 'application.maxlenght']).then(function (translations) {
    	jQuery.extend(jQuery.validator.messages, {
    		required: translations['application.field-required'],
            email: translations['application.email-required'],
            extension: translations['application.file-extension'],
            maxlength: jQuery.validator.format(translations['application.maxlenght'])
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