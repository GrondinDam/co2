<?php	header("Content-type: application/json; charset=utf-8"); ?>

var trad = {
"areyousuretodelete" : "<?php echo Yii::t("common", "Are you sure you want to delete") ?>", 
"connection" : "<?php echo Yii::t("common", "connexion") ?>",
"askadminprojects" : "<?php echo Yii::t("common", "You are going to ask to become an admin of the project") ?>",
"askadminorganizations" : "<?php echo Yii::t("common", "You are going to ask to become an admin of the organization") ?>",
"confirm" : "<?php echo Yii::t("common", "Please confirm") ?>",
"removeconnection" : "<?php echo Yii::t("common","Are you sure you want to remove this connection") ?>",
"asmember" : "<?php echo Yii::t("common", "as member") ?>",
"ascontributor" : "<?php echo Yii::t("common", "as contributor") ?>",
"asadmin" : "<?php echo Yii::t("common", "as admin") ?>",
"suretojoinprojects" : "<?php echo Yii::t("common", "Are you sure to join the project") ?>",
"suretojoinorganizations" : "<?php echo Yii::t("common", "Are you sure to join the organization") ?>",
"suretojoinevents" : "<?php echo Yii::t("common", "Are you sure to participate to the event") ?>",
"areyouadmin" : "<?php echo Yii::t("common", "Are you admin") ?>",
"yes" : "<?php echo Yii::t("common","Yes") ?>",
"no" : "<?php echo Yii::t("common","No") ?>",
"cancel" : "<?php echo Yii::t("common","Cancel") ?>",
"removeopinionbefore" : "<?php echo Yii::t("common", "Remove your last opinion before") ?>",
"voteaddedsuccess" : "<?php echo Yii::t("common", "Your vote has been successfully added") ?>",
"voteremovedsuccess" : "<?php echo Yii::t("common","Your vote has been successfully removed") ?>",
"thanktosignalabuse" : "<?php echo Yii::t("common","Thank you ! We are dealing it as quickly as possible. If there is more than 5 report, the news will be hidden") ?>",
"alreadyreportedabuse": "<?php echo Yii::t("common","You already reported this news as abuse") ?>" ,
"askreasonreportabuse": "<?php echo Yii::t("common", "You are going to declare an abuse : please fill the reason")?>",
"delete": "<?php echo Yii::t("common", "Delete")?>", 
"updatepublication": "<?php echo Yii::t("common", "Update publication")?>",
"reportanabuse": "<?php echo Yii::t("common", "Report an abuse")?>",
"You are not following" : "<?php echo Yii::t("common", "You are not following")?>",
"suretodeletenews" : "<?php echo Yii::t("common","Are you sure you want to delete this news") ?>",
"successdeletenews":"<?php echo Yii::t("common","News has been successfully delated") ?>",
"successsavenews":"<?php echo Yii::t("common","News added successfully!") ?>",
"nomorenews":"<?php echo Yii::t("common","No more news") ?>",
"somethingwrong":"<?php echo Yii::t("common","Something went wrong!") ?>",
"tryagain":"<?php echo Yii::t("common","Please try again") ?>",
"wrongwithurl":"<?php echo Yii::t("common","Something went wrong with the url") ?>",
"leaveeventsuccess":"<?php echo Yii::t("common", "You leave successfully this event") ?>",
"leaveeventsuccess":"<?php echo Yii::t("common", "You leave successfully this event") ?>",
"visiblepublic":"<?php echo Yii::t("common","Visible to all and posted on the city's wall")?>",
"visiblerestricted": "<?php echo Yii::t("common","Visible to all on this wall and published on this network")?>",
"visibleprivate": "<?php echo Yii::t("common","Private view")?>",
"voteUp": "<?php echo Yii::t("common","voteUp")?>",
"voteAbstain": "<?php echo Yii::t("common","voteAbstain")?>",
"voteUnclear": "<?php echo Yii::t("common","voteUnclear")?>",
"voteMoreInfo": "<?php echo Yii::t("common","voteMoreInfo")?>",
"voteDown": "<?php echo Yii::t("common","voteDown")?>",
"postalCode" : "<?php echo Yii::t("common","Postal Code"); ?>",
"unknownPostalCode" : "<?php echo Yii::t("common","Unknown Postal Code"); ?>",
"city" : "<?php echo Yii::t("common","City"); ?>",

"administrator" : "<?php echo Yii::t("common","Administrator") ?>",
"member" : "<?php echo Yii::t("common","Member") ?>",
"justCitizen" : "<?php echo Yii::t("common","Just a citizen wanting to give visibility to it :)") ?>",

