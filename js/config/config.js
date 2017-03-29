
window.config = window.config || {};

window.config.env = "prod"; // dev|prod

window.config.lang = "sk";

window.config.api = {

	"urls" : {
		"getOffers"			: "cms/api/offers",
		"getJobTitles"		: "cms/api/job-titles",
		"getProvinces"		: "cms/api/provinces",
		"getCities"			: "cms/api/cities",
		"postApplication"	: "cms/api/applications"
	}

}