"addProject" : "<?php echo Yii::t("common","Add a Project") ?>",
"addEvent" : "<?php echo Yii::t("common","Add an Event") ?>",
"addOrganization" : "<?php echo Yii::t("common","Add an Organization") ?>",
"chooseCountry" : "<?php echo Yii::t("common","Choose a country") ?>",
"LoginFirst" : "<?php echo Yii::t("common","Please Login First") ?>",
"mustacceptCGU" : "<?php echo Yii::t("login","You must validate the CGU to sign up.") ?>",
"usernamenotunique" : "<?php echo Yii::t("login","The user name is not unique : please change it.")?>",
"somethingwentwrong" : "<?php echo Yii::t("login","Something went really bad : contact your administrator !")?>",
"suredeletelocality" : "<?php echo Yii::t("common","Are you sure you want to delete the locality")?>",

"udpateorganizer" : "<?php echo Yii::t("event","Update the organizer") ?>",
"organizations" : "<?php echo Yii::t("common","organizations") ?>",
"projects" : "<?php echo Yii::t("common","projects") ?>",
"events" : "<?php echo Yii::t("common","events") ?>",
"organization" : "<?php echo Yii::t("common","organization") ?>",
"project" : "<?php echo Yii::t("common","project") ?>",
"event" : "<?php echo Yii::t("common","event") ?>",


"organizations":"<?php echo Yii::t("common","organizations"); ?>",
"projects":"<?php echo Yii::t("common","projects"); ?>",
"events":"<?php echo Yii::t("common","events"); ?>",
"people":"<?php echo Yii::t("common","people"); ?>",
"citoyens":"<?php echo Yii::t("common","citoyens"); ?>",
"followers":"<?php echo Yii::t("common","followers"); ?>",
"address" : "<?php echo Yii::t("common","Address") ?>",
"classified" : "<?php echo Yii::t("common","classified") ?>",

"Technologie" : "Technologie",
"Immobilier" : "Immobilier",
"Véhicules" : "Véhicules",
"Maison" : "Maison",
"Loisirs" : "Loisirs",
"Mode" : "Mode",

"all" : "Tous", 
"sharing" : "Partager", 
"donation" : "Donner", 
"forsale" : "Vendre",  
"forrent" : "Louer", 
"lookingfor" : "Recherche",  
"job" : "Emplois",

"Project maturity" : "<?php echo Yii::t("project","Project maturity",null,Yii::app()->controller->module->id)?>",
"idea" : "<?php echo Yii::t("project","idea",null,Yii::app()->controller->module->id)?>",
"started" : "<?php echo Yii::t("project","started",null,Yii::app()->controller->module->id)?>", 
"development" : "<?php echo Yii::t("project","development",null,Yii::app()->controller->module->id)?>",
"testing" : "<?php echo Yii::t("project","testing",null,Yii::app()->controller->module->id)?>",

};

var tradCountry = {
	"BE":"Belgique", 
    "FR":"France",
	"GP":"Guadeloupe", 
	"GF":"Guyanne Française",
	"MQ":"Martinique",
	"YT":"Mayotte",
	"NC":"Nouvelle-Calédonie",
	"RE":"La Réunion",
    "PM":"St Pierre et Miquelon",
};